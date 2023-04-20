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
      <th class="col-1">Nombre del Cliente/ Contacto</th>
      <th class="col-1">Certificaciones</th>
      <th class="col-1">Clg</th>
      <th class="col-2">Acto</th>
      <th class="col-1">Notas de apertura</th>
      <th class="col-1">Observaciones</th>
      <th class="col-1">---</th>
  
    </tr>
  </thead>

<?PHP
        $multiplicador = ($_GET['pag']-1)*8;

     $queryfam = "SELECT id_expediente, nombre_del_cliente, telefono, correo, recepcion_fecha_hora, p.u_nombre as proyectista, acto, exp_institu.institucion as institucion_exp, u.u_nombre, 
observaciones_1, clg_tipo, clg_auto_folio_real, folio_real, clave_valor, no_adeudo_predial, no_adeudo_agua, zonificacion, tradi_acto.actos as tradi_acto1, 
tradi_institu.institucion as tradi_institu1, observaciones_2,id_clg_tradicional, fech_entrega_prev_mesa FROM not190.expediente 
inner join proyectistas on proyectistas.id_proyectista = expediente.id_proyectista 
inner join usuarios as p on p.idusuario = proyectistas.id_usuario 
inner join exp_actos on exp_actos.id_acto = expediente.id_acto 
left join exp_institucion as exp_institu on exp_institu.id_institucion = expediente.id_institucion 
inner join usuarios as u on u.idusuario = expediente.id_usuario_n_exp 
left join clg_tipo on clg_tipo.id_clg_tipo = expediente.id_clg 
left join clg_tradicional as tradi on tradi.id_clg = expediente.id_clg_tradicional 
left join clg_actos as tradi_acto on tradi.id_acto = tradi_acto.id_clg_acto 
left join exp_institucion as tradi_institu on tradi_institu.id_institucion = tradi.id_institucion_clg_tradi 
where fech_entrega_prev_mesa is null
order by id_expediente DESC LIMIT ".$multiplicador.",8";


//echo "$queryfam";


    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);


    $sqlnumrows = "SELECT COUNT(*) as total FROM not190.expediente 
inner join proyectistas on proyectistas.id_proyectista = expediente.id_proyectista 
inner join usuarios as p on p.idusuario = proyectistas.id_usuario 
inner join exp_actos on exp_actos.id_acto = expediente.id_acto 
left join exp_institucion as exp_institu on exp_institu.id_institucion = expediente.id_institucion 
inner join usuarios as u on u.idusuario = expediente.id_usuario_n_exp 
left join clg_tipo on clg_tipo.id_clg_tipo = expediente.id_clg 
left join clg_tradicional as tradi on tradi.id_clg = expediente.id_clg_tradicional 
left join clg_actos as tradi_acto on tradi.id_acto = tradi_acto.id_clg_acto 
left join exp_institucion as tradi_institu on tradi_institu.id_institucion = tradi.id_institucion_clg_tradi 
where fech_entrega_prev_mesa is null
order by id_expediente DESC;";  
    
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
      <td><?php echo $rowfam['nombre_del_cliente'] ?><br>
        Tel.: <?php echo $rowfam['telefono'] ?><br>Correo: <?php echo $rowfam['correo'] ?>
      </td>
      <td>
          Clave y valor catastral: <b><?php if ($rowfam['clave_valor']>=1) echo "Listo";?> </b>
      <br>No adeudo de predial y mejora: <b><?php if ($rowfam['no_adeudo_predial']>=1) echo "Listo";?> </b>
      <br>No adeudo de agua o no servicio: <b><?php if ($rowfam['no_adeudo_agua']>=1) echo "Listo";?> </b>
      <br>Zonificación: <b><?php if ($rowfam['zonificacion']>=1) echo "Listo";?> </b>        
      </td>
      <td>CLG: <b><?php echo $rowfam['clg_tipo'] ?></b><br>
      Folio Real: <?php echo $rowfam['folio_real'] ?><?php echo $rowfam['clg_auto_folio_real'] ?><br> 

      </td>
      <td><?php if ($rowfam['tradi_acto1'] <= 0 && $rowfam['tradi_institu1'] <= 0) {
          echo "APERTURA- Acto: ".$rowfam['acto']."<br> Institución: ".$rowfam['institucion_exp'];
      }else{ ?>CLG- Acto: <?php echo $rowfam['tradi_acto1'] ?> <br>Institución: <?php echo $rowfam['tradi_institu1'] ?>
      <?php }?>
      </td>
      <td><?php echo $rowfam['observaciones_1'] ?></td>  
      <td><?php echo $rowfam['observaciones_2'] ?></td>
      <td>
        <a class="page-link text-dark" href="insert_previos.php?id_exp=<?PHP echo $rowfam['id_expediente'] ?>">Previos</a>
        
        <br>
              <?php 
              if ($rowfam['id_clg_tradicional'] >= 1) {
          echo '<button class="alert-success"><a href="CLG.php?id_clg='.$rowfam['id_clg_tradicional'].'">CLG word</a></button><br>';
            echo '<button class="alert-success"><a href="clave_valor.php?id_clg='.$rowfam['id_clg_tradicional'].'">clave valor</a></button><br>';
            echo '<button class="alert-success"><a href="agua.php?id_clg='.$rowfam['id_clg_tradicional'].'">agua</a></button><br>';
            echo '<button class="alert-success"><a href="zonificacion.php?id_clg='.$rowfam['id_clg_tradicional'].'">zonificacion</a></button><br>';
            echo '<button class="alert-success"><a href="predial.php?id_clg='.$rowfam['id_clg_tradicional'].'">Predial y Mejoras</a></button><br>';
              }
        
          echo '<br> <br><button class="alert-success"><a href="exp_pasar_mesa_prev.php?id_exp='.$rowfam['id_expediente'].'&user='.$user.'">Entregado a Mesa</a></button>';  
          
                  
       
          ?>
      </td>
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
              <a class="page-link text-dark" href="consultar_previa.php?pag=<?PHP echo $_GET['pag']-1 ?>">Anterior</a>
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
                <a class="page-link text-dark" href="consultar_previa.php?pag=<?PHP echo $i ?>"><?PHP echo $i ?></a>
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
              <a class="page-link text-dark" href="consultar_previa.php?pag=<?PHP echo $_GET['pag']+1 ?>">Siguiente</a>
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