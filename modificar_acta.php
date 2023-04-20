<?php
require_once "php/conexion.php";

session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();
}
?>
 <body>


<?php
include ("nav.php");


  if (isset($_POST['id_cotejo'])) {
    $id_cotejo = $_POST['id_cotejo'];

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
      where id_cotejo1 = '".$id_cotejo."';";
    

    //echo $queryacta_esc;
    $result_act_esc = mysqli_query($con,$queryacta_esc);

      $filas_emiti = mysqli_num_rows($result_act_esc);
      $row_act_esc_g = $result_act_esc->fetch_assoc();

    $id_acta = $row_act_esc_g['id_acta'];
  }else{
    $id_cotejo = $_GET['id_cot'];
       
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
      where id_cotejo1 = '".$id_cotejo."';";
    

    //echo $queryacta_esc;
    $result_act_esc = mysqli_query($con,$queryacta_esc);

      $filas_emiti = mysqli_num_rows($result_act_esc);
      $row_act_esc_g = $result_act_esc->fetch_assoc();

    $id_acta = $row_act_esc_g['id_acta']; 
  }



  
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

 $querycot = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, copia, hoja_anexa, c_fecha, fname, name ,id_usuario3, u_nombre FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario where id_cotejo = ".$id_cotejo.";";

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



$querymes = "SELECT id_mes, mes FROM not190.mes;";
$resultadomes = mysqli_query($con, $querymes);

while($rowmes = $resultadomes->fetch_assoc()) {
      $id_mes = $rowmes['id_mes']; 
      $mes = $rowmes['mes'];

$a[] = $rowmes['mes'];

}

  $queryigual_cotejoa1 = "SELECT * FROM not190.cotejos where c_nocotejo = ".$no_cotejo+1;

  
  $queryigual_cotejoa1 = "SELECT * FROM not190.actas where id_cotejo1 = ".$id_cotejo+1;
  $result_igual_cotejoa1 = mysqli_query($con,$queryigual_cotejoa1);
  $filas_igual_cotejoa1 = mysqli_num_rows($result_igual_cotejoa1);
  $row_igual_cota1 = $result_igual_cotejoa1->fetch_assoc();
  

$queryigual_cotejoe1 = "SELECT * FROM not190.actas where id_cotejo1 = ".$id_cotejo-1;
  $result_igual_cotejoe1 = mysqli_query($con,$queryigual_cotejoe1);
  $filas_igual_cotejoe1 = mysqli_num_rows($result_igual_cotejoe1);
  $row_igual_cote1 = $result_igual_cotejoe1->fetch_assoc();
  //echo "---->QE-".$queryigual_cotejoe1;
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function mostrar(id) {
    if (id == "escritura") {
        $("#escritura").show();
        $("#emitido_fecha").show();
        $("#tarjeta").hide();
        $("#factura").hide();
        $("#paro").hide();
        $("#otro").hide();
        $("#manual").hide();
    }

    if (id == "tarjeta") {
        $("#escritura").hide();
        $("#tarjeta").show();
        $("#emitido_fecha").show();
        $("#factura").hide();
        $("#paro").hide();
        $("#otro").hide();
        $("#manual").hide();
    }

    if (id == "factura") {
        $("#escritura").hide();
        $("#tarjeta").hide();
        $("#factura").show();
        $("#emitido_fecha").show();
        $("#paro").hide();
        $("#otro").hide();
        $("#manual").hide();
    }

    if (id == "paro") {
        $("#escritura").hide();
        $("#tarjeta").hide();
        $("#factura").hide();
        $("#paro").show();
        $("#emitido_fecha").show();
        $("#otro").hide();
        $("#manual").hide();
    }

    if (id == "otro") {
        $("#escritura").hide();
        $("#tarjeta").hide();
        $("#factura").hide();
        $("#paro").hide();
        $("#otro").show();
        $("#emitido_fecha").show();
        $("#manual").hide();
        
    }
    if (id == "manual") {
        $("#escritura").hide();
        $("#tarjeta").hide();
        $("#factura").hide();
        $("#paro").hide();
        $("#otro").hide();
        $("#manual").show();
        $("#emitido_fecha").show();
        
    }
}
</script>
</head>
<body>

<div class="table table-hover">          
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5"><h3> COTEJO: (<?php  echo $no_cotejo; ?> <?php  echo $l_no_cotejo; ?>)</h3></div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5"><h5> Hecha a solicitud de <?php  echo $solicitud; ?> </h5> </div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-md-1"></div>
      <div class="col-xs-6 col-md-5"><h5>fojas: <?php  echo $fojas; ?> <br>Fecha: <?php  echo $l_fecha = fechaCastellano($fecha);?></h5></div>
  </div>
</div>
<a class="btn btn-secondary btn-lg" href="consultar_contejosm.php?pag=1&no_libro=<?PHP echo $c_libro?>" role="button">Cotejos</a>
<?php

if ($filas_igual_cotejoa1>=1) {
$id_acta1 = $row_igual_cota1['id_cotejo1'];
$id_cotejo = $id_cotejo+1;
?>
<a class="btn btn-secondary btn-lg" href="modificar_acta.php?id_act=<?php  echo $id_acta1.'&id_cot='.$id_cotejo; ?>" role="button">Siguiente</a>
<?php
}else{
?>
<a class="btn btn-secondary btn-lg" href="insert_acta.php?id_cot=<?php  echo $id_cotejo+1; ?>" role="button">Siguiente</a>
<?php
}
if ($filas_igual_cotejoe1>=1) {
$id_acte1 = $row_igual_cote1['id_cotejo1'];
$id_cotejo = $id_cotejo-1;

?>
<a class="btn btn-secondary btn-lg" href="modificar_acta.php?id_act=<?php  echo $id_acte1.'&id_cot='.$id_cotejo; ?>" role="button">Anterior</a>
<?php
}else{
?>
<a class="btn btn-secondary btn-lg" href="insert_acta.php?id_cot=<?php  echo $id_cotejo-1; ?>" role="button">Anterior</a>
<?php
}
?>

<form id="formulario_esc" name="formulario_esc" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
<input type="hidden" name="id_acta" value="<?php echo $id_acta; ?>">   
<input type="hidden" name="id_cotejo" value="<?php echo $id_cotejo; ?>">   

    Tipo de documento: <?php 

    switch ($ca_id_tipo) {
    case 1:?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" selected>Escritura</option>
        <option value="tarjeta">Tarjetas de circulación</option>
        <option value="factura">Factura</option>
        <option value="paro">Identificación oficial</option>
        <option value="otro">Otro</option>
        <option value="manual">Manual</option>
     </select>
    <?php
    break;
    case 2:
    ?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" >Escritura</option>
        <option value="tarjeta" selected>Tarjetas de circulación</option>
        <option value="factura">Factura</option>
        <option value="paro">Identificación oficial</option>
        <option value="otro">Otro</option>
        <option value="manual">Manual</option>
     </select>
    <?php
    break;
    case 3:
    ?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" >Escritura</option>
        <option value="tarjeta" >Tarjetas de circulación</option>
        <option value="factura" selected>Factura</option>
        <option value="paro">Identificación oficial</option>
        <option value="otro">Otro</option>
        <option value="manual">Manual</option>
     </select>
    <?php
        break;
    case 4:
    ?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" >Escritura</option>
        <option value="tarjeta" >Tarjetas de circulación</option>
        <option value="factura">Factura</option>
        <option value="paro" selected>Identificación oficial</option>
        <option value="otro">Otro</option>
        <option value="manual">Manual</option>
     </select>
    <?php
        break;
    case 5:
    ?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" >Escritura</option>
        <option value="tarjeta" >Tarjetas de circulación</option>
        <option value="factura" >Factura</option>
        <option value="paro">Identificación oficial</option>
        <option value="otro" selected>Otro</option>
        <option value="manual">Manual</option>
     </select>
    <?php
        break;
    case 6:
    ?>
    <select id="status" name="status" onChange="mostrar(this.value);">
        <option>Tipo de documento</option>
        <option value="escritura" >Escritura</option>
        <option value="tarjeta" >Tarjetas de circulación</option>
        <option value="factura" >Factura</option>
        <option value="paro">Identificación oficial</option>
        <option value="otro">Otro</option>
        <option value="manual" selected>Manual</option>
     </select>
    <?php
        break;      
      }
    ?>
<div class="table table-hover">

<div id="escritura" style="display: none;">
    

    <div class="table table-hover">          
          <div class="row">

            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2">Formulario escritura</div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-1">Tipo: <br>
              <input name="esc_tipo" id="esc_tipo" placeholder="ESCRITURA" maxlength="30" size="30" class="form-control" value="<?php echo $ca_tipo_esc; ?>">
              <input name="no_esc" id="no_esc" placeholder="13,546" maxlength="30" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $ca_no_esc; ?>">
            </div>
            <div class="col-xs-12 col-md-1">Volumen: <br>
              <input name="vol_tipo" id="vol_tipo" placeholder="VOLUMEN" maxlength="30" size="30" class="form-control" value="<?php echo $ca_tipo_vol; ?>">
              <input name="no_vol" id="no_vol" placeholder="1,512" maxlength="30" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $ca_no_vol; ?>">
            </div>
            <div class="col-xs-12 col-md-4">Que contiene: <br>

              <input  type="checkbox" id="chbox_contiene_esc" name="chbox_contiene_esc" value="1" <?php if ($ca_ti_cont > 0){echo "checked";}?>><br><br>
              <input name="esc_q_contiene" id="esc_q_contiene" placeholder="QUE CONTIENE" maxlength="300" size="7" class="form-control" value="<?php echo $ca_ac_cont; ?>">
            </div>
            <div class="col-xs-12 col-md-4">en favor de <br>
              <input  type="checkbox" id="chbox_favor_esc" name="chbox_favor_esc" value="1" <?php if ($ca_tipo_favor > 0){echo "checked";}?>><br><br>
              <input name="persona" id="persona" placeholder="NOMBRE DE LA PERSONA" maxlength="300" size="7" class="form-control" value="<?php echo $ca_p_nombre; ?>">
              <input type="text" name="search_cliente" id='search_cliente' placeholder="NOMBRE DE LA EMPRESA" ondblclick="Doble_Clic(this.value)" class="form-control" value="<?php echo $ca_e_nombre; ?>">
              <input id="dni" name="dni" placeholder="RÉGIMEN DE CAPITAL" type="text" maxlength="255" class="form-control" value="<?php  echo $ca_t_sociedad; ?>" />
            </div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-4"><br>emitido por: 
              <input  type="checkbox" id="chbox_emitido_esc" name="chbox_emitido_esc" value="1" <?php if ($ca_tipo_emitido > 0){echo "checked";}?>><br>
              <input name="emitido_esc" id="emitido_esc" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control" value="<?php  echo $ca_emitido; ?>">
            </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_esc" name="chbox_de_fecha_esc" value="2" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_dia_esc" class="btn btn-outline-secondary btn-sm" name="cbx_dia_esc">          
                      <option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_mes_esc" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
              </select>

            <input type="ano_esc" name="ano_esc" placeholder="Año" maxlength="4" value="<?php echo $ca_a_ano; ?>">
            </div>
          </div>
    </div>
</div>

<div id="tarjeta" style="display: none;">
    <div class="table table-hover">      
           <div class="row">
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2">Formulario tarjeta de circulación</div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-12 col-md-4"> <br>
              <input name="tar_tipo" id="tar_tipo" placeholder="TIPO DE TARGETA" maxlength="200" size="200" class="form-control" value="<?php echo $ca_tipo_tar; ?>">
              <input name="tar_no" id="tar_no" placeholder="NUMERO O FOLIO DE LA TARJETA DE CIRCULACIÓN" maxlength="250" size="250" class="form-control" value="<?php echo $ca_no_tar; ?>">
          </div>
          </div>
        <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-4"><br>emitido por: 
              <input  type="checkbox" id="chbox_emitido_tarj" name="chbox_emitido_tarj" value="1" <?php if ($ca_tipo_emitido > 0){echo "checked";}?>><br>
              <input name="emitido_tarj" id="emitido_tarj" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control" value="<?php echo $ca_emitido; ?>">
            </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_tarj" name="chbox_de_fecha_tarj" value="1" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_dia_tarj" class="btn btn-outline-secondary btn-sm" name="cbx_dia_tarj">
<option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_mes_tarj" class="btn btn-outline-secondary btn-sm" name="cbx_mes_tarj">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
            </select>
            <input type="ano" name="ano_tarj" id="ano_tarj" placeholder="Año" value="<?php echo $ca_a_ano; ?>">
            </div>
          </div>

    </div>
</div>


<div id="factura" style="display: none;">
     <div class="table table-hover">      
         <div class="row">
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2">Factura</div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-12 col-md-3"> <br>
              <input name="fac_tipo" id="fac_tipo" placeholder="TIPO DE FACTURA" maxlength="200" size="200" class="form-control" value="<?php echo $ca_tipo_fac; ?>">
              <input name="fac_no" id="fac_no" placeholder="NÚMERO O FOLIO (OPCIONAL)" maxlength="30" size="7" class="form-control" value="<?php echo $ca_no_fac; ?>">
          </div>
          </div>
        <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-4"><br>emitido por: 
              <input  type="checkbox" id="chbox_emitido_fac" name="chbox_emitido_fac" value="1" checked><br>
              <input name="emitido_fac" id="emitido_fac" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control" value="<?php echo $ca_emitido; ?>">
            </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_fac" name="chbox_de_fecha_fac" value="1" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_mes_fac" class="btn btn-outline-secondary btn-sm" name="cbx_mes_fac">          
                      <option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_dia_fac" class="btn btn-outline-secondary btn-sm" name="cbx_dia_fac">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
              </select>

            <input type="ano_fac" name="ano_fac" placeholder="Año" maxlength="4" value="<?php echo $ca_a_ano; ?>">
            </div>         
          </div>
    </div>
</div>


<div id="paro" style="display: none;">
  <?php 
if ($sol_tipo == 1) {
  
  $queryautoform = "SELECT ac_idoficial1, a_idmex, emitido, a_dia, id_mes, a_ano, id_persona1, tipo_identificacion FROM not190.actas inner join ac_emitido on ac_emitido.id_emitido = ac_emitido.id_emitido inner join ac_identificaciones on ac_identificaciones.ac_idoficial = actas.ac_idoficial1 where id_persona1 = ".$idpersona." AND id_emitido = 5 LIMIT 0,1;";

  

  $result_emiti = mysqli_query($con,$queryautoform);

  $filas_emiti = mysqli_num_rows($result_emiti);
  $rowemiti = $result_emiti->fetch_assoc();

  if ($filas_emiti<=0) {
      $tipo_idof = "IDENTIFICACIÓN OFICIAL INE";
      $idmex = "";
      $emitido_por = "INSTITUTO NACIONAL ELECTORAL";
      $dia = "";
      $mes = "";
      $ano = "";    
  }else{
      $tipo_idof = $rowemiti['tipo_identificacion'];
      $idmex = $rowemiti['a_idmex'];
      $emitido_por = $rowemiti['emitido'];
      $dia = $rowemiti['a_dia'];
      $mes = $rowemiti['id_mes'];
      $ano = $rowemiti['a_ano'];    
  }

  }else{
      $tipo_idof = "IDENTIFICACIÓN OFICIAL INE";
      $idmex = "";
      $emitido_por = "INSTITUTO NACIONAL ELECTORAL";
      $dia = "";
      $mes = "";
      $ano = "";    
  }
$querymes = "SELECT id_mes, mes FROM not190.mes;";
$resultmes = mysqli_query($con, $querymes);
  ?>
     <div class="table table-hover">      
         <div class="row">
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2">Formulario de Identificación oficial</div>
          </div>
          <div class="row">
          <input type="hidden" name="perdona_idof" value="<?php echo $idpersona; ?>">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-12 col-md-3"><br>
              <input name="id_tipo" id="id_tipo" placeholder="TIPO DE IDENTIFICACIÓN" maxlength="30" size="30" class="form-control" value="<?php echo $tipo_idof; ?>">
              <input name="no_id" id="no_id" placeholder="IDMEX, FOLIO O NÚMERO" maxlength="30" size="30" class="form-control" value="<?php echo $idmex; ?>">
          </div>
          </div>
                  <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-4"><br>emitido por: 
              <input  type="checkbox" id="chbox_emitido_ido" name="chbox_emitido_ido" value="1" checked><br>
              <input name="emitido_ido" id="emitido_ido" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control" value="<?php echo $emitido_por; ?>">
            </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_ido" name="chbox_de_fecha_ido" value="2" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_dia_ido" class="btn btn-outline-secondary btn-sm" name="cbx_dia_ido">          
                      <option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_mes_ido" class="btn btn-outline-secondary btn-sm" name="cbx_mes_ido">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
              </select>

            <input type="ano_ido" name="ano_ido" placeholder="Año" maxlength="4" value="<?php echo $ca_a_ano; ?>">
            </div>
          </div>

    </div>

</div>
<div id="otro" style="display: none;">
     <div class="table table-hover">      
         <div class="row">
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2">Formulario de acta</div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-12 col-md-3"> <br>
              <input name="otro_doc_tipo" id="otro_doc_tipo" placeholder="DOCUMENTO" maxlength="150" size="150" class="form-control" value="<?php echo $ca_tipo_otro; ?>">
              <input name="otro_doc_vol" id="otro_doc_vol" placeholder="NÚMERO DE IDENTIFICADOR O FOLIO" maxlength="" size="7" class="form-control" value="<?php echo $ca_no_otro; ?>">
          </div>
            <div class="col-xs-12 col-md-4">Que contiene: <br>
              <input  type="checkbox" id="chbox_contiene_otro" name="chbox_contiene_otro" value="1"><br><br>
              <input name="q_contiene_otro" id="q_contiene_otro" placeholder="QUE CONTIENE" maxlength="300" size="7" class="form-control" value="<?php echo $ca_ac_cont; ?>">
            </div>
          </div>
    </div>
      <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-4"><br>emitido por: 
              <input  type="checkbox" id="chbox_emitido_otro" name="chbox_emitido_otro" value="1" checked><br>
              <input name="emitido_otro" id="emitido_otro" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control"value="<?php echo $ca_emitido; ?>">
            </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_esc" name="chbox_de_fecha_esc" value="2" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_dia_otro" class="btn btn-outline-secondary btn-sm" name="cbx_dia_otro">          
                      <option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_mes_otro" class="btn btn-outline-secondary btn-sm" name="cbx_mes_otro">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
              </select>

            <input type="ano_otro" name="ano_otro" placeholder="Año" maxlength="4" value="<?php echo $ca_a_ano; ?>">
            </div>          </div>

</div>

<div id="manual" style="display: none;">
     <div class="table table-hover">      
         <div class="row">
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-2"></div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-12 col-md-10"> <br>Corresponde 
              <input name="id_corresponde" id="id_corresponde" placeholder="DOCUMENTO" maxlength="" size="" class="form-control" value="<?php echo $ca_manual; ?>">
          </div>
          </div>
    </div>
      <div class="row">
          <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-12 col-md-1">
              <input name="emitido_manual" id="emitido_manual" placeholder="Emitido" maxlength="200" size="200" class="form-control" value="<?php echo $ca_tipo_emitido; ?>">
              
            </div>
            <div class="col-xs-12 col-md-9">
              <input name="emitido_nombre" id="emitido_nombre" placeholder="NOMBRE DE POR QUIEN FUE EMITIDO" maxlength="200" size="200" class="form-control" value="<?php echo $ca_emitido; ?>">
            </div>
          </div>
      <div class="row">
          <div class="col-xs-6 col-md-1"></div>
          <div class="col-xs-6 col-md-1"><br><br>
            <input name="fecha_manual" id="fecha_manual" placeholder="de fecha" maxlength="200" size="200" class="form-control" value="de fecha"><br>
          </div>
            <div class="col-xs-12 col-md-3"><br>de fecha: 
              <input  type="checkbox" id="chbox_de_fecha_manual" name="chbox_de_fecha_manual" value="2" <?php if ($ca_de_fecha > 0){echo "checked";}?>><br>
           <select id="cbx_dia_manual" class="btn btn-outline-secondary btn-sm" name="cbx_dia_manual">          
                      <option >Día</option>
                      <?php
                      for ($i=1; $i <= 31;$i++){
                        if ($ca_a_dia == $i) {
                      ?>
                      <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                      <?php    
                        }
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php
                      }
                      ?>
            </select>
              <select id="cbx_mes_manual" class="btn btn-outline-secondary btn-sm" name="cbx_mes_manual">
                        <option >Mes</option>
                            <?php 
                                    foreach ($a as $k => $v) {
                                      $k++;
                                      if ($ca_mes == $v) {
                                        echo "<option selected value=".$k.">".$v."</option>";  
                                      }else{
                                        echo "<option value=".$k.">".$v."</option>";
                                      }                                      
                                  } 
                            ?>
              </select>

            <input type="ano_manual" name="ano_manual" placeholder="Año" maxlength="4" value="<?php echo $ca_a_ano; ?>">
            </div>          </div>

</div>
          
<div id="emitido_fecha" style="display: none;">
 </div>
<input type="submit" class="btn btn-success disable" value="Ingresar Acta" name="regfam" >
    </form>
<div class="table table-hover">          


<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->

<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  <script type="text/javascript">
$(function() {
     $( "#emitido_fac" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });
$(function() {
     $( "#fac_tipo" ).autocomplete({
       source: 'lista_type_fac.php',
     });
  });

$(function() {
     $( "#esc_tipo" ).autocomplete({
       source: 'lista_type_esc.php',
     });
  });
        $(function() {
     $( "#vol_tipo" ).autocomplete({
       source: 'lista_type_vol.php',
     });
  });
        $(function() {
     $( "#esc_q_contiene" ).autocomplete({
       source: 'lista_esc_contiene.php',
     });
  });

$(function() {
     $( "#emitido_esc" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });

  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });

    $(function() {
     $( "#dni" ).autocomplete({
       source: 'lista_cliente1.php',
     });
  });

        $(function() {
     $( "#persona" ).autocomplete({
       source: 'lista_cliente2.php',
     });
  });
$(function() {
     $( "#tar_tipo" ).autocomplete({
       source: 'lista_type_targ.php',
     });
  });
$(function() {
     $( "#emitido_tarj" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });
$(function() {
     $( "#emitido_ido" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });
$(function() {
     $( "#id_tipo" ).autocomplete({
       source: 'lista_tipo_idof.php',
     });
  });
$(function() {
     $( "#otro_doc_tipo" ).autocomplete({
       source: 'lista_tipo_otro.php',
     });
  });
$(function() {
     $( "#emitido_otro" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });
$(function() {
     $( "#q_contiene_otro" ).autocomplete({
       source: 'lista_esc_contiene.php',
     });
  });

$(function() {
     $( "#emitido_nombre" ).autocomplete({
       source: 'lista_ac_emitido.php',
     });
  });
$(function() {
     $( "#fecha_manual" ).autocomplete({
       source: 'lista_ac_de_fecha.php',
     });
  });
$(function() {
     $( "#emitido_manual" ).autocomplete({
       source: 'lista_ac_emitido_por.php',
     });
  });




    function titulo_p(dato){
        if(dato=='SI'){
            document.getElementById("ano_t").style.display = "block";
            document.getElementById("objetosocial").style.display = "block";
            document.getElementById("motivos").style.display = "none";
            
        }
        if(dato=='NO'){
            document.getElementById("ano_t").style.display = "none";
            document.getElementById("objetosocial").style.display = "none";
            document.getElementById("motivos").style.display = "block";
            
        }

    }

    function Doble_Clic(str) {
      if (str.length == 0) {
        document.getElementById("dni").value = "";
        document.getElementById("direccion").value = "";
        document.getElementById("id_empresa").value = "";
        return;
      }
      else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
                {

          if (this.readyState == 4 && this.status == 200)
                    {
          var myObj = JSON.parse(this.responseText);
          document.getElementById
          ("dni").value = myObj[0];
                document.getElementById(
          "direccion").value = myObj[1];
                document.getElementById(
          "id_empresa").value = myObj[2];
          }
        };
        xmlhttp.open("GET", "busca_dni_dir.php?search_cliente=" + str, true);
        xmlhttp.send();
      }
    }
</script>       

<?PHP
if(isset($_POST['regfam'])){

  require ("modificar_actaobtedatos.php");


?>

<?php 
}else{
    require ("mostrar_acta.php");
}
?>
</body>
</html>