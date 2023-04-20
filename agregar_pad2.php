<?php

require_once "php/conexion.php";  
$con= conectar();
$items1 = $_POST['cbx_inte'];
$items2 = $_POST['cbx_padecimiento'];
$items3 = $_POST['tipo_pad'];

$id_fam_aint = ($_POST['id_fam']);

while(true){

    $item1 = current($items1);
    $item2 = current($items2);
    $item3 = current($items3);


   	$integ = (( $item1 !== false) ? $item1 : ", &nbsp;");
	$pade = (( $item2 !== false) ? $item2 : ", &nbsp;");
	$tipo_pade = (( $item3 !== false) ? $item3 : ", &nbsp;");



		$Inse_pad = "INSERT INTO `u494342329_censo`.`pad_int` (`idpadecimiento1`, `idintegrante1`, `p_tipo`) VALUES ('".$pade."', '".$integ."', '".$tipo_pade."');";

		//echo "INSERT INTO `u494342329_censo`.`pad_int` (`idpadecimiento1`, `idintegrante1`, `p_tipo`) VALUES ('".$pade."', '".$integ."', '".$tipo_pade."');";
		//echo $id_fam_aint;

   		$result_insert_pad = mysqli_query($con, $Inse_pad);

		if(!$result_insert_pad){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos");</script>';
    }

		$item1 = next( $items1 );
		$item2 = next( $items2 );
		$item3 = next( $items3 );

		if($item1 === false && $item2 === false && $item3 === false ) break;
}
?>
<script type="text/javascript">
	alert("PADECIMIENTO AGREGADO!");
	var fam = <?php echo $id_fam_aint?>;
	window.location.href='modificar_fam1.php?idfam='+fam;

</script>