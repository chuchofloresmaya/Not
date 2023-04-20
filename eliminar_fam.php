<?php

$id_fam_eli = ($_GET['idfamelim']);

eliminar_familia($id_fam_eli);

function eliminar_familia($id_fam_eli){
require_once "php/conexion.php";  
$con= conectar();

	$queryElim = "DELETE FROM `u494342329_censo`.`familia` WHERE (`idfamilia` = '".$id_fam_eli."');";
	$reselifam = $con->query($queryElim) or die ('<script type="text/javascript">alert("Eliminar al Insertar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	alert("Familia Eliminada!!");
	window.location.href='index.php';

</script>