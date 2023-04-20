<?php

$comp = ($_GET['comp']);


eliminar_familia($comp);

function eliminar_familia($comp){
require_once "php/conexion.php";  
$con= conectar();

	$queryElim = "DELETE FROM `not190`.`compareciente` WHERE (`id_compreciente` = '".$comp."');";
	$reselifam = $con->query($queryElim) or die ('<script type="text/javascript">alert("Eliminar al Insertar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	alert("Compareciente Eliminado!!");
	window.location.href='consult_proyectistas.php?pag=1';

</script>


