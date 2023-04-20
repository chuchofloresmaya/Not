<?PHP
require 'librerias/phpword/vendor/autoload.php';


	$i_hoja_anexa = $_GET['i_h_anexa'];
	$fojas = $_GET['i_n_fojas'];
	$copia_cert = $_GET['i_copia'];
	$lado = $_GET['i_h_lados'];
	$mostrada = $_GET['i_h_mostrada'];
	$l_tantos = $_GET['i_h_tantos'];
	$solicitud = $_GET['i_s_solicitud'];
	$l_no_cotejo = $_GET['i_h_lcotejo'];
	$l_libro = $_GET['i_h_llibro'];
	$fecha = $_GET['i_h_lfecha'];
	$libro = $_GET['i_no_libro'];
	$cot = $_GET['i_no_cotejo'];





	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/COTEJO-7-carta.docx');



	
	$replacements = array(
    array(	'hoja_anexa' => $i_hoja_anexa, 
			'fojas' => $fojas,
			'concuerda' => $copia_cert,
			'lados' => $lado,
			'mostrada' => $mostrada,
			'tantos' => $l_tantos,
			'solicitud' => $solicitud,
			'no_cotejo' => $l_no_cotejo,
			'libro' => $l_libro,
			'fecha' => $fecha),
    array(	'hoja_anexa' => $i_hoja_anexa."2", 
			'fojas' => $fojas."2",
			'concuerda' => $copia_cert."2",
			'lados' => $lado."2",
			'mostrada' => $mostrada."2",
			'tantos' => $l_tantos."2",
			'solicitud' => $solicitud."2",
			'no_cotejo' => $l_no_cotejo."2",
			'libro' => $l_libro."2",
			'fecha' => $fecha."2"),
);

$templateProcessor->cloneBlock('block_name', 0, true, tr, $replacements);



	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="COTEJO-'.$libro.'-'.$cot.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");

?>