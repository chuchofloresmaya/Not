<?PHP



	require 'librerias/phpword/vendor/autoload.php';
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/documento_plantilla.docx');


$templateProcessor->setValue('variable1', 'Esta es la variable 1');

$templateProcessor->setValue('variable2', 'Esta es la variable 2');

 

$templateProcessor->setValue('nombre', 'Edgar');

$templateProcessor->setValue('apellidos', 'Bautista');

 

$templateProcessor->setValue('telefono', '771111111');

$templateProcessor->setValue('email', 'edgar@mail.com');

header('Content-Disposition: attachment; filename="COTEJO 7-5968.docx"');
$templateProcessor->saveAs("php://output");
?>