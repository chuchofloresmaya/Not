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
$querynomuser = "SELECT u_nombre, u_nivel FROM not190.usuarios where idusuario = ".$user." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/favicon.png" type="image/png">
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
        <header class="header_area">
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-5">
                            <ul class="nav social_icon">
                                
                                
                            </ul>
                        </div>
                        <div class="col-sm-6 col-7">
                            <div class="top_btn d-flex justify-content-end">
                                <a>Hola <?php echo $rowusu['u_nombre']; ?></a>
                                <a href="cerrar_session.php">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><img src="image/Logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li> 
                            <li class="nav-item"><a class="nav-link" href="insert_ruta.php">Rutas</a></li>
                            <li class="nav-item"><a class="nav-link" href="insert_isr.php">ISR</a></li>
                            <li class="nav-item"><a class="nav-link" href="insert_isr.php">Ingresar ISR</a>
                            <li class="nav-item"><a class="nav-link" href="consultar_misisr.php?pag=1">Mis ISR</a>
                            
                      <?php 
                        if($rowusu['u_nivel'] >= 2){ ?>

                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultas Generales</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="consultar_isrg.php">ISR General</a></li>
                                    
                                    
                                </ul>
                            </li> 
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Capturadores</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="insert_capturadores.php">Ingresar Capturador</a></li>
                                    <li class="nav-item"><a class="nav-link" href="insert_sec.php">Sectores</a></li>
                                </ul>
                            </li> 
                        <?php
                        }
                        ?>
                    </div> 
                </div>
            </nav>
        </header>
        <!--================Header Area =================-->
