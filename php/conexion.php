
<?php
function conectar(){

$s="localhost";
$db= "not190";
$u= "root";
$pass = "";

$conexion = new mysqli($s, $u, $pass, $db);
if($conexion->connect_errno){
	return 'no conectado';
	}else{
		return $conexion;
		}
}

?>
