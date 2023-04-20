<?PHP

	$idcot = $_GET['idcot'];
	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	  $queryu = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, copia, plano, c_fecha, fname, name ,id_usuario3, u_nombre FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario WHERE id_cotejo = ".$idcot.";";

	  $resultq = mysqli_query($con,$queryu);
      $rowusu = $resultq->fetch_assoc();


      $no_fojas = $rowusu['c_hoja'];
      $lado = $rowusu['l_lado'];
      $mostrada = $rowusu['m_lados'];
      $tantos = $rowusu['c_tantos_soli']+1;

      $idpersona = $rowusu['c_persona'];
      $id_empresa = $rowusu['c_empresa'];

      $no_cotejo = $rowusu['c_nocotejo'];
      $libro = $rowusu['c_libro'];
      $fecha = $rowusu['c_fecha'];
      $hoja_anexa = $rowusu['c_hoja_anexa'];
      $copia_c = $rowusu['copia'];
      $plano = $rowusu['plano'];
	  
      

      //de letras a numeros 
		$formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
		$l_no_fojas = $formatterES->format($no_fojas);
		$l_tantos = HelperSTring::toUpper($formatterES->format($tantos));
		$l_no_cotejo = HelperSTring::toUpper($formatterES->format($no_cotejo));
		$l_libro = HelperSTring::toUpper($formatterES->format($libro));


		// convertir a mayusculas 
		abstract class HelperString
		{
		    /**
		     * Convierte un string a mayúsculas.
		     * Es insensible a lo acéntos.
		     *
		     * @param string $txt
		     *
		     * @return string
		     */
		    public static function toUpper($txt)
		    {
		        if (function_exists('mb_strtoupper')) {
		            return mb_strtoupper($txt); // Convierte carcateres especiales
		        }
		        return strtoupper($txt);
		    }
		}


		function fechaCastellano ($fecha) {
		  $fecha = substr($fecha, 0, 10);
		  $numeroDia = date('d', strtotime($fecha));
		  $dia = date('l', strtotime($fecha));
		  $mes = date('F', strtotime($fecha));
		  $anio = date('Y', strtotime($fecha));
		  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
		  $meses_ES = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		  $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
		  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
		  //return $numeroDia." de ".$nombreMes." de ".$anio;
		  $numeroDia = $formatterES->format($numeroDia);
		  $anio = $formatterES->format($anio);
		  return HelperSTring::toUpper($numeroDia)." DE ".$nombreMes." DEL AÑO ".HelperSTring::toUpper($anio);
		}

		//$fecha = "20-07-2022";
		//echo fechaCastellano($fecha);

		if ($no_fojas > 1) {
			$l_no_fojas =  $l_no_fojas." fojas";
		}elseif ($plano == 2){
			$l_no_fojas = "un plano";
		}else{
			$l_no_fojas = "una foja";
		}

		if($idpersona >= 1){
			$solicitud = $rowusu['p_nombre'];
		}else{
			$solicitud = '"'.$rowusu['e_nombre'].'", '.$rowusu['t_sociedad'];
		}

		if ($hoja_anexa <= 1) {
			$i_hoja_anexa = " ";
		}else{
			$i_hoja_anexa = "HOJA ANEXA";
		}

		if ($copia_c <= 1) {
			$copia_c = "original";
		}else{
			$copia_c = "copia certificada";
		}

		$l_fecha = fechaCastellano($fecha);

		header('location: certificacion_cotejo-carta.php?i_h_anexa='.$i_hoja_anexa.'&i_n_fojas='.$l_no_fojas.'&i_copia='.$copia_c.'&i_h_lados='.$lado.'&i_h_mostrada='.$mostrada.'&i_h_tantos='.$l_tantos.'&i_s_solicitud='.$solicitud.'&i_h_lcotejo='.$l_no_cotejo.'&i_h_llibro='.$l_libro.'&i_h_lfecha='.$l_fecha.'&i_no_cotejo='.$no_cotejo.'&i_no_libro='.$libro);

?>