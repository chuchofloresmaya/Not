<?php

$id_pad_eli = ($_GET['idestadp']);
$id_familia = ($_GET['idfam']);


eliminar_familia($id_pad_eli);

function eliminar_familia($id_pad_eli){
require_once "php/conexion.php";  
$con= conectar();

	$queryElimint = "DELETE FROM `u494342329_censo`.`fam_est` WHERE (`idfam_est` = '".$id_pad_eli."');";
	//echo $id_pad_eli;

 
	$reseliint = $con->query($queryElimint) or die ('<script type="text/javascript">alert("Error al Insertar los Datos");</script>'.mysqli_error($con));

}
?>

<script type="text/javascript">
	alert("Se elimino un el estado exitosamente");
	var fam = <?php echo $id_familia?>;
	window.location.href='modificar_fam1.php?idfam='+fam;

</script>