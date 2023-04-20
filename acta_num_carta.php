<?PHP
require 'librerias/phpword/vendor/autoload.php';

//    header('location: acta-num_carta.php?no_cot='.$no_cotejo.'&letra_no_cot='.$l_no_cotejo.'&no_libro='.$c_libro_num.'&letra_no_libro='.$l_c_libro.'&solicitud='.$solicitud.'&contiene='.$ca_esc_contenido.'&tipo_emitido='.$ca_tipo_emitido.'&emitido_por='.$ca_emitido.'&tipe_fecha='.$ca_de_fecha.'&fecha='.$ca_fecha'&tantos='.$l_tantos.'&orig_cop='.$origonal_copia.'&fechcot='.$l_fecha = fechaCastellano($fecha));


	$no_cot = $_GET['no_cot'];
	$letra_no_cot = $_GET['letra_no_cot'];
	$no_libro = $_GET['no_libro'];
	$letra_no_libro = $_GET['letra_no_libro'];
	$solicitud = $_GET['solicitud'];
	$contiene = $_GET['contiene'];
	$tipo_emitido = $_GET['tipo_emitido'];
	$emitido_por = $_GET['emitido_por'];
	$tipe_fecha = $_GET['tipe_fecha'];
	$fecha = $_GET['fecha'];
	
	$tantos = $_GET['tantos'];
	$orig_cop = $_GET['orig_cop'];
	$fechcot = $_GET['fechcot'];




	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/ACTA.docx');


	//Cambio de variable
	$templateProcessor->setValue('no_cotejo', $no_cot);
	$templateProcessor->setValue('letra_no_cotejo', $letra_no_cot);
	$templateProcessor->setValue('no_libro', $no_libro);
	$templateProcessor->setValue('letra_no_libro', $letra_no_libro);
	$templateProcessor->setValue('solicitud', $solicitud);
	$templateProcessor->setValue('contiene', $contiene);
	$templateProcessor->setValue('emitido_por', $tipo_emitido);
	$templateProcessor->setValue('emitido', $emitido_por);
	$templateProcessor->setValue('tipo_fecha', $tipe_fecha);
	$templateProcessor->setValue('fecha_doc', $fecha);
	$templateProcessor->setValue('tantos', $tantos);	
	$templateProcessor->setValue('original', $orig_cop);	
	$templateProcessor->setValue('fecha_del_cotejo', $fechcot);	



	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="Acta Número- '.$no_cot.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");

?>