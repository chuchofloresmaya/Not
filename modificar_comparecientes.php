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

$id_comp = $_GET['comp'];
$no_exp = $_GET['no_exp'];


if(!empty($_POST["regfam"])) {

 $id_tipo_comparecienteray = $_POST["id_tipo_compareciente"];
 $nombre_comray = $_POST["nombre_com"];
 $fecha_nacimeintoray = $_POST["fecha_nacimeinto"];
 $lugar_nacimientoray = $_POST["lugar_nacimiento"]; 
 $estado_civilray = $_POST["estado_civil"];
 $nombre_conyugeray = $_POST["nombre_conyuge"];
 $domicilioray = $_POST["domicilio"];
 $ocupacionray = $_POST["ocupacion"];
 $curpray = $_POST["curp"];
 $rfcray = $_POST["rfc"];
 $doc_identificacionray = $_POST["doc_identificacion"];
 $no_identificacionray = $_POST["no_identificacion"];

  
  $id_tipo_compareciente = $id_tipo_comparecienteray[0];
  $nombre_com = $nombre_comray[0];
  $fecha_nacimeinto = $fecha_nacimeintoray[0];
  $lugar_nacimiento = $lugar_nacimientoray[0];
  $estado_civil = $estado_civilray[0];
  $nombre_conyuge = $nombre_conyugeray[0];
  $domicilio = $domicilioray[0];
  $ocupacion = $ocupacionray[0];
  $curp = $curpray[0];
  $rfc = $rfcray[0];
  $doc_identificacion = $doc_identificacionray[0];
  $no_identificacion = $no_identificacionray;




      $querype = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$nombre_com."';";
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();


      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_comp = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$nombre_com."');";
        $result_insert_persona = mysqli_query($con, $insert_comp);
        $id_nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_nombre_com = $rowpe['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
      if ($estado_civil == 1) {
        $id_nombre_conyuge = 'null';
      }else{
        //$id_nombre_conyuge = null;
      $querycony = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$nombre_conyuge."';";
      $resultcony = mysqli_query($con,$querycony);

      $filascony = mysqli_num_rows($resultcony);
      $rowcony = $resultcony->fetch_assoc();


      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filascony<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_conyuge = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$nombre_conyuge."');";
        echo $insert_conyuge;
        $result_insert_conyuge = mysqli_query($con, $insert_conyuge);
        $id_nombre_conyuge =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_nombre_conyuge = $rowpe['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      }


  $update_compareciente = "UPDATE `not190`.`compareciente` SET `id_tipo_compareciente` = '".$id_tipo_compareciente."', `nombre_com` = '".$id_nombre_com."', `fecha_nacimeinto` = '".$fecha_nacimeinto."', `lugar_nacimiento` = '".$lugar_nacimiento."', `nombre_conyuge` = ".$id_nombre_conyuge.", `domicilio` = '".$domicilio."', `ocupacion` = '".$domicilio."', `curp` = '".$curp."', `rfc` = '".$rfc."', `doc_identificacion` = '".$doc_identificacion."', `no_identificacion` = '".$no_identificacion."' WHERE (`id_compreciente` = '".$id_comp."');";
  $result_update_compareciente = mysqli_query($con, $update_compareciente);

  

  //echo "------------------------>>$update_compareciente<<--------------------";

  }
$query_exp = "SELECT id_compreciente, id_tipo_compareciente,compareciente, nombre_com, nom_comprador.nombre as nombre_compareciente, fecha_nacimeinto, lugar_nacimiento, compareciente.estado_civil ,estados_civiles.estado_civil as estado_civil_nom, nombre_conyuge, 
nom_conyuge.nombre as nombre_conyuge, domicilio, ocupacion, curp, rfc, doc_identificacion, no_identificacion, tipo_identificacion FROM not190.compareciente
left join tipo_comparecinetes on compareciente.id_compreciente = tipo_comparecinetes.id_compareciente 
inner join nombres_expedientes as nom_comprador on compareciente.nombre_com = nom_comprador.id_nombre 
left join nombres_expedientes as nom_conyuge on compareciente.nombre_conyuge = nom_conyuge.id_nombre 
inner join estados_civiles on compareciente.estado_civil = estados_civiles.id_estado 
inner join documentos_identificacion as ide on compareciente.doc_identificacion = ide.id_documento 
where id_compreciente = ".$id_comp.";";

//echo $query_exp;

$result_exp = mysqli_query($con, $query_exp);
$fila_exp = $result_exp->fetch_assoc();

$querycivil = "SELECT id_estado, estado_civil FROM not190.estados_civiles;";
$resultcivil = mysqli_query($con, $querycivil);

while($rowcivil = $resultcivil->fetch_assoc()) {
      $id_civil = $rowcivil['id_estado']; 
      $estado_civil = $rowcivil['estado_civil'];

$c[] = $rowcivil['estado_civil'];
}

$querymes = "SELECT id_compareciente, compareciente FROM not190.tipo_comparecinetes;";
$resultadomes = mysqli_query($con, $querymes);

while($rowproyec = $resultadomes->fetch_assoc()) {
      $id_proyectista = $rowproyec['id_compareciente']; 
      $nombre = $rowproyec['compareciente'];

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
    <script type="text/javascript">
        function AgregarMas() {
      $("<div>").load("comparecientes.php", function() {
          $("#productos").append($(this).html());
      }); 
    }
    function BorrarRegistro() {
      $('div.lista-producto').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
                if ($(this).is(':checked')) {
            $(item).remove();
                }
            });
      });
    }
    </script> 
  <body>


<?php
include ("nav.php");

?>
<center><h1 class="display-3">Modificar compareciente <?php echo $fila_exp['nombre_compareciente'] ?></h1></center>
 <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?><?php echo "?comp=".$id_comp."&no_exp=$no_exp" ?>" method="post" onsubmit="return validacion_fam();" >
  
<div class="float-left">
  <div class="row">
  <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-3" id="fecha_tramite" >Compadeciente: <br>
  <select id="id_tipo_compareciente" name="id_tipo_compareciente[]" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>    
        <?php 
        foreach ($a as $k => $v) {
        $k++;
        if ($k != $fila_exp['id_tipo_compareciente']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>     
  <br>Nombre
   <input class="form-control" type="text" id="nombre_com" name="nombre_com[]" value="<?php echo $fila_exp['nombre_compareciente'] ?>" placeholder="Nombre">
   <br> Fecha de nacimiento
   <input class="form-control" type="date" id="fecha_nacimeinto" name="fecha_nacimeinto[]" value="<?php echo $fila_exp['fecha_nacimeinto'] ?>">
      Lugar de nacimiento:
   <input class="form-control" type="text" id="lugar_nacimiento" name="lugar_nacimiento[]" value="<?php echo $fila_exp['lugar_nacimiento'];?>" placeholder="Lugar de nacimiento">
   <center>Estado civil<br></center>
  <select id="estado_civil" name="estado_civil[]" class="btn btn-outline-secondary btn-sm" required>
        
        <?php 
        foreach ($c as $k => $v) {
        $k++;
        if ($k != $fila_exp['estado_civil']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }
        ?>
        </select>  

  <br>Estado civil<br>
    Nombre del cónyuge:
   <input class="form-control" type="text" id="nombre_conyuge" name="nombre_conyuge[]" value="<?php echo $fila_exp['nombre_conyuge'];?>" placeholder="Nombre">
  </div>
<div class="col-xs-6 col-md-3" id="fecha_termino" >
   Domicilio: 
   <input class="form-control" type="text" id="domicilio" name="domicilio[]" value="<?php echo $fila_exp['domicilio'];?>">
   Ocupación:
   <input class="form-control" type="text" id="ocupacion" name="ocupacion[]" value="<?php echo $fila_exp['ocupacion'];?>">
   CURP:
   <input class="form-control" type="text" id="curp" name="curp[]" value="<?php echo $fila_exp['curp'];?>">
   RFC:
   <input class="form-control" type="text" id="rfc" name="rfc[]" value="<?php echo $fila_exp['rfc'];?>"> 
    <br>

  </div>  
  <div class="col-xs-6 col-md-2" id="fecha_termino" >Documento de identificación
          <select id="doc_identificacion" name="doc_identificacion[]" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        <?php 
        foreach ($b as $k => $v) {
        $k++;
        if ($k != $fila_exp['doc_identificacion']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>    
    <br><br>No identificador:<br>
   <input class="form-control" type="text" id="no_identificacion" name="no_identificacion" value="<?php echo $fila_exp['no_identificacion']?>">
    <br>
  </div>
  <div class="col-xs-6 col-md-2" id="fecha_termino" >  
  <input type="submit" class="btn btn-success disable" value="Modificar" name="regfam" >
  <?php
  echo '<button class="alert-success"><a href="entregas_exp_proyectista.php?id_exp='.$no_exp.'">Regresar al expediente</a></button>';
  ?>
  </div>
  <div class="row" id="" >-----------------------------------------------------------------------------------------------------------------------COMPARECIENTE-----------------------------------------------------------------------------------------------------------------------------
  </div>
</div>
</div>
</form>
<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS DEL NOMBRE DE CLIENTE -->
    <?php 
    if(!empty($_POST["regfam"])) {
    ?>

    <?php 
    }
    ?>
<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  
      
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
 
</body>
</html> 