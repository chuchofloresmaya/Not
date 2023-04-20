<?php
// conecta a la base de datos
include("conectar.php"); 

if (isset($_GET['term'])) {
 $find_nombre = find_nombre($conn, $_GET['term']);
 $id_List = array();
 foreach($find_nombre as $nombre){
 $id_List[] = $nombre['tipo_emitido'];
 }
 echo json_encode($id_List);
}
 
function find_nombre($conn , $term){ 
 $query = "SELECT id_ac_emitido, tipo_emitido FROM not190.ac_emitido_tipo WHERE tipo_emitido like '%".$term."%' limit 10;";
 $result = mysqli_query($conn, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
?>