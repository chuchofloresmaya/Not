<?PHP

	$id_exp = $_GET['id_exp'];
	$user = $_GET['user'];
	require_once "php/conexion.php";
	$con = conectar();

		//Conulta para el cotejo
	$date= new DateTime("now", new DateTimeZone('America/Mexico_City'));
	$fech_entrega_proyectista = $date->format("Y-m-d H:i:s");
	

	  $queryu = "UPDATE `not190`.`expediente` SET `fech_entrega_proyc_mesa` = '".$fech_entrega_proyectista."', `usuario_entrega_proyc_mesa` = '".$user."' WHERE (`id_expediente` = ".$id_exp.");";


	  $resultq = mysqli_query($con,$queryu);
      
		header('location: consult_proyectistas.php?pag=1');

?>