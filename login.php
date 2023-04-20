<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
   <form class="" action="login.php" method="post">
   <h1 class="animate__animated animate__backInLeft">Notaría 190</h1>
   <p>Usuario <input type="text" placeholder="ingrese su nombre" name="usuario"></p>
   <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="pass"></p>
   <input type="submit" value="Ingresar" name="login">

      <?php
      require_once "php/conexion.php";
      $con= conectar();
      if(isset($_POST['login'])){
      $usuario =$_POST['usuario'];
      $pass =$_POST['pass'];
      $queryu = "SELECT idusuario FROM not190.usuarios where nickname = '$usuario' and contrasena = '$pass';";


      $resultq = mysqli_query($con,$queryu);

      $filas=mysqli_num_rows($resultq);
      $rowusu = $resultq->fetch_assoc();

      if($filas>0){

        session_start();

        
         $iduser = $rowusu['idusuario'];
         //echo $iduser;
         $_SESSION['usuario'] = $iduser;
         header('location: index.php');
         //header('location: index.php');

        
      }else{
        echo "<br><br><h3> ERROR AL INTENTAR INICIAR SESION <h3>"; 
      }
      mysqli_free_result($resultq);
      mysqli_close($con);
      }
      ?>
   </form> 
</body>
</html>