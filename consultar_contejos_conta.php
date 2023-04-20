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

    $multiplicador = ($_GET['pag']-1)*50;

$queryfam = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, copia, c_fecha, fname, name ,id_usuario3, u_nombre, id_acta, n_tipo, tipo_esc, ac_esc, vol_tipo, ac_vol, a_targeta, tipo_targetas, tipo_factura, a_factura, tipo_identificacion, a_idmex, tipo_otros, a_otro, ac_manual,ac_contenido FROM not190.cotejos 
        inner join hojas on cotejos.c_tamaño = hojas.id_hoja 
        inner join lados on cotejos.c_lados = lados.id_lado 
        inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado 
        LEFT JOIN personas ON cotejos.c_persona = personas.id_persona 
        LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa 
        LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad 
        inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa 
        inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario 
        LEFT join actas on actas.id_cotejo1 = cotejos.id_cotejo 
        LEFT join ac_tipos on actas.id_tipo1 = ac_tipos.id_ac_tipo
        LEFT join esc_tipo on actas.id_esc_tipo = esc_tipo.id_esc_tipo
        left join vol_tipo on actas.id_esc_vol = vol_tipo.id_vol_tipo
        LEFT JOIN acta_targetas on actas.id_targetas1 = acta_targetas.id_targetas
        LEFT JOIN ac_facturas on actas.id_factura1 = ac_facturas.id_factura
        LEFT JOIN ac_identificaciones on actas.ac_idoficial1 = ac_identificaciones.ac_idoficial
        LEFT JOIN ac_idotros on actas.id_otro = ac_idotros.ac_idotro
        LEFT JOIN ac_contenidos on actas.id_contenido = ac_contenidos.id_contenido
        order by c_nocotejo DESC LIMIT ".$multiplicador.",50";

$resultfam = $con1->query($queryfam);
$filasisr=mysqli_num_rows($resultfam);

    $sqlnumrows = "SELECT COUNT(*) as total FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario order by id_cotejo;";  
    $resultc = mysqli_query($con,$sqlnumrows);
    $rowtc = $resultc->fetch_assoc();


     $totale = $rowtc['total']/50 ;
     $redondeo = ceil($totale);
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
<center><h1 class="display-3">Cotejos General</h1></center>

<div class="container">
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
              <a class="page-link text-dark" href="consultar_contejos_conta.php?pag=<?PHP echo $_GET['pag']-1 ?>">Anterior</a>
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
                <a class="page-link text-dark" href="consultar_contejos_conta.php?pag=<?PHP echo $i ?>"><?PHP echo $i ?></a>
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
              <a class="page-link text-dark" href="consultar_contejos_conta.php?pag=<?PHP echo $_GET['pag']+1 ?>">Siguiente</a>
            </li>
            <?PHP
                }
            ?>            
          </ul>
        </nav>
    <table class="table table-striped table-bordered">
  <thead>

    <tr>
      
      <th class="col-1">Cotejo y Libro</th>
      <th class="col-1">Fecha</th>
      <th class="col-2">Solicitud </th>
      <th class="col-1">Fojas y Tantos </th>
      <th class="col-3">Documento</th>
      <th class="col-2">Costo</th>
      

      
      
    </tr>
  </thead>


<?PHP


        if($filasisr<=0){
          echo '<center> <h2>No hay cotejos por consultar <h1></center>';
        }

        if(isset($_GET['idfam'])){
        $conidfam = $_GET['idfam'];

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){  

            if ($conidfam == $rowfam['id_cotejo']) {
?>

            <tr>
      
          <th>No.Cotejo: <b> <?php echo $rowfam['c_nocotejo'] ?></b><br> Libro: <b><?php echo $rowfam['c_libro'] ?> </b></th>
          <th><?php echo $rowfam['c_fecha'] ?></th>
          <th><?php echo $rowfam['p_nombre'] ?> <?php echo $rowfam['e_nombre'] ?> <?php echo $rowfam['t_sociedad'] ?></th>
          <th>Tantos: <b><?php echo $rowfam['c_tantos_soli']+1; ?></b> <br> Fojas: <b><?php echo $rowfam['c_hoja'] ?></th>
          <th><?php echo $rowfam['c_fecha'] ?></th>
          <th></th>
          <th>
            <button class="alert-success"><a href="certificacion_cotejo-<?php echo $rowfam['c_tamaño'];?>.php?idcot=<?php echo $rowfam['id_cotejo'];?>">Certificación</a></button><br>
            <button class="alert-success"><a href="download.php?filename=<?php echo $rowfam['name'];?>&f=<?php echo $rowfam['fname']; ?>">Archivo</a></button><br> <?php echo $rowfam['name'] ?><br>
            <?php echo "<a href='modificar_cotejo.php?pag=".$_GET['pag']."&idfam=".$rowfam['id_cotejo']."'><button type='button'>Modificar</button></a>" ?>
          </th>
          <th><?php echo $rowfam['u_nombre'] ?> 
          <?php echo $rowfam['id_acta']."<--";
          if ($rowfam['id_acta'] > 0) {
            echo '<button class="alert-success"><a href="acta_num.php?acta='.$rowfam['id_acta'].'">Acta word</a></button>';
          } ?>
          </th>
              
            </tr>
<?PHP
            }else{
?>
            <tr>
      
      <td>No.Cotejo: <b> <?php echo $rowfam['c_nocotejo'] ?></b><br> Libro: <b><?php echo $rowfam['c_libro'] ?> </b></td>
      <td><?php echo $rowfam['p_nombre'] ?> <?php echo $rowfam['e_nombre'] ?> <?php echo $rowfam['t_sociedad'] ?></td>
      <td>Tantos: <b><?php echo $rowfam['c_tantos_soli']+1; ?></b> <br> Fojas: <b><?php echo $rowfam['c_hoja'] ?></td>
      <td><?php echo $rowfam['c_fecha'] ?></td>
      <td>fojas, Por <b><?php echo $rowfam['l_lado'] ?></b>... <br> me fue mostrada al <b><?php echo $rowfam['m_lados'] ?></b><br> Tamaño:  <b> <?php echo $rowfam['h_tamaño'] ?><br>
          En <?php echo $rowfam['hoja_anexa'] ?><br><b><?php if($rowfam['copia'] == 2) echo "copia certificada"; ?></b>
      </td>
      <td>
        <button class="alert-success"><a href="certificacion_cotejo-<?php echo $rowfam['c_tamaño'];?>.php?idcot=<?php echo $rowfam['id_cotejo'];?>">Certificación</a></button><br>
        <button class="alert-success"><a href="download.php?filename=<?php echo $rowfam['name'];?>&f=<?php echo $rowfam['fname']; ?>">Archivo</a></button><br> <?php echo $rowfam['name'] ?><br>
        <?php echo "<a href='modificar_cotejo.php?pag=".$_GET['pag']."&idfam=".$rowfam['id_cotejo']."'><button type='button'>Modificar</button></a>" ?>
      </td>
      <td><?php echo $rowfam['u_nombre'] ?>
          <?php echo $rowfam['id_acta']."<--";
          if ($rowfam['id_acta'] > 0) {
            echo '<button class="alert-success"><a href="acta_num.php?acta= '.$rowfam['id_acta'].'">Acta word</a></button>';
          } ?>
      </td>

              
      
        </tr>
<?PHP
            }
        }

        }    


        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td>No.Cotejo: <p class="font-weight-bold"><?php echo $rowfam['c_nocotejo'] ?></p> Libro: <p class="font-weight-bold"><?php echo $rowfam['c_libro'] ?> </p></td>
      <td><?php echo $rowfam['c_fecha'] ?></td>
      <td><?php echo $rowfam['p_nombre'] ?> <?php echo $rowfam['e_nombre'] ?> <?php echo $rowfam['t_sociedad'] ?></td>
      
      <td>Tantos: <p class="font-weight-bold"><?php echo $rowfam['c_tantos_soli']; ?></p>Fojas: <p class="font-weight-bold"><?php echo $rowfam['c_hoja'] ?></p></td>
      <td><?php echo $rowfam['n_tipo']." ".$rowfam['tipo_esc']." ".$rowfam['ac_esc']." ".$rowfam['vol_tipo']." ".$rowfam['ac_vol']." ".$rowfam['a_targeta']." ".$rowfam['tipo_targetas']." ".$rowfam['tipo_factura']." ".$rowfam['a_factura']." ".$rowfam['tipo_identificacion']." ".$rowfam['a_idmex']." ".$rowfam['tipo_otros']." ".$rowfam['a_otro']." ".$rowfam['ac_manual']." ".$rowfam['ac_contenido'] ?> </td>
      <td><?php 
      $fojas = $rowfam['c_hoja']-1;
      $tantos = $rowfam['c_tantos_soli'];
      $precio = (($fojas*25)+250)*($tantos);
      echo "((".$fojas."*25)+250)*(".$tantos.") = $".$precio;
      ?>
      </td>
      <td>
        <button class="alert-success"><a href="download.php?filename=<?php echo $rowfam['name'];?>&f=<?php echo $rowfam['fname']; ?>">Archivo</a></button><br> <?php echo $rowfam['name'] ?><br>
      </td>
      
      
    </tr>


<?PHP


        }
?>
  </tbody>
</table>


</div>

<?PHP

?>


<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>