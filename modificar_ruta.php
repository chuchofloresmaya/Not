<?php
require_once "php/conexion.php";

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

if(isset($_GET['idfam'])){
$conidfam = $_GET['idfam'];    

$querymodfam = "SELECT id_ruta,fecha, hora, Nombre_del_lugar, motivo, nombre, documentos, notas FROM not190.rutas 
left join lugares on lugares.id_lugares = rutas.id_lugar1
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
left join motivo_ruta on motivo_ruta.id_motivo = rutas.id_motivo1 where id_ruta = ".$conidfam.";";

$resultcfam = mysqli_query($con, $querymodfam);
$fila = $resultcfam->fetch_assoc();


$query = "SELECT id_lugares, Nombre_del_lugar FROM not190.lugares;";
$resultado = mysqli_query($con, $query);

$query1 = "SELECT id_motivo, motivo FROM not190.motivo_ruta;";
$resultado1 = mysqli_query($con, $query1);


}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <!-- Icono -->
    
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
<center><h1 class="display-3">Modificar</h1></center>
<div class="table table-hover">
        <form id="formulario_sec" name="formulario_sec" action="modificar_fam3.php" method="post" onsubmit="return validacion_fam();">
<input type="hidden" name="id_isrob1" value="<?php echo $conidfam; ?>">   
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-2">Fecha:
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Fecha de la cita o en la que se requiere el tramite, documento, entrega, etc.">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
</span>
  <br><input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" >
  Hora:
      <input class="form-control" type="time" id="hora" name="hora" value="<?php echo $fila['hora']; ?>">
  </div>
  <div class="col-xs-6 col-md-2">Lugar:  
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Seleccione el tipo de escritura ordinaria o especial">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
    <select id="ores" class="btn btn-outline-secondary btn-sm" name="cbx_ores">
            
            <?php while($row = $resultado->fetch_assoc()) {
            if($row['id_lugares'] == $fila['id_lugar1']){
            ?>
            <option value="<?php echo $row['id_lugares']; ?>" selected><?php echo $row['Nombre_del_lugar']; ?></option>
            <?php
            }else{
            ?>
            <option value="<?php echo $row['id_lugares']; ?>" ><?php echo $row['Nombre_del_lugar']; ?></option>
            <?php
            };}
            ?>
            
    </select>
    <br>
  </div>
  <div class="col-xs-6 col-md-2">Persona: 
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Nombre, Puesto o Carateristica de la persona a la que se visita">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
  <input class="form-control" name="persona" id="persona" placeholder="" size="25" maxlength="50" onkeypress="letrasMayus(this);" value="<?php echo $fila['nombre']; ?>"/>
  </div>
  
  <div class="col-xs-6 col-md-2">Motivo:  
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Seleccione el tipo de escritura ordinaria o especial">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
    <select id="oresmot" class="btn btn-outline-secondary btn-sm" name="oresmot">
            
            <?php while($rowmot = $resultado1->fetch_assoc()) {
            if($rowmot['id_motivo'] == $fila['id_motivo1']){
            ?>
            <option value="<?php echo $rowmot['id_motivo']; ?>" selected><?php echo $rowmot['motivo']; ?></option>            
            <?php
            }else{
            ?>
            <option value="<?php echo $rowmot['id_motivo']; ?>" ><?php echo $rowmot['motivo']; ?></option>
            <?PHP 
            };}
            ?>
    </select>
  </div>

</div>
    <div class="col-xs-6 col-md-3"> </div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-2">
    Documentos:
    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese Ingrese los documentos que se llevaran para entregar, tramite, firma, etc.">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
    <br>
    <textarea class="form-control" id="documentos" name="documentos" rows="3" form="formulario_sec"><?php echo $fila['documentos']; ?></textarea>
  </div>
  <div class="col-xs-6 col-md-2 ">Notas:
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Notas extras">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
   <textarea class="form-control" id="notas" name="notas" rows="3" form="formulario_sec"><?php echo $fila['notas']; ?></textarea>
    </div>
  <div class="col-xs-6 col-md-2">
  <br>
  <br>
  <input type="submit" class="btn btn-success disable" value="Ingresar Ruta" name="regfam" ></div>
  </div>
  <div class="col-xs-6 col-md-5">
  </div>
</div>


        </div>
        </form>

 
</center>
<br><br>

<!-- Archivos de boostrap js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>