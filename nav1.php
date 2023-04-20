<?php
include_once "php/conexion.php";  
$con = conectar();

echo $_SESSION['usuario'];
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    //header('location: mantenimiento.php');
    header('location: login.php');
    die();
}
$querynomuser = "SELECT u_nombre, u_nivel FROM u494342329_censo.usuario where idusuario =".$user." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();

?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <!-- Responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">

    
    <title>Formato</title>
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>
    <script language="javascript" src="js/validaciones.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">CENSO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="insert_fam.php">Capturar<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consultar.php">Consultar</a>
      </li>
      <?php 
      if($rowusu['u_nivel'] >= 2){ ?>
      <li class="nav-item">
        <a class="nav-link" href="consultar_capturadores.php">Capturadores</a>
      </li>
      <?php
      }
      ?>
      <li class="nav-item">
        <a class="nav-link">Usuario <?php echo $rowusu['u_nombre']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrar_session.php">Cerrar Sesion</a>
      </li>
    </ul>
  </div>
</nav>
</button>
<center> -Ya se puede modificar el Estado Civil 1 asi como agregar Estado civil 2 o Eliminar 
<br> -Errores tomar captura de pantalla y mandarla por favor!</center>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>