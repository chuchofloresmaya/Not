<?php
require_once "php/conexion.php";
$con = conectar();
session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

}

$ultimo_id = 0;

$con= conectar();
$con1= conectar();

$query1 = "SELECT MAX(c_nocotejo) AS c_nocotejo FROM cotejos;";  
$resultq = mysqli_query($con,$query1);
$ul_id_cotejo = $resultq->fetch_assoc();

//echo $ul_id_cotejo['id_cotejo'];

$queryem = "SELECT id_empresa, e_nombre, id_tiposciedad FROM not190.empresas;";
$resultbusqem = mysqli_query($con, $queryem);

$queryper = "SELECT id_persona, p_nombre FROM not190.personas;";
$resultbusqper = mysqli_query($con, $queryper);

$querysoc = "SELECT id_tiposociedad, t_sociedad FROM not190.tiposociedad;";
$resultbusoc = mysqli_query($con, $querysoc);



$querytam = "SELECT id_hoja, h_tamaño FROM not190.hojas;;";
$resultam = mysqli_query($con, $querytam);
if(isset($_POST['regfam'])){
  $numero_cotejo = $_POST['no_cotejo']+1;

}else{
  $numero_cotejo = $ul_id_cotejo['c_nocotejo']+1;
}


$querylib = "SELECT * FROM not190.cot_libro where inicio <= ".$numero_cotejo." && final >= ".$numero_cotejo.";";
$resultlibro = mysqli_query($con, $querylib);
$filas_libro = mysqli_num_rows($resultlibro);
$libro = $resultlibro->fetch_assoc();


if ($numero_cotejo == $libro['final']) {
$numero_cotejo1 = $numero_cotejo+1;

echo "<center>Último cotejo del libro ".$libro['no_libro']."</center>";
    $querylibn = "SELECT * FROM not190.cot_libro where inicio <= ".$numero_cotejo1." && final >= ".$numero_cotejo1.";";
    $resultlibron = mysqli_query($con, $querylibn);
    $filas_libron = mysqli_num_rows($resultlibron);
    $libron = $resultlibron->fetch_assoc();

//echo "<br> Consultando siguiente fila encontrada ".$filas_libron." --- libro buscado: ".$libron['no_libro'];

if ($filas_libron < 1) {
    $nuevo_l_libro = $libro['no_libro']+1;
    $nuevo_l_inicio = $numero_cotejo+1;
    $nuevo_l_final = $numero_cotejo+900;

    $insert_libro = "INSERT INTO `not190`.`cot_libro` (`id_libro`, `no_libro`, `inicio`, `final`) VALUES ('".$nuevo_l_libro."', '".$nuevo_l_libro."', '".$nuevo_l_inicio."', '".$nuevo_l_final."');";
    $result_insert_cotejo = mysqli_query($con, $insert_libro);
    //echo $insert_libro;
    echo "<center> <br>SE HA INTEGRADO UN NUEVO LIBRO DE COTEJO NÚMERO ".$nuevo_l_libro." EMPIEZA EN EL COTEJO ".$nuevo_l_inicio." TERMINA EN EL COTEJO ".$nuevo_l_final."</center>";

}

}


?>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <!-- Responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>
    
    </head>

    <body>


<?php
include ("nav.php");
?>
</div>

<center><h1 class="display-3">Cotejos</h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-1">Numero de cotejo: 
<br>
  <input name="no_cotejo" id="no_cotejo" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $numero_cotejo; ?> ">
  </div>
  <div class="col-xs-12 col-md-1">Libro: 
<br>
  <input name="no_libro" id="no_libro" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $libro['no_libro']; ?> ">
  </div>
  
  <div class="col-xs-6 col-md-2">Fecha:
   <input class="form-control" type="date" id="fecha" name="fecha" value="<?php $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); echo $date->format("Y-m-d");  ?>">
    <br>
  </div>
 <div class="col-xs-6 col-md-1">
   <label for="name">A solicitud de:<span></span></label><br>
   <input type="radio" name="titulo" value="SI" onchange="titulo_p(this.value);" required> Empresa</br>
   <input type="radio" name="titulo" value="NO" onchange="titulo_p(this.value);" required> Persona</br>
 </div>

   <div class="col-xs-6 col-md-2" id="ano_t" style="display:none;">
    <div class="one_third">            
        <label class="">Nombre de la empresa (Doble Click)</label>        
            <input type="text" name="search_cliente" id='search_cliente' ondblclick="Doble_Clic(this.value)" value="" class="form-control">
    </div>

   </div>
    <div class="col-xs-6 col-md-3" id="objetosocial" style="display:none;">
    <label for="selección2">Objeto Social <span></span></label><br>
    <input id="dni" name="dni" type="text" maxlength="255" value="" class="form-control"/>
    </div>

    <div class="col-xs-6 col-md-3" id="motivos" style="display:none;">
      <label for="selección1">Persona <span></span></label><br>
      <input id="persona" name="persona" type="text" maxlength="255" value=""/>
    </div>

    <div class="col-xs-6 col-md-1"> </div>
    </div>
<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<BR>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-1 ">Tantos solicitados:
    <br><input name="no_tantos" id="no_tantos" placeholder="ej. 2" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="1">
  </div>
  <div class="col-xs-6 col-md-1 ">Numero de fojas:
  <br><input name="no_fojas" id="no_fojas" placeholder="ej. 14" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="1">
  </div>
  <div class="col-xs-6 col-md-2">
  Hoja Anexa
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el folio de DeclaraN" ></span>
  <label><input  type="checkbox" id="hoja_anexa" name="hoja_anexa" value="1" checked> </label>
  <br>Fojas: por un solo lado
  <label><input  type="checkbox" id="sololad" name="sololad" value="1" > </label><br>
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el folio de DeclaraN"></span><br>
  Mostrada: solo anverso
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el folio de DeclaraN"></span>
  <label><input  type="checkbox" id="soloanberso" name="soloanberso" value="1" > </label><br>

</div>
  <div class="col-xs-6 col-md-1 ">Tamaño de hoja: <br>
      <select id="uif_ana" class="btn btn-outline-secondary btn-sm" name="tam_hoja">
            <?php while($rowtam = $resultam->fetch_assoc()) { ?>
                <option value="<?php echo $rowtam['id_hoja']; ?>"><?php echo $rowtam['h_tamaño']; ?></option>
            <?php
            }
            ?>
    </select>
  </div>
    <div class="col-xs-6 col-md-2">
      Seleccione Archivo:
      <label class="btn btn-outline-secondary btn-sm" for="my-file-selector">
        <input type="file" name="file" id="exampleInputFile">
      </label></div>
    <div class="col-xs-6 col-md-5"></div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 "><BR><input type="submit" class="btn btn-success disable" value="Ingresar Cotejo" name="regfam" ></div>
  <div class="col-xs-6 col-md-2"></div>
  <div class="col-xs-6 col-md-2">Copia certificada <input  type="checkbox" id="copia_c" name="copia_c" value="1" ><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Copiac certificada"></span>
  <br>Plano <input  type="checkbox" id="plano" name="plano" value="1" ><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Plano">
  </div>
  <div class="col-xs-6 col-md-8"></div>
  
</div>


        </div>
        </form>

<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->

<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  <script type="text/javascript">
  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });

    $(function() {
     $( "#dni" ).autocomplete({
       source: 'lista_cliente1.php',
     });
  });
        $(function() {
     $( "#persona" ).autocomplete({
       source: 'lista_cliente2.php',
     });
  });
</script>       
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  <script>
    function titulo_p(dato){
        if(dato=='SI'){
            document.getElementById("ano_t").style.display = "block";
            document.getElementById("objetosocial").style.display = "block";
            document.getElementById("motivos").style.display = "none";
            
        }
        if(dato=='NO'){
            document.getElementById("ano_t").style.display = "none";
            document.getElementById("objetosocial").style.display = "none";
            document.getElementById("motivos").style.display = "block";
            
        }

    }

    function Doble_Clic(str) {
      if (str.length == 0) {
        document.getElementById("dni").value = "";
        document.getElementById("direccion").value = "";
        document.getElementById("id_empresa").value = "";
        return;
      }
      else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
                {

          if (this.readyState == 4 && this.status == 200)
                    {
          var myObj = JSON.parse(this.responseText);
          document.getElementById
          ("dni").value = myObj[0];
                document.getElementById(
          "direccion").value = myObj[1];
                document.getElementById(
          "id_empresa").value = myObj[2];
          }
        };
        xmlhttp.open("GET", "busca_dni_dir.php?search_cliente=" + str, true);
        xmlhttp.send();
      }
    }
  </script>
</center>
<br><br>

<?PHP
if(isset($_POST['regfam'])){

    $no_cotejo = $_POST['no_cotejo'];  
    $no_libro = $_POST['no_libro'];
    $no_tantos = $_POST['no_tantos'];
    $no_fojas = $_POST['no_fojas'];
    $fecha = $_POST['fecha'];
    $solicitud = $_POST['titulo'];
  
    $empresa = $_POST['search_cliente'];
    $objetosocial = $_POST['dni'];
    $persona = $_POST['persona'];

    $hoja_anexa = isset($_POST['hoja_anexa']);
    $copia_c = isset($_POST['copia_c']);
    $plano = isset($_POST['plano']);
    $sololad = isset($_POST['sololad']);
    $soloan = isset($_POST['soloanberso']);
    $tam_hoja = $_POST['tam_hoja']; 

    //PARA OBTENER Y SUBIR ARCHIVO
    
    $name=$no_cotejo."-".$_FILES['file']['name'];

    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];
    // $caption1=$_POST['caption'];
    // $link=$_POST['link'];
    $fname = date("YmdHis").'_'.$name;

    

      //echo "<br> Name obtenido ".$name;
      //echo "<br> Fname Generado".$fname;

    //BUSCAR EN LA BASE DE DATOS NOMBRE IGUAL 
    //$chk = $con->query("SELECT * FROM cotejos where name = '".$name."';")->rowCount();

      $queryfile = "SELECT * FROM cotejos where name = '".$name."';";
      $resultfile = mysqli_query($con,$queryfile);
      $chk=mysqli_num_rows($resultfile);
      //echo "chk: .....> ".$chk;

    //
      if ($size >= 1) {
        
      
      if($chk){
        $i = 1;
        $c = 0;
      while($c == 0){
          $i++;
          $reversedParts = explode('.', strrev($name), 2);
          $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
        // var_dump($tname);exit;
          //$chk2 = $con1->query("SELECT * FROM  cotejos where name = '$tname'; ")->rowCount();
              $queryfile1 = "SELECT * FROM cotejos where name = '".$tname."';";
              $resultfile1 = mysqli_query($con,$queryfile1);
              $chk2=mysqli_num_rows($resultfile1);
          if($chk2 == 0){
            $c = 1;
            $name = $tname;
          }
        }
    }
  }




    if ($hoja_anexa <= 0) {
      $hoja_anexa =1;
    }else{
      $hoja_anexa =2;
    }

    if ($sololad <= 0) {
      $sololad =1;
    }else{
      $sololad =2;
    }

    if ($soloan <= 0) {
      $soloan =1;
    }else{
      $soloan =2;
    }

    if ($copia_c <= 0) {
      $copia_c =1;
    }else{
      $copia_c =2;
    }
    
    if ($plano <= 0) {
      $plano =1;
    }else{
      $plano =2;
    }

    if ($solicitud == "SI") {
      
    $filasem = 0;
    $queryem = "SELECT id_empresa, id_tiposciedad FROM not190.empresas where e_nombre = '$empresa';";
    $resultem = mysqli_query($con,$queryem);
    $filasem = mysqli_num_rows($resultem);
    $rowem = $resultem->fetch_assoc();
    

    //echo "Empresas encontradas: ".$filasem;

    if ($filasem<=0) { 
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);

      $filasobs = mysqli_num_rows($resultobs);
      $rowobs = $resultobs->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Objetos social encontrados :".$filasobs;

      if ($filasobs<=0) {
        echo "<br>Ingresar objeto social ".$objetosocial;
        $insert_sociedad = "INSERT INTO `tiposociedad` (`id_tiposociedad`, `t_sociedad`) VALUES (NULL, '".$objetosocial."');";
        $result_insert_sociedad = mysqli_query($con, $insert_sociedad);
        $id_objetosocial =mysqli_insert_id($con);
        //echo "<br>ultimo id  objeto social".$id_objetosocial;
      }else{
        $id_objetosocial = $rowobs['id_tiposociedad'];
        //echo "<br>ID DEL OBJETO SOCIAL ".$id_objetosocial;
      }
      $insert_empresa = "INSERT INTO `not190`.`empresas` (`e_nombre`, `id_tiposciedad`) VALUES ('".$empresa."', '".$id_objetosocial."');";
        $result_insert_empresa = mysqli_query($con, $insert_empresa);
        $id_empresa =mysqli_insert_id($con);

        //echo "<br>ultimo id empresa".$id_empresa;
      //echo "<br>insertando empresa".$id_empresa." ingresando regimen ".$id_objetosocial;
    }elseif ($filasem = 0) {
      //para queno entre en ningun ciclo
    }else{
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);
      $rowobs = $resultobs->fetch_assoc();
      $id_objetosocial = $rowobs['id_tiposociedad'];
      $id_empresa = $rowem['id_empresa'];
      
      //echo "<BR> ID EMPRESA :".$id_empresa." ID TIPO DE SOCIEDAD ".$id_objetosocial;
    }

    $id_persona = "NULL";
  }

if ($solicitud == "NO") {
      $querype = "SELECT id_persona, p_nombre FROM not190.personas where p_nombre = '".$persona."';";
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_persona = "INSERT INTO `not190`.`personas` (`p_nombre`) VALUES ('".$persona."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_persona =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_persona = $rowpe['id_persona'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
      $id_empresa = "NULL";
      $id_objetosocial = "NULL";

}

    

$i = 1;
while ($i <= 1) {
      
      $querymax = "SELECT c_nocotejo FROM not190.cotejos where c_nocotejo = '".$no_cotejo."';";
      $resultmax = mysqli_query($con,$querymax);
      $filamax = mysqli_num_rows($resultmax);
      $rowpe = $resultmax->fetch_assoc();

      if ($filamax<=0) {
                $insert_cotejo = "INSERT INTO `cotejos` (`id_cotejo`, `c_nocotejo`, `c_libro`, `c_hoja`, `c_tantos_soli`, `c_tamaño`, `c_lados`, `c_mostrada`, `c_persona`, `c_empresa`, `c_tiposociedad`, `c_hoja_anexa`, `copia`, `plano`,  `c_fecha`, `fname`, `name`, `id_usuario3`) VALUES (NULL, '".$no_cotejo."', '".$no_libro."', '".$no_fojas."', '".$no_tantos."', '".$tam_hoja."', '".$sololad."', '".$soloan."',  ".$id_persona.", ".$id_empresa.", ".$id_objetosocial.", '".$hoja_anexa."', '".$copia_c."', '".$plano."', '".$fecha."','".$fname."', '".$name."', '".$user."');";

        $result_insert_cotejo = mysqli_query($con, $insert_cotejo);  
        //echo $insert_cotejo;

        echo "<br>COTEJO NO.: ".$no_cotejo."------  DISPONIBLE<br>";

        $move =  move_uploaded_file($temp,"upload/".$fname);
        $i = 2;

      }else{
        echo "COTEJO NO.: ".$rowpe['c_nocotejo']."------ OCUPADO <br>";
        $no_cotejo++;
      }
}  

?>

<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-1">Cotejo y Libro</th>
      <th class="col-2">Empresa o Persona</th>
      <th class="col-1">Tantos y Fojas </th>
      <th class="col-1">Fecha </th>
      <th class="col-2">Lados, Mostrada y tamaño de hoja</th>
      <th class="col-1">Generar Certificación </th>
      <th class="col-1">Archivo </th>
      <th class="col-1">Usuario</th>
      
    </tr>
  </thead>

<?PHP
    $queryfam = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, c_fecha, fname, name ,id_usuario3, u_nombre FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario order by id_cotejo DESC LIMIT 10;";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td>No.Cotejo: <b> <?php echo $rowfam['c_nocotejo'] ?></b><br> Libro: <b><?php echo $rowfam['c_libro'] ?> </b></td>
      <td><?php echo $rowfam['p_nombre'] ?> <?php echo $rowfam['e_nombre'] ?> <?php echo $rowfam['t_sociedad'] ?></td>
      <td>Tantos: <b><?php echo $rowfam['c_tantos_soli']+1; ?></b> <br> Fojas: <b><?php echo $rowfam['c_hoja'] ?></b></td>
      <td><?php echo $rowfam['c_fecha'] ?></td>
      <td>fojas, Por <b><?php echo $rowfam['l_lado'] ?></b>... <br> me fue mostrada al <b><?php echo $rowfam['m_lados'] ?></b><br> Tamaño:  <b> <?php echo $rowfam['h_tamaño'] ?></td>
      <td>
        <button class="alert-success"><a href="certificacion_cotejo-<?php echo $rowfam['c_tamaño'];?>.php?idcot=<?php echo $rowfam['id_cotejo'];?>">Certificación</a></button>
      </td>
      <td>
        <button class="alert-success"><a href="download.php?filename=<?php echo $rowfam['name'];?>&f=<?php echo $rowfam['fname']; ?>">Archivo</a></button><br>
        <?php echo $rowfam['name'] ?>
      </td>
      <td>
        <?php echo $rowfam['u_nombre'] ?>
      </td>

      
    </tr>


<?PHP


        }
?>
  </tbody>
</table>
<?PHP
}

?>
    
<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS DEL NOMBRE DE CLIENTE -->
      
<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  
<script type="text/javascript">
  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });
</script>       
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  <script>

    function Doble_Clic(str) {
      if (str.length == 0) {
        document.getElementById("dni").value = "";
        document.getElementById("direccion").value = "";
        document.getElementById("id_empresa").value = "";
        return;
      }
      else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
                {

          if (this.readyState == 4 && this.status == 200)
                    {
          var myObj = JSON.parse(this.responseText);
          document.getElementById
          ("dni").value = myObj[0];
                document.getElementById(
          "direccion").value = myObj[1];
                document.getElementById(
          "id_empresa").value = myObj[2];
          }
        };
        xmlhttp.open("GET", "busca_dni_dir.php?search_cliente=" + str, true);
        xmlhttp.send();
      }
    }
  </script>

    </script> 
</body>
</BR>
</html>