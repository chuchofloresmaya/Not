<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<title>Mantenimiento</title>
</head>
<body>
	<style type="text/css">
		body{
			background-image: url(img/bg1.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			background-attachment: fixed;

		}
	</style>
</body>
</html>

<?php
require_once "php/conexion.php";  
$con= conectar();

    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $cbx_lugar = $_POST['cbx_ores'];
    
    $persona = $_POST['persona'];
    $cbx_mot = $_POST['oresmot'];
    $documentos = $_POST['documentos'];
    $nota = $_POST['notas'];
    $idisr = $_POST['id_isrob1'];


    if ($persona <= 0) {
      $id_personas = "null";
    }else{      
    $queryper = "SELECT id_personas, nombre FROM not190.ruta_personas where nombre = '".$persona."';";
    $resultper = mysqli_query($con,$queryper);
    $filasper = mysqli_num_rows($resultper);
    $rowper = $resultper->fetch_assoc();
    //echo "Lugares encontrados: ".$filasem;

    if ($filasper<=0) { 
        $insert_persona = "INSERT INTO `not190`.`ruta_personas` (`nombre`) VALUES ('".$persona."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_personas = mysqli_insert_id($con);
    }else{
      $id_personas = $rowper['id_personas'];
    }   
}


    //echo "UPDATE `not190`.`rutas` SET `fecha` = '".$fecha."', `hora` = '".$hora."', `id_lugar1` = '".$cbx_lugar."', `lugar_no_comun` = '".$lugarnc."', `persona` = '".$persona."', `id_motivo1` = '".$cbx_mot."', `documentos` = '".$documentos."', `notas` = '".$nota."' WHERE (`id_ruta` = ".$idisr.");";

//require_once "php/conexion.php";  
//$con= conectar();

$sentenciaf = "UPDATE `not190`.`rutas` SET `fecha` = '".$fecha."', `hora` = '".$hora."', `id_lugar1` = '".$cbx_lugar."', `id_persona` = '".$id_personas."', `id_motivo1` = '".$cbx_mot."', `documentos` = '".$documentos."', `notas` = '".$nota."' WHERE (`id_ruta` = ".$idisr.");";

echo "$sentenciaf";

	//"UPDATE `not190`.`rutas` SET `fecha` = ".$fecha.", `hora` = ".$hora.", `id_lugar1` = ".$cbx_lugar.", `lugar_no_comun` = ".$lugarnc.", `persona` = ".$persona.", `id_motivo1` = ".$cbx_mot.", `documentos` = ".$documentos.", `notas` = ".$notas." WHERE (`id_ruta` = '17');"

$resmodfam = $con->query($sentenciaf) or die ('<script type="text/javascript">alert("Error al Actulizar los Datos verifica los campos de ISR dijitados");</script>'.mysqli_error($con));

?>

<script type="text/javascript">
	alert("Actulizado correctamente");
	var fam = <?php echo $idisr?>;
	window.location.href='consultar_rutasm.php?pag=1';
</script>