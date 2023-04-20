<?PHP
	require 'librerias/phpword/vendor/autoload.php';
	$no_exp = $_GET['id_clg'];
	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	  $queryu = "SELECT oficinas.oficina, ubicacion_inmueble, folio_real, propietario.nombre as propietario, actos.actos, comprador.nombre as comprador, institucio.institucion, tradi.medidas_colindancias  FROM not190.clg_tradicional as tradi left join clg_oficinas as oficinas on tradi.id_oficina = oficinas.id_oficina left join nombres_expedientes as propietario on tradi.id_propietario = propietario.id_nombre left join clg_actos as actos on tradi.id_acto = actos.id_clg_acto left join nombres_expedientes as comprador on tradi.id_comprador = comprador.id_nombre left join  exp_institucion as institucio on tradi.id_institucion_clg_tradi = institucio.id_institucion where id_clg = ".$no_exp.";";

	  $resultq = mysqli_query($con,$queryu);
      $rowusu = $resultq->fetch_assoc();

      
      $oficina = $rowusu['oficina'];
      $ubicacion_inmueble = $rowusu['ubicacion_inmueble'];
      $folio_real = $rowusu['folio_real'];
      $propietario = $rowusu['propietario'];
      $actos = $rowusu['actos'];
      $comprador = $rowusu['comprador'];
      $institucion = $rowusu['institucion'];
      $medidas_colindancias = $rowusu['medidas_colindancias'];
	  
      
	//CArgando el documento plantilla
	$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor('plantillas/clgplan.docx');

/*	echo "
	('oficina', $oficina);
	('ubicacion_inmueble', $ubicacion_inmueble);
	('folio', $folio_real);
	('propietario', $propietario);
	('actos', $actos);
	('comprador', $comprador);
	('institucion', $institucion);
	('medidas_colindancias', $medidas_colindancias);
	";*/
	//Cambio de variable

	$templateProcessor->setValue('oficina', $oficina);
	$templateProcessor->setValue('ubicacion_inmueble', $ubicacion_inmueble);
	$templateProcessor->setValue('folio', $folio_real);
	$templateProcessor->setValue('propietario', $propietario);
	$templateProcessor->setValue('actos', $actos);
	$templateProcessor->setValue('comprador', $comprador);
	$templateProcessor->setValue('institucion', $institucion);
	$templateProcessor->setValue('medidas_colindancias', $medidas_colindancias);






	//Preparando para descargar el docuemnto
	header('Content-Disposition: attachment; filename="CLG-exp-'.$no_exp.'.docx"');

	//Enviar el output del objeto al explorador para descarga del usuario.
	$templateProcessor->saveAs("php://output");


?>