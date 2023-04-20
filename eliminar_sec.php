<?php

$id_sect = $_GET['idususec'];

eliminar_familia($id_sect);

function eliminar_familia($id_sect){
require_once "php/conexion.php";  
$con= conectar();

	$queryElim = "DELETE FROM `u494342329_censo`.`usu_sec` WHERE (`idusu_sec` = ".$id_sect.");";
	$reselifam = $con->query($queryElim) or die ('<script type="text/javascript">alert("Eliminar al Insertar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	alert("Se elimino el Sector del Usuario!");
	window.location.href='insert_sec.php';

</script>