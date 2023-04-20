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
require_once "conexion/conexion.php";
?>
<br><br>
<br> <br>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container {
	height: 400px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 95,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Sin primera comunion mayores a 12 años'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: [
			<?php
$sql=mysql_query("SELECT count(*) As integrantes, s_sector FROM integrante 
inner join familia on integrante.idfamilia1 = familia.idfamilia
inner join sector on familia.idsector2 = sector.idsector
WHERE i_1com = 'NO' and i_edad >= 12
group by idsector2
order by integrantes desc
;");
while($res=mysql_fetch_array($sql)){			
?>					
			
			['<?php echo $res['s_sector']; ?>'],
<?php
}
?>
			]
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Personas',
            data: [
			
			<?php
$sql=mysql_query("SELECT count(*) As integrantes, s_sector FROM integrante 
inner join familia on integrante.idfamilia1 = familia.idfamilia
inner join sector on familia.idsector2 = sector.idsector
WHERE i_1com = 'NO' and i_edad >= 12
group by idsector2
order by integrantes desc
;");
while($res=mysql_fetch_array($sql)){			
?>			
			
			[<?php echo $res['integrantes'] ?>],
			
<?php
}
?>
			]
        }]
    });
});
		</script>
	</head>
	<body>

<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>

<center><a href="grafica2.php">Atras</a>
	</body>
</html>
