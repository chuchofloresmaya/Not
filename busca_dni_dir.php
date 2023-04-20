<?php

// consigue el nombre desde el formulario
$search_cliente = $_REQUEST['search_cliente'];

// Coneccion a la base de datos

include("conectar.php"); 

if ($search_cliente !== "") {
	
	// Se busca el dni y la direccion correspondiente al nombre
	$query = mysqli_query($conn, "SELECT id_empresa, e_nombre, id_tiposciedad, t_sociedad FROM not190.empresas inner join tiposociedad on empresas.id_tiposciedad = tiposociedad.id_tiposociedad WHERE e_nombre='$search_cliente'");

	$row = mysqli_fetch_array($query);

	// consigue el dni
	$dni = $row["t_sociedad"];

	// consigue la Sociedad
	$direccion = $row["id_tiposciedad"];

	// consigue la Sociedad
	$id_empresa = $row["id_tiposciedad"];
}

// lo almacena un un arreglo
$result = array("$dni", "$direccion", "$id_empresa");

// lo envia al formulario
$myJSON = json_encode($result);
echo $myJSON;
?>