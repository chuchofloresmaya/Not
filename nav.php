<?php
require_once "php/conexion.php";
$con= conectar();




if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    //header('location: mantenimiento.php');
    header('location: login.php');
    die();
}
$querynomuser = "SELECT u_nombre, u_nivel, u_departamento, nickname FROM not190.usuarios where idusuario = ".$user." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();

    $query_libro = "SELECT MAX(no_libro) AS no_libro , MAX(inicio) AS inicio, MAX(final) AS final FROM not190.cot_libro;";
    
    $result_libro = mysqli_query($con,$query_libro);
    $row_libro = $result_libro->fetch_assoc();

$querynuevoexp = "SELECT * FROM not190.usu_expedientes where id_usuario = ".$user." and id_funcion = 1;";  
$resultnuevoexp = mysqli_query($con,$querynuevoexp);
$rownuevoexp = $resultnuevoexp->fetch_assoc();
$filasnuevoexp=mysqli_num_rows($resultnuevoexp);


$qeryporyect = "SELECT * FROM not190.proyectistas where id_usuario = ".$user.";";  
$resultproyect = mysqli_query($con,$qeryporyect);
$rowproyect = $resultproyect->fetch_assoc();
$filaproyect=mysqli_num_rows($resultproyect);

$queryprevia = "SELECT * FROM not190.usu_expedientes where id_usuario = ".$user." and id_funcion = 2;";  
$resultprevia = mysqli_query($con,$queryprevia);
$rowprevia = $resultprevia->fetch_assoc();
$filasprevia = mysqli_num_rows($resultprevia);

//-------------------------------------------OCULTAR ERRORES
//error_reporting(0);
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/icono.png" type="image/png">
        <title>Notaria 190</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
        <!--================Header Area =================-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="img/icono.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Notaria 190
  </a>
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">---- <span class="sr-only">(current)</span></a>
      </li>
      <?php 
      //echo $rowusu['u_departamento'] ."----". $rowusu['u_nivel'];
      if($rowusu['u_departamento'] == 1 or $rowusu['u_departamento'] == 3){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Contaduria
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="consultar_contejos_conta.php?pag=1">Cotejos</a>
          <a class="dropdown-item" href="consultar_isrg.php?pag=1">ISR General</a>
        </div>
      </li>
      <?php 
      } ?>
      <?php 
      if($rowusu['u_nivel'] >= 3 or $rowusu['u_departamento'] == 5){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Acuses
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="acuse_cotejos.php?pag=1">Cotejos</a>
      
        </div>
      </li>
      <?php 
      } ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ISR
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="insert_isr.php">Ingresar ISR</a>
          <a class="dropdown-item" href="consultar_misisr.php?pag=1">Mis ISR</a>

      <?php 
      if($rowusu['u_nivel'] >= 2){ ?>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="consultar_isrg.php?pag=1">ISR General</a>
      <?php
      }
      ?>
            <?php 
      if($rowusu['u_nivel'] == 3){ ?>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="consultar_isrm.php?pag=1">Modificar ISR</a>
      <?php
      }
      ?>
        
        </div>
      </li>
      <?php 
      if($filasnuevoexp >= 1){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mesa de Trabajo
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="insert_expediente.php">Nuevo Expediente</a>
          <a class="dropdown-item" href="consultar_nuevo_expediente.php?pag=1">Expedientes</a>
          <a class="dropdown-item" href="consultar_exp.php?pag=1">Ingresar Fechas</a>
          <a class="dropdown-item" href="consult_postfirma_mesa.php?pag=1">Post Firma</a>
        </div>
      </li>
      <?php 
      } ?>

      <?php 
      if($filaproyect >= 1){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Proyectista
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="consult_proyectistas.php?pag=1">Proyectos a Realizar</a>
          <a class="dropdown-item" href="insert_expediente_proyect.php?pag=1">Nuevo expediente</a>
        </div>
      </li>
      <?php 
      } ?>

      <?php 
      //if($filasprevia >= 1){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Previa
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="consultar_previa.php?pag=1">Previos</a>
        </div>
      </li>
      <?php 
      //} ?>

      <?php 
      //if($filasprevia >= 1){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Post-Firma
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="consult_postfirma.php?pag=1">Post-Firma</a>
        </div>
      </li>
      <?php 
      //} ?>      

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bitácora
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="insert_rutas.php">Ingresar a Bitácora</a>
          <a class="dropdown-item" href="consultar_rutasm.php?pag=1">Mi Bitácora</a>

      <?php 
      if($rowusu['u_nivel'] >= 2){ ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="consultar_rutag.php?pag=1">General Rutas</a>
      <?php
      }
      ?>
      <?php 
      if($rowusu['u_nivel'] == 3){ ?>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="consultar_rutagm.php?pag=1">Modificar Bitacora</a>
      <?php
      }
      ?>
        
        </div>
      </li>
      <?php 
      if($rowusu['u_departamento'] > 1 or $rowusu['u_departamento'] == 1){ ?>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cotejos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="insert_cotejo.php">Ingresar Cotejo</a>
          <a class="dropdown-item" href="consultar_contejosm.php?pag=1&no_libro=<?PHP echo $row_libro['no_libro'] ?>">Cotejos</a>

          <?php
          }
          ?>
        
        
        </div>
      </li>      

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="nav-item nav-link disabled" href="#">Usuario <?php echo $rowusu['u_nombre']; ?></a>
      <a class="navbar-brand" href="cerrar_session.php">Cerrar sesión</a>


    </form>
  </div>
</nav>        </header>
        <!--================Header Area =================-->
