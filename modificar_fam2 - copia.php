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

	$id_fam = $_POST['idfamily'];
    $sector1 = $_POST['cbx_sector'];
    $manzana = $_POST['n_manzana'];
    $familia = $_POST['n_familia'];
    $calle = $_POST['n_calle'];
    $numero = $_POST['n_numero'];
    $hoja = $_POST['n_no_hoja'];

 //   echo "Sector ".$sector1."familia ".$manzana." calle ".$calle." numero ".$numero." familia ".$familia." Estado c ".$ins_estado_c."Hoja ".$hoja."id de familia".$id_fam;

//require_once "php/conexion.php";  
//$con= conectar();

$sentenciaf = "UPDATE `u494342329_censo`.`familia` SET `idsector2` = '".$sector1."', `f_manzana` = '".$manzana."', `f_calle` = '".$calle."', `f_numero` = '".$numero."', `f_familia` = '".$familia."', `hoja` = '".$hoja."' WHERE (`idfamilia` = '".$id_fam."');";

$resmodfam = $con->query($sentenciaf) or die ('<script type="text/javascript">alert("Error al Actulizar los Datos verifica los campos de Familia dijitados");</script>'.mysqli_error($con));


$idestado = $_POST['idestado'];
$estado= $_POST['cbx_estado_c'];

//echo $idestado.' y '.$estado;
$queryestado = "UPDATE `u494342329_censo`.`fam_est` SET `idestado_civil1` = '".$estado."' WHERE (`idfam_est` ='".$idestado."');";
$resultado = $con->query($queryestado)or die ('<script type="text/javascript">alert("Error al Actulizar el estado civil");</script>'.mysqli_error($con));

//ModificiarIntegrantes($items1, $items2, $items3, $items4, $items5, $items6, $items7, $items8, $items9, $items10, $items11, $items12, $items13, $items14, $items15, $items16);

//function ModificarIntegrante($items1, $items2, $items3, $items4, $items5, $items6, $items7, $items8, $items9, $items10, $items11, $items12,  $items13, $items14, $items15, $items16){

if(isset($_POST['id_int'])){

$items1 = $_POST['cbx_parentesco'];
$items2 = $_POST['nombre'];
$items3 = $_POST['apellido_pat'];
$items4 = $_POST['apellido_mat'];
$items5 = $_POST['edad'];
$items6 = $_POST['cbx_sexo'];
$items7 = $_POST['cbx_bautizado'];
$items8 = $_POST['cbx_pcom'];
$items9 = $_POST['cbx_confirmacion'];
$items10 = $_POST['cbx_gma'];
$items11 = $_POST['cbx_escolaridad'];
$items12 = $_POST['cbx_ocupacion'];
$items13 = $_POST['cbx_religion'];
$items16 = $_POST['id_int'];

if(isset($_POST['id_int_pad'])){
$items14 = $_POST['cbx_padecimiento'];
$items15 = $_POST['tipo_pad'];
$items17 = $_POST['id_int_pad'];
$obtener = 1;


	while (true) {


	$item14 = current($items14);
    $item15 = current($items15);
    $item17 = current($items17);

		$pade_i = (( $item14 !== false) ? $item14 : ", &nbsp;");
		$pade_tipo_i = (( $item15 !== false) ? $item15 : ", &nbsp;");
		$idint_pad = (( $item17 !== false) ? $item17 : ", &nbsp;");

    	$modifpad ="UPDATE `u494342329_censo`.`pad_int` SET `idpadecimiento1` = '".$pade_i."', `p_tipo` = '".$pade_tipo_i."' WHERE (`idpad_int` = '".$idint_pad."');";
    	//echo '<br> SE CAMBIARA POR EL PADECIMIENTO con el numero: '.$idint_pad.' por el tipo: '.$pade_i.' y descripcion: '.$pade_tipo_i;

    	
    	$result_mod_int = mysqli_query($con, $modifpad);


		if(!$result_mod_int)
        echo '<script type="text/javascript">alert("Ocurrio un error al modificar el padecimiento");</script>';    

		$item14 = next( $items14 );
		$item15 = next( $items15 );
    	$item17 = next( $items17 );

    		if($item14 === false && $item15 === false && $item17 === false) break;
}
}

	while(true){

    $item1 = current($items1);
    $item2 = current($items2);
    $item3 = current($items3);
    $item4 = current($items4);
    $item5 = current($items5);
    $item6 = current($items6);
    $item7 = current($items7);
    $item8 = current($items8);
    $item9 = current($items9);
    $item10 = current($items10);
    $item11 = current($items11);
    $item12 = current($items12);
    $item13 = current($items13);
    $item16 = current($items16);

    
		
		$pare_i = (( $item1 !== false) ? $item1 : ", &nbsp;");
		$nom_i = (( $item2 !== false) ? $item2 : ", &nbsp;");
		$ape_pat_i = (( $item3 !== false) ? $item3 : ", &nbsp;");
		$ape_mat_i = (( $item4 !== false) ? $item4 : ", &nbsp;");
		$edad_i = (( $item5 !== false) ? $item5 : ", &nbsp;");
		$sex_i = (( $item6 !== false) ? $item6 : ", &nbsp;");
		$bau_i = (( $item7 !== false) ? $item7 : ", &nbsp;");
		$pcom_i = (( $item8 !== false) ? $item8 : ", &nbsp;");
		$conf_i = (( $item9 !== false) ? $item9 : ", &nbsp;");
		$gma_i = (( $item10 !== false) ? $item10 : ", &nbsp;");
		$esco_i = (( $item11 !== false) ? $item11 : ", &nbsp;");
		$ocup_i = (( $item12 !== false) ? $item12 : ", &nbsp;");
		$relig_i = (( $item13 !== false) ? $item13 : ", &nbsp;");
		
		$idinte = (( $item16 !== false) ? $item16 : ", &nbsp;");





        $modificar_int = "UPDATE `u494342329_censo`.`integrante` SET `idparentesco1` = '".$pare_i."', `i_nombre` = '".$nom_i."', `i_apellido_pat` = '".$ape_pat_i."', `i_apellido_mat` = '".$ape_mat_i."',`idsexo1` = '".$sex_i."', `i_edad` = '".$edad_i."', `i_bautizo` = '".$bau_i."', `i_1com` = '".$pcom_i."', `i_confirmacion` = '".$conf_i."', `i_gru_mov_aso` = '".$gma_i."', `idescolatidad` = '".$esco_i."', `idocupacion` = '".$ocup_i."', `idreligion` = '".$relig_i."' WHERE (`idintegrante` = '".$idinte."');";

    $result_insert_int = mysqli_query($con, $modificar_int);
    
    if(!$result_insert_int){
        echo '<script type="text/javascript">alert("Error al Modificar los Datos de los integrantes llena todos los campos");</script>';
    }


    
		$item1 = next( $items1 );
		$item2 = next( $items2 );
		$item3 = next( $items3 );
		$item4 = next( $items4 );
		$item5 = next( $items5 );
		$item6 = next( $items6 );
		$item7 = next( $items7 );
		$item8 = next( $items8 );
		$item9 = next( $items9 );
		$item10 = next( $items10 );
		$item11 = next( $items11 );
		$item12 = next( $items12 );
		$item13 = next( $items13 );
		$item16 = next( $items16 );

		


		if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false && $item9 === false && $item10 === false && $item11 === false && $item12 === false && $item13 === false ) break;
}
}

?>

<script type="text/javascript">
	alert("Familia Actualizada Exitosamente");
	var fam = <?php echo $id_fam?>;
	window.location.href='registro_integrantes.php?idfam='+fam;

</script>