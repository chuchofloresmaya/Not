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


$query_exp = "SELECT exp.id_expediente, exp.nombre_del_cliente, exp.telefono, exp.correo, acto.acto, institucion.institucion as prev_institucion, exp.observaciones_1, clg_tipo.clg_tipo, exp.clg_auto_folio_real, tradi.folio_real, ofic.oficina, tradi.ubicacion_inmueble, 
tradi.folio_real, exp_nom_pro.nombre as propietario, prev_act.actos as acto_prev, exp_nom_com.nombre as comprador, institucion_clg.institucion as clg_institucion, tradi.medidas_colindancias, tradi.clave_catastral,
exp.firma, exp.no_esc, exp.fech_firma, exp.fech_intermedia_fecha,
exp.intermedia_fecha, exp.fecha_av_def, exp.av_def, exp.vol_esc, exp.otorgamiento, exp.fname_proyect, exp.name_proyect, exp.observaciones_1, exp.observaciones_2, exp.observaciones_3, exp.observaciones_4
FROM not190.expediente as exp
inner join exp_actos as acto on exp.id_acto = acto.id_acto
left join exp_institucion as institucion on exp.id_institucion = institucion.id_institucion
left join clg_tipo on exp.id_clg = clg_tipo.id_clg_tipo
left join clg_tradicional as tradi on exp.id_clg_tradicional = tradi.id_clg
left join clg_oficinas as ofic on tradi.id_oficina = ofic.id_oficina
left join nombres_expedientes as exp_nom_pro on id_propietario = exp_nom_pro.id_nombre
left join clg_actos as prev_act on tradi.id_acto = prev_act.id_clg_acto
left join nombres_expedientes as exp_nom_com on id_comprador = exp_nom_com.id_nombre
left join exp_institucion as institucion_clg on tradi.id_institucion_clg_tradi = institucion_clg.id_institucion
where id_expediente = ".$no_exp.";";


//echo "<br>$query_exp<br>";

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

<center><h1 class="display-3">Fechas del Proyecto No.: <?php echo $no_exp ?></h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?><?php echo "?id_exp=".$no_exp ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
  <input type="hidden" name="no_exp" value="<?php echo $no_exp; ?>">   
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-1">
   <label for="name"><h3>Fechas de entregas:</h3><span></span></label><br>
 </div>
   <div class="col-xs-6 col-md-2"> 
 </div>
    <div class="col-xs-6 col-md-2"> 

 </div>
     <div class="col-xs-6 col-md-2"> 
     </div>
</div>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-2" id="fecha_tramite" ><br>Fecha de la Firma
   <input class="form-control" type="date" id="firma" name="firma" <?php if ($fila_exp['firma'] > 1) {
     echo 'value="'.$fila_exp['firma'].'" disabled';
   } ?>>
  <?php if ($fila_exp['firma'] > 1) { ?>
    <input type="hidden" name="firma" value="<?php echo $fila_exp['firma']; ?>">   
    <input type="hidden" name="fech_firma" value="<?php echo 1; ?>">   
  <?php
  }
  ?>  
   <br> Ingresar Número de escritura:
   <input class="form-control" type="number" id="no_esc" name="no_esc" value="<?php echo $fila_exp['no_esc'];?>" placeholder="2548">
   Ingresar Volumen de escritura:
   <input class="form-control" type="number" id="vol_esc" name="vol_esc" value="<?php echo $fila_exp['vol_esc'];?>" placeholder="178">
   <br> Fecha de otorgamiento :
   <input class="form-control" type="date" id="otorgamiento" name="otorgamiento" <?php if ($fila_exp['otorgamiento'] > 1) {
     echo 'value="'.$fila_exp['otorgamiento'].'" disabled';
   } ?>>
  <?php if ($fila_exp['otorgamiento'] > 1) { ?>

    <input type="hidden" name="otorgamiento" value="<?php echo $fila_exp['otorgamiento']; ?>">
    <input type="hidden" name="fech_otorgamiento" value="<?php echo 1; ?>">
  <?php
  }
  ?>   

    <br>
  </div>
<div class="col-xs-6 col-md-2" id="fecha_termino" ><br>Intermedia
   <input class="form-control" type="date" id="intermedia_fecha" name="intermedia_fecha" <?php if ($fila_exp['intermedia_fecha'] > 1) {
     echo 'value="'.$fila_exp['intermedia_fecha'].'" disabled';
   } ?>>
  <?php if ($fila_exp['intermedia_fecha'] > 1) { ?>
    <input type="hidden" name="intermedia_fecha" value="<?php echo $fila_exp['intermedia_fecha']; ?>">   
    <input type="hidden" name="fech_intermedia_fecha" value="<?php echo 1; ?>">   
  <?php
  }
  ?>   
   
    <br>
    <br>
    <br>
          Subir proyecto:
      <label class="btn btn-outline-secondary btn-sm" for="my-file-selector">
        <input type="file" name="file" id="exampleInputFile">
      </label>

  <?php if ($fila_exp['fname_proyect'] > 1) {
     echo "Archivo cargado: ".$fila_exp['name_proyect'];
  ?>
    <input type="hidden" name="indicador_archivo" value="<?php echo $fila_exp['name_proyect'];?>">   
    <button class="alert-success"><a href="download_proyect.php?filename=<?php echo $fila_exp['name_proyect'];?>&f=<?php echo $fila_exp['fname_proyect']; ?>">Archivo</a></button>
  <?php
   }
   ?>
  </div>  
  <div class="col-xs-6 col-md-2" id="fecha_termino" ><br>Av. Def.
   <input class="form-control" type="date" id="av_def" name="av_def" <?php if ($fila_exp['av_def'] > 1) {
     echo 'value="'.$fila_exp['av_def'].'" disabled';
   } ?>>
  <?php if ($fila_exp['av_def'] > 1) { ?>
    <input type="hidden" name="av_def" value="<?php echo $fila_exp['av_def']; ?>">   
    <input type="hidden" name="fecha_av_def" value="<?php echo 1; ?>">   
  <?php
  }
  ?>   

    <br>
  </div>
  <div class="col-xs-6 col-md-2" id="fecha_termino" ><br>No de Expediente <?php echo $fila_exp['id_expediente'] ?><br>
  Nombre del cliente <?php echo $fila_exp['nombre_del_cliente'] ?><br>
  Telefono <?php echo $fila_exp['telefono'] ?><br>
  correo <?php echo $fila_exp['correo'] ?><br>
  Acto-Apertura: <?php echo $fila_exp['acto'] ?><br>
  Institucion: <?php echo $fila_exp['prev_institucion'] ?><br>
  
  ----------------------------------------
  <BR>Ubicación del inmueble <br>
 <?php echo $fila_exp['ubicacion_inmueble'];?>
  </div>
  <div class="col-xs-6 col-md-2" id="fecha_termino" ><br>Clg tipo: <?php echo $fila_exp['clg_tipo'] ?><br>
  Folio: <?php echo $fila_exp['clg_auto_folio_real'] ?> <?php echo $fila_exp['folio_real'] ?><br>
  Oficina <?php echo $fila_exp['oficina'] ?><br>
  Propietario <?php echo $fila_exp['propietario'] ?><br>
  Acto-Previa: <?php echo $fila_exp['acto_prev'] ?><br>
  Comprador: <?php echo $fila_exp['comprador'] ?><br>
  Institucion: <?php echo $fila_exp['clg_institucion'] ?><br>
  clave catastral: 
  <br>----------------------------------------
  <BR>Medidas y Colindancias<br>
  <?php echo $fila_exp['medidas_colindancias'];?>
  </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2"><br><br><h3>Observaciones</h3>
  </div>
    <div class="col-xs-6 col-md-2">Observaciones:
    <textarea rows="6"cols="40" name="observaciones_4" form="formulario_sec"  ><?php echo $fila_exp['observaciones_4'];?></textarea>
    </div>  
    <div class="col-xs-6 col-md-2"><p>Observaciones de Apertura:</p>
    <p>
      <?php echo $fila_exp['observaciones_1'];?>
    </p>
    <p>Observaciones de Previa:</p>
    <p>
      <?php echo $fila_exp['observaciones_2'];?>
    </p>
    <p>Observaciones de Entrega:</p>
    <p>
      <?php echo $fila_exp['observaciones_3'];?>
    </p>

    </div>
 </div> 
<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<BR>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>


  <div class="col-xs-6 col-md-2"><input type="submit" class="btn btn-success disable" value="Ingresar Previos" name="regfam" ></div>
    <div class="col-xs-6 col-md-1">
      
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
    $no_esc = $_POST['no_esc'];

    $indicador_archivo = isset($_POST['indicador_archivo']);    
    
    $firma = $_POST['firma'];
    $fech_firma = isset($_POST['fech_firma']);
    $intermedia_fecha = $_POST['intermedia_fecha'];
    $fech_intermedia_fecha = isset($_POST['fech_intermedia_fecha']);  
    $av_def = $_POST['av_def'];
    $fecha_av_def = isset($_POST['fecha_av_def']);
    $observaciones_4 = $_POST['observaciones_4'];  
    $vol_esc = $_POST['vol_esc'];
    $otorgamiento = $_POST['otorgamiento'];
    $fech_otorgamiento = isset($_POST['fech_otorgamiento']);


    $name=$no_esc."-ESC-".$vol_esc."-VOL-".$_FILES['file']['name'];

    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];
    // $caption1=$_POST['caption'];
    // $link=$_POST['link'];
    $fname = date("YmdHis").'_'.$name;


    if ($indicador_archivo >= 0 && $size < 1) {
      $querynomuser = "SELECT name_proyect, fname_proyect FROM not190.expediente where id_expediente = '".$no_exp."';";
      //ECHO $querynomuser;
      $resultq = mysqli_query($con,$querynomuser);
      $rowusu = $resultq->fetch_assoc();


      $name = $rowusu['name_proyect'];
      $fname = $rowusu['fname_proyect'];

      
    }else{

      if ($size >= 1) {

      $queryfile = "SELECT * FROM not190.expediente where name_proyect = '".$name."';";
      $resultfile = mysqli_query($con,$queryfile);
      $chk=mysqli_num_rows($resultfile);
      
      if($chk){
        $i = 1;
        $c = 0;
      while($c == 0){
          $i++;
          $reversedParts = explode('.', strrev($name), 2);
          $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
        // var_dump($tname);exit;
          //$chk2 = $con1->query("SELECT * FROM  cotejos where name = '$tname'; ")->rowCount();
              $queryfile1 = "SELECT * FROM not190.expediente where name_proyect = '".$tname."';";
              $resultfile1 = mysqli_query($con,$queryfile1);
              $chk2=mysqli_num_rows($resultfile1);
          if($chk2 == 0){
            $c = 1;
            $name = $tname;
          }
        }
    }
  }    
}


/*    echo "<br> numero de expediente: ".$no_exp;
    echo "<br> Numero de escritura: ".$no_esc;
    echo "<br> fecha de firma: ".$firma;
    echo "<br> Indicador de fecha de firma: ".$fech_firma;
    echo "<br>Fecha de intermedia: ".$intermedia_fecha;
    echo "<br> Indicador de la fecha de la firma: ".$fech_intermedia_fecha;
    echo "<br> Indicador de aviso definitivo: ".$fecha_av_def;
    echo "<br> Avido definitivo: ".$av_def;
    echo "<br> Otorgamiento: ".$otorgamiento;
    echo "<br> Indicador de otorgamiento: ".$fech_otorgamiento;    
    echo "<br> Observaciones: ".$observaciones_4;
*/

  $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); //echo $date->format("Y-m-d H:i:s");

  //echo "OBS: $observaciones_fechas_entrega  <br>Entrega1: $entrega_a_gest1 <br>Entrega2: $fecha_entrega_municipio1 <br>Entrega3: $entrega_por_gest1";

  if ($firma > 1 && $fech_firma <= 0) {
    $fech_firma = $date->format("Y-m-d H:i:s");
    $update_firma = "UPDATE `not190`.`expediente` SET `firma` = '".$firma."', `fech_firma` = '".$fech_firma."' WHERE (`id_expediente` = '".$no_exp."');";
    $result_firma = mysqli_query($con, $update_firma);
  }

  if ($intermedia_fecha > 1 && $fech_intermedia_fecha <= 0) {
    $fech_intemedia = $date->format("Y-m-d H:i:s");
    $update_intermedia = "UPDATE `not190`.`expediente` SET `fech_intermedia_fecha` = '".$fech_intemedia."', `intermedia_fecha` = '".$intermedia_fecha."' WHERE (`id_expediente` = '".$no_exp."');";
    //echo $update_intermedia;
    $result_intermedia = mysqli_query($con, $update_intermedia);
  }

  if ($av_def > 1 && $fecha_av_def <= 0) {
    $fecha_av_def = $date->format("Y-m-d H:i:s");
    $update_av_def = "UPDATE `not190`.`expediente` SET `fecha_av_def` = '".$fecha_av_def."', `av_def` = '".$av_def."' WHERE (`id_expediente` = '".$no_exp."');";
    $result_av_def = mysqli_query($con, $update_av_def);    
  }

  if ($otorgamiento > 1 && $fech_otorgamiento <= 0) {
    $fech_otorgamiento = $date->format("Y-m-d H:i:s");
    $update_otorgamiento = "UPDATE `not190`.`expediente` SET `otorgamiento` = '".$otorgamiento."', `fech_otorgamiento` = '".$fech_otorgamiento."' WHERE (`id_expediente` = '".$no_exp."');";
    $result_otorgamiento = mysqli_query($con, $update_otorgamiento);    
  }
          $insert_expdiente = "UPDATE `not190`.`expediente` SET `no_esc` = '".$no_esc."', `vol_esc` = '".$vol_esc."', `observaciones_4` = '".$observaciones_4."',`fname_proyect` = '".$fname."', `name_proyect` = '".$name."', `id_usuario_proyect` = '".$user."' WHERE (`id_expediente` = '".$no_exp."');";




                $move =  move_uploaded_file($temp,"escrituras_proyectistas/".$fname);

      //echo $insert_expdiente;
      $result_insert_expediente = mysqli_query($con, $insert_expdiente);

?>

<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-1">No.Exp<BR>Nombre del cliente</th>
      <th class="col-2">Fechas</th>
      <th class="col-2"></th>
      <th class="col-1"></th>
      <th class="col-2">Observaciones</th>
      <th class="col-1">Observaciones</th>
      
      
    </tr>
  </thead>

<?PHP

    $queryfam = "SELECT id_expediente, nombre_del_cliente, observaciones_1, clg_tipo, exp.id_clg as tradi_clg_id,clg_auto_folio_real, folio_real, ofi_clg.oficina as oficina, tradi.id_oficina as id_oficina, tradi.ubicacion_inmueble, propietario.nombre as propietario,
tradi.id_acto, tradi_acto.actos, comprador.nombre as comprador, tradi_institu.institucion as institucion, tradi.id_institucion_clg_tradi, tradi.medidas_colindancias, clg_tradi_tramite, clg_tradi_termino, id_clg_tradicional,
clave_valor, no_adeudo_predial, no_adeudo_agua, zonificacion, observaciones_2, cert_entrega_gestor, cert_entrega_municipio, cert_por_gestor
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
      <td>Fecha de entrega al gestor: <?php echo $rowfam['cert_entrega_gestor'] ?></td>
      <td>Fecha de entrega al municipio: <?php echo $rowfam['cert_entrega_municipio'] ?></td>
      <td>Fecha de entrega por el gestor: <?php echo $rowfam['cert_por_gestor'] ?></td>
  <td>    <p>
      <?php echo $fila_exp['observaciones_1'];?>
    </p>
    <p>Observaciones de Previa:</p>
    <p>
      <?php echo $fila_exp['observaciones_2'];?>
    </p>
    <p>Observaciones de Entrega:</p>
    <p>
      <?php echo $fila_exp['observaciones_3'];?>
    </p>
  </td>
      <td><br>

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