<?php
require_once "php/conexion.php";
$con= conectar();



session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();
}

/*$querynomuser = "SELECT u_nombre FROM u494342329_censo.usuario where idusuario =".$user." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();*/

$queryfam = "SELECT idfamilia, s_sector, f_manzana, f_familia, f_calle, f_numero, hoja FROM u494342329_censo.familia
inner join sector on familia.idsector2 = sector.idsector
where idusuario2 =".$user." order by idfamilia DESC;";



$resultfam = $con->query($queryfam);


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

    
    <title>Formato</title>
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>
    </head>
    <body>


<?php
include ("nav.php");
$queryMAN = "SELECT f_manzana FROM u494342329_censo.familia where idusuario2 = ".$user." group by f_manzana";
$resultadoMAN = mysqli_query($con, $queryMAN);

?>
<br>
<br>
<br>
<br>
<!--            <div class="col-2 color5">
                <select onchange="fconsman()" class="redondeado contorno color5" id="cbx_estado_c" name="cbx_estado_c">
                <option value="">Manzana</option>
                <?php while($rowMAN = $resultadoMAN->fetch_assoc()) {?>
                <option value=" <?php echo $rowMAN['f_manzana']; ?>" ><?php echo $rowMAN['f_manzana']; ?></option>
                <?PHP
                ;}
                ?> </select>
            </div>
<script type="text/javascript">
 --> 
</script>


<?php
$filas=mysqli_num_rows($resultfam);

if($filas<=0){
  echo '<center> <h2>no hay familias por consultar debes ingresar por lo menos una familia <h1></center>';
}

while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 

$idfami=$rowfam['idfamilia'];

$queryest = "SELECT e_estado_c FROM u494342329_censo.fam_est
inner join estado_civil on estado_civil.idestado_civil = fam_est.idestado_civil1 where idfamilia2 = ".$idfami.";";
$resultest = mysqli_query($con, $queryest);

?>
  <table class="table table-striped">
    <tr class="">
      <th>Sector: <?php echo $rowfam['s_sector'] ?></th>
      <th>Manzana: <?php echo $rowfam['f_manzana'] ?></th>

      <?php
      while ($rowest = $resultest->fetch_array(MYSQLI_BOTH)){     
      echo "<th>Estado Civil: ".$rowest['e_estado_c']."</th>";
      }
      ?>


    </tr>
    <tr class="">
      <th>Familia: <?php echo $rowfam['f_familia'] ?></th>
    </tr>
    <tr class="info">
      <th>Calle: <?php echo $rowfam['f_calle'] ?></th>
      <th>Numero: <?php echo $rowfam['f_numero'] ?></th>
      <th>No. Hoja: <?php echo $rowfam['hoja'] ?></th>
    </tr>
  </table>


        <table class="table table-striped">
          <tr class="">
            <th>Parentesco</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Bautizo</th>
            <th>1° Comunión</th>
            <th>Confirmación</th>
            <th>Gma</th>
            <th>Escolaridad</th>
            <th>Ocupación</th>
            <th>Religión</th>
            </tr>
<?php
$queryint = "SELECT p_parentesco, i_nombre, i_apellido_pat, i_apellido_mat, i_edad, s_sexo, i_bautizo, i_1com, i_confirmacion, i_gru_mov_aso, e_numero, e_escolaridad, l_ocupacion, o_ocupacion, n_religion, r_religion FROM u494342329_censo.integrante
inner join parentesco on parentesco.idparentesco = integrante.idparentesco1
inner join sexo on sexo.idsexo = integrante.idsexo1
inner join escolaridad on escolaridad.idescolaridad = integrante.idescolatidad
inner join ocupacion on ocupacion.idocupacion = integrante.idocupacion
inner join religion on religion.idreligion = integrante.idreligion where idfamilia1 =".$idfami.";";
$resultint = $con->query($queryint);


 while ($rowint = $resultint->fetch_array(MYSQLI_BOTH)){

          echo '<tr>
                <td>'.$rowint['p_parentesco'].'</td>
                <td>'.$rowint['i_nombre'].'</td>
                <td>'.$rowint['i_apellido_pat'].'</td>
                <td>'.$rowint['i_apellido_mat'].'</td>
                <td>'.$rowint['i_edad'].'</td>
                <td>'.$rowint['s_sexo'].'</td>
                <td>'.$rowint['i_bautizo'].'</td>
                <td>'.$rowint['i_1com'].'</td>
                <td>'.$rowint['i_confirmacion'].'</td>
                <td>'.$rowint['i_gru_mov_aso'].'</td>
                <td>'.$rowint['e_numero'].')'.$rowint['e_escolaridad'].'</td>
                <td>'.$rowint['l_ocupacion'].')'.$rowint['o_ocupacion'].'</td>
                <td>'.$rowint['n_religion'].')'.$rowint['r_religion'].'</td>
              </tr>';
           }
          ?>

          <tr class="">
            <th>Nombre</th>
            <th>Padecimiento</th>
            <th>tipo de padecimiento</th>
          </tr>         
<?php
$querypade = "SELECT i_nombre, p_padecimiento, p_tipo FROM u494342329_censo.integrante
inner join pad_int on integrante.idintegrante = pad_int.idintegrante1
inner join padecimiento on pad_int.idpadecimiento1 = padecimiento.idpadecimiento
where idfamilia1 = ".$idfami.";";

$resPADE = mysqli_query($con, $querypade);

          while ($registropade = $resPADE->fetch_array(MYSQLI_BOTH)){

          echo '<tr>
                <td>'.$registropade['i_nombre'].'</td>
                <td>'.$registropade['p_padecimiento'].'</td>
                <td>'.$registropade['p_tipo'].'</td>
              </tr>';
           }
          echo "<td><a href='modificar_fam1.php?idfam=".$idfami."'><button type='button'>Modificar</button></a></td>";           
          ?>

        </table>




<?php 
}
?>

<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>