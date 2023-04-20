  <?php
  session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

  }


  ?>
<?php
//Familia
require_once "php/conexion.php";  
$con= conectar();


/*$querynomuser = "SELECT u_nombre FROM u494342329_censo.usuario where idusuario =".$user." ;";  
$resultq = mysqli_query($con,$querynomuser);
$rowusu = $resultq->fetch_assoc();*/

if(isset($_POST['cbx_parentesco'])){

$items1 = $_POST['cbx_parentesco'];
$items2 = $_POST['nombre'];
$items3 = $_POST['apellido_pat'];
$items4 = $_POST['apellido_mat'];
$items5 = $_POST['edad'];
$items6 = $_POST['cbx_sexo'];
$items7 = $_POST['cbx_bautizado'];
$items8 = $_POST['cbx_pcom'];
$items9 = $_POST['cbx_confirmacion'];
$items10 = $_POST['cbx_gma'];
$items11 = $_POST['cbx_escolaridad'];
$items12 = $_POST['cbx_ocupacion'];
$items13 = $_POST['cbx_religion'];
$items14 = $_POST['cbx_padecimiento'];
$items15 = $_POST['tipo_pad'];




if(isset($_SESSION['idfam'])){
	$idfamilia = $_SESSION['idfam'];
}else{
	$idfamilia = 0;
}




while(true){




    $item1 = current($items1);
    $item2 = current($items2);
    $item3 = current($items3);
    $item4 = current($items4);
    $item5 = current($items5);
    $item6 = current($items6);
    $item7 = current($items7);
    $item8 = current($items8);
    $item9 = current($items9);
    $item10 = current($items10);
    $item11 = current($items11);
    $item12 = current($items12);
    $item13 = current($items13);
    $item14 = current($items14);
    $item15 = current($items15);
    
		
		$pare_i = (( $item1 !== false) ? $item1 : ", &nbsp;");
		$nom_i = (( $item2 !== false) ? $item2 : ", &nbsp;");
		$ape_pat_i = (( $item3 !== false) ? $item3 : ", &nbsp;");
		$ape_mat_i = (( $item4 !== false) ? $item4 : ", &nbsp;");
		$edad_i = (( $item5 !== false) ? $item5 : ", &nbsp;");
		$sex_i = (( $item6 !== false) ? $item6 : ", &nbsp;");
		$bau_i = (( $item7 !== false) ? $item7 : ", &nbsp;");
		$pcom_i = (( $item8 !== false) ? $item8 : ", &nbsp;");
		$conf_i = (( $item9 !== false) ? $item9 : ", &nbsp;");
		$gma_i = (( $item10 !== false) ? $item10 : ", &nbsp;");
		$esco_i = (( $item11 !== false) ? $item11 : ", &nbsp;");
		$ocup_i = (( $item12 !== false) ? $item12 : ", &nbsp;");
		$relig_i = (( $item13 !== false) ? $item13 : ", &nbsp;");
		$pade_i = (( $item14 !== false) ? $item14 : ", &nbsp;");
		$pade_tipo_i = (( $item15 !== false) ? $item15 : ", &nbsp;");




    $insertar_int= "INSERT INTO integrante (`idfamilia1`, `idparentesco1`, `i_nombre`, `i_apellido_pat`, `i_apellido_mat`, `i_edad`, `idsexo1`, `i_bautizo`, `i_1com`, `i_confirmacion`, `i_gru_mov_aso`, `idescolatidad`, `idocupacion`, `idreligion`) VALUES ('".$idfamilia."', '".$pare_i."', '".$nom_i."', '".$ape_pat_i."', '".$ape_mat_i."', '".$edad_i."', '".$sex_i."', '".$bau_i."', '".$pcom_i."', '".$conf_i."', '".$gma_i."', '".$esco_i."', '".$ocup_i."', '".$relig_i."');";

    $result_insert_int = mysqli_query($con, $insertar_int);
    
    if(!$result_insert_int){
        echo '<script type="text/javascript">alert("Error al Insertar los Datos");</script>';    
    }


    if($pade_i <> 0){

    	$insertarpad = "INSERT INTO `u494342329_censo`.`pad_int` (`idpadecimiento1`, `idintegrante1`, `p_tipo`) VALUES ('".$pade_i."', '".mysqli_insert_id($con)."', '".$pade_tipo_i."');";

    		$result_insert_pad = mysqli_query($con, $insertarpad);

		if(!$result_insert_pad)
        echo '<script type="text/javascript">alert("Error al Insertar los Datos");</script>';    
    }



    $ultimo_id =mysqli_insert_id($con);
		$item1 = next( $items1 );
		$item2 = next( $items2 );
		$item3 = next( $items3 );
		$item4 = next( $items4 );
		$item5 = next( $items5 );
		$item6 = next( $items6 );
		$item7 = next( $items7 );
		$item8 = next( $items8 );
		$item9 = next( $items9 );
		$item10 = next( $items10 );
		$item11 = next( $items11 );
		$item12 = next( $items12 );
		$item13 = next( $items13 );
		$item14 = next( $items14 );
		$item15 = next( $items15 );



		if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false && $item9 === false && $item10 === false && $item11 === false && $item12 === false && $item13 === false ) break;


}
}ELSE{

	$idfamilia = $_GET['idfam'];
}
?>



<head>


	<title></title>
<?PHP

$queryfam = "SELECT s_sector, f_manzana, f_familia, f_calle, f_numero, hoja FROM u494342329_censo.familia
inner join sector on familia.idsector2 = sector.idsector where idfamilia = ".$idfamilia.";";
$resultfam = mysqli_query($con, $queryfam);
$rowfam = $resultfam->fetch_assoc();

$queryest = "SELECT e_estado_c FROM u494342329_censo.fam_est
inner join estado_civil on estado_civil.idestado_civil = fam_est.idestado_civil1 where idfamilia2 = ".$idfamilia.";";
$resultest = mysqli_query($con, $queryest);



$querypade = "SELECT i_nombre, p_padecimiento, p_tipo FROM u494342329_censo.integrante
inner join pad_int on integrante.idintegrante = pad_int.idintegrante1
inner join padecimiento on pad_int.idpadecimiento1 = padecimiento.idpadecimiento
where idfamilia1 = ".$idfamilia.";";

$resPADE = mysqli_query($con, $querypade);

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

<?PHP include ("nav.php");

?>
<br>
<br>
<br>
<br>
	<table class="table table-striped">
		<tr class="">
			<th>Sector: <?php echo $rowfam['s_sector'] ?></th>
			<th>Manzana: <?php echo $rowfam['f_manzana'] ?></th>
			<?php
			while ($rowest = $resultest->fetch_array(MYSQLI_BOTH)){			
			echo "<th>Estado Civil: ".$rowest['e_estado_c']."</th>";
			}
			?>
		</tr>
		<tr class="">
			<th>Familia: <?php echo $rowfam['f_familia'] ?></th>
		</tr>
		<tr class="">
			<th>Calle: <?php echo $rowfam['f_calle'] ?></th>
			<th>Numero: <?php echo $rowfam['f_numero'] ?></th>
			<th>No. Hoja: <?php echo $rowfam['hoja'] ?></th>
		</tr>
	</table>

				<table class="table table-striped">


					<tr class="">
						<th>Parentesco</th>
						<th>Nombres</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Edad</th>
						<th>Sexo</th>
						<th>Bautizo</th>
						<th>1 Com</th>
						<th>Confirmacion</th>
						<th>Gma</th>
						<th>escolaridad</th>
						<th>ocupacion</th>
						<th>religion</th>
				    </tr>

<?php

$queryINT = "SELECT p_parentesco, i_nombre, i_apellido_pat, i_apellido_mat, i_edad, s_sexo, i_bautizo, i_1com, i_confirmacion, i_gru_mov_aso, e_numero, e_escolaridad, l_ocupacion, o_ocupacion, n_religion, r_religion FROM u494342329_censo.integrante
inner join parentesco on parentesco.idparentesco = integrante.idparentesco1
inner join sexo on sexo.idsexo = integrante.idsexo1
inner join escolaridad on escolaridad.idescolaridad = integrante.idescolatidad
inner join ocupacion on ocupacion.idocupacion = integrante.idocupacion
inner join religion on religion.idreligion = integrante.idreligion
where idfamilia1 = ".$idfamilia.";";

$resINTEGRANTES = $con->query($queryINT);



				  while ($registroIntegrante = $resINTEGRANTES->fetch_array(MYSQLI_BOTH)){

				  echo '<tr>
					    	<td>'.$registroIntegrante['p_parentesco'].'</td>
					    	<td>'.$registroIntegrante['i_nombre'].'</td>
					    	<td>'.$registroIntegrante['i_apellido_pat'].'</td>
					    	<td>'.$registroIntegrante['i_apellido_mat'].'</td>
					    	<td>'.$registroIntegrante['i_edad'].'</td>
					    	<td>'.$registroIntegrante['s_sexo'].'</td>
					    	<td>'.$registroIntegrante['i_bautizo'].'</td>
					    	<td>'.$registroIntegrante['i_1com'].'</td>
					    	<td>'.$registroIntegrante['i_confirmacion'].'</td>
					    	<td>'.$registroIntegrante['i_gru_mov_aso'].'</td>
					    	<td>'.$registroIntegrante['e_numero'].')'.$registroIntegrante['e_escolaridad'].'</td>
					    	<td>'.$registroIntegrante['l_ocupacion'].')'.$registroIntegrante['o_ocupacion'].'</td>
					    	<td>'.$registroIntegrante['n_religion'].')'.$registroIntegrante['r_religion'].'</td>
					    </tr>';

				   }
				  ?>
					<tr class="table table-striped">
						<th>Nombre</th>
						<th>Padecimiento</th>
						<th>tipo de padecimiento</th>
					</tr>				  
				  <?php

				  while ($registropade = $resPADE->fetch_array(MYSQLI_BOTH)){

				  echo '<tr>
					    	<td>'.$registropade['i_nombre'].'</td>
					    	<td>'.$registropade['p_padecimiento'].'</td>
					    	<td>'.$registropade['p_tipo'].'</td>
					    </tr>';
				   }
				  ?>

				</table>
<?php
echo "<td><a href='modificar_fam1.php?idfam=".$idfamilia."'><button type='button'>Modificar</button></a></td>";

			
$idfamilia = 0;
?>
<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</body>
</html>