<?php 
include_once "php/conexion.php";  
$con = conectar();

  session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

  }

if(isset($_GET['idfam'])){
$conidfam = $_GET['idfam'];    
$pag = $_GET['pag'];    


$querymodfam = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, c_mostrada, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, copia, plano, c_fecha, fname, name ,id_usuario3, u_nombre FROM not190.cotejos inner join hojas on cotejos.c_tamaño = hojas.id_hoja inner join lados on cotejos.c_lados = lados.id_lado inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado LEFT JOIN personas ON cotejos.c_persona = personas.id_persona LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario WHERE id_cotejo = ".$conidfam.";";

//echo $querymodfam ;

$resultcfam = mysqli_query($con, $querymodfam);
$fila = $resultcfam->fetch_assoc();

$querytam = "SELECT id_hoja, h_tamaño FROM not190.hojas;;";
$resultam = mysqli_query($con, $querytam);




}
?>
<?php
include ("nav.php");


?>
</div>
<center><h1 class="display-3">Modificar Cotejo: <?php echo $fila['c_nocotejo'] ?></h1></center>
<div class="table table-hover">

<form id="formulario_sec" name="formulario_sec" action="modificar_cotejo2.php" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">
  <input type="hidden" name="id_cotejo" value="<?php echo $conidfam; ?>">   
  <input type="hidden" name="pag" value="<?php echo $pag; ?>">   
  <div class="row">

    <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-12 col-md-1">Numero de cotejo: <br>
      <input name="no_cotejo" id="no_cotejo" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $fila['c_nocotejo']; ?> ">
    </div>
    <div class="col-xs-12 col-md-1">Libro: <br>
      <input name="no_libro" id="no_libro" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $fila['c_libro']; ?> ">
    </div>

    <div class="col-xs-6 col-md-2">Fecha:
      <input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $fila['c_fecha']; ?>"><br>
    </div>
    <div class="col-xs-6 col-md-1">
      <label for="name">A solicitud de:<span></span></label><br>
       <?php
       if ($fila['c_persona'] >= 1){
       ?>
       <input type="radio" name="titulo" value="SI" onchange="titulo_p(this.value);" required> Empresa</br>
       <input type="radio" name="titulo" value="NO" onchange="titulo_p(this.value);" required checked> Persona</br>
       <?php
       }else{
       ?>
       <input type="radio" name="titulo" value="SI" onchange="titulo_p(this.value);" required checked> Empresa</br>
       <input type="radio" name="titulo" value="NO" onchange="titulo_p(this.value);" required> Persona</br>
       <?php
       }
       ?>
    </div>

    <div class="col-xs-6 col-md-2" id="ano_t" style="display:none;">
      <div class="one_third">            
        <label class="">Nombre de la empresa (Doble Click)</label>        
        <input type="text" name="search_cliente" id='search_cliente' ondblclick="Doble_Clic(this.value)" value="<?php echo $fila['e_nombre']; ?>" class="form-control" class="form-control"/>     
      </div>
    </div>

    <div class="col-xs-6 col-md-3" id="objetosocial" style="display:none;">
      <label for="selección2">Objeto Social <span></span></label><br>
      <input id="dni" name="dni" type="text" maxlength="255" value="<?php echo $fila['t_sociedad']; ?>" class="form-control"/>
    </div>

    <div class="col-xs-6 col-md-3" id="motivos" style="display:none;">
      <label for="selección1">Persona <span></span></label><br>
      <input id="persona" name="persona" type="text" maxlength="255" value="<?php echo $fila['p_nombre']; ?>" class="form-control"/>
    </div>

  </div>

  <div class="row">
    <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-1 ">Tantos solicitados:
    <br><input name="no_tantos" id="no_tantos" placeholder="ej. 2" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $fila['c_tantos_soli']; ?>">
    </div>
    <div class="col-xs-6 col-md-1 ">Numero de fojas:
    <br><input name="no_fojas" id="no_fojas" placeholder="ej. 14" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control" value="<?php echo $fila['c_hoja']; ?>">
    </div>
    <div class="col-xs-6 col-md-2">
    Hoja Anexa
    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title=""></span>
    <br>
    <label>
    <?php
    if ($fila['c_hoja_anexa'] == 2) {
    ?>
    <input  type="checkbox" id="hoja_anexa" name="hoja_anexa" value="1" checked> </label><br>
    <?PHP 
    }else{
    ?>
    <input  type="checkbox" id="hoja_anexa" name="hoja_anexa" value="1"> </label><br>
    <?PHP 
    }
    ?>
    Fojas: por un solo lado <br>
    <label>
    <?php
    if ($fila['c_lados'] == 1) {
    ?>
    <input  type="checkbox" id="sololad" name="sololad" value="1"><br>  
    <?PHP 
    }else{
    ?>
    <input  type="checkbox" id="sololad" name="sololad" value="1" checked><br>
    <?PHP 
    }
    ?>
    
    Mostrada: solo anverso <br>
    <?php
    if ($fila['c_mostrada'] == 1) {
    ?>
    <input  type="checkbox" id="soloanberso" name="soloanberso" value="1"><br>  
    <?PHP 
    }else{
    ?>
    <input  type="checkbox" id="soloanberso" name="soloanberso" value="1" checked><br>
    <?PHP 
    }
    ?>
    <br>
    </div>
    <div class="col-xs-6 col-md-1 ">Tamaño de hoja: <br>
      <select id="uif_ana" class="btn btn-outline-secondary btn-sm" name="tam_hoja">
            <?php while($rowtam = $resultam->fetch_assoc()) { 
                      if ($rowtam['id_hoja'] == $fila['c_tamaño']) {
            ?>
                <option value="<?php echo $rowtam['id_hoja']; ?>" selected><?php echo $rowtam['h_tamaño']; ?></option>
            <?php
            }else{
            ?>
                <option value="<?php echo $rowtam['id_hoja']; ?>"><?php echo $rowtam['h_tamaño']; ?></option>
            <?php
            }
            }
            ?>
      </select>
    </div>
    <div class="col-xs-6 col-md-2">
      <?php  
      ?>
      <label class="btn btn-outline-secondary btn-sm" for="my-file-selector">
        <input type="file" name="file" id="exampleInputFile">
      </label>
      <?php
      if ($fila['name']>=0) {
        echo "Archivo cargado:  ".$fila['name'];
      ?>
      <input type="hidden" name="file-n" value="<?php echo $fila['name']; ?>">   
      <?php
      } 
      ?>
    </div>
    
  </div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 "><input type="submit" class="btn btn-success disable" value="Ingresar Cotejo" name="regfam" ></div>
  <div class="col-xs-6 col-md-2"></div>
  <div class="col-xs-6 col-md-2">Copia certificada 
    <?php
    if ($fila['copia'] == 1) {
    ?>
    <input  type="checkbox" id="copia_c" name="copia_c" value="1" ><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Copiac certificada" >
    <?PHP 
    }else{
    ?>
    <input  type="checkbox" id="copia_c" name="copia_c" value="1" checked>
    <?PHP 
    }
    ?></span>
  <br>
  Plano 
    <?php
    
    if ($fila['plano'] == 1) {
    ?>
    <input  type="checkbox" id="plano" name="plano" value="1" ><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Plano">
    <?PHP 
    }else{
    ?>
    <input  type="checkbox" id="plano" name="plano" value="1" checked>
    <?PHP 
    }
    ?>
  </div>
  <div class="col-xs-6 col-md-8"> </div>
  
</div>
  </div>

</form>
<!-- Archivos de boostrap js -->
      <!-- ESTE SCRIPT REALIZA EL AUTOLLENADO DEL DNI Y LA DIRECCION LUEGO DE HACER DOBLE CLIK -->
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
        $(function() {
     $( "#persona" ).autocomplete({
       source: 'lista_cliente2.php',
     });
  });

    function titulo_p(dato){
        if(dato=='SI'){
            document.getElementById("ano_t").style.display = "block";
            document.getElementById("objetosocial").style.display = "block";
            document.getElementById("motivos").style.display = "none";
            
        }
        if(dato=='NO'){
            document.getElementById("ano_t").style.display = "none";
            document.getElementById("objetosocial").style.display = "none";
            document.getElementById("motivos").style.display = "block";
            
        }

    }

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
  $(function() {
     $( "#search_cliente" ).autocomplete({
       source: 'lista_cliente.php',
     });
  });

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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>