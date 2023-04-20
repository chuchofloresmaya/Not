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
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/COTEJO-7-oficio.docx');


	//Cambio de variable
	$templateProcessor->setValue('hoja_anexa', $i_hoja_anexa);
	$templateProcessor->setValue('fojas', $fojas);
	$templateProcessor->setValue('concuerda', $copia_cert);
	$templateProcessor->setValue('lados', $lado);
	$templateProcessor->setValue('mostrada', $mostrada);
	$templateProcessor->setValue('tantos', $l_tantos);
	$templateProcessor->setValue('solicitud', $solicitud);
	$templateProcessor->setValue('no_cotejo', $l_no_cotejo);
	$templateProcessor->setValue('libro', $l_libro);
	$templateProcessor->setValue('fecha', $fecha);
	





	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="COTEJO-'.$libro.'-'.$cot.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");

?>