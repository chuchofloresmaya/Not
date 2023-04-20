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

$querymes = "SELECT id_oficina, oficina FROM not190.clg_oficinas;";
$resultadomes = mysqli_query($con, $querymes);

while($rowproyec = $resultadomes->fetch_assoc()) {
      $id_proyectista = $rowproyec['id_oficina']; 
      $nombre = $rowproyec['oficina'];

$a[] = $rowproyec['oficina'];
}

$queryactos = "SELECT * FROM not190.exp_actos;";
$resultactos = mysqli_query($con, $queryactos);

while($rowacto = $resultactos->fetch_assoc()) {
      $acto = $rowacto['acto'];

$actos[] = $rowacto['acto'];
}
$no_exp = $_GET['id_exp'];


$query_exp = "SELECT id_expediente, observaciones_1, clg_tipo, exp.id_clg as tradi_clg_id,clg_auto_folio_real, folio_real, ofi_clg.oficina as oficina, tradi.id_oficina as id_oficina, tradi.ubicacion_inmueble, propietario.nombre as propietario,
tradi.id_acto, tradi_acto.actos, comprador.nombre as comprador, tradi_institu.institucion as institucion, tradi.id_institucion_clg_tradi, tradi.medidas_colindancias, clg_tradi_tramite, clg_tradi_termino,
clave_valor, no_adeudo_predial, no_adeudo_agua, zonificacion, observaciones_2, tradi.clave_catastral
FROM not190.expediente as exp
inner join proyectistas on proyectistas.id_proyectista = exp.id_proyectista 
inner join usuarios as p on p.idusuario = proyectistas.id_usuario 
left join exp_institucion as exp_institu on exp_institu.id_institucion = exp.id_institucion 
inner join usuarios as u on u.idusuario = exp.id_usuario_n_exp 
left join clg_tipo on clg_tipo.id_clg_tipo = exp.id_clg
left join clg_tradicional as tradi on tradi.id_clg = exp.id_clg_tradicional
left join clg_actos as tradi_acto on tradi.id_acto = tradi_acto.id_clg_acto
left join exp_institucion as tradi_institu on tradi_institu.id_institucion = tradi.id_institucion_clg_tradi 
left join clg_oficinas as ofi_clg on tradi.id_oficina = ofi_clg.id_oficina
left join nombres_expedientes as propietario on tradi.id_propietario = propietario.id_nombre
left join nombres_expedientes as comprador on tradi.id_comprador = comprador.id_nombre
where id_expediente = ".$no_exp.";";

$result_exp = mysqli_query($con, $query_exp);
$fila_exp = $result_exp->fetch_assoc();

$queryinstitucion = "SELECT * FROM not190.exp_institucion;";
$resultinstitucion = mysqli_query($con, $queryinstitucion);

while($rowinstitucion = $resultinstitucion->fetch_assoc()) {
      $institucion = $rowinstitucion['institucion'];

    $ins[] = $rowinstitucion['institucion'];
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

<center><h1 class="display-3">Previos Expediente No.: <?php echo $no_exp ?></h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?><?php echo "?id_exp=".$no_exp ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
  <input type="hidden" name="no_exp" value="<?php echo $no_exp; ?>">   
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-1">
   <label for="name"><h3>CLG:</h3><span></span></label><br>
   <input type="radio" name="titulo" value="SI" onchange="titulo_p(this.value);" required> Tradicional</br>
   <input type="radio" name="titulo" value="NO" onchange="titulo_p(this.value);" required> Automatizado</br>
   <input type="radio" name="titulo" value="Pendiente" onchange="titulo_p(this.value);" required> Pendiente</br>
   <?php 
   if ($fila_exp['tradi_clg_id'] >= 1) {
     echo "<br> Para modificar CLG seleccione: ".$fila_exp['clg_tipo'];
   } 
   ?>
 </div>
</div>



<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
   <div class="col-xs-6 col-md-2" id="ano_t" style="display:none;">
    <div class="col-xs-6 col-md-1"><h3>CLG TRADICIONAL</h3>
    </div>

   </div>
  <div class="col-xs-6 col-md-3" id="ubicacion" style="display:none;"><h3>Folio real electronico:</h3>
      <input class="form-control" type="text" id="folio_real" name="folio_real" value="<?php echo $fila_exp['folio_real'] ?>">
  </div>
    <div class="col-xs-6 col-md-2" id="fechas" style="display:none;">
      <div class="col-xs-6 col-md-2" id="fecha_tramite"><br>Fecha de ingreso:
   <input class="form-control" type="date" id="clg_fecha_tramite" name="clg_fecha_tramite" value="<?php echo $fila_exp['clg_tradi_tramite'] ?>">
    <br>
  </div>
<div class="col-xs-6 col-md-2" id="fecha_termino"><br>Fecha de egreso:
   <input class="form-control" type="date" id="clg_fecha_termino" name="clg_fecha_termino" value="<?php echo $fila_exp['clg_tradi_termino'] ?>">
    <br>
  </div>  
  </div>

</div>


<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-4" id="motivos" style="display:none;"><h3>CLG AUTOMATIZADO</h3>
      <label for="selección1">Ingresar folio real <span></span></label><br>
      <input id="auto_folio_real" name="auto_folio_real" type="text" maxlength="255" value="<?php echo $fila_exp['clg_auto_folio_real'];?>" class="form-control"/>
  </div>  

</div>
<div class="row">
    <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-2">Selecionar Ofina
          <select id="select_oficina" name="select_oficina" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        <option >Oficina</option>
        <?php 
        foreach ($a as $k => $v) {
        $k++;
        if ($k != $fila_exp['id_oficina']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>


</div>
  <div class="col-xs-6 col-md-2" id="">Ubicacion de vivienda (en Mayusculas):
      <textarea rows="6" cols="60" name="ubicacion_vivienda" form="formulario_sec"><?php echo $fila_exp['ubicacion_inmueble'] ?></textarea>
  </div>
    <div class="col-xs-6 col-md-2" id=""></div>
</div>


<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-3" id="propietario">Propietario:
      <input class="form-control" type="text" id="tpropietario" name="tpropietario" value="<?php echo $fila_exp['propietario'] ?>"><br>
      Comprador:<br>
      <input class="form-control" type="text" id="tcomprador" name="tcomprador" value="<?php echo $fila_exp['comprador'] ?>">      
  </div>
    <div class="col-xs-6 col-md-3" id="comprador">Clave Catastral:<br>
      <input class="form-control" type="text" id="clave_catastral" name="clave_catastral" value="<?php echo $fila_exp['clave_catastral'] ?>">
  </div>
    <div class="col-xs-6 col-md-2" id="institucion">
        Acto Juridico<br>
        <select name="acto" id="acto" class="form-control">
          <option value=""> Acto...</option>
                <?php 
                foreach ($actos as $k => $v) {
                $k++;
                if ($k != $fila_exp['id_acto']) {
                echo "<option value=".$k.">".$v."</option>";
                }else{
                echo "<option selected value=".$k.">".$v."</option>";
                }
                } 
               ?>
        </select>                
      <BR>Institución: <br>
                <select name="pais" id="pais" class="form-control">
                    <option value=""> Institucion...</option>
                    <?php 
                    foreach ($ins as $i => $n) {
                    $i++;
                    
                    if ($i != $fila_exp['id_institucion_clg_tradi']) {
                    echo "<option value=".$i.">".$n."</option>";   
                    }else{
                    echo "<option selected value=".$i.">$i".$n."</option>";   
                    }
                    } 
                    ?>
                </select>
  </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-4" id="medidas_colindancias">Medidas y conlindancias:
      <textarea rows="6" cols="80" name="medidas_colindancias2" form="formulario_sec"><?php echo $fila_exp['medidas_colindancias'] ?></textarea>
  </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2"><br><br><h3>Certificaciones</h3>
  </div>
  <div class="col-xs-6 col-md-2"><br><br>Clave y valor catastral:
      <br><input  type="checkbox" id="clave_valor" name="clave_valor" value="1" <?php if ($fila_exp['clave_valor']>=1) echo "checked";?>>
      <br>No adeudo de predial y mejora
      <br><input  type="checkbox" id="no_adeudo_predial" name="no_adeudo_predial" value="1" <?php if ($fila_exp['no_adeudo_predial']>=1) echo "checked";?>>
      <br>No adeudo de agua o no servicio
      <br><input  type="checkbox" id="no_adeudo_agua" name="no_adeudo_agua" value="1" <?php if ($fila_exp['no_adeudo_agua']>=1) echo "checked";?>>
      <br>Zonificación
      <br><input  type="checkbox" id="zonificacion" name="zonificacion" value="1" <?php if ($fila_exp['zonificacion']>=1) echo "checked";?>>
  </div>
    <div class="col-xs-6 col-md-2">Observaciones:
    <textarea rows="6"cols="40" name="observaciones_previa" form="formulario_sec"  ><?php echo $fila_exp['observaciones_2'];?></textarea>
    </div>  
    <div class="col-xs-6 col-md-2"><p>Observaciones de Apertura:</p>
    <p>
      <?php echo $fila_exp['observaciones_1'];?>
    </p>
    <p>Observaciones de Previa:</p>
    <p>
      <?php echo $fila_exp['observaciones_2'];?>
    </p>    
    </div>
 </div> 
<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<BR>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>


  <div class="col-xs-6 col-md-2"><input type="submit" class="btn btn-success disable" value="Ingresar Previos" name="regfam" ></div>
    <div class="col-xs-6 col-md-2">

  </div>
      
    </div>
</div>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2"></div>
  <div class="col-xs-6 col-md-2">
  </div>
  <div class="col-xs-6 col-md-8"></div>
  
</div>


        </div>
        </form>
  <script type="text/javascript">
    $(function() {
     $( "#vendedor" ).autocomplete({
       source: 'lista_personas_exp.php',
     });
  });
    $(function() {
     $( "#tcomprador" ).autocomplete({
       source: 'lista_personas_exp.php',
     });
  });
    $(function() {
     $( "#tpropietario" ).autocomplete({
       source: 'lista_personas_exp.php',
     });
  });
</script> 
<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->
  <script>
    function titulo_p(dato){
        if(dato=='SI'){
            document.getElementById("ano_t").style.display = "block";                      
            document.getElementById("motivos").style.display = "none";
            document.getElementById("ubicacion").style.display = "block";
        }
        if(dato=='NO'){
            document.getElementById("ano_t").style.display = "none";             
            document.getElementById("motivos").style.display = "block";
            document.getElementById("ubicacion").style.display = "none";            
        }
        if(dato=='Pendiente'){
            document.getElementById("ano_t").style.display = "none";             
            document.getElementById("motivos").style.display = "none";
            document.getElementById("ubicacion").style.display = "none";            
        }        
        
    }
</script>
<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  

   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  
</center>
<br><br>

<?PHP
if(isset($_POST['regfam'])){

    $no_exp = $_POST['no_exp'];  
    $tipo_clg = $_POST['titulo'];  
    $select_oficina = $_POST['select_oficina'];  
    $ubicacion_vivienda = $_POST['ubicacion_vivienda'];
    $folio_real = $_POST['folio_real'];
    $propietario = $_POST['tpropietario'];
    $acto = $_POST["acto"];  
    $comprador = $_POST['tcomprador'];
    $institucion = $_POST["pais"];
    $medidas_colindancias = $_POST["medidas_colindancias2"];
    $clg_fecha_tramite = $_POST["clg_fecha_tramite"];
    $clg_fecha_termino = $_POST["clg_fecha_termino"];
    $auto_folio_real = $_POST["auto_folio_real"];
    $clave_valor = isset($_POST["clave_valor"]);
    $no_adeudo_predial = isset($_POST["no_adeudo_predial"]);
    $no_adeudo_agua = isset($_POST["no_adeudo_agua"]);
    $zonificacion = isset($_POST["zonificacion"]);
    $observaciones_previa = $_POST["observaciones_previa"];
    $clave_catastral = $_POST["clave_catastral"];


    if ($institucion <= 0) {
      $institucion = "null";
    }
    if ($acto <= 0) {
      $acto = "null";
    }    
   if ($clave_valor < 1) {
      $clave_valor = "null";
    }
    if ($no_adeudo_predial < 1) {
      $no_adeudo_predial = "null";
    }
    if ($no_adeudo_agua < 1) {
      $no_adeudo_agua = "null";
    }
    if ($zonificacion < 1) {
      $zonificacion = "null";
    }

    if ($select_oficina == "Oficina") {
      $select_oficina = "null";
    }

  $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); //echo $date->format("Y-m-d H:i:s");


      $querype = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$propietario."';";
      //echo $querype;
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_persona = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$propietario."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_propietario =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_propietario = $rowpe['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }


      $query_comp = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$comprador."';";
      $result_comp = mysqli_query($con,$query_comp);

      $filas_comp = mysqli_num_rows($result_comp);
      $row_comp = $result_comp->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_comp<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_comp = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$comprador."');";
        $result_insert_comprador = mysqli_query($con, $insert_comp);
        $id_comprador =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_comprador = $row_comp['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      $insert_clg = "INSERT INTO `not190`.`clg_tradicional` (`id_oficina`, `ubicacion_inmueble`, `folio_real`, `id_propietario`, `id_acto`, `id_comprador`, `id_institucion_clg_tradi`, `medidas_colindancias`, `clave_catastral`, `insercion_fecha_hora`, `usuario_insert_clg`) VALUES (".$select_oficina.", '".$ubicacion_vivienda."', '".$folio_real."',".$id_propietario.", ".$acto.", ".$id_comprador.", ".$institucion.", '".$medidas_colindancias."', '".$clave_catastral."', '".$date->format("Y-m-d H:i:s")."', ".$user.");";
      //echo $insert_clg;
      $result_insert_clg = mysqli_query($con, $insert_clg);
      $id_clg =mysqli_insert_id($con);
      
  if ($tipo_clg == "SI") {


      $insert_exp_previa = "UPDATE `not190`.`expediente` SET `id_clg` = 1, `id_clg_tradicional` = '".$id_clg."', `clg_tradi_tramite` = '".$clg_fecha_tramite."', `clg_tradi_termino` = '".$clg_fecha_termino."', `clave_valor` = ".$clave_valor.", `no_adeudo_predial` = ".$no_adeudo_predial.", `no_adeudo_agua` = ".$no_adeudo_agua.", `zonificacion` = ".$zonificacion.",`observaciones_2` = '".$observaciones_previa."', `fecha_insert_clg` = '".$date->format("Y-m-d H:i:s")."', `id_usuario_clg_certis` = ".$user." WHERE (`id_expediente` = ".$no_exp.");";
      //echo "<BR>insert: ---> ".$insert_exp_previa;
      $result_insert_exp_previa = mysqli_query($con, $insert_exp_previa);
      //echo "insert: ---> ".$insert_exp_previa;

    
  }elseif($tipo_clg == "NO"){
      
          $insert_expdiente = "UPDATE `not190`.`expediente` SET `id_clg` = '2', `id_clg_tradicional` = '".$id_clg."', `clg_auto_folio_real` = '".$auto_folio_real."', `clave_valor` = ".$clave_valor.", `no_adeudo_predial` = ".$no_adeudo_predial.", `no_adeudo_agua` = ".$no_adeudo_agua.", `zonificacion` = ".$zonificacion.",`observaciones_2` = '".$observaciones_previa."', `fecha_insert_clg` = '".$date->format("Y-m-d H:i:s")."', `id_usuario_clg_certis` = ".$user." WHERE (`id_expediente` = ".$no_exp.");";
      //echo $insert_expdiente;
      $result_insert_expediente = mysqli_query($con, $insert_expdiente);
  }else{
        $insert_expdiente_pend = "UPDATE `not190`.`expediente` SET `clg_auto_folio_real` = '".$auto_folio_real."', `id_clg_tradicional` = '".$id_clg."', `clave_valor` = ".$clave_valor.", `no_adeudo_predial` = ".$no_adeudo_predial.", `no_adeudo_agua` = ".$no_adeudo_agua.", `zonificacion` = ".$zonificacion.",`observaciones_2` = '".$observaciones_previa."', `fecha_insert_clg` = '".$date->format("Y-m-d H:i:s")."', `id_usuario_clg_certis` = ".$user." WHERE (`id_expediente` = ".$no_exp.");";
      //echo $insert_expdiente;
      $result_insert_expediente = mysqli_query($con, $insert_expdiente_pend);
  }
?>

<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-1">No.Exp<BR>Nombre del cliente</th>
      <th class="col-2">Oficina / Ubicacion</th>
      <th class="col-2">Folio /Propietario /Comprador </th>
      <th class="col-1">Acto / Institución</th>
      <th class="col-2"> Medidias / Fechas</th>
      <th class="col-1">Observaciones</th>
      <th class="col-1">Certificaciones</th>
      
      
    </tr>
  </thead>

<?PHP

    $queryfam = "SELECT id_expediente, nombre_del_cliente, observaciones_1, clg_tipo, exp.id_clg as tradi_clg_id,clg_auto_folio_real, folio_real, ofi_clg.oficina as oficina, tradi.id_oficina as id_oficina, tradi.ubicacion_inmueble, propietario.nombre as propietario,
tradi.id_acto, tradi_acto.actos, comprador.nombre as comprador, tradi_institu.institucion as institucion, tradi.id_institucion_clg_tradi, tradi.medidas_colindancias, clg_tradi_tramite, clg_tradi_termino, id_clg_tradicional,
clave_valor, no_adeudo_predial, no_adeudo_agua, zonificacion, observaciones_2
FROM not190.expediente as exp
inner join proyectistas on proyectistas.id_proyectista = exp.id_proyectista 
inner join usuarios as p on p.idusuario = proyectistas.id_usuario 
left join exp_institucion as exp_institu on exp_institu.id_institucion = exp.id_institucion 
inner join usuarios as u on u.idusuario = exp.id_usuario_n_exp 
left join clg_tipo on clg_tipo.id_clg_tipo = exp.id_clg
left join clg_tradicional as tradi on tradi.id_clg = exp.id_clg_tradicional
left join clg_actos as tradi_acto on tradi.id_acto = tradi_acto.id_clg_acto
left join exp_institucion as tradi_institu on tradi_institu.id_institucion = tradi.id_institucion_clg_tradi 
left join clg_oficinas as ofi_clg on tradi.id_oficina = ofi_clg.id_oficina
left join nombres_expedientes as propietario on tradi.id_propietario = propietario.id_nombre
left join nombres_expedientes as comprador on tradi.id_comprador = comprador.id_nombre 
where id_expediente = ".$no_exp.";";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay Previas por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 

?>

    <tr>
      
      <td>No.Exp.: <b> <?php echo $rowfam['id_expediente'] ?></b><BR>Nombre: <?php echo $rowfam['nombre_del_cliente'] ?></td>
      <td>Oficina: <?php echo $rowfam['oficina']; ?>
      <br>Ubicacion y vivienda: <p><?php echo $rowfam['ubicacion_inmueble']; ?></p>
      </td>
      <td>Folio:<?php echo $rowfam['folio_real']; ?><?php echo $rowfam['clg_auto_folio_real']; ?> <br> Propietario: <?php echo $rowfam['propietario'] ?>
      <br> Comprador: <?php echo $rowfam['comprador']; ?>
      </td>
      <td>Acto:<?php echo $rowfam['actos'] ?><br>Institucion: <?php echo $rowfam['institucion'] ?></td>
      <td>
      Fecha de ingreso: <b><?php echo $rowfam['clg_tradi_tramite'] ?></b> <br>Fecha de egreso: <b><?php echo $rowfam['clg_tradi_termino'] ?></b><br>
      Medidas y Colindancias: <br><?php echo $rowfam['medidas_colindancias'] ?>
      </td>
      <td>Clave y valor catastral: <br><b><?php if ($fila_exp['clave_valor']>=1) echo "Listo";?> </b>
      <br>No adeudo de predial y mejora: <br><b><?php if ($fila_exp['no_adeudo_predial']>=1) echo "Listo";?> </b>
      <br>No adeudo de agua o no servicio: <br><b><?php if ($fila_exp['no_adeudo_agua']>=1) echo "Listo";?> </b>
      <br>Zonificación: <br><b><?php if ($fila_exp['zonificacion']>=1) echo "Listo";?> </b>
      </td>
      <td>Observaciones: <?php echo $rowfam['observaciones_2'] ?><br>
      
      <?php 
            echo '<button class="alert-success"><a href="CLG.php?id_clg='.$rowfam['id_clg_tradicional'].'">CLG word</a></button><br>';
            echo '<button class="alert-success"><a href="clave_valor.php?id_clg='.$rowfam['id_clg_tradicional'].'">clave valor</a></button><br>';
            echo '<button class="alert-success"><a href="agua.php?id_clg='.$rowfam['id_clg_tradicional'].'">agua</a></button><br>';
            echo '<button class="alert-success"><a href="zonificacion.php?id_clg='.$rowfam['id_clg_tradicional'].'">zonificacion</a></button><br>';
            echo '<button class="alert-success"><a href="predial.php?id_clg='.$rowfam['id_clg_tradicional'].'">Predial y Mejoras</a></button><br>';

          ?>
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
  
  
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  
<script type="text/javascript">
  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });
</script>       
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
 
</body>
</html>