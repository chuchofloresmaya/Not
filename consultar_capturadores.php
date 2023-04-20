<?php
session_start();
?>

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

$querycap = "SELECT idusuario, u_nombre, s_sector FROM u494342329_censo.usu_sec
inner join usuario on usuario.idusuario = usu_sec.idusuario1
inner join sector on sector.idsector = usu_sec.idsector1;";
$resultcap = mysqli_query($con, $querycap);


?>
<br>
<br>
<br>
<br>

<form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="get">
   <div class="col-2 color5">
        <select class="redondeado contorno color5" id="userc" name="userc">
        <?php while($rowcap = $resultcap->fetch_assoc()) {?>
        <option value=" <?php echo $rowcap['idusuario']; ?>" ><?php echo $rowcap['s_sector'].' ) '.$rowcap['u_nombre']; ?></option>
        <?PHP
        ;}
        ?> </select>
    </div>
<input type="submit" class="btn btn-success disable" value="Consultar" name="consult" ></br></br>

<?php



if(isset($_GET['consult'])){
$userc = $_GET['userc'];

$querynomuser = "SELECT u_nombre FROM u494342329_censo.usuario where idusuario =".$userc." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();

echo '<center> <h2>Usuario: '.$rowusu['u_nombre'].'</h2></center>';

$queryfam = "SELECT idfamilia, s_sector, f_manzana, f_familia, f_calle, f_numero, hoja FROM u494342329_censo.familia
inner join sector on familia.idsector2 = sector.idsector
where idusuario2 =".$userc." order by idfamilia DESC;";
$resultfam = $con->query($queryfam);

$filas=mysqli_num_rows($resultfam);

if($filas<=0){
  echo '<center> <h2>Este Ususario no ha registrado nada </h2></center>';
}

while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 

$idfami=$rowfam['idfamilia'];

$queryest = "SELECT e_estado_c FROM u494342329_censo.fam_est
inner join estado_civil on estado_civil.idestado_civil = fam_est.idestado_civil1 where idfamilia2 = ".$idfami.";";
$resultest = mysqli_query($con, $queryest);

?>

<script>
function envia(elemento){
var valor = elemento.previousSibling.value;
var el_id = elemento.previousSibling.id;
var usu = '<?php echo $user; ?>';
var usuc = '<?PHP echo $userc; ?>';
window.location.href = 'comentar_fam.php?valor='+ valor + '&id=' + el_id + '&usuadm=' + usu + '&usuc=' + usuc;
}
</script>
<div id="<?php echo $idfami?>">
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
    <tr class="">
      <th>Calle: <?php echo $rowfam['f_calle'] ?></th>
      <th>Numero: <?php echo $rowfam['f_numero'] ?></th>
      <th>No. Hoja: <?php echo $rowfam['hoja'] ?></th>
    </tr>
  </table>
</div>



        <table class="table table-striped">
          <tr class="">
            <th>Parentesco</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Bautizo</th>
            <th>1 Com</th>
            <th>Confirmacion</th>
            <th>Gma</th>
            <th>escolaridad</th>
            <th>ocupacion</th>
            <th>religion</th>
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

          <tr class="table table-striped">
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
<td>
<form action="#">

<textarea user="<?php echo $user;?>" id="<?php echo $idfami; ?>" value="" row="2" col="2"></textarea><input type="button" onclick="envia(this);" value="Comentar" />
</td>
</form>
</table>
<?php
$querycom = "SELECT u_nombre, comentario FROM u494342329_censo.comentario
inner join usuario on idusuario3 = idusuario
where idfamilia3 = ".$idfami.";";
$restultcom = mysqli_query($con, $querycom);
$filascom=mysqli_num_rows($restultcom);
if($filascom>=1){
  

?>

<center>
  <table >
    <tr>
        <th >Ususario</th>
        <th >Comentario</th>
    </tr>
    <tr>
        <?php
        while ($rowcom = $restultcom->fetch_array(MYSQLI_BOTH)){ 
        ?>
        <th><?php echo $rowcom['u_nombre'] ?></th>
        <th><?php echo $rowcom['comentario'] ?></th>
    </tr>
        <?php
        }
        ?>
</table>
</center>
<?php 
}
}
}
?>

</body>
</html>