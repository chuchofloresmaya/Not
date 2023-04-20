<?PHP

	$id_exp = $_GET['id_exp'];
	$user = $_GET['user'];
	require_once "php/conexion.php";
	$con = conectar();

		//Conulta para el cotejo
	$date= new DateTime("now", new DateTimeZone('America/Mexico_City'));
	$fech_entrega_proyectista = $date->format("Y-m-d H:i:s");
	

	  $queryu = "UPDATE `not190`.`expediente` SET `fech_mesa_postfirma` = '".$fech_entrega_proyectista."', `id_usu_entrega_mesa_postfirma` = '".$user."' WHERE (`id_expediente` = ".$id_exp."); ";

	  $resultq = mysqli_query($con,$queryu);
      
		header('location: consult_postfirma_mesa.php?pag=1');

?>