<?php
require_once "php/conexion.php";
$con = conectar();
$con1= conectar();

session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

}
?>


<?php
$no_exp = $_GET['no_exp'];

include ("nav.php");

?>

 <ul class="list-group">
   <li class="list-group-item">


<?php 
require_once "php/conexion.php";
$con = conectar();

$querycivil = "SELECT id_estado, estado_civil FROM not190.estados_civiles;";
$resultcivil = mysqli_query($con, $querycivil);

while($rowcivil = $resultcivil->fetch_assoc()) {
      $id_civil = $rowcivil['id_estado']; 
      $estado_civil = $rowcivil['estado_civil'];

$c[] = $rowcivil['estado_civil'];
}

$querymes = "SELECT id_compareciente, compareciente FROM not190.tipo_comparecinetes;";
$resultadomes = mysqli_query($con, $querymes);
//echo "$querymes";

while($rowproyec = $resultadomes->fetch_assoc()) {
      $id_proyectista = $rowproyec['id_compareciente']; 
      $a[] = $rowproyec['compareciente'];
}

$querydocid = "SELECT id_documento, tipo_identificacion FROM not190.documentos_identificacion;";
$resultadodocid = mysqli_query($con, $querydocid);

while($rowdocid = $resultadodocid->fetch_assoc()) {
      $id_compareciente = $rowdocid['id_documento']; 
      $tipo_identificacion = $rowdocid['tipo_identificacion'];
$b[] = $rowdocid['tipo_identificacion'];
}
?>


<center><h1 class="display-3">Ingresar compareciente</h1></center><br><br>
<form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?><?php echo "?no_exp=".$no_exp ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2">


    <input type="hidden" name="no_exp" value="<?php echo $no_exp; ?>">   
    Tipo de compareciente<br>
          <select id="id_tipo_compareciente" name="id_tipo_compareciente" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        <?php 
        foreach ($a as $l => $w) {
        $l++;
        if ($l != $fila_exp['id_compareciente']) {
          echo "<option value=".$l.">".$w."</option>";
        }
        }                                       
        ?>
        </select>
  </div>
</div>


  <div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  
<div class="col-xs-6 col-md-1">
   <label for="name">Sexo:<span></span></label><br>
   <input type="radio" name="id_sexo" value="1" required> Hombre</br>
   <input type="radio" name="id_sexo" value="2" required> Mujer</br>
</div>


 <div class="col-xs-6 col-md-3" id="ano_t">
      <label class="">Nombre (Doble Click en caso de ya estar registrado)</label>        
      <input type="text" name="nombre_comp" id='nombre_comp' ondblclick="Doble_Clic(this.value)" value="" class="form-control"><br>
    </div>

    <div class="col-xs-6 col-md-1" id="nacionalidad" >
      <label for="name">Originario (a):<span></span></label><br>
      <input type="radio" name="nacionalidad" id="nacionalidad_mexicano" value="mexicano" onchange="nacionalidad_rad(this.value);">
      <label for="nacionalidad_mexicano">Mexico</label><br>

      <input type="radio" name="nacionalidad" id="nacionalidad_extranjero" value="extranjero" onchange="nacionalidad_rad(this.value);">
      <label for="nacionalidad_extranjero">Extranjero</label><br>
    </div>

    <div class="col-xs-6 col-md-2" id="mexicano" style="display:none;">
        <label for="selección2">Estado de Origen<span></span></label><br>
        <input id="estado" name="estado" type="text" maxlength="255" value="" class="form-control"/>
    </div>

    <div class="col-xs-6 col-md-2" id="extangero" style="display:none;">
        <label for="selección2">Pais de Origen<span></span></label><br>
        <input id="pais" name="pais" type="text" maxlength="255" value="" class="form-control"/>
    </div>
    <div class="col-xs-6 col-md-2" id="fecha_termino" >Fecha de nacimiento
       <input class="form-control" type="date" id="fecha_nacimeinto" name="fecha_nacimeinto">
    </div>
</div>



  <div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  
<div class="col-xs-6 col-md-3" id="fecha_tramite" >Hijo de padres: 
   <input class="form-control" type="text" id="hijo_a_padres" name="hijo_a_padres" placeholder="mexicanos">
</div>  

<div class="col-xs-6 col-md-3" id="fecha_termino" >Oucpacion
  <input class="form-control" type="text" id="ocupacion" name="ocupacion" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="asalariado">
</div>

<div class="col-xs-6 col-md-3" id="fecha_termino" >Dirección:<br>
  <input class="form-control" type="text" id="domicilio" name="domicilio" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Calle">
  <br>Numero: (si no tiene dejar en blanco)<br>
  <input class="form-control" type="text" id="numero" name="numero" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Ejemplo:    '516 con numero interior 5'">

  <br>Colonia:<br>
  <input class="form-control" type="text" id="colonia" name="colonia" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Colonia">

  <br>C.P.:<br>
  <input class="form-control" type="text" id="CP" name="CP" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="C.P.">
</div>
</div>
  
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  
<div class="col-xs-6 col-md-2">
    <br>CURP<br>
    <input class="form-control" type="text" id="curp" name="curp">                 
    <br>RFC<br>
    <input class="form-control" type="text" id="rfc" name="rfc">              
    <br>
</div>


<div class="col-xs-6 col-md-3" id="ano_t">
    <br>Documento de identificación<br>
          <select id="doc_identificacion" name="doc_identificacion" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        <?php 
        foreach ($b as $k => $v) {
        $k++;
        if ($k != $fila_exp['id_documento']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>    
    <br><br>No identificador:<br>
   <input class="form-control" type="text" id="no_identificacion" name="no_identificacion">             
</div>

    <div class="col-xs-6 col-md-1" id="" >
      <br>
      <br>
      <br>
    <input type="submit" class="btn btn-success disable" value="Ingresar Compareciente" name="regfam" >
    </div>
    

    

  <div class="col-xs-6 col-md-2" id="fecha_termino" > 
  </div>
  <div class="col-xs-6 col-md-2" id="fecha_termino" >  
  
  </div>



  <div class="row" id="" >
  </div>
</div>




	</li>
 </ul> 
</div></form>
<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->

<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  <script type="text/javascript">

    
      function nacionalidad_rad(valor) {
        if (valor == "mexicano") {
          document.getElementById("extangero").style.display = "none";
          document.getElementById("mexicano").style.display = "block";
        } else if (valor == "extranjero") {
          document.getElementById("extangero").style.display = "block";
          document.getElementById("mexicano").style.display = "none";
        }
      }



  $(function() {
     $( "#nombre_comp" ).autocomplete({
       source: 'lista_nombre.php',
     });
  });

  $(function() {
     $( "#estado" ).autocomplete({
       source: 'lista_estados.php',
     });
  });

  $(function() {
     $( "#pais" ).autocomplete({
       source: 'lista_paises.php',
     });
  });

  $(function() {
     $( "#hijo_a_padres" ).autocomplete({
       source: 'lista_hijo_padres.php',
     });
  });

  $(function() {
     $( "#ocupacion" ).autocomplete({
       source: 'lista_ocupaciones.php',
     });
  });
  $(function() {
     $( "#domicilio" ).autocomplete({
       source: 'lista_domicilio.php',
     });
  });
  $(function() {
     $( "#colonia" ).autocomplete({
       source: 'lista_colonia.php',
     });
  });


</script>       
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  <script>
    function Doble_Clic(str) {
      if (str.length == 0) {
        document.getElementById("hijo_a_padres").value = "";
        document.getElementById("ocupacion").value = "";
        document.getElementById("id_tipo_compareciente").value = "";
        
        document.getElementById("fecha_nacimeinto").value = "";
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
          ("hijo_a_padres").value = myObj[0];
          document.getElementById(
          "ocupacion").value = myObj[1];
          document.getElementById(
          "id_tipo_compareciente").value = myObj[2];
          document.getElementById(
          "fecha_nacimeinto").value = myObj[3];
          document.getElementById(
          "estado").value = myObj[4];          
          
//para auto selecionar el radio buton
//document.addEventListener("DOMContentLoaded", function(event) {document.getElementById(myObj[4]).checked = true;});
          }
        };
        xmlhttp.open("GET", "busca_dni_dir1.php?nombre_comp=" + str, true);
        xmlhttp.send();


      }
    }
  </script>

<?php

  if(!empty($_POST["regfam"])) {
    
    $id_tipo_compareciente  = $_POST['id_tipo_compareciente'];  
    $id_sexo  = $_POST['id_sexo'];  
    $nombre_comp  = $_POST['nombre_comp'];  
    $nacionalidad  = $_POST['nacionalidad'];
    $fecha_nacimiento  = $_POST['fecha_nacimeinto'];
    $hijo_a_padres  = $_POST['hijo_a_padres'];
    $ocupacion  = $_POST['ocupacion'];
    $domicilio  = $_POST['domicilio'];
    $numero  = $_POST['numero'];
    $colonia  = $_POST['colonia'];    
    $CP  = $_POST['CP'];
    $curp  = $_POST['curp'];
    $rfc  = $_POST['rfc'];
    $doc_identificacion  = $_POST['doc_identificacion'];
    $no_identificacion  = $_POST['no_identificacion'];

    /* echo "tipo compareciente: $id_tipo_compareciente <br>
    Id sexo: $id_sexo <br>
    nombre_comp: $nombre_comp <br>
    Nacionalidad: $nacionalidad <br>
    Fecha de nacimiento: $fecha_nacimiento <br>
    Hijo de padres: $hijo_a_padres <br>
    Ocupacion: $ocupacion <br>
    Domicilio: $domicilio <br>
    Número: $numero <br>
    Colonia: $colonia <br>
    CP: $CP <br>
    CURP: $curp <br>
    RFC: $rfc <br>
    Documento de identificacion: $doc_identificacion <br>
    Numero de identificacion: $no_identificacion <br>"; */

      $querynom_comp = "SELECT * FROM `nombres_comparecientes` WHERE nombre_com = '".$nombre_comp."';";
      $resultnom_comp = mysqli_query($con,$querynom_comp);

      $filasnom_comp = mysqli_num_rows($resultnom_comp);
      $rownom_comp = $resultnom_comp->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filasnom_comp<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_nom_comp = "INSERT INTO `not190`.`nombres_comparecientes` (`nombre_com`) VALUES ('".$nombre_com."');";
        $result_insert_nom_comp = mysqli_query($con, $insert_nom_comp);
        $nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $nombre_com = $rownom_comp['nombre_com'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }



      $querynom_comp = "SELECT * FROM `nombres_comparecientes` WHERE nombre_com = '".$nombre_comp."';";
      $resultnom_comp = mysqli_query($con,$querynom_comp);

      $filasnom_comp = mysqli_num_rows($resultnom_comp);
      $rownom_comp = $resultnom_comp->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filasnom_comp<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_nom_comp = "INSERT INTO `not190`.`nombres_comparecientes` (`nombre_com`) VALUES ('".$nombre_com."');";
        $result_insert_nom_comp = mysqli_query($con, $insert_nom_comp);
        $nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $nombre_com = $rownom_comp['nombre_com'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
//Ingresar el nombre

      $querynom_comp = "SELECT * FROM `nombres_comparecientes` WHERE nombre_com = '".$nombre_comp."';";
      $resultnom_comp = mysqli_query($con,$querynom_comp);

      $filasnom_comp = mysqli_num_rows($resultnom_comp);
      $rownom_comp = $resultnom_comp->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filasnom_comp<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_nom_comp = "INSERT INTO `not190`.`nombres_comparecientes` (`nombre_com`) VALUES ('".$nombre_com."');";
        $result_insert_nom_comp = mysqli_query($con, $insert_nom_comp);
        $nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $nombre_com = $rownom_comp['nombre_com'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }


      $querynom_comp = "SELECT id_nombre_compareciente, nombre_com FROM `nombres_comparecientes` WHERE nombre_com = '".$nombre_comp."';";
      $resultnom_comp = mysqli_query($con,$querynom_comp);

      $filasnom_comp = mysqli_num_rows($resultnom_comp);
      $rownom_comp = $resultnom_comp->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filasnom_comp<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_nom_comp = "INSERT INTO `not190`.`nombres_comparecientes` (`nombre_com`) VALUES ('".$nombre_com."');";
        $result_insert_nom_comp = mysqli_query($con, $insert_nom_comp);
        $nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $nombre_com = $rownom_comp['id_nombre_compareciente'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($nacionalidad == "mexicano") {
            $estado  = $_POST['estado'];
            //echo "<br>$estado <br>";
            $queryestado = "SELECT id_estado, estado FROM not190.estados WHERE estado = '".$estado."';";
            $resultestado = mysqli_query($con,$queryestado);

            $filasestado = mysqli_num_rows($resultestado);
            $rowestado = $resultestado->fetch_assoc();

            //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
            //echo "<br> Persona encontrada encontrados :".$filaspe;
          if ($filasestado<=0) {
              //echo "<br>Ingresar persona ".$persona;
              $insert_estado = "INSERT INTO `not190`.`estados` (`estado`) VALUES ('".$estado."');";
              $result_insert_estado = mysqli_query($con, $insert_estado);
              $id_estado =mysqli_insert_id($con);
              $id_pais = 'null';
              //echo "<br>ultimo id  person".$id_persona;
            }else{
              $id_estado = $rowestado['id_estado'];
              $id_pais = 'null';
              //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
            }

      }else{
            $pais  = $_POST['pais'];
            $querypais = "SELECT id_pais, paises FROM not190.paises WHERE paises = '".$pais."';";
            $resultpais = mysqli_query($con,$querypais);

            $filaspais = mysqli_num_rows($resultpais);
            $rowpais = $resultpais->fetch_assoc();

          if ($filaspais<=0) {
              //echo "<br>Ingresar persona ".$persona;
              $insert_pais = "INSERT INTO `not190`.`paises` (`paises`) VALUES ('".$pais."');";
              $result_insert_pais = mysqli_query($con, $insert_pais);
              $id_pais =mysqli_insert_id($con);
              //echo "<br>ultimo id  person".$id_persona;
              $id_estado = 'null';
            }else{
              $id_pais = $rowestado['id_estado'];
              $id_estado = 'null';
              //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
            }        
      }


      $queryhijo_padres = "SELECT id_nacionalidad, nacionalidad FROM not190.nacionalidades_padres WHERE nacionalidad = '".$hijo_a_padres."';";
      $resulthijo_padres = mysqli_query($con,$queryhijo_padres);

      $filashijo_padres = mysqli_num_rows($resulthijo_padres);
      $rowhijo_padres = $resulthijo_padres->fetch_assoc();

    if ($filashijo_padres<=0) {
       //echo "<br>Ingresar persona ".$persona;
       $insert_hijo_padres = "INSERT INTO `not190`.`nacionalidades_padres` (`nacionalidad`) VALUES ('".$hijo_a_padres."');";
       $result_insert_hijo_padres = mysqli_query($con, $insert_hijo_padres);
       $hijo_a_padres =mysqli_insert_id($con);
       //echo "<br>ultimo id  person".$id_persona;
    }else{
       $hijo_a_padres = $rowhijo_padres['id_nacionalidad'];
       //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
   }        


      $queryocupacion = "SELECT id_ocupacion, ocupacion FROM not190.ocupaciones_comp WHERE ocupacion = '".$ocupacion."';";
      $result_ocupacion = mysqli_query($con,$queryocupacion);

      $filas_ocupacion = mysqli_num_rows($result_ocupacion);
      $row_ocupacion = $result_ocupacion->fetch_assoc();

    if ($filas_ocupacion <= 0) {
       //echo "<br>Ingresar persona ".$persona;
       $insert_ocupacion = "INSERT INTO `not190`.`ocupaciones_comp` (`ocupacion`) VALUES ('".$ocupacion."');";
       $result_insert_ocupacion = mysqli_query($con, $insert_ocupacion);
       $ocupacion =mysqli_insert_id($con);
       //echo "<br>ultimo id  person".$id_persona;
    }else{
       $ocupacion = $row_ocupacion['id_ocupacion'];
       //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
   }        


      $querydom = "SELECT id_domicilio, domicilio FROM not190.domicilio_comp WHERE domicilio = '".$domicilio."';";
      $result_dom = mysqli_query($con,$querydom);

      $filas_dom = mysqli_num_rows($result_dom);
      $row_dom = $result_dom->fetch_assoc();

    if ($filas_dom <= 0) {
       //echo "<br>Ingresar persona ".$persona;
       $insert_dom = "INSERT INTO `not190`.`domicilio_comp` (`domicilio`) VALUES ('".$domicilio."');";
       $result_insert_dom = mysqli_query($con, $insert_dom);
       $domicilio =mysqli_insert_id($con);
       //echo "<br>ultimo id  person".$id_persona;
    }else{
       $domicilio = $row_dom['id_domicilio'];
       //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
   }        


      $querycolonia = "SELECT id_colonia, colonia_comp FROM not190.colonias where colonia_comp = '".$colonia."';";
      $result_colonia = mysqli_query($con,$querycolonia);

      $filas_colonia = mysqli_num_rows($result_colonia);
      $row_colonia = $result_colonia->fetch_assoc();

    if ($filas_ocupacion <= 0) {
       //echo "<br>Ingresar persona ".$persona;
       $insert_ocupacion = "INSERT INTO `not190`.`colonias` (`colonia_comp`) VALUES ('".$colonia."');";
       $result_insert_ocupacion = mysqli_query($con, $insert_ocupacion);
       $domicilio =mysqli_insert_id($con);
       //echo "<br>ultimo id  person".$id_persona;
    }else{
       $domicilio = $row_colonia['id_colonia'];
       //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
   }        




  echo "INSERT INTO `compareciente` (`id_compreciente`, `id_exp`, `id_tipo_compareciente`, `id_sexo`, `nombre_com`, `nacionalidad`, `lugar_nacimiento`, `id_estado`, `id_pais`, `fecha_nacimeinto`, `hijo_a_padres`, `ocupacion`, `domicilio`, `numero`, `colonia`, `cp`, `estado_civil`, `nombre_conyuge`, `curp`, `rfc`, `doc_identificacion`, `no_identificacion`, `id_usu`, `fech_usu`) VALUES (NULL, '$id_exp', '$id_tipo_compareciente', '$id_sexo', '$nombre_com', '$nacionalidad', NULL, '$id_estado', '$id_pais', '$fecha_nacimiento', '$hijo_a_padres', '$ocupacion', '$domicilio', '$numero', '$colonia', '$CP', NULL, NULL, '$curp', '$rfc', '$doc_identificacion', '$no_identificacion', '$user', '2023-04-14 16:09:45');";

/*
id_exp  --------------
id_tipo_compareciente-
id_sexo---------------
nombre_com------------
nacionalidad----------
lugar_nacimiento------
id_estado-------------
id_pais---------------
fecha_nacimeinto------
hijo_a_padres---------
ocupacion-------------
domicilio-------------
numero----------------
colonia---------------
cp
estado_civil
curp
rfc
doc_identificacion
no_identificacion
*/
 

  //INSERT INTO `compareciente` (`id_compreciente`, `id_exp`, `id_tipo_compareciente`, `id_sexo`, `nombre_com`, `nacionalidad`, `lugar_nacimiento`, `id_estado`, `id_pais`, `fecha_nacimeinto`, `hijo_a_padres`, `ocupacion`, `domicilio`, `numero`, `colonia`, `cp`, `estado_civil`, `nombre_conyuge`, `curp`, `rfc`, `doc_identificacion`, `no_identificacion`, `id_usu`, `fech_usu`) VALUES (NULL, '20', '3', '3', '1', '1', NULL, '1', NULL, '1996-05-28', '1', '1', '1', '516', '1', '50200', NULL, NULL, 'FOMJ960528HMCLYS03', 'FOMJ9605282K3', '1', 'IDMEX1273276350', '1', '2023-04-14 16:09:45');
  }
?>