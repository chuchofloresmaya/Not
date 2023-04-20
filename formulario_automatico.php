<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Formulario Automatico</title>
<link rel="stylesheet" type="text/css" href="total/view.css" media="all">

  
</head>

	
      
		<form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
		<div class="form_description">
		<h2>Formulario de Solicitudes - LLenado Automatico</h2>
		<p></p>
		</div>						
		<ul >
		         
		    <input type="text" name="search_cliente" id='search_cliente' ondblclick="Doble_Clic(this.value)" value="">
              
        <li id="li_2" >
		<label class="description">Documento de Identidad </label>
		<div>
		<input id="dni" name="dni" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
        
        <li id="li_3" >
		<label class="description" >Direccion del cliente </label>
		<div>
		<input id="direccion" name="direccion" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
              
        <li id="li_4" >
		<label class="description">Solicitud </label>
		<div>
		<input id="id_empresa" name="id_empresa" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
			
		<li class="buttons">
		<div class="col-xs-6 col-md-2 "><BR><input type="submit" class="btn btn-success disable" value="Ingresar Cotejo" name="regfam" ></div>
		</li>
		</ul>
		
        </form>	
<?PHP
  if(isset($_POST['regfam'])){
  	$no_cotejo = $_POST['search_cliente'];

  	echo " No Cotejo: ".$no_cotejo;
  }
 ?>
      
      
<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS DEL NOMBRE DE CLIENTE -->
      
<!-- jQuery -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  
<script type="text/javascript">
  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });
    $(function() {
     $( "#dni" ).autocomplete({
       source: 'lista_cliente1.php',
     });
  });
</script>       
   
  <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
  <script>

		function Doble_Clic(str) {
			if (str.length == 0) {
				document.getElementById("dni").value = "";
				document.getElementById("direccion").value = "";
				document.getElementById("id_empresa").value = "";
				return;
			}
			else {

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function ()
                {

					if (this.readyState == 4 && this.status == 200)
                    {
					var myObj = JSON.parse(this.responseText);
					document.getElementById
					("dni").value = myObj[0];
             		document.getElementById(
					"direccion").value = myObj[1];
             		document.getElementById(
					"id_empresa").value = myObj[2];
					}
				};
				xmlhttp.open("GET", "busca_dni_dir.php?search_cliente=" + str, true);
				xmlhttp.send();
			}
		}
	</script>      
  
      
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>