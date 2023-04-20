
 <ul class="list-group">
   <li class="list-group-item">
<div class="float-left"><input type="checkbox" name="item_index" /></div>

<?php 
require_once "php/conexion.php";
$con = conectar();

$querycivil = "SELECT id_estado, estado_civil FROM not190.estados_civiles;";
$resultcivil = mysqli_query($con, $querycivil);

while($rowcivil = $resultcivil->fetch_assoc()) {
      $id_civil = $rowcivil['id_estado']; 
      $estado_civil = $rowcivil['estado_civil'];

$c = $rowcivil['estado_civil'];
}

$querymes = "SELECT id_compareciente, compareciente FROM not190.tipo_comparecinetes;";
$resultadomes = mysqli_query($con, $querymes);

while($rowproyec = $resultadomes->fetch_assoc()) {
      $id_proyectista = $rowproyec['id_compareciente']; 
      $nombre = $rowproyec['compareciente'];

$a = $rowproyec['compareciente'];
}

$querydocid = "SELECT id_documento, tipo_identificacion FROM not190.documentos_identificacion;";
$resultadodocid = mysqli_query($con, $querydocid);

while($rowdocid = $resultadodocid->fetch_assoc()) {
      $id_compareciente = $rowdocid['id_documento']; 
      $tipo_identificacion = $rowdocid['tipo_identificacion'];

$b = $rowdocid['tipo_identificacion'];
}
?>


<div class="float-left">
  <div class="row">
  <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-3" id="fecha_tramite" >Compadeciente: <br>
  <select id="id_tipo_compareciente" name="id_tipo_compareciente" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        
        <?php 
        foreach ($a as $k => $v) {
        $k++;
        if ($k != $fila_exp['compareciente']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>     
  <br>Nombre
   <input class="form-control" type="text" id="nombre_com" name="nombre_com" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Nombre">
   <br> Fecha de nacimiento
   <input class="form-control" type="date" id="fecha_nacimeinto" name="fecha_nacimeinto">
      Lugar de nacimiento:
   <input class="form-control" type="text" id="lugar_nacimiento" name="lugar_nacimiento" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Lugar de nacimiento">
   <center>Estado civil<br></center>
  <select id="estado_civil" name="estado_civil" class="btn btn-outline-secondary btn-sm" required>
        
        <?php 
        foreach ($c as $k => $v) {
        $k++;
        if ($k != $fila_exp['estado_civil']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>  

  <br>Estado civil Casado<br>
    Nombre del cónyuge:
   <input class="form-control" type="text" id="nombre_conyuge" name="nombre_conyuge" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Nombre">
  </div>
<div class="col-xs-6 col-md-3" id="fecha_termino" >
   Domicilio: 
   <input class="form-control" type="text" id="domicilio" name="domicilio">
   Ocupación:
   <input class="form-control" type="text" id="ocupacion" name="ocupacion">
   CURP:
   <input class="form-control" type="text" id="curp" name="curp">
   RFC:
   <input class="form-control" type="text" id="rfc" name="rfc"> 
    <br>

  </div>  
  <div class="col-xs-6 col-md-2" id="fecha_termino" >Documento de identificación
          <select id="doc_identificacion" name="doc_identificacion" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        <?php 
        foreach ($b as $k => $v) {
        $k++;
        if ($k != $fila_exp['id_documento']) {
          echo "<option value=".$k.">".$v."</option>";
        }else{
          echo "<option selected value=".$k.">".$v."</option>";
        }
        }                                       
        ?>
        </select>    
    <br><br>No identificador:<br>
   <input class="form-control" type="text" id="no_identificacion" name="no_identificacion">              
    <br>
  </div>
  <div class="col-xs-6 col-md-2" id="fecha_termino" >  
  
  </div>
  <div class="row" id="" >-----------------------------------------------------------------------------------------------------------------------COMPARECIENTE-----------------------------------------------------------------------------------------------------------------------------
  </div>
</div>
</div>



	</li>
 </ul> 

<?php

  if(!empty($_POST["regfam"])) {
    
    $contador = count($_POST["nombre_com"]);
    $ProContador=0;
    $query = "INSERT INTO `not190`.`compareciente` (`id_exp`, `id_tipo_compareciente`, `nombre_com`, `fecha_nacimeinto`, `lugar_nacimiento`, `estado_civil`, `nombre_conyuge`, `domicilio`, `ocupacion`, `curp`, `rfc`, `doc_identificacion`, `no_identificacion`, `id_usu`, `fech_usu`) VALUES ";
    $queryValue = "";
    for($i=0;$i<$contador;$i++) {
      if(!empty($_POST["nombre_com"][$i])) {
        $ProContador++;
        if($queryValue!="") {
          $queryValue .= ",";
        }

      $nombre_com = $_POST["nombre_com"][$i];
      $querype = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$nombre_com."';";
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();


      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_comp = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$nombre_com."');";
        $result_insert_persona = mysqli_query($con, $insert_comp);
        $id_nombre_com =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_nombre_com = $rowpe['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      $estado_civil = $_POST['estado_civil'][$i];

      if ($estado_civil == 1) {
        $id_nombre_conyuge = 'null';
      }else{
        //$id_nombre_conyuge = null;
      $nombre_conyuge = $_POST["nombre_conyuge"][$i];
      $querycony = "SELECT id_nombre, nombre FROM not190.nombres_expedientes where nombre = '".$nombre_conyuge."';";
      $resultcony = mysqli_query($con,$querycony);

      $filascony = mysqli_num_rows($resultcony);
      $rowcony = $resultcony->fetch_assoc();


      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filascony<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_conyuge = "INSERT INTO `not190`.`nombres_expedientes` (`nombre`) VALUES ('".$nombre_conyuge."');";
        //echo $insert_conyuge;
        $result_insert_conyuge = mysqli_query($con, $insert_conyuge);
        $id_nombre_conyuge =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_nombre_conyuge = $rowpe['id_nombre'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }

      }
      //INSERTAR FECH
        $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); //echo $date->format("Y-m-d H:i:s");
        $fech_comp = $date->format("Y-m-d H:i:s");

        $queryValue .= "('" . $no_exp . "', '" . $_POST["id_tipo_compareciente"][$i] . "', '" . $id_nombre_com . "', '" . $_POST["fecha_nacimeinto"][$i] . "', '" . $_POST["lugar_nacimiento"][$i] . "', '" . $_POST['estado_civil'][$i] . "', " . $id_nombre_conyuge . ", '" . $_POST["domicilio"][$i] . "', '" . $_POST["ocupacion"][$i] . "', '" . $_POST["curp"][$i] . "', '" . $_POST["rfc"][$i] . "', '".$_POST["doc_identificacion"][$i]."', '".$_POST["no_identificacion"][$i]."', '".$user."', '" .$fech_comp."')";
      }
    }
    $sql = $query.$queryValue;
    if($ProContador!=0) {
        //echo $sql;
        
        $resultadocon = mysqli_query($con, $sql);
      if(!empty($resultadocon)){ $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
   <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
        }
    }
  }
?>