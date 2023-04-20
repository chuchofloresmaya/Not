<?php
// conecta a la base de datos
include("conectar.php"); 

if (isset($_GET['term'])) {
 $find_nombre = find_nombre($conn, $_GET['term']);
 $id_List = array();
 foreach($find_nombre as $nombre){
 $id_List[] = $nombre['estado'];
 }
 echo json_encode($id_List);
}
 
function find_nombre($conn , $term){ 
 $query = "SELECT id_estado, estado FROM not190.estados WHERE estado like '%".$term."%' limit 10;";
 $result = mysqli_query($conn, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
?>