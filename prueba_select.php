<?php
$paiselegido = 3;
require_once "php/conexion.php";
$con = conectar();

$queryinstitucion = "SELECT * FROM not190.exp_institucion;";
$resultinstitucion = mysqli_query($con, $queryinstitucion);

while($rowinstitucion = $resultinstitucion->fetch_assoc()) {
      $institucion = $rowinstitucion['institucion'];

$institucions[] = $rowinstitucion['institucion'];
}

$html = "";
if ($paiselegido == 1) {
      $html = '
      <option value="">Institución</option>
      ';    
}
if ($paiselegido == 2) {
      $html = '
      <option value="">Institución</option>
      ';    
}
if ($paiselegido == 3) {

      $html = '    
    <option value="1">issfam</option>
    <option value="2">HSBC</option>
    <option value="3">FOVISSSTE</option>
    <option value="4">Banorte</option>
    <option value="5">Bancomer</option>
    <option value="6">Bancomer</option>
';  
}
if ($paiselegido == 4) {
      $html = '
    <option value="1">issfam</option>
    <option value="2">HSBC</option>
    <option value="3">FOVISSSTE</option>
    <option value="4">Banorte</option>
    <option value="5">Bancomer</option>
    <option value="6">Bancomer</option>
      ';    
}
echo $html; 
?>