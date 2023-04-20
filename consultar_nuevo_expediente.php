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

	
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>

    </head>
    <body>
<?php
include ("nav.php");

?>
<center><h1 class="display-3">Expedientes</h1></center>

<div class="container">
    <table class="table table-striped table-bordered">
  <thead>

    <tr>
      
      <th class="col-1">No.Expediente</th>
      <th class="col-2">Nombre del Cliente</th>
      <th class="col-2">Contacto</th>
      <th class="col-1">Proyectista</th>
      <th class="col-2">Acto/Institucion</th>
      <th class="col-1">Observaciones</th>
  
    </tr>
  </thead>

<?PHP
        $multiplicador = ($_GET['pag']-1)*8;

     $queryfam = "SELECT id_expediente, nombre_del_cliente, telefono, correo, recepcion_fecha_hora, p.u_nombre as proyectista, acto, institucion, u.u_nombre, observaciones_1 FROM not190.expediente inner join proyectistas on proyectistas.id_proyectista = expediente.id_proyectista inner join usuarios as p on p.idusuario = proyectistas.id_usuario inner join exp_actos on exp_actos.id_acto = expediente.id_acto left join exp_institucion on exp_institucion.id_institucion = expediente.id_institucion inner join usuarios as u on u.idusuario = expediente.id_usuario_n_exp order by id_expediente DESC LIMIT ".$multiplicador.",8";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);


    $sqlnumrows = "SELECT COUNT(*) as total FROM not190.expediente inner join proyectistas on proyectistas.id_proyectista = expediente.id_proyectista inner join usuarios as p on p.idusuario = proyectistas.id_usuario inner join exp_actos on exp_actos.id_acto = expediente.id_acto left join exp_institucion on exp_institucion.id_institucion = expediente.id_institucion inner join usuarios as u on u.idusuario = expediente.id_usuario_n_exp order by id_expediente DESC;";  
    $resultc = mysqli_query($con,$sqlnumrows);
    $rowtc = $resultc->fetch_assoc();


     $totale = $rowtc['total']/8 ;
     $redondeo = ceil($totale);
 

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td><center><?php echo $rowfam['id_expediente'] ?></center></td>
      <td><?php echo $rowfam['nombre_del_cliente'] ?></td>
      <td>Tel.: <?php echo $rowfam['telefono'] ?><br>Correo: <?php echo $rowfam['correo'] ?></td>
      <td><?php echo $rowfam['proyectista'] ?> </td>
      <td><?php echo $rowfam['acto'] ?> <br><?php echo $rowfam['institucion'] ?></td>
      <td><?php echo $rowfam['observaciones_1'] ?></td>  
    </tr>


<?PHP


        }
?>

</tbody>
</table>
        <nav aria-label="...">
          <ul class="pagination ">
            <?PHP
            if($_GET['pag'] == 1){    
            ?>
            <li class="page-item disabled">
              <span class="page-link">Anterior</span>
            </li>
            <?PHP 
            }else{ 
            ?>
            <li class="page-item">
              <a class="page-link text-dark" href="consultar_nuevo_expediente.php?pag=<?PHP echo $_GET['pag']-1 ?>">Anterior</a>
            </li>
            <?PHP 
            } 
            for ($i=1;$i<=$redondeo;$i++){
                if($i == $_GET['pag']){    
                    ?>
            <li class="page-item active">
              <span class="page-link bg-secondary text-white"><?PHP echo $i ?><span class="sr-only">(current)</span>
              </span>
            </li>

            <?php
            }else{
            ?>

            <li class="page-item">
                <a class="page-link text-dark" href="consultar_nuevo_expediente.php?pag=<?PHP echo $i ?>"><?PHP echo $i ?></a>
            </li>
            <?PHP
            }}
            if($_GET['pag'] == $redondeo){
            ?>            
            <li class="page-item disabled">
              <span class="page-link ">Siguiente</span>
            </li>
            <?PHP
                }else{
            ?>

            <li class="page-item">
              <a class="page-link text-dark" href="consultar_nuevo_expediente.php?pag=<?PHP echo $_GET['pag']+1 ?>">Siguiente</a>
            </li>
            <?PHP
                }
            ?>            
          </ul>
        </nav>
</div>



<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>