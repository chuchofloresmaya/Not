<?php

$id_int_eli = ($_GET['idintelim']);
$id_familia = ($_GET['idfam']);


eliminar_familia($id_int_eli);

function eliminar_familia($id_int_eli){
require_once "php/conexion.php";  
$con= conectar();

	$queryElimint = "DELETE FROM `u494342329_censo`.`integrante` WHERE (`idintegrante` = '".$id_int_eli."');";
	echo $id_int_eli;
	 
	$reseliint = $con->query($queryElimint) or die ('<script type="text/javascript">alert("Error al Elimiar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	alert("SE ELIMINO EXITOSAMENTE UN INTEGRANTE");
	var fam = <?php echo $id_familia?>;
	window.location.href='modificar_fam1.php?idfam='+fam;

</script>