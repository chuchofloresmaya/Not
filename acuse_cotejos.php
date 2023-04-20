<?php
require_once "php/conexion.php";

session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();
}
?>

 <body>


<?php
include ("nav.php");
?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

function AgregarMas() {
  $("<div>").load("InputDinamico.php", function() {
      $("#productos").append($(this).html());
  }); 
}
function BorrarRegistro() {
  $('div.lista-producto').each(function(index, item){
    jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
        $(item).remove();
            }
        });
  });
}
</script>

<body>


<!-- Begin page content -->

<div class="container">
  <h3 class="mt-5">Acuse de cotejos</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
      


<FORM name="num_cot" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">>
<div id="outer">
<div id="header">

</div>
<div id="productos">
<?php require_once("InputDinamico.php") ?>
</div>
<div class="btn-action float-clear">
<input class="btn btn-success" type="button" name="agregar_registros" value="Agregar Mas" onClick="AgregarMas();" />
<input class="btn btn-danger" type="button" name="borrar_registros" value="Borrar Campos" onClick="BorrarRegistro();" />
<span class="success"><?php if(isset($resultado)) { echo $resultado; }?></span>
</div>
<div style="position: relative;">
<input class="btn btn-primary" type="submit" name="guardar" value="Guardar Ahora" />
</div>
</div>
</form>


      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script src="dist/js/bootstrap.min.js"></script>

<?PHP


?>
        <table class="table table-striped">


          <tr class="">
            <th>No de cotejo</th>
            <th>Solicitud</th>
            <th>Fojas</th>
            <th>Tantos</th>
          </tr>


<?php

  if(!empty($_POST["guardar"])) {
    $values = array();
    $contador = count($_POST["no_cotejo"]);
    $ProContador=0;
    $query = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, 
        copia, c_fecha, fname, name ,id_usuario3, u_nombre, id_acta FROM not190.cotejos 
        inner join hojas on cotejos.c_tamaño = hojas.id_hoja 
        inner join lados on cotejos.c_lados = lados.id_lado 
        inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado 
        LEFT JOIN personas ON cotejos.c_persona = personas.id_persona 
        LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa 
        LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad 
        inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa 
        inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario 
        LEFT join actas on actas.id_cotejo1 = cotejos.id_cotejo
        where c_nocotejo = ";

    $queryValue = "";
      $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
  // convertir a mayusculas 
    abstract class HelperString
    {
        /**
         * Convierte un string a mayúsculas.
         * Es insensible a lo acéntos.
         *
         * @param string $txt
         *
         * @return string
         */
        public static function toUpper($txt)
        {
            if (function_exists('mb_strtoupper')) {
                return mb_strtoupper($txt); // Convierte carcateres especiales
            }
            return strtoupper($txt);
        }
    }

    for($i=0;$i<$contador;$i++) {


      if(!empty($_POST["no_cotejo"][$i])) {
        $ProContador++;
        $queryValue .= "'" . $_POST["no_cotejo"][$i] . "'";
        $no_cotejo = $_POST["no_cotejo"][$i];

        $sql = $query.$queryValue;
        $resultacuse = mysqli_query($con,$sql);
        $rowacuse = $resultacuse->fetch_assoc();
        $queryValue ="";
    
      $idpersona = $rowacuse['c_persona'];

    if($idpersona >= 1){
      $solicitud = $rowacuse['p_nombre'];
    }else{
      $solicitud = '"'.$rowacuse['e_nombre'].'", '.$rowacuse['t_sociedad'];
    }
    $tantos = $rowacuse['c_tantos_soli'];

          ECHO "<tr>
            <td>".$rowacuse['c_nocotejo']."</th>
            <th>".$solicitud."</th>
            <th>".$rowacuse['c_hoja']."</th>
            <th>".$tantos."</th>
          </td>";

      $l_no_cotejo = HelperSTring::toUpper($formatterES->format($no_cotejo));
    
    if ($tantos > 1) {
      $tantos =  $tantos." TANTOS";
    }else{
      $tantos = "UN TANTO";
    }


/* En la captura de tu pregunta aparenta estar definido así 'error' 
$error = [ 'error' => '<li>Tamaño máximo superado</li>' ];
$error = serialize($error);
$error = urlencode($error);
OJO: agregamos 'mensaje=' para que en el otro lado llegue como $_GET['mensaje'] 
header("Location: subidaarchivos.php?mensaje=" . $error);*/

    }
  //require_once ("acuse_cot_carta.php");

    $values[] = array ('no_cot' => $rowacuse['c_nocotejo'], 'no_cot_l' => $l_no_cotejo, 'tantos' => $tantos);
    }

    $values = array($values);
    //var_dump($values);
    $values = serialize($values);
    $values = urlencode($values);
    //var_dump($values);

?>
    <button class="alert-success"><a href="acuse_cot_carta.php?array=<?php echo $values;?>">Acuse</a></button>'

<?php 
}
?>
</body>

</html>