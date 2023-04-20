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

$ultimo_id = 0;

$con= conectar();
$con1= conectar();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <!-- Icono -->
    
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
<center><h1 class="display-3">Formulario ISR</h1></center>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-1">Escritura: <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Inserta la escritura a registrar">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
</span>
<br>
  <input name="escritura" id="escritura" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control">
  </div>
  <div class="col-xs-6 col-md-1">Tipo:  
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Seleccione el tipo de escritura ordinaria o especial">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
    <select id="ores" class="btn btn-outline-secondary btn-sm" name="cbx_ores">
                        <option value="1">Ordinaria</option>
                        <option value="2">Especial</option>
    </select>
  </div>
  <div class="col-xs-6 col-md-1">Volumen: 
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Inserta el volumen de la escritura a registrar">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
   <br>
  <input type="text" class="form-control" name="volumen" id="volumen" placeholder="8" maxlength="4" size="7" onkeypress="return soloNumeros(event);">
  </div>
  <div class="col-xs-6 col-md-1">Mes: 
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Seleccione el mes en el que se ingreso la escritra">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
  </span>
  <br>
          <select id="cbx_mes" class="btn btn-outline-secondary btn-sm" name="cbx_mes">
                        <option >Mes</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
            </select>
  </div>
  
  <div class="col-xs-6 col-md-2">
    Enajenante:
    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el nombre de la persona que vendio">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
    <br>
    <input class="form-control" name="enajenante" id="enajenante" placeholder="Enajenante" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/></div>


  <div class="col-xs-6 col-md-2">
    Adquiriente:
    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el nombre de la persona que compro">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>
    <br>
    <input class="form-control" name="adquiriente" id="adquiriente" placeholder="Adquiriente" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/></div>
</div>
    <div class="col-xs-6 col-md-3"> </div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 ">Fecha:
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="En la que se pago el DeclaraNot">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
   </span>

    <br><input class="form-control" type="date" id="fecha" name="fecha"></div>
  <div class="col-xs-6 col-md-2">Folio de DeclaraNot: 
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el folio de DeclaraN">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
 </span>

  <br>
  <input class="form-control" type="text" class="" name="notfolio" id="notfolio" placeholder="Folio: 18946578" maxlength="8" size="10" onkeypress="return soloNumeros(event);"></div>
  <div class="col-xs-6 col-md-1 ">UIF: <br>
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Selecione si es acretado o no su UIF">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
  </span>
    <select id="uif_ana" class="btn btn-outline-secondary btn-sm" name="uif_ana">
                        <option value="1">Acreditado</option>
                        <option value="2">No Acreditado</option>
    </select></div>
    <div class="col-xs-6 col-md-6"></div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 ">ISR: 
  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese la cantidad de ISR ya sea entidad o federativa en su capo correspondiente">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
  </span>
  <br>
    <input type="text" class="form-control" name="federativa" id="federativa" placeholder="Federativa" maxlength="5" size="7" onkeypress="return soloNumeros(event);"> <input type="text" class="form-control" name="entidad" id="entidad" placeholder="Entidad" maxlength="5" size="7" onkeypress="return soloNumeros(event);"></div>
  <div class="col-xs-6 col-md-1">Folio CDFI <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingrese el folio de CDFI">
  <button class="form-control" style="pointer-events: none;" type="button" disabled>?</button>
  </span>
  <input type="text" class="form-control" name="cfdi" id="cfdi" placeholder="12D57E" maxlength="6" size="8"></div>
  <div class="col-xs-6 col-md-1"><BR><input type="submit" class="btn btn-success disable" value="Ingresar ISR" name="regfam" ></div>
  <div class="col-xs-6 col-md-8"></div>
  
</div>


        </div>
        </form>

 
</center>
<br><br>

<?PHP
if(isset($_POST['regfam'])){
    $escritura = $_POST['escritura'];
    $ores = $_POST['cbx_ores'];
    $volumen = $_POST['volumen'];
    $cbx_mes = $_POST['cbx_mes'];
    $enajenante = $_POST['enajenante'];
    $adquiriente = $_POST['adquiriente'];
    $federativa = $_POST['federativa'];
    $entidad = $_POST['entidad'];
    $fecha = $_POST['fecha'];
    $notfolio = $_POST['notfolio'];
    $uif_ana = $_POST['uif_ana'];
    $cfdi = $_POST['cfdi'];

    //echo "PRUEBA".$escritura.", ".$ores.", ".$volumen.", ".$cbx_mes.", '".$enajenante."', '".$adquiriente."', ".$federativa.", ".$entidad.", '".$fecha."', ".$notfolio.", ".$uif_ana.", ".$cfdi.", ".$user.");";

    $insertar_fam = "INSERT INTO `isr` (`id_isr`, `escritura`, `id_tipo1`, `volumen`, `id_mes1`, `enajenante`, `adquiriente`, `federativa`, `entidad`, `fecha`, `folio`, `id_uif1`, `cfdi`, `id_usuario1`) VALUES (NULL, ".$escritura.", ".$ores.", ".$volumen.", ".$cbx_mes.", '".$enajenante."', '".$adquiriente."', '".$federativa."', '".$entidad."', '".$fecha."', ".$notfolio.", ".$uif_ana.", '".$cfdi."', ".$user.");";

    $result_insert_fam = mysqli_query($con, $insertar_fam);

    if(!$result_insert_fam){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos Verifica todos los campos");</script>';
    }else{

    }
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"></th>
      <th class="col-1">Escritura</th>
      <th class="col-1">Tipo </th>
      <th class="col-1">Volumen </th>
      <th class="col-1">Mes </th>
      <th class="col-2">Enajenante - Adquiriente</th>
      <th class="col-1">Fecha</th>
      <th class="col-1">Folio</th>
      <th class="col-1">Validez</th>
      <th class="col-2">Federativa - Entidad</th>
      <th class="col-1">CFDI</th>
      
    </tr>
  </thead>

<?PHP
    $queryfam = "SELECT escritura, irs_tipo, volumen, mes, enajenante, adquiriente, fecha, folio, validez, federativa, entidad, cfdi FROM not190.isr inner join tipo_isr on isr.id_tipo1 = tipo_isr.id_tipo inner join mes on isr.id_mes1 = mes.id_mes inner join uif on isr.id_uif1 = uif.id_uif where id_usuario1 = ".$user." order by id_isr DESC;";

$resultfam = $con1->query($queryfam);
$filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      <th scope="row"></th>
      <td><?php echo $rowfam['escritura'] ?></td>
      <td><?php echo $rowfam['irs_tipo'] ?></td>
      <td><?php echo $rowfam['volumen'] ?></td>
      <td><?php echo $rowfam['mes'] ?></td>
      <td><?php echo $rowfam['enajenante'] ?> - <?php echo $rowfam['adquiriente'] ?></td>
      <td><?php echo $rowfam['fecha'] ?></td>
      <td><?php echo $rowfam['folio'] ?></td>
      <td><?php echo $rowfam['validez'] ?></td>
      <td><?php echo $rowfam['federativa'] ?> - <?php echo $rowfam['entidad'] ?></td>
      <td><?php echo $rowfam['cfdi'] ?></td>
      
    </tr>


<?PHP


        }
?>
  </tbody>
</table>
<?PHP
}

?>
    



<!-- Archivos de boostrap js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>