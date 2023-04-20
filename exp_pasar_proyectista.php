<?PHP



	$id_exp = $_GET['id_exp'];
	$user = $_GET['user'];
	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	$date= new DateTime("now", new DateTimeZone('America/Mexico_City'));
	$fech_entrega_proyectista = $date->format("Y-m-d H:i:s");
	

	  $queryu = "UPDATE `not190`.`expediente` SET `id_usuario_entr_proyectista` = '".$user."', `entrega_al_proyectista` = '".$fech_entrega_proyectista."' WHERE (`id_expediente` = ".$id_exp.");"; 
	echo "$queryu";

	  $resultq = mysqli_query($con,$queryu);
      
		header('location: consultar_exp.php?pag=1');

?>