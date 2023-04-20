<?php
require_once "php/conexion.php";
$con = conectar();
$con1= conectar();
session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

}



?>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <!-- Responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>
    
    </head>

    <body>


<?php
include ("nav.php");
?>
</div>

<center><h1 class="display-3">Formulario Ruta</h1></center>
<div class="table table-hover">
<form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();" enctype="multipart/form-data">  
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-2">Fecha:
    <br><input class="form-control" type="date" id="fecha" name="fecha">
  Hora:
      <input class="form-control" type="time" id="" name="hora">
  </div>
  <div class="col-xs-6 col-md-2">Lugar:  
  <input class="form-control" name="lugar" id="lugar" placeholder="" size="25" maxlength="50" />
  </div>
  <div class="col-xs-6 col-md-2">Persona: 
  <br>
  <input class="form-control" name="persona" id="persona" placeholder="" size="25" maxlength="50" onkeypress="letrasMayus(this);"/>
  </div>
  
  <div class="col-xs-6 col-md-2">Motivo:  
  <input class="form-control" name="motivo" id="motivo" placeholder="" size="25" maxlength="50" onkeypress="letrasMayus(this);"/>    
  </div>

</div>
    <div class="col-xs-6 col-md-3"> </div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
    <div class="col-xs-6 col-md-2"><br>
    Documentos:
    <br>
    <textarea class="form-control" id="documentos" name="documentos" rows="3" form="formulario_sec"></textarea>
  </div>
  <div class="col-xs-6 col-md-2 "><br>Notas u observaciones:<br>
   <textarea class="form-control" id="notas" name="notas" rows="3" form="formulario_sec"></textarea>
    </div>
  <div class="col-xs-6 col-md-2">
  <br>
  <br>
  <input type="submit" class="btn btn-success disable" value="Ingresar Ruta" name="regfam" ></div>
  </div>
  <div class="col-xs-6 col-md-5">

  </div>
</div>


        </div>
        </form>


<!-- ESTE SCRIPT GENERA LA LISTA DE COINCIDENCIAS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  
  <script type="text/javascript">
  $(function() {
     $( "#lugar" ).autocomplete({
       source: 'lista_lugares.php',
     });
  });

    $(function() {
     $( "#persona" ).autocomplete({
       source: 'lista_ruta_personas.php',
     });
  });
        $(function() {
     $( "#motivo" ).autocomplete({
       source: 'lista_ruta_motivo.php',
     });
  });
</script>       
</center>
<br><br>

<?PHP
if(isset($_POST['regfam'])){


$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$lugar = $_POST['lugar'];  
$persona = $_POST['persona'];  
$motivo = $_POST['motivo'];  
$documentos = $_POST['documentos'];  
$notas = $_POST['notas'];  
    

    if ($lugar <= 0) {
      $id_lugar1 = "null";
    }else{      
    $queryem = "SELECT id_lugares, Nombre_del_lugar FROM not190.lugares where Nombre_del_lugar = '".$lugar."';";
    $resultem = mysqli_query($con,$queryem);
    $filasem = mysqli_num_rows($resultem);
    $rowem = $resultem->fetch_assoc();
    //echo "Lugares encontrados: ".$filasem;

    if ($filasem<=0) { 

      $insert_lugar = "INSERT INTO `not190`.`lugares` (`Nombre_del_lugar`) VALUES ('".$lugar."');";
        $result_insert_empresa = mysqli_query($con, $insert_lugar);
        $id_lugar1 =mysqli_insert_id($con);
    }else{
      $id_lugar1 = $rowem['id_lugares'];
    }
}


    if ($persona <= 0) {
      $id_personas = "null";
    }else{      
    $queryper = "SELECT id_personas, nombre FROM not190.ruta_personas where nombre = '".$persona."';";
    $resultper = mysqli_query($con,$queryper);
    $filasper = mysqli_num_rows($resultper);
    $rowper = $resultper->fetch_assoc();
    //echo "Lugares encontrados: ".$filasem;

    if ($filasper<=0) { 
        $insert_persona = "INSERT INTO `not190`.`ruta_personas` (`nombre`) VALUES ('".$persona."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_personas = mysqli_insert_id($con);
    }else{
      $id_personas = $rowper['id_personas'];
    }   
}
  
    if ($motivo <= 0) {
      $id_motivo = "null";
    }else{      
    $querymotivo = "SELECT id_motivo, motivo FROM not190.motivo_ruta where motivo = '".$motivo."';";
    $resultmotivo = mysqli_query($con,$querymotivo);
    $filasmotivo = mysqli_num_rows($resultmotivo);
    $rowmotivo = $resultmotivo->fetch_assoc();
    //echo "Motivos: ".$filasmotivo;

    if ($filasmotivo<=0) { 
        $insert_motivo = "INSERT INTO `not190`.`motivo_ruta` (`motivo`) VALUES ('".$motivo."');";
        //echo "$insert_motivo";
        $result_insert_motivo = mysqli_query($con, $insert_motivo);
        $id_motivo = mysqli_insert_id($con);
    }else{
      $id_motivo = $rowmotivo['id_motivo'];
    }   

  
        $date= new DateTime("now", new DateTimeZone('America/Mexico_City')); //echo $date->format("Y-m-d H:i:s");
        $fech_insert = $date->format("Y-m-d H:i:s");

  $insert_ruta = "INSERT INTO `not190`.`rutas` (`fecha`, `hora`, `id_lugar1`, `id_persona`, `id_motivo1`, `documentos`, `notas`, `id_ususario2`, `fech_insert`) VALUES ('".$fecha."', '".$hora."', ".$id_lugar1.", ".$id_personas.", ".$id_motivo.", '".$documentos."', '".$notas."', '".$user."', '".$fech_insert."');";
  //echo "$insert_ruta";
  $result_insert_cotejo = mysqli_query($con, $insert_ruta);  



    //INSERT INTO `not190`.`rutas` (`fecha`, `hora`, `id_lugar1`, `id_persona`, `id_motivo1`, `documentos`, `notas`, `id_ususario2`, `fech_insert`) VALUES ('fecha', 'hora', 'id_lugar', 'id_persona', 'id_motivo', 'documentos', 'notras', 'usu', 'fech_insert');
}

?>

<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-2">Fecha y Hora</th>
      <th class="col-3">Lugar-Persona-Motivo</th>
      <th class="col-3">Documentos</th>
      <th class="col-3">Notas</th>
    </tr>
  </thead>

<?PHP
    $queryfam = "SELECT fecha, hora, Nombre_del_lugar, motivo, nombre, documentos, notas FROM not190.rutas 
left join lugares on lugares.id_lugares = rutas.id_lugar1
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
left join motivo_ruta on motivo_ruta.id_motivo = rutas.id_motivo1
where id_ususario2 = $user order by id_ruta DESC LIMIT 10";

//echo "$queryfam";

    $resultfam = $con1->query($queryfam);
    $filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td>Fecha: <br> <?php echo $rowfam['fecha'] ?><br> <?php echo $rowfam['hora'] ?> </td>
      <td>-<?php echo $rowfam['Nombre_del_lugar'] ?><br>-<?php echo $rowfam['nombre'] ?><br>-<?php echo $rowfam['motivo'] ?></td>
      <td><?php echo $rowfam['documentos']; ?></td>
      <td><?php echo $rowfam['notas']; ?></td>
      <td>
      </td>

      
    </tr>


<?PHP


        }
?>
  </tbody>
</table>
<?PHP
}

?>
    


    </script> 
</body>
</BR>
</html>