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

$querycap = "SELECT * FROM u494342329_censo.sector;";
$resultcap = mysqli_query($con, $querycap);


?>
<br>
<br>
<br>
<br>

<form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="get">
   <div class="col-2 color5">
        <select class="redondeado contorno color5" id="sec" name="sec">
        <?php while($rowcap = $resultcap->fetch_assoc()) {?>
        <option value=" <?php echo $rowcap['idsector']; ?>" ><?php echo $rowcap['s_sector']?></option>
        <?PHP
        ;}
        ?> </select>
        <select class="redondeado contorno color5" id="sac" name="sac">
        	<option value="i_bautizo" >Bautismo</option>
        	<option value="i_1com" >Primera Comunión</option>
        	<option value="i_confirmacion" >Confirmación</option>
        </select>

    </div>
<input type="submit" class="btn btn-success disable" value="Consultar" name="consult" ></br></br>

<?php



if(isset($_GET['consult'])){
$sec = $_GET['sec'];
$sac = $_GET['sac'];

$querynomuser = "SELECT idintegrante,i_nombre, f_familia, i_edad, s_sector,f_manzana, f_calle, f_numero,i_confirmacion, r_religion FROM u494342329_censo.integrante
inner join familia on integrante.idfamilia1 = familia.idfamilia
inner join sector on sector.idsector = familia.idsector2
inner join religion on religion.idreligion = integrante.idreligion
where (".$sac." = 'NO') and (i_edad >= 12) and (idsector = ".$sec.") ;";   
$resultfam = $con->query($querynomuser);


$querysec = "SELECT * FROM u494342329_censo.sector where idsector = ".$sec.";";  
$ressec = mysqli_query($con,$querysec);
$rowsec = $ressec->fetch_assoc();

$queryconut = "SELECT count(*) FROM u494342329_censo.integrante
inner join familia on integrante.idfamilia1 = familia.idfamilia
inner join sector on sector.idsector = familia.idsector2
inner join religion on religion.idreligion = integrante.idreligion
where (".$sac." = 'NO') and (i_edad >= 12) and (idsector = ".$sec.") ;";   
$rescont = mysqli_query($con,$queryconut);
$rowcont = $rescont->fetch_assoc();


$filas=mysqli_num_rows($resultfam);


echo '<center> <h2>Sector: '.$rowsec['s_sector'].'</h2></center>';
if($sac== 'i_bautizo'){
	echo '<center> <h2>Sacramento del Bautismo </h2></center>';
}else if ($sac== 'i_1com'){
	echo '<center> <h2>Sacramento de la Primera Comunión </h2></center>';
}else if ($sac== 'i_confirmacion'){
	echo '<center> <h2>Sacramento de la Confirmación </h2></center>';
}


if($filas<=0){
  echo '<center> <h2>No Hay Gente registrada que no tengo el este Sacramento</h2></center>';
}

echo '<center> <h2>Total de personas sin este sacramento: '.$rowcont['count(*)'].'  </h2></center>';
while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 

?>

<div id="<?php //echo $idfami?>">
  <table class="table table-striped">
    <tr class="">
      <th>Nombre: <?php echo $rowfam['i_nombre'] ?></th>
      <th>Edad: <?php echo $rowfam['i_edad'] ?></th>
      <th>Familia: <?php echo $rowfam['f_familia'] ?></th>
      <th>Religión: <?php echo $rowfam['r_religion'] ?></th>      
      <th>Manzana: <?php echo $rowfam['f_manzana'] ?></th>
      <th>Calle: <?php echo $rowfam['f_calle'] ?> <?php if($rowfam['f_numero'] > 0){echo "#".$rowfam['f_numero'];}else{ echo "S/N";}  ?></th>

    </tr>
</table>
<?php
}
}
?>
</center>

</body>
</html>