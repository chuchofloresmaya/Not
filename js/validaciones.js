function validacion_fam(){
		var sec = document.getElementById("cbx_sector").value
		var man = document.getElementById("manzana").value
		var fam = document.getElementById("familia").value
		var calle = document.getElementById("calle").value	
		var es_c = document.getElementById("cbx_estado_c").value
		var n_hoja = document.getElementById("no_hoja").value		
			
	if(sec == ""){
		alert("SELECCIONE UN SECTOR O PONGASE EN CONTACTO PARA ASIGNARLE UN SECTOR")
		return false;
	}
	if(man == ""){
		alert("POR FAVOR DIJITE UNA MANZANA")
		return false;
	}
	if(fam == ""){
		alert("Por Favor Dijite el nombre de la Familia")
		return false;
	}
	if(calle == ""){
		alert("Dijite el Nombre de la Calle o Privada")
		return false;
	}
	if(es_c == ""){
		alert("Seleccione un Estado Civil")
		return false;
	}
	if(n_hoja == ""){
		alert("DIJITE EL NUMERO DE LA HOJA")
		return false;
	}
}

function validacion_int(){
		var nom = document.getElementById("nombre").value
		var edad = document.getElementById("edad").value
		var sex = document.getElementById("cbx_sexo").value
		var par = document.getElementById("cbx_parentesco").value
		var fam = document.getElementById("idfam").value

	if(fam <= 0){
		alert("Antes de Registrar un Integrante debes Registrar una familia")
		return false;
	}
			
	if(nom == ""){
		alert("Dijitar Nombre del integrante")
		return false;
	}
	if(edad == ""){
		alert("Dijite la Edad del integrante")
		return false;
	}
	if(sex == ""){
		alert("Dijite el Sexo del Integrante")
		return false;
	}
	if(par == ""){
		alert("Seleccione el parentesco del integrante")
		return false;
	}

}

