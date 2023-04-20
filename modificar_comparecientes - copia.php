<div class="lista-producto float-clear" style="clear:both;">
 <ul class="list-group">
   <li class="list-group-item">
<div class="float-left"><input type="checkbox" name="item_index[]" /></div>

<?php 
$id_comp = $_GET['comp'];

require_once "php/conexion.php";
$con = conectar();






$query_exp = "SELECT id_compreciente, compareciente, nombre_com, nom_comprador.nombre as nombre_compareciente, fecha_nacimeinto, lugar_nacimiento, compareciente.estado_civil ,estados_civiles.estado_civil as estado_civil_nom, nombre_conyuge, 
nom_conyuge.nombre as nombre_conyuge, domicilio, ocupacion, curp, rfc, doc_identificacion, no_identificacion, tipo_identificacion FROM not190.compareciente 
inner join tipo_comparecinetes on compareciente.id_compreciente = tipo_comparecinetes.id_compareciente 
inner join nombres_expedientes as nom_comprador on compareciente.nombre_com = nom_comprador.id_nombre 
left join nombres_expedientes as nom_conyuge on compareciente.nombre_conyuge = nom_conyuge.id_nombre 
inner join estados_civiles on compareciente.estado_civil = estados_civiles.id_estado 
inner join documentos_identificacion as ide on compareciente.doc_identificacion = ide.id_documento 
where id_compareciente = 3;";

//echo "<br>$query_exp<br>";

$result_exp = mysqli_query($con, $query_exp);
$fila_exp = $result_exp->fetch_assoc();




$querycivil = "SELECT id_estado, estado_civil FROM not190.estados_civiles;";
$resultcivil = mysqli_query($con, $querycivil);

while($rowcivil = $resultcivil->fetch_assoc()) {
      $id_civil = $rowcivil['id_estado']; 
      $estado_civil = $rowcivil['estado_civil'];

$c[] = $rowcivil['estado_civil'];
}

$querymes = "SELECT id_compareciente, compareciente FROM not190.tipo_comparecinetes;";
$resultadomes = mysqli_query($con, $querymes);

while($rowproyec = $resultadomes->fetch_assoc()) {
      $id_proyectista = $rowproyec['id_compareciente']; 
      $nombre = $rowproyec['compareciente'];

$a[] = $rowproyec['compareciente'];
}

$querydocid = "SELECT id_documento, tipo_identificacion FROM not190.documentos_identificacion;";
$resultadodocid = mysqli_query($con, $querydocid);

while($rowdocid = $resultadodocid->fetch_assoc()) {
      $id_compareciente = $rowdocid['id_documento']; 
      $tipo_identificacion = $rowdocid['tipo_identificacion'];

$b[] = $rowdocid['tipo_identificacion'];
}
?>


<div class="float-left">
  <div class="row">
  <div class="col-xs-6 col-md-1 "></div>
<div class="col-xs-6 col-md-3" id="fecha_tramite" >Compadeciente: <br>
  <select id="id_tipo_compareciente" name="id_tipo_compareciente[]" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
        
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
   <input class="form-control" type="text" id="nombre_com" name="nombre_com[]" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Nombre">
   <br> Fecha de nacimiento
   <input class="form-control" type="date" id="fecha_nacimeinto" name="fecha_nacimeinto[]">
      Lugar de nacimiento:
   <input class="form-control" type="text" id="lugar_nacimiento" name="lugar_nacimiento[]" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Lugar de nacimiento">
   <center>Estado civil<br></center>
  <select id="estado_civil" name="estado_civil[]" class="btn btn-outline-secondary btn-sm" required>
        
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
   <input class="form-control" type="text" id="nombre_conyuge" name="nombre_conyuge[]" value="<?php //echo $fila_exp['no_esc'];?>" placeholder="Nombre">
  </div>
<div class="col-xs-6 col-md-3" id="fecha_termino" >
   Domicilio: 
   <input class="form-control" type="text" id="domicilio" name="domicilio[]">
   Ocupación:
   <input class="form-control" type="text" id="ocupacion" name="ocupacion[]">
   CURP:
   <input class="form-control" type="text" id="curp" name="curp[]">
   RFC:
   <input class="form-control" type="text" id="rfc" name="rfc[]"> 
    <br>

  </div>  
  <div class="col-xs-6 col-md-2" id="fecha_termino" >Documento de identificación
          <select id="doc_identificacion" name="doc_identificacion[]" class="btn btn-outline-secondary btn-sm" name="cbx_mes_esc" required>
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
   <input class="form-control" type="text" id="no_identificacion" name="no_identificacion[]">              
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
</div>