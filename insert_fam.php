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
$query = "SELECT u_nombre, idusuario, idsector, s_sector FROM u494342329_censo.usuario
inner join usu_sec on usuario.idusuario = usu_sec.idusuario1
inner join sector on usu_sec.idsector1 = sector.idsector
where idusuario=".$user.";";
$resultado = mysqli_query($con, $query);
$resultado1 = mysqli_query($con, $query);


$queryEC = "SELECT idestado_civil, e_estado_c FROM u494342329_censo.estado_civil;";
$resultadoEC = mysqli_query($con, $queryEC);
$resultadoEC1 = mysqli_query($con, $queryEC);

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
<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
        <div class="row">
            <div class="col-3 borde">    
                <select id="cbx_sector" name="cbx_sector" class="redondeado contorno">
                <?php while($row = $resultado->fetch_assoc()) {?>
                <option value="<?php echo $row['idsector']; ?>"><?php echo $row['s_sector']; ?></option>
                <?PHP 
                ;}
                ?>
                </select>
            </div>
            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="n_manzana" id="manzana" placeholder="Manzana: 8" maxlength="2" size="7" onkeypress="return soloNumeros(event);">
            </div>
            <div class="col-2 color5">
                <select class="redondeado contorno color5" id="cbx_estado_c" name="cbx_estado_c">
                <option value="">Estado Civil</option>
                <?php while($rowec = $resultadoEC->fetch_assoc()) {?>
                <option value=" <?php echo $rowec['idestado_civil']; ?>" ><?php echo $rowec['e_estado_c']; ?></option>
                <?PHP
                ;}
                ?> </select>
            </div>
            <div class="col-2 color5">
                <select class="redondeado contorno color5" id="cbx_estado_c_2" name="cbx_estado_c_2">
                <option value="">Estado Civil 2</option>
                <option value="2">Iglesia</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-5 borde"> 
                <input class="redondeado contorno" type="tex" name="n_familia" id="familia" placeholder="Familia: Pérez López" onkeypress="letrasMayus(this); " pattern="[A-Z ]+">
            </div>                     
        </div>
        <div class="row">
            <div class="col-3 borde">
                <input type="text" name="n_calle" id="calle" size="30" class="redondeado contorno" placeholder="Calle: Manuel buendia" onkeyup="letrasMayus(this)">
            </div>

            <div class="col-2 borde"><input type="456" name="n_numero" class="redondeado contorno" id="numero" placeholder="No.: #516" maxlength="4" size="4" onkeypress="return soloNumeros(event);"></div>         
        </div>
        <div class="row">
            <div class="col-5 borde">
                <input type="text" name="n_no_hoja" id="no_hoja" placeholder="Numero de Hoja: 40" size="15" class="redondeado contorno" maxlength="3" onkeypress="return soloNumeros(event);">
            </div>
<input type="submit" class="btn btn-success disable" value="Registrar Familia" name="regfam" ></br></br>            
        </div>
        </form>
</center>
<br><br>

<?PHP
if(isset($_POST['regfam'])){
    $sector1 = $_POST['cbx_sector'];
    $manzana = $_POST['n_manzana'];
    $familia = $_POST['n_familia'];
    $calle = $_POST['n_calle'];
    $numero = $_POST['n_numero'];
    $ins_estado_c = $_POST['cbx_estado_c'];
    $hoja = $_POST['n_no_hoja'];

    $insertar_fam= "INSERT INTO `u494342329_censo`.`familia` (`idusuario2`, `idsector2`, `f_manzana`, `f_calle`, `f_numero`, `f_familia`, `hoja`) VALUES ('".$user."', '".$sector1."', '".$manzana."', '".$calle."', '".$numero."', '".$familia."', '".$hoja."');";

    $result_insert_fam = mysqli_query($con, $insertar_fam);

    if(!$result_insert_fam){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos Verifica todos los campos");</script>';
    }else{
    $ultimo_id =mysqli_insert_id($con);
    $_SESSION['idfam'] = $ultimo_id;

    $insert_est = "INSERT INTO `u494342329_censo`.`fam_est` (`idfamilia2`, `idestado_civil1`) VALUES (".$ultimo_id.", ".$ins_estado_c.");";
    $insert_estado = mysqli_query($con, $insert_est);
    
    if(isset($_POST['cbx_estado_c_2'])){
        $estado_c2 =$_POST['cbx_estado_c_2'];
        $insert_est2 = "INSERT INTO `u494342329_censo`.`fam_est` (`idfamilia2`, `idestado_civil1`) VALUES (".$ultimo_id.", ".$estado_c2.");";
        $insert_estado2 = mysqli_query($con, $insert_est2);

    }
    

    //Esta linea son los datos que se registraran en la base 
    //echo '</br> Usuario que registro: '.$user.'</br> Sector: '.$sector1.'</BR> Nombre de la familia: '.$familia.'</br> Manzana: '.$manzana.'</br> calle: '.$calle.'</BR> Numero: '.$numero.'</br> Id estado civil: '.$ins_estado_c. '</br> Hoja: '.$hoja ;
    //Consulta Sector    
    $querysec1 = "SELECT idsector, s_sector FROM u494342329_censo.sector where idsector =".$sector1.";";
    $resultsec1 = mysqli_query($con, $querysec1);
    $rowsec1 = $resultsec1->fetch_assoc();
    //echo  '</br> </br>el sector es: '.$rowsec1['s_sector'].'</br>';

    //Consulta Esyado Civil
    $queryECC = "SELECT idestado_civil, e_estado_c FROM u494342329_censo.estado_civil where idestado_civil =".$ins_estado_c.";";
    $resultadoECC = mysqli_query($con, $queryECC);
    $rowecc = $resultadoECC->fetch_assoc();
    //echo '</br> El Estado civil es: '.$rowecc['e_estado_c'].'</br>';

    
    //Consuta Ususario
    $queryusu = "SELECT idusuario, u_nombre FROM u494342329_censo.usuario where idusuario = ".$user.";";
    $resultusu = mysqli_query($con, $queryusu);
    $rowusu = $resultusu->fetch_assoc();
    //echo "<br> el Usuario que ingreso esta familia es.... chan chan chan chan...: ".$rowusu['u_nombre']."  :o </br>";
    
    echo "</br> El Usuario ".$rowusu['u_nombre']." Registro a la Familia: ".$familia." su Estado Civil es: ".$rowecc['e_estado_c'];
    
    if($estado_c2 <> NULL || $estado_c2 <> ""){
        $queryECC2 = "SELECT idestado_civil, e_estado_c FROM u494342329_censo.estado_civil where idestado_civil =".$estado_c2.";";
        $resultadoECC2 = mysqli_query($con, $queryECC2);
        $rowecc2 = $resultadoECC2->fetch_assoc();
        echo " e ".$rowecc2['e_estado_c'];
    }
    
    echo "</br> del sector: ".$rowsec1['s_sector']." en la manzana: ".$manzana." calle: ".$calle." con el numero: ".$numero." Numero de Hoja ".$hoja."<br>";


    
        
/*aqui guardar una variable con el ID de la familia con la funcion $variable = "SELECT last_intert_id()" conecxion y guardar verificar con una impresion a ver si queda*/
    }
echo '<a href="consultar.php"><button type="button" class="btn btn-success disable">No Registrar Integrantes</button></a>';
    
}

include ("for_integrante.php");
?>



<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>