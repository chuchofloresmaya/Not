<?php
include_once "php/conexion.php";  
$con = conectar();

$usu = $_GET['usuc'];
$user = $_GET['usuadm'];
$comentar = $_GET['valor'];
$comidfam = $_GET['id'];

//echo "('$user', '$comidfam', '$comentar', '$usu');";
$querycom= "INSERT INTO `u494342329_censo`.`comentario` (`idusuario3`, `idfamilia3`, `comentario`, `idusuario4`) VALUES ('$user', '$comidfam', '$comentar', '$usu');";
$rescom = $con->query($querycom) or die ('<script type="text/javascript">alert("Error al Comentar");</script>'.mysqli_error($con));
mysqli_close($con);

?>
<script type="text/javascript">
	
var usu = '<?php echo $usu; ?>';
var idfam = '<?PHP echo $comidfam; ?>';
	window.location.href='consultar_capturadores.php?userc='+ usu + '&consult=1#'+idfam;
</script>