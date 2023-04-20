<?php
include("conectar.php"); 

    $esc_tipo = "NULL";
    $no_esc = "NULL";
    $vol_tipo = "NULL";
    $no_vol = "NULL";
    $q_contiene = "NULL";
    $e_favor = "NULL";
    $emitido = "NULL";
    $cbx_mes = "NULL";
    $cbx_dia = "NULL";
    $ano = "NULL";
    $tar_tipo = "NULL";
    $no_targ = "NULL";
    $fac_tipo= "NULL";
    $id_tipo= "NULL";
    $no_id = "NULL";
    $id_tipo= "NULL";
    $no_id = "NULL";
    $otro_doc_tipo = "NULL";
    $otro_doc_vol= "NULL";
    $chbox_contiene_esc = "NULL";
    $chbox_favor_esc = "NULL";
    $chbox_emitido_esc = "NULL";
    $chbox_de_fecha_esc = "NULL";


    $status = $_POST['status'];
    $esc_tipo = $_POST['esc_tipo'];
    $no_esc = $_POST['no_esc'];
    $vol_tipo = $_POST['vol_tipo'];
    $no_vol = $_POST['no_vol'];
    $chbox_contiene_esc = isset($_POST['chbox_contiene_esc']);
    $esc_q_contiene = $_POST['esc_q_contiene'];
    $chbox_favor_esc = isset($_POST['chbox_favor_esc']);
    $persona = $_POST['persona'];
    $empresa = $_POST['search_cliente'];
    $objetosocial = $_POST['dni'];
    

    $chbox_emitido_esc = isset($_POST['chbox_emitido_esc']);
    $emitido = $_POST['emitido_esc'];
    $chbox_de_fecha_esc = isset($_POST['chbox_de_fecha_esc']);
    $cbx_mes_esc = $_POST['cbx_mes_esc'];
    $cbx_dia_esc = $_POST['cbx_dia_esc'];
    $ano_esc = $_POST['ano_esc'];


    //targeta de circulación

    $tar_tipo = $_POST['tar_tipo'];
    $tar_no = $_POST['tar_no'];
    $chbox_emitido_tarj = isset($_POST['chbox_emitido_tarj']); 
    $emitido_tarj = $_POST['emitido_tarj']; 
    $chbox_de_fecha_tarj = isset($_POST['chbox_de_fecha_tarj']);
    $cbx_mes_tarj = $_POST['cbx_mes_tarj'];
    $cbx_dia_tarj = $_POST['cbx_dia_tarj'];
    $ano_tarj = $_POST['ano_tarj'];    

     //Factura
    $fac_tipo = $_POST['fac_tipo'];
    $fac_no = $_POST['fac_no'];
    $chbox_emitido_fac = isset($_POST['chbox_emitido_fac']); 
    $emitido_fac = $_POST['emitido_fac']; 
    $chbox_de_fecha_fac = isset($_POST['chbox_de_fecha_fac']);
    $cbx_mes_fac = $_POST['cbx_mes_fac'];
    $cbx_dia_fac = $_POST['cbx_dia_fac'];
    $ano_fac = $_POST['ano_fac'];    



    //Identificación oficial
    $id_tipo = $_POST['id_tipo'];
    $no_id = $_POST['no_id'];
    $chbox_emitido_ido = isset($_POST['chbox_emitido_ido']);
    $emitido_ido = $_POST['emitido_ido'];
    $chbox_de_fecha_ido = isset($_POST['chbox_de_fecha_ido']);
    $cbx_mes_ido = $_POST['cbx_mes_ido'];
    $cbx_dia_ido = $_POST['cbx_dia_ido'];
    $ano_ido = $_POST['ano_ido'];
    $perdona_idof = $_POST['perdona_idof'];


    //Otros documentos
    $otro_doc_tipo = $_POST['otro_doc_tipo'];
    $otro_doc_vol = $_POST['otro_doc_vol'];
    $chbox_contiene_otro = isset($_POST['chbox_contiene_otro']);
    $q_contiene_otro = $_POST['q_contiene_otro'];
    $chbox_emitido_otro = isset($_POST['chbox_emitido_otro']);
    $emitido_otro = $_POST['emitido_otro'];
    $chbox_de_fecha_otro = isset($_POST['chbox_de_fecha_otro']);
    $cbx_mes_otro = $_POST['cbx_mes_otro'];
    $cbx_dia_otro = $_POST['cbx_dia_otro'];
    $ano_otro = $_POST['ano_otro'];


    //Manual
    $id_corresponde = $_POST['id_corresponde'];
    $emitido_manual = $_POST['emitido_manual'];
    $emitido_nombre = $_POST['emitido_nombre'];
    $fecha_manual = $_POST['fecha_manual'];
    $cbx_dia_manual = $_POST['cbx_dia_manual'];
    $cbx_mes_manual = $_POST['cbx_mes_manual'];
    $ano_manual = $_POST['ano_manual'];



switch ($status) {
    case "escritura":

    $queryes = "SELECT id_esc_tipo, tipo_esc FROM not190.esc_tipo where tipo_esc = '".$esc_tipo."';";
    $result_esc = mysqli_query($con,$queryes);

      $filas_esc = mysqli_num_rows($result_esc);
      $rowesc = $result_esc->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_esc<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_esc = "INSERT INTO `not190`.`esc_tipo` (`tipo_esc`) VALUES ('".$esc_tipo."');";
        $result_insert_esc = mysqli_query($con, $insert_esc);
        $id_esc =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_esc = $rowesc['id_esc_tipo'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

    $queryvol = "SELECT id_vol_tipo, vol_tipo FROM not190.vol_tipo where vol_tipo = '".$vol_tipo."';";
    $result_vol = mysqli_query($con,$queryvol);

      $filas_vol = mysqli_num_rows($result_vol);
      $rowvol = $result_vol->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_vol<=0) {
        
        $insert_vol = "INSERT INTO `not190`.`vol_tipo` (`vol_tipo`) VALUES ('".$vol_tipo."');";
        $result_insert_esc = mysqli_query($con, $insert_vol);
        $id_vol =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_vol = $rowvol['id_vol_tipo'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
    $querycont = "SELECT id_contenido, ac_contenido FROM not190.ac_contenidos where ac_contenido = '".$esc_q_contiene."';";
    $result_cont = mysqli_query($con,$querycont);

      $filas_cont = mysqli_num_rows($result_cont);
      $rowcont = $result_cont->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_cont<=0) {
        
        $insert_cont = "INSERT INTO `not190`.`ac_contenidos` (`ac_contenido`) VALUES ('".$esc_q_contiene."');";
        $result_insert_cont = mysqli_query($con, $insert_cont);
        $id_cont =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_cont = $rowcont['id_contenido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($chbox_favor_esc == 1) {
          $chbox_favor_esc = 1;
      }else{
        $chbox_favor_esc = 'NULL';
      }

 //echo $persona;

if ($persona >= 0) {

    //echo ">>>>---------SI ES MAYOR -----<<<";

      $querype = "SELECT id_persona, p_nombre FROM not190.personas where p_nombre = '".$persona."';";
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_persona = "INSERT INTO `not190`.`personas` (`p_nombre`) VALUES ('".$persona."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_persona =mysqli_insert_id($con);
        $id_empresa = "NULL";
        $id_objetosocial = "NULL";
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_persona = $rowpe['id_persona'];
        $id_empresa = "NULL";
        $id_objetosocial = "NULL";
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

}elseif ($empresa >= 0) {

    $filasem = 0;
    $queryem = "SELECT id_empresa, id_tiposciedad FROM not190.empresas where e_nombre = '$empresa';";
    $resultem = mysqli_query($con,$queryem);
    $filasem = mysqli_num_rows($resultem);
    $rowem = $resultem->fetch_assoc();
      

    //echo "Empresas encontradas: ".$filasem;

    if ($filasem<=0) { 
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);

      $filasobs = mysqli_num_rows($resultobs);
      $rowobs = $resultobs->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Objetos social encontrados :".$filasobs;

      if ($filasobs<=0) {
        echo "<br>Ingresar objeto social ".$objetosocial;
        $insert_sociedad = "INSERT INTO `tiposociedad` (`id_tiposociedad`, `t_sociedad`) VALUES (NULL, '".$objetosocial."');";
        $result_insert_sociedad = mysqli_query($con, $insert_sociedad);
        $id_objetosocial =mysqli_insert_id($con);
        //echo "<br>ultimo id  objeto social".$id_objetosocial;
      }else{
        $id_objetosocial = $rowobs['id_tiposociedad'];
        //echo "<br>ID DEL OBJETO SOCIAL ".$id_objetosocial;
      }
      $insert_empresa = "INSERT INTO `not190`.`empresas` (`e_nombre`, `id_tiposciedad`) VALUES ('".$empresa."', '".$id_objetosocial."');";
        $result_insert_empresa = mysqli_query($con, $insert_empresa);
        $id_empresa =mysqli_insert_id($con);
        $id_persona = "NULL";

        //echo "<br>ultimo id empresa".$id_empresa;
      //echo "<br>insertando empresa".$id_empresa." ingresando regimen ".$id_objetosocial;
    }elseif ($filasem = 0) {
      //para queno entre en ningun ciclo
    }else{
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);
      $rowobs = $resultobs->fetch_assoc();
      $id_objetosocial = $rowobs['id_tiposociedad'];
      $id_empresa = $rowem['id_empresa'];
      $id_persona = "NULL";  
    }
}else{
        $id_objetosocial = "NULL";
      $id_empresa = "NULL";
      $id_persona = "NULL";  
}



      if ($chbox_emitido_esc == 1) {
          $chbox_emitido_esc = 1;
      }else{
        $chbox_emitido_esc = 'NULL';
      }


    //emitido
    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_emiti<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_emiti = $rowemiti['id_emitido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($chbox_de_fecha_esc == 1) {
          $chbox_de_fecha_esc = 1;
      }else{
        $chbox_de_fecha_esc = 'NULL';
      }

      if ($cbx_dia_esc == "Día") {
          $cbx_dia_esc ='NULL';}

      if ($cbx_mes_esc == "Mes") {
          $cbx_mes_esc ='NULL';}

      if ($ano_esc <= 0) {
          $ano_esc ='NULL';}

      if ($chbox_contiene_esc == 1) {
          $chbox_contiene_esc = 1;
      }else{
        $chbox_contiene_esc = 'NULL';
      }


        //$insert_esc_db = "INSERT INTO `not190`.`actas` (`id_cotejo1`, `id_tipo1`, `id_esc_tipo`, `id_esc_vol`, `ac_esc`, `ac_vol`, `a_que_cont`, `id_contenido`, `a_favor`, `id_persona1`, `id_empresa1`, `id_sociedad1`, `id_tipo_emitido1`, `id_emitido1`, `act_fecha`, `a_dia`, `id_mes`, `a_ano`, `usuario4`) VALUES (".$id_cotejo.", '1', ".$.", ".$.", '".$."', '".$."',  , ".$.", ".$.", ".$id_empresa.", ".$id_objetosocial.", ".$chbox_emitido_esc.", ".$id_emiti.", ".$chbox_de_fecha_esc.", ".$cbx_dia_esc.", ".$cbx_mes_esc.", ".$ano_esc.", ".$user.");";
      
      $insert_esc_db = "UPDATE `not190`.`actas` SET `id_tipo1` = '1', `id_esc_tipo` = ".$id_esc.", `id_esc_vol` = ".$id_vol.", `ac_esc` = '".$no_esc."', `ac_vol` = '".$no_vol."', `a_que_cont` = ".$chbox_contiene_esc.", `id_contenido` = ".$id_cont.", `a_favor` = ".$chbox_favor_esc.", `id_persona1` = ".$id_persona.", `id_empresa1` = ".$id_empresa.", `id_sociedad1` = ".$id_objetosocial.", `id_tipo_emitido1` = ".$chbox_emitido_esc.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$chbox_de_fecha_esc.", `a_dia` = ".$cbx_dia_esc.", `id_mes` = ".$cbx_mes_esc.", `a_ano` = ".$ano_esc.", `a_targeta` = null, `id_targetas1` = null, `ac_idoficial1` = null, `a_idmex` = null, `id_factura1` = null, `a_factura` = null, `id_otro` = null, `a_otro` = null, `ac_manual` = null WHERE (`id_acta` = ".$id_acta.");";

        $result_insert_esci = mysqli_query($con, $insert_esc_db);
        //echo $insert_esc_db;

        require ("imp_acta_esc.php");
    break;
//-------------------------------------------------------------------------------------------TARGETA-------------------------------------------
    case "tarjeta":

    $querytitar = "SELECT id_targetas, tipo_targetas FROM not190.acta_targetas where tipo_targetas = '".$tar_tipo."';";
    $result_titar = mysqli_query($con,$querytitar);

      $filas_titar = mysqli_num_rows($result_titar);
      $rowtitar = $result_titar->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_titar<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_tar = "INSERT INTO `not190`.`esc_tipo` (`tipo_esc`) VALUES ('".$esc_tipo."');";
        $result_tar = mysqli_query($con, $insert_tar);
        $id_targ =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_targ = $rowtitar['id_targetas'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido_tarj."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_emiti<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido_tarj."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_emiti = $rowemiti['id_emitido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($chbox_emitido_tarj == 1) {
          $chbox_emitido_tarj = 1;
      }else{
        $chbox_emitido_tarj = 'NULL';
      }

      if ($chbox_de_fecha_tarj == 1) {
          $chbox_de_fecha_tarj = 1;
      }else{
        $chbox_de_fecha_tarj = 'NULL';
      }

      if ($cbx_dia_tarj == "Día") {
          $cbx_dia_tarj ='NULL';}

      if ($cbx_mes_tarj == "Mes") {
          $cbx_mes_tarj ='NULL';}

      if ($ano_tarj <= 0) {
          $ano_tarj ='NULL';}

    
      //$insert_targeta = "INSERT INTO `not190`.`actas` (`id_cotejo1`, `id_tipo1`, `id_tipo_emitido1`, `id_emitido1`, `act_fecha`, `a_dia`, `id_mes`, `a_ano`, `a_targeta`, `id_targetas1`, `usuario4`) VALUES (".$id_cotejo.", 2, ".$chbox_emitido_tarj.", ".$id_emiti.", ".$chbox_de_fecha_tarj.", ".$cbx_dia_tarj.", ".$cbx_mes_tarj.", ".$ano_tarj.", '".$tar_no."', ".$id_targ.",".$user.");";
      //$result_insert_tarj = mysqli_query($con, $insert_targeta);

      $update_targeta = "UPDATE `not190`.`actas` SET `id_tipo1` = '2', `id_esc_tipo` = null, `id_esc_vol` = null, `ac_esc` = null, `ac_vol` = null, `a_que_cont` = null, `id_contenido` = null, `a_favor` = null, `id_persona1` = null, `id_empresa1` = null, `id_sociedad1` = null, `id_tipo_emitido1` = ".$chbox_emitido_tarj.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$chbox_de_fecha_tarj.", `a_dia` = ".$cbx_dia_tarj.", `id_mes` = ".$cbx_mes_tarj.", `a_ano` = '".$ano_tarj."', `a_targeta` = '".$tar_no."', `id_targetas1` = ".$id_targ.", `ac_idoficial1` = null, `a_idmex` = null, `id_factura1` = null, `a_factura` = null, `id_otro` = null, `a_otro` = null, `ac_manual` = null WHERE (`id_acta` = ".$id_acta.");";

        $result_insert_esci = mysqli_query($con, $update_targeta);

      require ("imp_acta_tarjeta.php");
        //echo $insert_targeta;
    break;
//---------------------------------------------------------------------------------FACTURA--------------------------------------------------------
    case "factura":
    $querytifac = "SELECT id_factura, tipo_factura FROM not190.ac_facturas where tipo_factura = '".$fac_tipo."';";
    $result_fac = mysqli_query($con,$querytifac);

      $filas_fac = mysqli_num_rows($result_fac);
      $rowfac = $result_fac->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_fac<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_tifac = "INSERT INTO `not190`.`ac_facturas` (`tipo_factura`) VALUES ('".$fac_tipo."');";
        $result_insert_fac = mysqli_query($con, $insert_tifac);
        $id_fac =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_fac = $rowfac['id_factura'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
      if ($chbox_emitido_fac == 1) {
          $chbox_emitido_fac = 1;
      }else{
        $chbox_emitido_fac = 'NULL';
      }

    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido_fac."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_emiti<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido_fac."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_emiti = $rowemiti['id_emitido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
      //ECHO "---->".$chbox_de_fecha_fac."<---->Dia: ".$cbx_dia_fac." Mes: ".$cbx_mes_fac." Año: ".$ano_fac;
      if ($chbox_de_fecha_fac == 1) {
          $chbox_de_fecha_fac = 1;
      }else{
        $chbox_de_fecha_fac = 'NULL';
      }

      if ($cbx_dia_fac == "Día") {
          $cbx_dia_fac ='NULL';}

      if ($cbx_mes_fac == "Mes") {
          $cbx_mes_fac ='NULL';}

      if ($ano_fac <= 0) {
          $ano_fac ='NULL';}

    //$insert_factura = "INSERT INTO `not190`.`actas` (`id_cotejo1`, `id_tipo1`, `id_tipo_emitido1`, `id_emitido1`, `act_fecha`, `a_dia`, `id_mes`, `a_ano`, `id_factura1`, `a_factura`, `usuario4`) VALUES (".$id_cotejo.", '3', ".$chbox_emitido_fac.", ".$id_emiti.", ".$chbox_de_fecha_fac.", ".$cbx_dia_fac.", ".$cbx_mes_fac.", ".$ano_fac.", ".$id_fac.", '".$fac_no."', ".$user.");"; 

      $update_fact = "UPDATE `not190`.`actas` SET `id_tipo1` = '3', `id_esc_tipo` = null, `id_esc_vol` = null, `ac_esc` = null, `ac_vol` = null, `a_que_cont` = null, `id_contenido` = null, `a_favor` = null, `id_persona1` = null, `id_empresa1` = null, `id_sociedad1` = null, `id_tipo_emitido1` = ".$chbox_emitido_fac.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$chbox_de_fecha_fac.", `a_dia` = ".$cbx_dia_fac.", `id_mes` = ".$cbx_mes_fac.", `a_ano` = '".$ano_fac."', `a_targeta` = null, `id_targetas1` = null, `ac_idoficial1` = null, `a_idmex` = null, `id_factura1` = ".$id_fac.", `a_factura` = '".$fac_no."', `id_otro` = null, `a_otro` = null, `ac_manual` = null WHERE (`id_acta` = ".$id_acta.");";

      //echo $update_fact;

        $result_insert_esci = mysqli_query($con, $update_fact);

      require ("imp_acta_fac.php");

        break;
//-----------------------------------------------------------------------IDENTIFICACION OFICIAL--------------------------------------------------
    case "paro":
    
    $queryidof = "SELECT ac_idoficial, tipo_identificacion FROM not190.ac_identificaciones where tipo_identificacion = '".$id_tipo."';";
    $result_idof = mysqli_query($con,$queryidof);

      $filas_idof = mysqli_num_rows($result_idof);
      $row_idof = $result_idof->fetch_assoc();

    if ($filas_idof<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_idof = "INSERT INTO `not190`.`ac_identificaciones` (`tipo_identificacion`) VALUES ('".$id_tipo."');";
        $result_insert_idof = mysqli_query($con, $insert_idof);
        $id_idof =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_idof = $row_idof['ac_idoficial'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($chbox_emitido_ido == 1) {
          $chbox_emitido_ido = 1;
      }else{
        $chbox_emitido_ido = 'NULL';
      }

    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido_ido."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

    if ($filas_emiti<=0) {
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido_ido."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        
      }else{
        $id_emiti = $rowemiti['id_emitido'];
      }      
      

      if ($chbox_de_fecha_ido == 1) {
          $chbox_de_fecha_ido = 1;
      }else{
        $chbox_de_fecha_ido = 'NULL';
      }

      if ($cbx_dia_ido == "Día") {
          $cbx_dia_ido ='NULL';}

      if ($cbx_mes_ido == "Mes") {
          $cbx_mes_ido ='NULL';}

      if ($ano_ido <= 0) {
          $ano_ido ='NULL';}


    //$insert_identificacion = "INSERT INTO `not190`.`actas` (`id_cotejo1`, `id_tipo1`, `id_persona1`, `id_tipo_emitido1`, `id_emitido1`, `act_fecha`, `a_dia`, `id_mes`, `a_ano`, `ac_idoficial1`, `a_idmex`, `usuario4`) VALUES (".$id_cotejo.", 4, ".$perdona_idof.", ".$chbox_emitido_ido.", ".$id_emiti.", ".$chbox_de_fecha_ido.", ".$cbx_dia_ido.", ".$cbx_mes_ido.", '".$ano_ido."', ".$id_idof.", '".$no_id."', ".$user.");";
     
      $update_idof = "UPDATE `not190`.`actas` SET `id_tipo1` = '4', `id_esc_tipo` = null, `id_esc_vol` = null, `ac_esc` = null, `ac_vol` = null, `a_que_cont` = null, `id_contenido` = null, `a_favor` = null, `id_persona1` = ".$perdona_idof.", `id_empresa1` = null, `id_sociedad1` = null, `id_tipo_emitido1` = ".$chbox_emitido_ido.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$chbox_de_fecha_ido.", `a_dia` = ".$cbx_dia_ido.", `id_mes` = ".$cbx_mes_ido.", `a_ano` = '".$ano_ido."', `a_targeta` = null, `id_targetas1` = null, `ac_idoficial1` = ".$id_idof.", `a_idmex` = '".$no_id."', `id_factura1` = null, `a_factura` = null, `id_otro` = null, `a_otro` = null, `ac_manual` = null WHERE (`id_acta` = ".$id_acta.");";

        //echo $update_idof;

        $result_update_idof = mysqli_query($con, $update_idof);
        require ("imp_acta_identificacion.php");
        break;
//----------------------------------------------------------------Otro---------------------------------------------------------------------------
    case "otro":

      if ($chbox_contiene_otro == 1) {
          $chbox_contiene_otro = 1;
      }else{
        $chbox_contiene_otro = 'NULL';
      }

      if ($chbox_emitido_otro == 1) {
          $chbox_emitido_otro = 1;
      }else{
        $chbox_emitido_otro = 'NULL';
      }
  if (empty($q_contiene_otro)) {
      $id_cont = "null";
    }else{
    $querycont = "SELECT id_contenido, ac_contenido FROM not190.ac_contenidos where ac_contenido = '".$q_contiene_otro."';";
    $result_cont = mysqli_query($con,$querycont);

      $filas_cont = mysqli_num_rows($result_cont);
      $rowcont = $result_cont->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filas_cont<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_cont = "INSERT INTO `not190`.`ac_contenidos` (`ac_contenido`) VALUES ('".$q_contiene_otro."');";
        $result_insert_cont = mysqli_query($con, $insert_cont);
        $id_cont =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_cont = $rowcont['id_contenido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
    }

    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido_otro."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

    if ($filas_emiti<=0) {
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido_otro."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        
      }else{
        $id_emiti = $rowemiti['id_emitido'];
      } 

      if ($chbox_de_fecha_otro == 1) {
          $chbox_de_fecha_otro = 1;
      }else{
        $chbox_de_fecha_otro = 'NULL';
      }

      if ($cbx_dia_otro == "Día") {
          $cbx_dia_otro ='NULL';}

      if ($cbx_mes_otro == "Mes") {
          $cbx_mes_otro ='NULL';}

      if ($ano_otro <= 0) {
          $ano_otro ='NULL';}

    $queryotro = "SELECT ac_idotro, tipo_otros FROM not190.ac_idotros where tipo_otros = '".$otro_doc_tipo."';";
    $result_idof = mysqli_query($con,$queryotro);

      $filas_idof = mysqli_num_rows($result_idof);
      $row_idof = $result_idof->fetch_assoc();

    if ($filas_idof<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_idof = "INSERT INTO `not190`.`ac_idotros` (`tipo_otros`) VALUES ('".$otro_doc_tipo."');";
        $result_insert_idof = mysqli_query($con, $insert_idof);
        $id_otro =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_otro = $row_idof['ac_idotro'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }


      //$result_insert_otro = mysqli_query($con, $insert_otro);

      $update_idof = "UPDATE `not190`.`actas` SET `id_tipo1` = '5', `id_esc_tipo` = null, `id_esc_vol` = null, `ac_esc` = null, `ac_vol` = null, `a_que_cont` = ".$chbox_contiene_otro.", `id_contenido` = ".$id_cont.", `a_favor` = null, `id_persona1` = null, `id_empresa1` = null, `id_sociedad1` = null, `id_tipo_emitido1` = ".$chbox_emitido_otro.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$chbox_de_fecha_otro.", `a_dia` = ".$cbx_dia_otro.", `id_mes` = ".$cbx_mes_otro.", `a_ano` = '".$ano_otro."', `a_targeta` = null, `id_targetas1` = null, `ac_idoficial1` = null, `a_idmex` = null, `id_factura1` = null, `a_factura` = null, `id_otro` = ".$id_otro.",  `a_otro` = '".$otro_doc_vol."', `ac_manual` = null WHERE (`id_acta` = ".$id_acta.");";

        //echo $update_idof;

        $result_update_idof = mysqli_query($con, $update_idof);


      require ("imp_acta_otro.php");      
        break;
//-------------------------------------------------------------------------MANUAL-------------------------------------------------
    case "manual":

    $querytipemit = "SELECT id_ac_emitido, tipo_emitido FROM not190.ac_emitido_tipo where tipo_emitido = '".$emitido_manual."';";
    $result_tipemit = mysqli_query($con,$querytipemit);

      $filas_tipemit = mysqli_num_rows($result_tipemit);
      $row_tipemit = $result_tipemit->fetch_assoc();

    if ($filas_tipemit<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_idof = "INSERT INTO `not190`.`ac_emitido_tipo` (`tipo_emitido`) VALUES ('".$emitido_manual."');";
        $result_insert_idof = mysqli_query($con, $insert_idof);
        $id_tipo_emitido =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_tipo_emitido = $row_tipemit['id_ac_emitido'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

    $queryemit = "SELECT id_emitido, emitido FROM not190.ac_emitido where emitido = '".$emitido_nombre."';";
    $result_emiti = mysqli_query($con,$queryemit);

      $filas_emiti = mysqli_num_rows($result_emiti);
      $rowemiti = $result_emiti->fetch_assoc();

    if ($filas_emiti<=0) {
        $insert_emiti = "INSERT INTO `not190`.`ac_emitido` (`emitido`) VALUES ('".$emitido_nombre."');";
        $result_insert_emiti = mysqli_query($con, $insert_emiti);
        $id_emiti =mysqli_insert_id($con);
        
      }else{
        $id_emiti = $rowemiti['id_emitido'];
      } 

    $query_fecha_man = "SELECT id_ac_fecha, de_fecha FROM not190.ac_de_fechas where de_fecha = '".$fecha_manual."';";
    $result_fecha_man = mysqli_query($con,$query_fecha_man);

      $filas_fecha_man = mysqli_num_rows($result_fecha_man);
      $row_fecha_man = $result_fecha_man->fetch_assoc();

    if ($filas_fecha_man<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_fecha_man = "INSERT INTO `not190`.`ac_emitido_tipo` (`tipo_emitido`) VALUES ('".$fecha_manual."');";
        $result_insert_fecha_man = mysqli_query($con, $insert_fecha_man);
        $id_fecha_man =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_fecha_man = $row_fecha_man['id_ac_fecha'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      if ($cbx_dia_manual == "Día") {
          $cbx_dia_manual ='NULL';}

      if ($cbx_mes_manual == "Mes") {
          $cbx_mes_manual ='NULL';}

      if ($ano_manual <= 0) {
          $ano_manual ='NULL';
      }


      $update_idof = "UPDATE `not190`.`actas` SET `id_tipo1` = '6', `id_esc_tipo` = null, `id_esc_vol` = null, `ac_esc` = null, `ac_vol` = null, `a_que_cont` = null, `id_contenido` = null, `a_favor` = null, `id_persona1` = null, `id_empresa1` = null, `id_sociedad1` = null, `id_tipo_emitido1` = ".$chbox_emitido_otro.", `id_emitido1` = ".$id_emiti.", `act_fecha` = ".$id_fecha_man.", `a_dia` = ".$cbx_dia_manual.", `id_mes` = ".$cbx_mes_manual.", `a_ano` = '".$ano_manual."', `a_targeta` = null, `id_targetas1` = null, `ac_idoficial1` = null, `a_idmex` = null, `id_factura1` = null, `a_factura` = null, `id_otro` = null,  `a_otro` = null, `ac_manual` = '".$id_corresponde."' WHERE (`id_acta` = ".$id_acta.");";

        //echo $update_idof;

        $result_update_idof = mysqli_query($con, $update_idof);



//    $insert_manual = "INSERT INTO `not190`.`actas` (`id_cotejo1`, `id_tipo1`, `id_tipo_emitido1`, `id_emitido1`, `act_fecha`, `a_dia`, `id_mes`, `a_ano`, `ac_manual`, `usuario4`) VALUES (".$id_cotejo.", '6', ".$id_tipo_emitido.", ".$id_emiti.", ".$id_fecha_man.", ".$cbx_dia_manual.", ".$cbx_mes_manual.", ".$ano_manual.", '".$id_corresponde."', ".$user.");";


      require ("imp_acta_manual.php");
/*     echo "<br>----Type Documento: ".$id_corresponde." Tipo Emitido: >>>".$emitido_manual."<<<< nombre emitido : ".$emitido_nombre." fecha : ".$fecha_manual." Dia: ".$cbx_dia_manual." Mes:---".$cbx_mes_manual." Año :---".$ano_manual;
*/
    break;

}
?>
