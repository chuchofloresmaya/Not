<?PHP
require 'librerias/phpword/vendor/autoload.php';


	$iddia = $_GET['diae'];  
	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	  $queryruta = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, persona, motivo, documentos, notas, u_nombre  FROM not190.rutas LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo inner join usuarios on rutas.id_ususario2 = usuarios.idusuario where fecha='".$iddia."';";

	  
	$resultruta = $con->query($queryruta);
	$filastura=mysqli_num_rows($resultruta);
$arregle = 0;
/*        while ($rowruta = $resultruta->fetch_array(MYSQLI_BOTH)){ 
         		$recorrido = array(
         			array"['hora' => '".$rowruta ['hora']."', 'lugar' => '".$rowruta ['Nombre_del_lugar']."', 'persona' => '".$rowruta ['persona']."', 'motivo' => '".$rowruta ['motivo']."', 'documentos' => '".$rowruta ['documentos']."', 'notas' => '".$rowruta ['notas']."', 'usuario' => '".$rowruta ['u_nombre']."'],"
         		);
        }*/


		/*
		$texto_completo = null;
        foreach ($recorrido as $val) {
		$texto_completo[] = $val;
		}
		*/
		$replacements = array(
		    array('hora' => '00:00', 'lugar' => 'LUGAR1', 'persona' => 'PERSONA1', 'motivo' => 'MOTIVO1', 'documentos' => 'DOCUMENTO1', 'notas' => 'NOTAS1', 'usuario' => 'JESUS ANTONIO'),
		    array('hora' => '03:00', 'lugar' => 'LUGAR2', 'persona' => 'PERSONA2', 'motivo' => 'MOTIVO2', 'documentos' => 'DOCUMENTO2', 'notas' => 'NOTAS2', 'usuario' => 'JESUS ANTONIO1'),
		);
				

	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/bitacora.docx');

		
	//Cambio de variable
	$templateProcessor->setValue('fecha', $iddia);
	//$templateProcessor->cloneRowAndSetvalues('hora', $recorrido);
	$templateProcessor->cloneBlock('block_name', 0, true, false, $replacements);		


	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="Bitacora-'.$fecha.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");

?>