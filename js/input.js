
    function letrasMayus(e){
    e.value=e.value.toUpperCase();
    }

    function soloNumeros(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
    
	function soloLetras(e) {
	    key = e.keyCode || e.which;
	    tecla = String.fromCharCode(key).toLowerCase();
	    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	    especiales = [8, 37, 39, 46];

	    tecla_especial = false
	    for(var i in especiales) {
	        if(key == especiales[i]) {
	            tecla_especial = true;
	            break;
	        }
	    }

	    if(letras.indexOf(tecla) == -1 && !tecla_especial)
	        return false;
	}

	function dosfunciones(a,b){
		letrasMayus(a);
		soloLetras(b);
	}


	function limpia() {
	    var val = document.getElementById("miInput").value;
	    var tam = val.length;
	    for(i = 0; i < tam; i++) {
	        if(!isNaN(val[i]))
	            document.getElementById("miInput").value = '';
	    }
	}