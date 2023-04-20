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
$hoy = getdate();

if(isset($_GET['diae'])){
    $diae = $_GET['diae'];
}else{
    $diae = date("Y-m-d");    
}
//echo "Dia recibido es".$diae;

    $queryfam = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, nombre, motivo, documentos, notas, u_nombre  FROM not190.rutas
LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares 
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo 
inner join usuarios on rutas.id_ususario2 = usuarios.idusuario 
order by id_ruta DESC;";

    $sqlnumrows = "SELECT COUNT(*) as total FROM not190.rutas 
    LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares 
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo 
inner join usuarios on rutas.id_ususario2 = usuarios.idusuario 
order by id_ruta DESC;";

    $resultc = mysqli_query($con,$sqlnumrows);
    $rowtc = $resultc->fetch_assoc();
    $multiplicador = ($_GET['pag']-1)*8;

     $totale = $rowtc['total']/8 ;
     $redondeo = ceil($totale);

    $queryfam = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, nombre, motivo, documentos, notas, u_nombre FROM not190.rutas 
LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares 
left join ruta_personas on ruta_personas.id_personas = rutas.id_persona
LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo 
inner join usuarios on rutas.id_ususario2 = usuarios.idusuario     
 where fecha='".$diae."' order by id_ruta DESC";

//echo "$queryfam";
$resultfam = $con1->query($queryfam);
$filasisr=mysqli_num_rows($resultfam);



// para imprimir fecha  con cetenacion echo ($hoy['mday'])."5"; 
 //echo $redondeo;
$fecha = ($hoy['mday']);
$dia = ($hoy['mday']);
$ano = ($hoy['year']);
$mes = ($hoy['mon']);

//echo $fecha;
$date = $ano."-".$mes."-".$dia;
//echo $date;
$ultimo_dia_mes = date("t", strtotime($date));
//echo $ultimo_dia_mes;


switch ($dia) {
    case 0:
        $n_dia = "Domingo";
        break;
    case 1:
        $n_dia = "Lunes";
        break;
    case 2:
        $n_dia = "Martes";
        break;
    case 3:
        $n_dia = "Miercoles";
        break;
    case 4:
        $n_dia = "Jueves";
        break;
    case 5:
        $n_dia = "Viernes";
        break;
    case 6:
        $n_dia = "Sabado";
        break;
}






?>
<center><h1 class="display-3">Bitácora</h1></center>

<div class="container">
            <nav aria-label="...">
          <ul class="pagination ">
            <?PHP
            if($_GET['pag'] == 1){

            ?>
            <li class="page-item disabled">
              
            </li>
            <?PHP 
            }else{ 
            ?>
            <li class="page-item">
              
            </li>
            <?PHP 
            } 
            for ($i=1;$i<6;){
                $j = $i-1;
                $fecha_actual = date("Y-m-d");
                $dia_ciclo = date("Y-m-d",strtotime($fecha_actual."+ $j days")); 

                if($i == $_GET['pag']){    
                    $pagactual = ($hoy['mday'])+$j;

                    
            ?>

            <li class="page-item active">
              <span class="page-link bg-secondary text-white"><?PHP echo $dia_ciclo; ?><span class="sr-only">(current)</span>
              </span>
            </li>

            <?php
            }else{
            ?>

            <li class="page-item">
                <a class="page-link text-dark" href="consultar_rutag.php?diae=<?PHP echo $dia_ciclo; ?>&pag=<?PHP echo $i ?>"><?PHP echo $dia_ciclo; ?></a>
            </li>
            <?PHP
        
            }
            $i++;
            }
            if($_GET['pag'] == 5){
            ?>            
            <li class="page-item disabled">
              
            </li>
            <?PHP
                }else{
            ?>

            <li class="page-item">
              
            </li>
            <?PHP
                }
                
            ?>            
          </ul>
          <ul>
              <li>
                  <a class="page-link text-dark" href="formato_bitacora.php?diae=<?PHP echo $diae; ?>">DESCAGAR WORD</a>
              </li>
          </ul>
        </nav>
<table class="table table-striped">
  <thead>
    <tr>
      
      <th class="col-2">Fecha - Hora</th>
      <th class="col-2">Lugar </th>
      <th class="col-2">Persona </th>
      <th class="col-2">Motivo </th>
      <th class="col-2">Documentos</th>
      <th class="col-2">Notas</th>
      <th class="col-2">Usuario</th>

       
      
      
    </tr>
  </thead>

<?PHP


        if($filasisr<=0){
          echo '<center> <h2>No hay nada programado para este día <h1></center>';
        }

        while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){ 
?>

    <tr>
      
      <td><?php echo $rowfam['fecha'] ?> - <?php echo $rowfam['hora'] ?></td>
      <td><?php echo $rowfam['Nombre_del_lugar'] ?> - <?php echo $rowfam['lugar_no_comun'] ?></td>
      <td><?php echo $rowfam['nombre'] ?></td>
      <td><?php echo $rowfam['motivo'] ?></td>
      <td><?php echo $rowfam['documentos'] ?></td>
      <td><?php echo $rowfam['notas'] ?></td>
      <td><?php echo $rowfam['u_nombre'] ?></td>
      
    </tr>


<?PHP


        }
?>
  </tbody>
</table>


</div>

<?PHP

?>


<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>