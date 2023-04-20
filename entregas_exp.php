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


$query_exp = "SELECT id_expediente, nombre_del_cliente, correo, telefono, observaciones_1, clg_tipo, exp.id_clg as tradi_clg_id,clg_auto_folio_real, folio_real, ofi_clg.oficina as oficina, tradi.id_oficina as id_oficina, tradi.ubicacion_inmueble, propietario.nombre as propietario,
tradi.id_acto, tradi_acto.actos, comprador.nombre as comprador, tradi_institu.institucion as institucion, tradi.id_institucion_clg_tradi, tradi.medidas_colindancias, clg_tradi_tramite, clg_tradi_termino,
clave_valor, no_adeudo_predial, no_adeudo_agua, zonificacion, observaciones_2, cert_entrega_gestor, cert_entrega_municipio, cert_por_gestor,observaciones_3
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

<center><h1 class="display-3">Fechas de entrega de certificaciones No.: <?php echo $no_exp ?></h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?><?php echo "?id_exp=".$no_exp ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
  <input type="hidden" name="no_exp" value="<?php echo $no_exp; ?>">   
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-1">
   <label for="name"><h3>Fechas de entregas:</h3><span></span></label><br>
 </div>
   <div class="col-xs-6 col-md-2"> 
                                  Formatos para entregar certificaciones:<br><p>
                                   <?php if ($fila_exp['clave_valor']>=1) echo "Clave Valor";?><br>
                                   <?php if ($fila_exp['no_adeudo_predial']>=1) echo "No adeudo de predial";?><br>
                                   <?php if ($fila_exp['no_adeudo_agua']>=1) echo "No adeudo de Agua";?><br>
                                   <?php if ($fila_exp['zonificacion']>=1) echo "Zonificación";?><br></p>
 </div>
    <div class="col-xs-6 col-md-2"> 
                                  Estado CLG:<br><p>
                                   <?php if($fila_exp['clg_tipo'] >= 1){
                                    if ($fila_exp['clg_auto_folio_real'] >= 1) {
                                      echo "AUTOMATIZADO";
                                    }elseif ($fila_exp['clg_tradi_termino'] > 1) {
                                      echo "TRADICIONAL LISTO";
                                    }else{
                                      echo "TRADICIONAL EN PROCESO";
                                    }
                                  }else{
                                    echo "PENDIENTE";
                                  }
                                 ?><br>

 </div>
     <div class="col-xs-6 col-md-2"> 
      <?php echo "Nombre del cliente: ".$fila_exp['nombre_del_cliente']." <br> Correo: ".$fila_exp['correo']." <br> Telefono: ".$fila_exp['telefono']."";
      ?>
     </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-2" id="fecha_tramite" ><br>Fecha de entrega al gestor:
   <input class="form-control" type="date" id="entrega_a_gest" name="entrega_a_gest" <?php if ($fila_exp['cert_entrega_gestor'] > 1) {
     echo 'value="'.$fila_exp['cert_entrega_gestor'].'" disabled';
   } ?>>


  <?php if ($fila_exp['cert_entrega_gestor'] > 1) { ?>
    <input type="hidden" name="entrega_a_gest" value="<?php echo $fila_exp['cert_entrega_gestor']; ?>">   
    <input type="hidden" name="entrega_a_gest1" value="<?php echo 1; ?>">   
  <?php
  }
  ?>   

    <br>
  </div>
<div class="col-xs-6 col-md-2" id="fecha_termino" ><br>Fecha de entrega a municipio:
   <input class="form-control" type="date" id="fecha_entrega_municipio" name="fecha_entrega_municipio" <?php if ($fila_exp['cert_entrega_municipio'] > 1) {
     echo 'value="'.$fila_exp['cert_entrega_municipio'].'" disabled';
   } ?>>
  <?php if ($fila_exp['cert_entrega_municipio'] > 1) { ?>
    <input type="hidden" name="fecha_entrega_municipio" value="<?php echo $fila_exp['cert_entrega_municipio']; ?>">   
    <input type="hidden" name="fecha_entrega_municipio1" value="<?php echo 1; ?>">   
  <?php
  }
  ?>   
   
    <br>
  </div>  
  <div class="col-xs-6 col-md-2" id="fecha_termino" ><br>Fecha entregada por el gestor:
   <input class="form-control" type="date" id="entrega_por_gest" name="entrega_por_gest" <?php if ($fila_exp['cert_por_gestor'] > 1) {
     echo 'value="'.$fila_exp['cert_por_gestor'].'" disabled';
   } ?>>
  <?php if ($fila_exp['cert_por_gestor'] > 1) { ?>
    <input type="hidden" name="entrega_por_gest" value="<?php echo $fila_exp['cert_por_gestor']; ?>">   
    <input type="hidden" name="entrega_por_gest1" value="<?php echo 1; ?>">   
  <?php
  }
  ?>   

    <br>
  </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2"><br><br><h3>Observaciones</h3>
  </div>
    <div class="col-xs-6 col-md-2">Observaciones:
    <textarea rows="6"cols="40" name="observaciones_fechas_entrega" form="formulario_sec"  ><?php echo $fila_exp['observaciones_3'];?></textarea>
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
    $entrega_a_gest = $_POST['entrega_a_gest'];  
    $entrega_a_gest1 = $_POST['entrega_a_gest1'];      
    $fecha_entrega_municipio = $_POST['fecha_entrega_municipio'];  
    $fecha_entrega_municipio1 = isset($_POST['fecha_entrega_municipio1']);      
    $entrega_por_gest = $_POST['entrega_por_gest'];
    $entrega_por_gest1 = isset($_POST['entrega_por_gest1']);
    $observaciones_fechas_entrega = $_POST['observaciones_fechas_entrega'];  


  $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); //echo $date->format("Y-m-d H:i:s");

  //echo "OBS: $observaciones_fechas_entrega  <br>Entrega1: $entrega_a_gest1 <br>Entrega2: $fecha_entrega_municipio1 <br>Entrega3: $entrega_por_gest1";

  if ($entrega_a_gest > 1 && $entrega_a_gest1 <= 0) {
    $fech_cert_entrega_gestor = $date->format("Y-m-d H:i:s");
    $update_cert_entrega_gestor = "UPDATE `expediente` SET `fech_cert_entrega_gestor` = '".$fech_cert_entrega_gestor."' WHERE `expediente`.`id_expediente` = ".$no_exp.";";
    $result_update_cert_entrega_gestor = mysqli_query($con, $update_cert_entrega_gestor);
  }

  if ($fecha_entrega_municipio > 1 && $fecha_entrega_municipio1 <= 0) {
    $fech_cert_entrega_municipio = $date->format("Y-m-d H:i:s");
    $update_cert_entrega_gestor = "UPDATE `expediente` SET `fech_cert_entrega_municipio` = '".$fech_cert_entrega_municipio."' WHERE `expediente`.`id_expediente` = ".$no_exp.";";
    $result_update_cert_entrega_gestor = mysqli_query($con, $update_cert_entrega_gestor);
  }

  if ($entrega_por_gest > 1 && $entrega_por_gest1 <= 0) {
    $fech_cert_por_gestor = $date->format("Y-m-d H:i:s");
    $update_cert_por_gestor = "UPDATE `expediente` SET `fech_cert_por_gestor` = '".$fech_cert_por_gestor."' WHERE `expediente`.`id_expediente` = ".$no_exp.";";
    $result_update_cert_por_gestor = mysqli_query($con, $update_cert_por_gestor);    
  }


      
          $insert_expdiente = "UPDATE `expediente` SET `cert_entrega_gestor` = '".$entrega_a_gest."', `cert_entrega_municipio` = '".$fecha_entrega_municipio."',   `cert_por_gestor` = '".$entrega_por_gest."', `id_usuario_certis` = '".$user."',`observaciones_3` = '".$observaciones_fechas_entrega."' WHERE `expediente`.`id_expediente` = ".$no_exp.";";

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