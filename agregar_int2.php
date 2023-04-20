<?php
require_once "php/conexion.php";  
$con= conectar();

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
$items14 = $_POST['cbx_padecimiento'];
$items15 = $_POST['tipo_pad'];

$id_fam_aint = ($_POST['id_fam']);



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
    $item14 = current($items14);
    $item15 = current($items15);

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
		$pade_i = (( $item14 !== false) ? $item14 : ", &nbsp;");
		$pade_tipo_i = (( $item15 !== false) ? $item15 : ", &nbsp;");

    $insertar_int= "INSERT INTO integrante (`idfamilia1`, `idparentesco1`, `i_nombre`, `i_apellido_pat`, `i_apellido_mat`, `i_edad`, `idsexo1`, `i_bautizo`, `i_1com`, `i_confirmacion`, `i_gru_mov_aso`, `idescolatidad`, `idocupacion`, `idreligion`) VALUES ('".$id_fam_aint."', '".$pare_i."', '".$nom_i."', '".$ape_pat_i."', '".$ape_mat_i."', '".$edad_i."', '".$sex_i."', '".$bau_i."', '".$pcom_i."', '".$conf_i."', '".$gma_i."', '".$esco_i."', '".$ocup_i."', '".$relig_i."');";


    $result_insert_int = mysqli_query($con, $insertar_int);
    
    if(!$result_insert_int){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos del integrante");</script>';
    }


    if($pade_i <> 0){

    	$insertarpad = "INSERT INTO `u494342329_censo`.`pad_int` (`idpadecimiento1`, `idintegrante1`, `p_tipo`) VALUES ('".$pade_i."', '".mysqli_insert_id($con)."', '".$pade_tipo_i."');";

    		$result_insert_pad = mysqli_query($con, $insertarpad);

		if(!$result_insert_pad)
        echo '<script type="text/javascript">alert("Error al Insertar los Datos en padesimiento");</script>';    
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
		$item14 = next( $items14 );
		$item15 = next( $items15 );

		if($item1 === false) break;
}
?>
<script type="text/javascript">
	alert("Familia Actualizada Exitosamente");
	var fam = <?php echo $id_fam_aint?>;
	window.location.href='modificar_fam1.php?idfam='+fam;

</script>