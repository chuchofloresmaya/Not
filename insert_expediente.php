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


$queryproy = "SELECT id_proyectista, u_nombre FROM not190.proyectistas
inner join usuarios on proyectistas.id_usuario = usuarios.idusuario;";
$resulproyect = mysqli_query($con, $queryproy);


$queryactos = "SELECT * FROM not190.exp_actos;";
$resultactos = mysqli_query($con, $queryactos);

while($rowacto = $resultactos->fetch_assoc()) {
      $acto = $rowacto['acto'];

$actos[] = $rowacto['acto'];
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

<center><h1 class="display-3">Nuevo Expediente</h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-3">Nombre del cliente: 
  <input name="nombre_cliente" id="nombre_cliente" size="10" class="form-control">
  </div>
  <div class="col-xs-6 col-md-2">Telefono:
      <input class="form-control" type="number" id="numero" name="numero" value="">
  </div>
  <div class="col-xs-6 col-md-2">Correo electronico:
      <input class="form-control" type="text" id="correo" name="correo" value="">
  </div>
 <div class="col-xs-6 col-md-2">
   <label for="name">Proyectista:<span></span></label><br>

      <select id="selec_proyect" name="selec_proyect" class="btn btn-outline-secondary btn-sm" name="selec_proyect">
            <?php while($rowtam = $resulproyect->fetch_assoc()) { ?>
                <option value="<?php echo $rowtam['id_proyectista']; ?>"><?php echo $rowtam['u_nombre']; ?></option>
            <?php
            }
            ?>
    </select>


 </div>
</div>
<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<BR>
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
                  <div class='box-body'>
                  <div class="form-group">
                <label for="pais">Acto:</label>
                <select name="pais" id="pais" class="form-control" required>
                    <option value=""> Acto...</option>
                       <?php 
                    foreach ($actos as $k => $v) {
                    $k++;
                    echo "<option value=".$k.">".$v."</option>";                               
                    } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad">Institución:</label>
                <select name="ciudad" id="ciudad" class="form-control"></select>
            </div>
              </div>

  <div class="col-xs-6 col-md-2 ">Observaciones:
    <textarea rows="6" cols="40" name="feedback" form="formulario_sec"  ></textarea>
  </div>
    <div class="col-xs-6 col-md-2">
      <input type="submit" class="btn btn-success disable" value="Ingresar Expediente" name="regfam" >
    </div>
</div>
<div class="row">
  <div class="col-xs-6 col-md-1 "> </div>
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2"></div>
  <div class="col-xs-6 col-md-2">
  </div>
  <div class="col-xs-6 col-md-8"></div>
  
</div>


        </div>
        </form>

<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->
<script language="javascript">
$(document).ready(function(){
    $("#pais").on('change', function () {
        $("#pais option:selected").each(function () {
            paiselegido=$(this).val();
            $.post("buscarinstituciones.php", { paiselegido: paiselegido }, function(data){
                $("#ciudad").html(data);
            });     
        });
   });
});
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

    $nombre_cliente = $_POST['nombre_cliente'];  
    $telefono = $_POST['numero'];
    $correo = $_POST['correo'];
    $id_proyectista = $_POST['selec_proyect'];
    $id_acto = $_POST['pais'];
    $id_institucion = $_POST['ciudad'];
    $feedback = $_POST["feedback"];
  
  //echo "<br> Telefono: ".$telefono;
  /*echo "<br> Name obtenido: ".$nombre_cliente;
  echo "<br> Telefono: ".$telefono;
  echo "<br> Correo: ".$correo;
  echo "<br> id_proyectista: ".$id_proyectista;
  echo "<br> id_acto: ".$id_acto;
  echo "<br> id_institucion: ".$id_institucion;
  echo "<br> Observaciones: ".$feedback;*/

  if ($id_proyectista < 0) {
    $id_proyectista == "null";
  }
  if ($id_acto < 0) {
    $id_acto = "null";
  }
  if ($id_institucion < 0) {
    $id_institucion = "null";
  }
  $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); 
  
          $insert_expdiente = "INSERT INTO `not190`.`expediente` (`nombre_del_cliente`, `telefono`, `correo`, `recepcion_fecha_hora`, `id_proyectista`, `id_acto`, `id_institucion`, `observaciones_1`, `id_usuario_n_exp`) VALUES ('".$nombre_cliente."', '".$telefono."', '".$correo."', '".$date->format("Y-m-d H:i:s")."', ".$id_proyectista.", ".$id_acto.", ".$id_institucion.", '".$feedback."', '".$user."');";
        //echo $insert_expdiente;
      $result_insert_expediente = mysqli_query($con, $insert_expdiente);

?>

<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-1">Número de Expediente</th>
      <th class="col-2">Nombre del cliente</th>
      <th class="col-2">Contacto</th>
      <th class="col-2">Proyectista</th>
      <th class="col-1">Acto/institucion</th>
      <th class="col-1">Observaciones</th>
      
      
    </tr>
  </thead>

<?PHP

    $queryfam = "SELECT id_expediente, nombre_del_cliente, telefono, correo, recepcion_fecha_hora, p.u_nombre as proyectista, acto, institucion, u.u_nombre, observaciones_1 FROM not190.expediente inner join proyectistas on proyectistas.id_proyectista = expediente.id_proyectista inner join usuarios as p on p.idusuario = proyectistas.id_usuario inner join exp_actos on exp_actos.id_acto = expediente.id_acto left join exp_institucion on exp_institucion.id_institucion = expediente.id_institucion inner join usuarios as u on u.idusuario = expediente.id_usuario_n_exp order by id_expediente DESC LIMIT 10;";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 

?>

    <tr>
      
      <td>No.Exp.: <b> <?php echo $rowfam['id_expediente'] ?></b></td>
      <td>Nombre: <?php echo $rowfam['nombre_del_cliente'] ?></td>
      <td>Tel.:<b><?php echo $rowfam['telefono']; ?></b> <br> Correo: <b><?php echo $rowfam['correo'] ?></b></td>
      <td><?php echo $rowfam['proyectista'] ?></td>
      <td>Acto <b><?php echo $rowfam['acto'] ?><br><?php echo $rowfam['institucion'] ?></td>    
      <td><?php echo $rowfam['observaciones_1'] ?></td>
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
  
    </script> 
</body>
</BR>
</html>