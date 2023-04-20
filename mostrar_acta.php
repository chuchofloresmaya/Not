<?php 
$id_acta = $id_acta;

$queryacta_esc = "SELECT id_acta, id_cotejo1, id_tipo1, c_nocotejo, tipo_esc, ac_esc, vol_tipo, ac_vol, tipo_que_contiene, ac_contenido, tipo_favor, p_nombre, e_nombre, t_sociedad, tipo_emitido, emitido, de_fecha, a_dia, mes, a_ano, a_targeta, tipo_targetas, tipo_factura, a_factura, tipo_identificacion, a_idmex, tipo_otros, a_otro, ac_manual FROM not190.actas 
              inner join cotejos on actas.id_cotejo1 = cotejos.id_cotejo
              left join esc_tipo on actas.id_esc_tipo = esc_tipo.id_esc_tipo
              left join vol_tipo on actas.id_esc_vol = vol_tipo.id_vol_tipo
              left join ac_a_que_conts on actas.a_que_cont = ac_a_que_conts.ac_a_que_conts
              left join ac_contenidos on actas.id_contenido = ac_contenidos.id_contenido
              left join ac_en_favor on actas.a_favor = ac_en_favor.id_ac_favor
              LEFT JOIN personas ON actas.id_persona1 = personas.id_persona 
              LEFT JOIN empresas ON actas.id_empresa1 = empresas.id_empresa 
              LEFT JOIN tiposociedad ON actas.id_sociedad1 = tiposociedad.id_tiposociedad
              LEFT JOIN ac_emitido_tipo on actas.id_tipo_emitido1 = ac_emitido_tipo.id_ac_emitido
              LEFT JOIN ac_emitido on actas.id_emitido1 = ac_emitido.id_emitido
              LEFT JOIN ac_de_fechas on actas.act_fecha = ac_de_fechas.id_ac_fecha
              LEFT JOIN mes on actas.id_mes = mes.id_mes
              LEFT JOIN acta_targetas on actas.id_targetas1 = acta_targetas.id_targetas
              LEFT JOIN ac_facturas on actas.id_factura1 = ac_facturas.id_factura
              LEFT JOIN ac_identificaciones on actas.ac_idoficial1 = ac_identificaciones.ac_idoficial
              LEFT JOIN ac_idotros on actas.id_otro = ac_idotros.ac_idotro
              where id_acta = '".$id_acta."';";
    //echo $queryacta_esc;

    $result_act_esc = mysqli_query($con,$queryacta_esc);

      $filas_emiti = mysqli_num_rows($result_act_esc);
      $row_act_esc_g = $result_act_esc->fetch_assoc();

    $ca_id_acta = $row_act_esc_g['id_acta'];
    $ca_id_cotejo = $row_act_esc_g['id_cotejo1'];
    $ca_id_tipo = $row_act_esc_g['id_tipo1'];
    $ca_tipo_esc = $row_act_esc_g['tipo_esc'];
    $ca_no_esc = $row_act_esc_g['ac_esc'];
    $ca_tipo_vol = $row_act_esc_g['vol_tipo'];
    $ca_no_vol = $row_act_esc_g['ac_vol'];
    $ca_ti_cont = $row_act_esc_g['tipo_que_contiene'];
    $ca_ac_cont = $row_act_esc_g['ac_contenido'];
    $ca_tipo_favor = $row_act_esc_g['tipo_favor'];
    $ca_p_nombre = $row_act_esc_g['p_nombre'];
    $ca_e_nombre = $row_act_esc_g['e_nombre'];
    $ca_t_sociedad = $row_act_esc_g['t_sociedad'];
    $ca_tipo_emitido = $row_act_esc_g['tipo_emitido'];
    $ca_emitido = $row_act_esc_g['emitido'];
    $ca_de_fecha = $row_act_esc_g['de_fecha'];
    $ca_a_dia = $row_act_esc_g['a_dia'];
    $ca_mes = $row_act_esc_g['mes'];
    $ca_a_ano = $row_act_esc_g['a_ano'];


    $ca_tipo_tar = $row_act_esc_g['tipo_targetas'];
    $ca_no_tar = $row_act_esc_g['a_targeta'];

    $ca_tipo_fac = $row_act_esc_g['tipo_factura'];
    $ca_no_fac = $row_act_esc_g['a_factura'];

    $ca_tipo_id = $row_act_esc_g['tipo_identificacion'];
    $ca_no_id = $row_act_esc_g['a_idmex'];

    $ca_tipo_otro = $row_act_esc_g['tipo_otros'];
    $ca_no_otro = $row_act_esc_g['a_otro'];    

    $ca_manual = $row_act_esc_g['ac_manual'];



    //echo "ID DEL COTEJO------>".$ca_id_cotejo;


    // convertir a mayusculas 
   if(function_exists("HelperString()")){
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
}


$querycot = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, copia, hoja_anexa, c_fecha, fname, name ,id_usuario3, u_nombre FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario where id_cotejo = ".$ca_id_cotejo.";";

   $resultcot = mysqli_query($con,$querycot);
   $rowcot = $resultcot->fetch_assoc();

   $id_cotejo = $rowcot['id_cotejo'];
   $no_cotejo = $rowcot['c_nocotejo'];
   $c_libro = $rowcot['c_libro'];
   $idpersona = $rowcot['c_persona'];
   $tantos = $rowcot['c_tantos_soli']+1;
   $ori_copia = $rowcot['copia'];
   $fecha = $rowcot['c_fecha'];
   $fojas = $rowcot['c_hoja'];


      if ($c_libro<10){
    $c_libro_num = "0".$c_libro;
   }else{
    $c_libro_num = $c_libro;
   }

   $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
   $l_no_cotejo = HelperSTring::toUpper($formatterES->format($no_cotejo));
   $l_c_libro = HelperSTring::toUpper($formatterES->format($c_libro));
   $l_tantos = HelperSTring::toUpper($formatterES->format($tantos));

if(function_exists(fechaCastellano($fecha))){
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
      $anioL = $formatterES->format($anio);
      return HelperSTring::toUpper($numeroDia)." DE ".$nombreMes." DEL AÑO ".$anio." ".HelperSTring::toUpper($anioL);
    }
}

   if ($ori_copia == 1) {
     $origonal_copia = "ORIGINAL";
   }else{
     $origonal_copia = "COPIA CERTIFICADA ";
   }

   if($idpersona >= 1){
      $solicitud = $rowcot['p_nombre'];
      $sol_tipo = 1; // es una persona
    }else{
      $solicitud = '"'.$rowcot['e_nombre'].'", '.$rowcot['t_sociedad'];
      $sol_tipo = 2;//es una empresa para quitar error de identificacion 
    }

    if ($ca_a_dia < 10) {
      $ca_a_dia = "0".$ca_a_dia;
    }

    if ($ca_a_dia <= 0 && $ca_mes <= 0) {
       $ca_fecha = $ca_a_ano;
    }elseif ($ca_a_dia <= 0 && $ca_mes >= 0){
      $ca_fecha = $ca_mes." de ".$ca_a_ano;
    }else{
      $ca_fecha = $ca_a_dia." de ".$ca_mes." de ".$ca_a_ano;
    }

    


switch ($ca_id_tipo) {
    case 1:
      $ca_esc_contenido = $ca_tipo_esc." ".$ca_no_esc." ".$ca_tipo_vol." ".$ca_no_vol." ".$ca_ti_cont." ".$ca_ac_cont." ".$ca_tipo_favor." ".$ca_p_nombre." ".$ca_e_nombre." ".$ca_t_sociedad;
        break;
    case 2:
        $ca_esc_contenido = $ca_tipo_tar." ".$ca_no_tar;
        break;
    case 3:
        $ca_esc_contenido = $ca_tipo_fac." ".$ca_no_fac;
        break;
    case 4:
        $ca_esc_contenido = $ca_tipo_id." ".$ca_no_id;
        break;
    case 5:
        $ca_esc_contenido = $ca_tipo_otro." ".$ca_no_otro." ".$ca_ti_cont." ".$ca_ac_cont;
        break;
    case 6:
        $ca_esc_contenido = $ca_manual;
        break;      
      }
   
?>


<div class="table table-hover">          
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">ACTA NUMERO: (<?php  echo $no_cotejo; ?> <?php  echo $l_no_cotejo; ?>)</div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">LIBRO (<?php  echo $c_libro_num; ?> <?php  echo $l_c_libro; ?>).</div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">ACTO:</div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">COTEJO DE FOTOCOPIAS: Hecha a solicitud de <?php  echo $solicitud; ?> respecto de lo siguiente:</div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">Corresponde a un documento identificado como "<?php  echo $ca_esc_contenido." ".$ca_tipo_emitido." ".$ca_emitido ?>"<?php echo " ".$ca_de_fecha." ".$ca_fecha ?>.</div>
  </div>


    <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5">HECHO EL COTEJO DE FOTOCOPIAS EN <?php  echo $l_tantos; ?> TANTOS Y CON LA OBSERVACION DE QUE CONCUERDA FIEL Y EXACTAMENTE CON SU <?php  echo $origonal_copia; ?>, AGREGANDO UN TANTO DE ESTE AL APENDICE DE DOCUMENTOS DE ESTE LIBRO, MARCADOS BAJO EL ASIENTO NÚMERO <?php  echo $l_no_cotejo; ?>, FECHA <?php  echo $l_fecha = fechaCastellano($fecha);?>. DOY FE. </div>
  </div>
    <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      
</div>
  </div>
</div>