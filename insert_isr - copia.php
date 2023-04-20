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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <!-- Responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">

	
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>

    </head>
    <body>
<?php
include ("nav.php");
?>
<br>
<br>
<br>
<br>
<br>
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
        <div class="row">
            <div class="col-3 borde">
                Escritura 
                <input type="text" class="escritura" name="escritura" id="escritura" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);">
            <select id="ores" class="btn btn-outline-secondary btn-sm" name="cbx_ores">
                        <option value="1">Ordinaria</option>
                        <option value="2">Especial</option>
            </select>
            Volumen
            <input type="text" class="volumen" name="volumen" id="volumen" placeholder="8" maxlength="2" size="7" onkeypress="return soloNumeros(event);">
            </div>

            <div class="col-2 borde">
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
            <div class="col-2 ">
                    <input name="enajenante" id="enajenante" placeholder="Enajenante" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/>

            </div>
            <div class="col-2 ">
                    <input name="adquiriente" id="adquiriente" placeholder="Adquiriente" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/>                    
            </div>

        </div>
        <div class="row">
            <div class="col-5 borde"> 
                            <input type="date" id="fecha" name="fecha">
                DeclaraNot
                <input type="text" class="" name="notfolio" id="notfolio" placeholder="Folio: 18946578" maxlength="8" size="10" onkeypress="return soloNumeros(event);">
                UIF
                <select id="uif_ana" class="btn btn-outline-secondary btn-sm" name="uif_ana">
                        <option value="1">Acreditado</option>
                        <option value="2">No Acreditado</option>
                </select>
            </div>
            <div class="col-3 borde">
                <center>ISR
                <input type="text" class="" name="federativa" id="federativa" placeholder="Federativa" maxlength="5" size="7" onkeypress="return soloNumeros(event);">
                <input type="text" class="" name="entidad" id="entidad" placeholder="Entidad" maxlength="5" size="7" onkeypress="return soloNumeros(event);">
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-3 borde">
            <center>            
            CDFI: <input type="text" class="" name="cfdi" id="cfdi" placeholder="12D57E" maxlength="6" size="8" onkeypress="return soloNumeros(event);">
            </div></center>
        </div>

<input type="submit" class="btn btn-success disable" value="Ingresar ISR" name="regfam" ></br></br>            
        </div>
        </form>



<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-12 col-md-1">Escritura: <br><input name="escritura" id="escritura" placeholder="5378" maxlength="5" size="7" onkeypress="return soloNumeros(event);" class="form-control">
  </div>
  <div class="col-xs-6 col-md-1">Tipo:  <br>
    <select id="ores" class="btn btn-outline-secondary btn-sm" name="cbx_ores">
                        <option value="1">Ordinaria</option>
                        <option value="2">Especial</option>
    </select>
  </div>
  <div class="col-xs-6 col-md-1">Volumen: <br>
            <input type="text" class="form-control" name="volumen" id="volumen" placeholder="8" maxlength="2" size="7" onkeypress="return soloNumeros(event);">
  </div>
  <div class="col-xs-6 col-md-1">Mes: <br>
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
    Enajenante: <br>
    <input class="form-control" name="enajenante" id="enajenante" placeholder="Enajenante" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/></div>

  <div class="col-xs-6 col-md-2">
    Adquiriente: <br>
    <input class="form-control" name="adquiriente" id="adquiriente" placeholder="Adquiriente" size="25" maxlength="50" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/></div>
</div>
    <div class="col-xs-6 col-md-3"> </div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 ">Fecha: <br><input class="form-control" type="date" id="fecha" name="fecha"></div>
  <div class="col-xs-6 col-md-2">Folio de DeclaraNot: <br>
  <input class="form-control" type="text" class="" name="notfolio" id="notfolio" placeholder="Folio: 18946578" maxlength="8" size="10" onkeypress="return soloNumeros(event);"></div>
  <div class="col-xs-6 col-md-1 ">UIF: <br>
    <select id="uif_ana" class="btn btn-outline-secondary btn-sm" name="uif_ana">
                        <option value="1">Acreditado</option>
                        <option value="2">No Acreditado</option>
    </select></div>
    <div class="col-xs-6 col-md-6"></div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-1 "></div>
  <div class="col-xs-6 col-md-2 ">ISR: <br>
    <input type="text" class="form-control" name="federativa" id="federativa" placeholder="Federativa" maxlength="5" size="7" onkeypress="return soloNumeros(event);"> <input type="text" class="form-control" name="entidad" id="entidad" placeholder="Entidad" maxlength="5" size="7" onkeypress="return soloNumeros(event);"></div>
  <div class="col-xs-6 col-md-1">CDFI <input type="text" class="form-control" name="cfdi" id="cfdi" placeholder="12D57E" maxlength="6" size="8"></div>
  <div class="col-xs-6 col-md-9"></div>
</div>




            <div class="container">
                <div class="row">
                    <div class="col">                    
                    </div>
                    <div class="col-6 formulario">                    
                        <div class="well well-sm">
                            <form class="form-horizontal" method="post">
                                <fieldset>
                                    <legend class="text-center header">Contact us</legend>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="name" type="text" placeholder="First Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>              
                    <div class="col">                    
                    </div>
                </div>
            </div>

 
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

    $insertar_fam = "INSERT INTO `isr` (`id_isr`, `escritura`, `id_tipo`, `volumen`, `id_mes`, `enajenante`, `adquiriente`, `federativa`, `entidad`, `fecha`, `folio`, `id_uif`, `cfdi`, `id_usuario`) VALUES (NULL, ".$escritura.", ".$ores.", ".$volumen.", ".$cbx_mes.", '".$enajenante."', '".$adquiriente."', ".$federativa.", ".$entidad.", '".$fecha."', ".$notfolio.", ".$uif_ana.", ".$cfdi.", ".$user.");";

    $result_insert_fam = mysqli_query($con, $insertar_fam);

    if(!$result_insert_fam){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos Verifica todos los campos");</script>';
    }else{

    }
?>

  <table class="table table-bordered table-striped">
    <thead>
    <tr class="">

        <th>Escritura: </th>
        <th>Tipo: </th>
        <th>Volumen </th>
        <th>Mes </th>
        <th>Enajenante </th>
        <th>Adquiriente </th>
        <th>Fecha </th>
        <th>Folio </th>
        <th>Validez </th>
        <th>Federativa </th>
        <th>Entidad </th>
        <th>CFDI </th>
    </thead>
    <tbody>

<?PHP
    $queryfam = "SELECT escritura, irs_tipo, volumen, mes, enajenante, adquiriente, fecha, folio, validez, federativa, entidad, cfdi FROM not190.isr inner join tipo_isr on isr.id_tipo = tipo_isr.id_tipo inner join mes on isr.id_mes = mes.id_mes inner join uif on isr.id_uif = uif.id_uif where id_usuario = ".$user." order by id_ruta DESC";

$resultfam = $con1->query($queryfam);
$filasisr=mysqli_num_rows($resultfam);

        if($filasisr<=0){
          echo '<center> <h2>No hay ISR por consultar <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
        <td><?php echo $rowfam['escritura'] ?></td>
        <td><?php echo $rowfam['irs_tipo'] ?></td>
        <td><?php echo $rowfam['volumen'] ?></td>
        <td><?php echo $rowfam['mes'] ?></td>
        <td><?php echo $rowfam['enajenante'] ?></td>
        <td><?php echo $rowfam['adquiriente'] ?></td>
        <td><?php echo $rowfam['fecha'] ?></td>
        <td><?php echo $rowfam['folio'] ?></td>
        <td><?php echo $rowfam['validez'] ?></td>
        <td><?php echo $rowfam['federativa'] ?></td>
        <td><?php echo $rowfam['entidad'] ?></td>
        <td><?php echo $rowfam['cfdi'] ?></td>
    </tr>

<?PHP


        }


    }

?>
    
    </tr>
    </tbody>
    </table>


<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>