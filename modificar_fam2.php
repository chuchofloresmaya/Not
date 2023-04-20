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

    $escritura = $_POST['escritura'];
    $ores = $_POST['cbx_ores'];
    $volumen = $_POST['volumen'];
    $cbx_mes = $_POST['cbx_mes'];
    $enajenante = $_POST['enajenante'];
    $adquiriente = $_POST['adquiriente'];
    $federativa = $_POST['federativa'];
    $entidad = $_POST['entidad'];
    $fecha = $_POST['fecha'];
    $notfolio = $_POST['notfolio'];
    $uif_ana = $_POST['uif_ana'];
    $cfdi = $_POST['cfdi'];
    $idisr = $_POST['id_isrob1'];



 //   echo "Sector ".$sector1."familia ".$manzana." calle ".$calle." numero ".$numero." familia ".$familia." Estado c ".$ins_estado_c."Hoja ".$hoja."id de familia".$id_fam;

//require_once "php/conexion.php";  
//$con= conectar();

$sentenciaf = "UPDATE `not190`.`isr` SET `escritura` = ".$escritura.", `id_tipo1` = ".$ores.", `volumen` = ".$volumen.", `id_mes1` = ".$cbx_mes.", `enajenante` = '".$enajenante."', `adquiriente` = '".$adquiriente."', `federativa` = '".$federativa."', `entidad` = '".$entidad."', `fecha` = '".$fecha."', `folio` = ".$notfolio.", `id_uif1` = ".$uif_ana.", `cfdi` = '".$cfdi."' WHERE (`id_isr` = ".$idisr.");";

$resmodfam = $con->query($sentenciaf) or die ('<script type="text/javascript">alert("Error al Actulizar los Datos verifica los campos de ISR dijitados");</script>'.mysqli_error($con));

?>

<script type="text/javascript">
	alert("Actulizado correctamente");
	var fam = <?php echo $idisr?>;
	window.location.href='consultar_isrm.php?idfam='+fam;
</script>