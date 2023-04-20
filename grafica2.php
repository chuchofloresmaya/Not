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
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'No Confirmados Mayores a 12 Años'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
<?php
$sql=mysql_query("SELECT count(*) As integrantes, s_sector FROM integrante inner join familia on integrante.idfamilia1 = familia.idfamilia inner join sector on familia.idsector2 = sector.idsector WHERE i_confirmacion = 'NO' and i_edad >= 12 group by idsector2 order by integrantes desc;");

while($res=mysql_fetch_array($sql)){			
?>
			
			['<?php echo $res['s_sector'] ?>'],
			
<?php
}
?>
			
			],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Censo San Cristobal Huichochitlan (2019)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Personas'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'No Confimados',
            data: [
			<?php
$sql=mysql_query("SELECT count(*) As integrantes, s_sector FROM integrante inner join familia on integrante.idfamilia1 = familia.idfamilia inner join sector on familia.idsector2 = sector.idsector WHERE i_confirmacion = 'NO' and i_edad >= 12 group by idsector2 order by integrantes desc;");
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
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br><br>
<center><a href="graficas.php">Atras</a>  <br><br> <a href="grafica3.php">Siguiente</a></center>
	</body>
</html>
