<?php
// conecta a la base de datos
include("conectar.php"); 

if (isset($_GET['term'])) {
 $find_nombre = find_nombre($conn, $_GET['term']);
 $id_List = array();
 foreach($find_nombre as $nombre){
 $id_List[] = $nombre['e_nombre'];
 }
 echo json_encode($id_List);
}
 
function find_nombre($conn , $term){ 
 $query = "SELECT e_nombre, id_tiposciedad, t_sociedad FROM not190.empresas inner join tiposociedad on empresas.id_tiposciedad = tiposociedad.id_tiposociedad WHERE e_nombre like '%".$term."%' limit 10;";
 $result = mysqli_query($conn, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
?>