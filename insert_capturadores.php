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



?>
<br>
<br>
<br>
<br>


<div class="table table-hover">
    <form id="formulario_sec" name="formulario_sec" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) //archivo actual ?>" method="post" onsubmit="return validacion_fam();">
        <div class="row">

            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="c_nombre" id="nombre" placeholder="Nombre" maxlength="" size="7" onkeyup="letrasMayus(this)" pattern="[A-Z ]+">
            </div>
            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="c_apellido_pat" id="paterno" placeholder="Apellido Paterno" maxlength="" size="7" onkeyup="letrasMayus(this)" pattern="[A-Z ]+">
            </div>
            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="c_apellido_mat" id="materno" placeholder="Apellido Materno" maxlength="" size="7" onkeyup="letrasMayus(this)" pattern="[A-Z ]+">
            </div>
            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="usuario" id="ususario" placeholder="Usuario" maxlength="" size="7" onkeyup="letrasMayus(this)">
            </div>
            <div class="col-2 borde">
                <input type="text" class="redondeado contorno" name="pass" id="pass" placeholder="Password" maxlength="" size="7" onkeyup="letrasMayus(this)">
            </div>

            <div class="col-2 borde"><input type="456" name="c_admin" class="redondeado contorno" id="numero" placeholder="Admin= 2" maxlength="1" size="7" onkeypress="return soloNumeros(event);"></div>         
            </div>

        </div>
<input type="submit" class="btn btn-success disable" value="Registrar Usuario" name="regfam" ></br></br>            
        </div>
        </form>
</center>


<?PHP
if(isset($_POST['regfam'])){
    $nombre = $_POST['c_nombre'];
    $ape_pat = $_POST['c_apellido_pat'];
    $ape_mat = $_POST['c_apellido_mat'];
    $usu = $_POST['usuario'];
    $pass = $_POST['pass'];
    $admin = $_POST['c_admin']; 

    $insertar_fam= "INSERT INTO `usuario` (`idusuario`, `u_nombre`, `u_apellido_pat`, `u_apellido_mat`, `usuario`, `pass`, `u_nivel`) VALUES (NULL, '".$nombre."', '".$ape_pat."', '".$ape_mat."', '".$usu."', '".$pass."', '".$admin."');";

    $result_insert_fam = mysqli_query($con, $insertar_fam);

    if(!$result_insert_fam){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos Verifica todos los campos");</script>';
    }
    }

$querycap = "SELECT * FROM u494342329_censo.usuario ORDER BY idusuario desc;";
$queryAlumnos = mysqli_query($con, $querycap);
?>

                <table class="table">


                    <tr class="">
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Ususario</th>
                        <th>Password</th>
                        <th>Nivel de usuario</th>

                    </tr>

                  <?php

                  while($registroAlumno  = $queryAlumnos->fetch_array( MYSQLI_BOTH)) 
                  {


                  echo '<tr>
                        <td>'.$registroAlumno['u_nombre'].'</td>
                        <td>'.$registroAlumno['u_apellido_pat'].' '.$registroAlumno['u_apellido_mat'].'</td>
                        <td>'.$registroAlumno['usuario'].'</td>
                        <td>'.$registroAlumno['pass'].'</td>
                        <td>'.$registroAlumno['u_nivel'].'</td>
                    </tr>';
                   }

                  ?>
                </table>

</div>


<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</HTML>