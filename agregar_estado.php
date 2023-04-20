<?php

$id_familia = ($_GET['idfam']);


agregar_estado($id_familia);

function agregar_estado($id_familia){
require_once "php/conexion.php";  
$con= conectar();

	$queryElimint = "INSERT INTO `fam_est` (`idfam_est`, `idfamilia2`, `idestado_civil1`) VALUES (NULL, '".$id_familia."', '2');";
	//echo $id_pad_eli;

 
	$reseliint = $con->query($queryElimint) or die ('<script type="text/javascript">alert("Error al Insertar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	var fam = <?php echo $id_familia?>;
	window.location.href='modificar_fam1.php?idfam='+fam;

</script>

