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
?>

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


$querysec = "SELECT * FROM u494342329_censo.sector;";
$resultsec = mysqli_query($con, $querysec);

$queryusuario = "SELECT idusuario, u_nombre, usuario FROM u494342329_censo.usuario;";
$resultusu = mysqli_query($con, $queryusuario);



?>
<br>
<br>
<br>
<br>
<div class="table table-hover">
<center>
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
        <div class="row">
            	<?php
            	//while ($ususario = $queryusuario->fetch_array(MYSQLI_BOTH)){
            	?>

            <div class="col-2 ">
            <select class="redondeado contorno color5" id="cbx_usuario" name="cbx_usuario">           
                <?php while($rowusu = $resultusu->fetch_assoc()) {?>
                <option value=" <?php echo $rowusu['idusuario']; ?>" ><?php echo $rowusu['usuario']; ?></option>                
                <?PHP
                ;}
                ?>
            </select>
            </div>

            <div class="col-2">
            <select class="redondeado contorno color5" id="cbx_sect" name="cbx_sect">           
                <?php while($rowsect = $resultsec->fetch_assoc()) {?>
                <option value=" <?php echo $rowsect['idsector']; ?>" ><?php echo $rowsect['s_sector']; ?></option>                
                <?PHP
                ;}
                ?>
            </select>
            </div>
        </div>
<input type="submit" class="btn btn-success disable" value="Registrar Usuario" name="regsec" ></br></br>            
        </div>
        </form>
</center>
<?PHP
if(isset($_POST['regsec'])){
    $usu = $_POST['cbx_usuario'];
    $sect = $_POST['cbx_sect'];
  	  
    $insertsect = "INSERT INTO `u494342329_censo`.`usu_sec` (`idusuario1`, `idsector1`) VALUES ('".$usu."', '".$sect."');";

    $resultsect = mysqli_query($con, $insertsect);

    if(!$resultsect){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos Verifica todos los campos");</script>';
    }

}

$queryusu_sec = "SELECT idusu_sec, u_nombre, usuario, s_sector FROM u494342329_censo.usu_sec inner join usuario on usuario.idusuario = usu_sec.idusuario1 inner join sector on sector.idsector = usu_sec.idsector1;";
$resullist = mysqli_query($con, $queryusu_sec);

?>
                <table class="table">
                    <tr class="">
                        <th>Nombre</th>
                        <th>Nickname</th>
                        <th>Sector</th>
                        <th></th>
                    </tr>

                  <?php
                  while($rowlist  = $resullist->fetch_array( MYSQLI_BOTH)) 
                  {


                  echo '<tr>
                        <td>'.$rowlist['u_nombre'].'</td>                      
                        <td>'.$rowlist['usuario'].'</td>
                        <td>'.$rowlist['s_sector'].'</td>'?>
						<?php echo "<td><a href='eliminar_sec.php?idususec=".$rowlist['idusu_sec']."'><button type='button'>Eliminar</button></a></td>";                       
                    '</tr>';
                   }

                  ?>
                </table>

</div>

</body>
</html>