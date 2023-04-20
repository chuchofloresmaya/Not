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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <!-- Responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/paginacion.css">
	
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>

    </head>
    <body>
<?php
include ("nav.php");
?>
<center><h1 class="display-3">Mi Bitácora</h1></center>

<div class="container my-5">
  <nav aria-label="...">
    <ul class="pagination">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active">
        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
      </li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>


<div class="container">
<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-2">Fecha - Hora</th>
      <th class="col-2">Lugar </th>
      <th class="col-1">Persona </th>
      <th class="col-1">Motivo </th>
      <th class="col-2">Documentos</th>
      <th class="col-2">Notas</th>

       
      
      
    </tr>
  </thead>

<?PHP
    $queryfam = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, persona, motivo, documentos, notas, u_nombre  FROM not190.rutas
inner join lugares on rutas.id_lugar1 = lugares.id_lugares
inner join motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo
inner join usuarios on rutas.id_ususario2 = usuarios.idusuario
order by id_ruta DESC;";

$resultfam = $con1->query($queryfam);
$filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay rutas por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td><?php echo $rowfam['fecha'] ?> - <?php echo $rowfam['hora'] ?></td>
      <td><?php echo $rowfam['Nombre_del_lugar'] ?> - <?php echo $rowfam['lugar_no_comun'] ?></td>
      <td><?php echo $rowfam['persona'] ?></td>
      <td><?php echo $rowfam['motivo'] ?></td>
      <td><?php echo $rowfam['documentos'] ?></td>
      <td><?php echo $rowfam['notas'] ?></td>
      
    </tr>


<?PHP


        }
?>
  </tbody>
</table></div>



<?PHP

?>


<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>