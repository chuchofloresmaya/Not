<?PHP
require 'librerias/phpword/vendor/autoload.php';

//    header('location: acta-num_carta.php?no_cot='.$no_cotejo.'&letra_no_cot='.$l_no_cotejo.'&no_libro='.$c_libro_num.'&letra_no_libro='.$l_c_libro.'&solicitud='.$solicitud.'&contiene='.$ca_esc_contenido.'&tipo_emitido='.$ca_tipo_emitido.'&emitido_por='.$ca_emitido.'&tipe_fecha='.$ca_de_fecha.'&fecha='.$ca_fecha'&tantos='.$l_tantos.'&orig_cop='.$origonal_copia.'&fechcot='.$l_fecha = fechaCastellano($fecha));



if (isset($_GET['array'])) {
    /* Deshacemos el trabajo hecho por 'serialize' */
    $values = unserialize($_GET['array']);
    // El contenido del error está en el índice 'error'
}

var_dump($values);


/*
$values = [
    ['userId' => 1, 'userName' => 'Batman', 'userAddress' => 'Gotham City'],
    ['userId' => 2, 'userName' => 'Superman', 'userAddress' => 'Metropolis'],
];
$templateProcessor->cloneRowAndSetValues('userId', $values);
 */

	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/acuse_cotejos_carta.docx');

	//$values = [['no_cot' => '6638', 'no_cot_l' => 'SEIS MIL SEISCIENTOS TREINTA Y OCHO', 'tantos' => 'UN TANTO'],];



	//Cambio de variable
	foreach ($values as $values) {
 		$templateProcessor->cloneRowAndSetValues('no_cot', $values);
	}


	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="acuse-.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");

?>