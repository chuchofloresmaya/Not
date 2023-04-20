<?PHP
require 'librerias/phpword/vendor/autoload.php';

	$iddia = $_GET['diae'];  
	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	  $queryruta = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, nombre, motivo, documentos, notas, u_nombre FROM not190.rutas 
LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares 
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo 
inner join usuarios on rutas.id_ususario2 = usuarios.idusuario where fecha='".$iddia."';";

	  
	$resultruta = $con->query($queryruta);
	$filastura = mysqli_num_rows($resultruta);

	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/bitacora.docx');
	
		
	$array_int = [];
	while ($rowruta = $resultruta->fetch_array(MYSQLI_BOTH)){ 
		$lugar = $rowruta['Nombre_del_lugar']." ".$rowruta['lugar_no_comun'];
		$array_int[] = 
		['hora' => $rowruta['hora'], 'lugar' => $lugar, 'persona' => $rowruta['nombre'], 'motivo' => $rowruta['motivo'], 'documentos' => $rowruta['documentos'], 'notas' => $rowruta['notas'], 'usuario' => $rowruta['u_nombre']];
	}


	//Cambio de variable
	$templateProcessor->setValue('fecha', $iddia);
	$templateProcessor->cloneRowAndSetvalues('hora', $array_int);		





	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="Bitacora-fecha-'.$iddia.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");
?>