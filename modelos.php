<?php
require_once "php/conexion.php";
$con= conectar();

$querysoc = "SELECT id_tiposociedad, t_sociedad FROM not190.tiposociedad;";
$resultbusoc = mysqli_query($con, $querysoc);

$valor = $_POST["elegido"];

$queryconsultem = "SELECT id_empresa, id_tiposciedad FROM not190.empresas where id_empresa=".$valor.";";
$resultsultem = mysqli_query($con,$queryconsultem);
$rowconsultem = $resultsultem->fetch_assoc();

$html = "";

while($rowsoc = $resultbusoc->fetch_assoc()) {
     if($rowsoc['id_tiposociedad'] == $rowconsultem['id_tiposciedad'] ){
		echo '<option value="'.$rowsoc['id_tiposociedad'].'" selected>'.$rowsoc['t_sociedad'].'</option>';
	}else{
		echo '<option value="'.$rowsoc['id_tiposociedad'].'" >'.$rowsoc['t_sociedad'].'</option>';
	}
 }

echo $html;	

?>