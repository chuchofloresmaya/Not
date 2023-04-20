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
<center><h1 class="display-3">ISR General</h1></center>

<div class="container">
    <table class="table table-striped table-bordered">
  <thead>

    <tr>
      
      <th class="col-1">Escritura</th>
      <th class="col-1">Tipo </th>
      <th class="col-1">Volumen </th>
      <th class="col-1">Mes </th>
      <th class="col-2">Enajenante - Adquiriente</th>
      <th class="col-1">Fecha</th>
      <th class="col-1">Folio</th>
      <th class="col-1">Validez</th>
      <th class="col-1">Federativa - Entidad</th>
      <th class="col-1">CFDI</th>
      <th class="col-1">Usuario</th>
      
    </tr>
  </thead>

<?PHP
        $multiplicador = ($_GET['pag']-1)*8;

     $queryfam = "SELECT escritura, irs_tipo, volumen, mes, enajenante, adquiriente, fecha, folio, validez, federativa, entidad, cfdi, u_nombre FROM not190.isr inner join tipo_isr on isr.id_tipo1 = tipo_isr.id_tipo inner join mes on isr.id_mes1 = mes.id_mes inner join uif on isr.id_uif1 = uif.id_uif inner join usuarios on isr.id_usuario1 = usuarios.idusuario order by id_isr DESC LIMIT ".$multiplicador.",8";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);


    $sqlnumrows = "SELECT COUNT(*) as total FROM not190.isr inner join tipo_isr on isr.id_tipo1 = tipo_isr.id_tipo inner join mes on isr.id_mes1 = mes.id_mes inner join uif on isr.id_uif1 = uif.id_uif inner join usuarios on isr.id_usuario1 = usuarios.idusuario order by id_isr DESC;";  
    $resultc = mysqli_query($con,$sqlnumrows);
    $rowtc = $resultc->fetch_assoc();


     $totale = $rowtc['total']/8 ;
     $redondeo = ceil($totale);
 



$queryfam = "SELECT COUNT(*) FROM not190.isr inner join tipo_isr on isr.id_tipo1 = tipo_isr.id_tipo inner join mes on isr.id_mes1 = mes.id_mes inner join uif on isr.id_uif1 = uif.id_uif inner join usuarios on isr.id_usuario1 = usuarios.idusuario order by id_isr DESC;";

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td><center><?php echo $rowfam['escritura'] ?></center></td>
      <td><?php echo $rowfam['irs_tipo'] ?></td>
      <td><?php echo $rowfam['volumen'] ?></td>
      <td><?php echo $rowfam['mes'] ?></td>
      <td><?php echo $rowfam['enajenante'] ?> <br> <?php echo $rowfam['adquiriente'] ?></td>
      <td><?php echo $rowfam['fecha'] ?></td>
      <td><?php echo $rowfam['folio'] ?></td>
      <td><?php echo $rowfam['validez'] ?></td>
      <td>$<?php echo $rowfam['federativa'] ?> <br> $<?php echo $rowfam['entidad'] ?></td>
      <td><?php echo $rowfam['cfdi'] ?></td>
      <td><?php echo $rowfam['u_nombre'] ?></td>
      
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
              <a class="page-link text-dark" href="consultar_isrg.php?pag=<?PHP echo $_GET['pag']-1 ?>">Anterior</a>
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
                <a class="page-link text-dark" href="consultar_isrg.php?pag=<?PHP echo $i ?>"><?PHP echo $i ?></a>
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
              <a class="page-link text-dark" href="consultar_isrg.php?pag=<?PHP echo $_GET['pag']+1 ?>">Siguiente</a>
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