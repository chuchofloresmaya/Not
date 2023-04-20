<?PHP
  
    $queryacta_esc = "SELECT id_acta, id_cotejo1, c_nocotejo, tipo_esc, ac_esc, vol_tipo, ac_vol, tipo_que_contiene, ac_contenido, tipo_favor, p_nombre, e_nombre, t_sociedad, tipo_emitido, emitido, de_fecha, a_dia, mes, a_ano FROM not190.actas 
              inner join cotejos on actas.id_cotejo1 = cotejos.id_cotejo
              inner join esc_tipo on actas.id_esc_tipo = esc_tipo.id_esc_tipo
              inner join vol_tipo on actas.id_esc_vol = vol_tipo.id_vol_tipo
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
              where id_cotejo1 = '".$id_cotejo."';";
    

    $result_act_esc = mysqli_query($con,$queryacta_esc);

      $filas_emiti = mysqli_num_rows($result_act_esc);
      $row_act_esc_g = $result_act_esc->fetch_assoc();

    $ca_id_acta = $row_act_esc_g['id_acta'];
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


    if ($ca_a_dia <= 0 && $ca_mes <= 0) {
       $ca_fecha = $ca_a_ano;
    }elseif ($ca_a_dia <= 0 && $ca_mes >= 0){
      $ca_fecha = $ca_mes." de ".$ca_a_ano;
    }else{
      $ca_fecha = $ca_a_dia." de ".$ca_mes." de ".$ca_a_ano;
    }

    $ca_esc_contenido = $ca_tipo_esc." ".$ca_no_esc." ".$ca_tipo_vol." ".$ca_no_vol." ".$ca_ti_cont." ".$ca_ac_cont." ".$ca_tipo_favor." ".$ca_p_nombre." ".$ca_e_nombre." ".$ca_t_sociedad;



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
      <div class="col-xs-6 col-md-5"><button class="alert-success"><a href="acta_num.php?acta=<?php echo $ca_id_acta;?>">Acta en Word</a></button>
</div>
  </div>
</div>

<?php
?>
