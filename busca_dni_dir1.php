<?php

// consigue el nombre desde el formulario
$nombre_comp = $_REQUEST['nombre_comp'];

// Coneccion a la base de datos

include("conectar.php"); 

if ($nombre_comp !== "") {
	
	// Se busca el dni y la direccion correspondiente al nombre
	$query = mysqli_query($conn, "SELECT id_tipo_compareciente, id_sexo, comp_nombre.nombre_com, compareciente.nacionalidad, estados_comp.estado, paises_comp.paises as pais, fecha_nacimeinto, hijo_a_padres.nacionalidad as hijo_a_padres, ocupaciones.ocupacion, domicilio.domicilio, numero, colonias.colonia_comp as colonia, cp, curp, rfc, doc_identificacion, no_identificacion FROM not190.compareciente
inner join nombres_comparecientes as comp_nombre on compareciente.nombre_com = comp_nombre.id_nombre_compareciente
left join estados as estados_comp on compareciente.id_estado = estados_comp.id_estado
left join paises as paises_comp on compareciente.id_pais = paises_comp.id_pais
left join nacionalidades_padres as hijo_a_padres on compareciente.hijo_a_padres = hijo_a_padres.id_nacionalidad
left join ocupaciones_comp as ocupaciones on compareciente.ocupacion = ocupaciones.id_ocupacion
left join domicilio_comp as domicilio on compareciente.domicilio = domicilio.id_domicilio
left join colonias on compareciente.colonia = colonias.id_colonia 
where comp_nombre.nombre_com = '".$nombre_comp."' order by id_compreciente desc LIMIT 1");

	$row = mysqli_fetch_array($query);
	//consigue la Sociedad
	$id_tipo_compareciente = $row["id_tipo_compareciente"];

	// consigue el dni
	$hijo_a_padres = $row["hijo_a_padres"];

	// consigue la Sociedad
	$ocupacion = $row["ocupacion"];

	// consigue la Sociedad
	$id_sexo = $row["id_sexo"];

	// consigue la Sociedad
	$fecha_nacimeinto = $row["fecha_nacimeinto"];

	// consigue la Sociedad
	$estado = $row["estado"];
	

	// consigue la Sociedad
	/*
	$nacionalidad_o = $row["nacionalidad"];	
	if ($nacionalidad_o = 1) {
		$nacionalidad = "nacionalidad_extranjero";
	} else if ($nacionalidad_o = 2) {
		$nacionalidad = "nacionalidad_mexicano";
	}*/
	


	// consigue la Sociedad
	//$id_empresa = $row["id_tiposciedad"];
}

// lo almacena un un arreglo
$result = array("$hijo_a_padres", "$ocupacion", "$id_tipo_compareciente", "$fecha_nacimeinto", "$estado");

// lo envia al formulario
$myJSON = json_encode($result);
echo $myJSON;
?>