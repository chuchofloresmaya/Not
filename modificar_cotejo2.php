<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<title>Mantenimiento</title>
</head>
<body>
	<style type="text/css">
		body{
			background-image: url(img/bg1.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			background-attachment: fixed;

		}
	</style>
</body>
</html>

<?php
require_once "php/conexion.php";  
$con= conectar();

    $pag = $_POST['pag'];
    $id_cot = $_POST['id_cotejo'];
    $no_cotejo = $_POST['no_cotejo'];
    $no_libro = $_POST['no_libro'];
    $no_tantos = $_POST['no_tantos'];
    $no_fojas = $_POST['no_fojas'];
    $fecha = $_POST['fecha'];
    $solicitud = $_POST['titulo'];

    $empresa = $_POST['search_cliente'];
    $objetosocial = $_POST['dni'];
    $persona = $_POST['persona'];

    $hoja_anexa = isset($_POST['hoja_anexa']);
    $sololad = isset($_POST['sololad']);
    $soloan = isset($_POST['soloanberso']);
    $tam_hoja = $_POST['tam_hoja']; 
    $copia_c = $_POST['copia_c']; 
    $plano = $_POST['plano']; 
    

    //PARA OBTENER Y SUBIR ARCHIVO
    

    $file_pre = $_POST['file-n']; 
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];
    // $caption1=$_POST['caption'];
    // $link=$_POST['link'];
    $fname = date("YmdHis").'_'.$name;



     //BUSCAR EN LA BASE DE DATOS NOMBRE IGUAL 
    //$chk = $con->query("SELECT * FROM cotejos where name = '".$name."';")->rowCount();

      $queryfile = "SELECT * FROM cotejos where name = '".$name."';";
      $resultfile = mysqli_query($con,$queryfile);
      $chk=mysqli_num_rows($resultfile);
      //echo "chk: .....> ".$chk;


    if ($size >= 1) {
        
      
      if($chk){
        $i = 1;
        $c = 0;
      while($c == 0){
          $i++;
          $reversedParts = explode('.', strrev($name), 2);
          $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
        // var_dump($tname);exit;
          //$chk2 = $con1->query("SELECT * FROM  cotejos where name = '$tname'; ")->rowCount();
              $queryfile1 = "SELECT * FROM cotejos where name = '".$tname."';";
              $resultfile1 = mysqli_query($con,$queryfile1);
              $chk2=mysqli_num_rows($resultfile1);
          if($chk2 == 0){
            $c = 1;
            $name = $tname;
          }
        }
    }
  }


 echo "SOLOAN OBTENIDO-----".$soloan."<BR>";

    if ($sololad >= 1) {
      $sololad =2;
    }else{
      $sololad =1;
    }

    if ($soloan >= 1) {
      $soloan =2;
    }else{
      $soloan =1;
    }

    if ($hoja_anexa >= 1) {
      $hoja_anexa =2;
    }else{
      $hoja_anexa =1;
    }

    if ($copia_c >= 1) {
      $copia_c =2;
    }else{
      $copia_c =1;
    }

    if ($plano >= 1) {
      $plano =2;
    }else{
      $plano =1;
    }
    if ($solicitud == "SI") {
      
    $filasem = 0;
    $queryem = "SELECT id_empresa, id_tiposciedad FROM not190.empresas where e_nombre = '$empresa';";
    $resultem = mysqli_query($con,$queryem);
    $filasem = mysqli_num_rows($resultem);
    $rowem = $resultem->fetch_assoc();
    

    //echo "Empresas encontradas: ".$filasem;

    if ($filasem<=0) { 
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);

      $filasobs = mysqli_num_rows($resultobs);
      $rowobs = $resultobs->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Objetos social encontrados :".$filasobs;

      if ($filasobs<=0) {
        echo "<br>Ingresar objeto social ".$objetosocial;
        $insert_sociedad = "INSERT INTO `tiposociedad` (`id_tiposociedad`, `t_sociedad`) VALUES (NULL, '".$objetosocial."');";
        $result_insert_sociedad = mysqli_query($con, $insert_sociedad);
        $id_objetosocial =mysqli_insert_id($con);
        //echo "<br>ultimo id  objeto social".$id_objetosocial;
      }else{
        $id_objetosocial = $rowobs['id_tiposociedad'];
        //echo "<br>ID DEL OBJETO SOCIAL ".$id_objetosocial;
      }
      $insert_empresa = "INSERT INTO `not190`.`empresas` (`e_nombre`, `id_tiposciedad`) VALUES ('".$empresa."', '".$id_objetosocial."');";
        $result_insert_empresa = mysqli_query($con, $insert_empresa);
        $id_empresa =mysqli_insert_id($con);

        //echo "<br>ultimo id empresa".$id_empresa;
      //echo "<br>insertando empresa".$id_empresa." ingresando regimen ".$id_objetosocial;
    }elseif ($filasem = 0) {
      //para queno entre en ningun ciclo
    }else{
      $queryobs = "SELECT id_tiposociedad FROM not190.tiposociedad where t_sociedad = '$objetosocial';";
      $resultobs = mysqli_query($con,$queryobs);
      $rowobs = $resultobs->fetch_assoc();
      $id_objetosocial = $rowobs['id_tiposociedad'];
      $id_empresa = $rowem['id_empresa'];
      
      //echo "<BR> ID EMPRESA :".$id_empresa." ID TIPO DE SOCIEDAD ".$id_objetosocial;
    }

    $id_persona = "NULL";
  }

if ($solicitud == "NO") {
      $querype = "SELECT id_persona, p_nombre FROM not190.personas where p_nombre = '".$persona."';";
      $resultpe = mysqli_query($con,$querype);

      $filaspe = mysqli_num_rows($resultpe);
      $rowpe = $resultpe->fetch_assoc();

      //echo "<BR> Impresion de el id de la sociedad :".$rowobs['id_tiposociedad'];
      //echo "<br> Persona encontrada encontrados :".$filaspe;
    if ($filaspe<=0) {
        //echo "<br>Ingresar persona ".$persona;
        $insert_persona = "INSERT INTO `not190`.`personas` (`p_nombre`) VALUES ('".$persona."');";
        $result_insert_persona = mysqli_query($con, $insert_persona);
        $id_persona =mysqli_insert_id($con);
        //echo "<br>ultimo id  person".$id_persona;
      }else{
        $id_persona = $rowpe['id_persona'];
        //echo "<br>ID DEL LA PERSONA ES: ".$id_persona;
      }
      $id_empresa = "NULL";
      $id_objetosocial = "NULL";

}




    //echo "UPDATE `not190`.`cotejos` SET `c_nocotejo` = '".$no_cotejo."', `c_libro` = '".$no_libro."', `c_hoja` = '".$no_fojas."', `c_tantos_soli` = '".$no_tantos."', `c_tamaño` = '".$tam_hoja."', `c_lados` = ".$sololad.", `c_persona` = ".$id_persona.", `c_empresa` = ".$id_empresa.", `c_tiposociedad` = ".$id_objetosocial.", `c_hoja_anexa` = '".$hoja_anexa."', `c_mostrada` = '".$soloan."', `c_fecha` = '".$fecha."', `fname` = '".$fname."', `name` = '".$name."' WHERE (`id_cotejo` = '".$id_cot."');";
//require_once "php/conexion.php";  
//$con= conectar();


    if ($file_pre>=0 && $name<=0) {
      $sentenciaf = "UPDATE `not190`.`cotejos` SET `c_nocotejo` = '".$no_cotejo."', `c_libro` = '".$no_libro."', `c_hoja` = '".$no_fojas."', `c_tantos_soli` = '".$no_tantos."', `c_tamaño` = '".$tam_hoja."', `c_lados` = ".$sololad.", `c_persona` = ".$id_persona.", `c_empresa` = ".$id_empresa.", `c_tiposociedad` = ".$id_objetosocial.", `c_hoja_anexa` = '".$hoja_anexa."', `c_mostrada` = '".$soloan."', `c_fecha` = '".$fecha."', `copia` = '".$copia_c."', `plano` = '".$plano."' WHERE (`id_cotejo` = '".$id_cot."');";

    }else{
      $sentenciaf = "UPDATE `not190`.`cotejos` SET `c_nocotejo` = '".$no_cotejo."', `c_libro` = '".$no_libro."', `c_hoja` = '".$no_fojas."', `c_tantos_soli` = '".$no_tantos."', `c_tamaño` = '".$tam_hoja."', `c_lados` = ".$sololad.", `c_persona` = ".$id_persona.", `c_empresa` = ".$id_empresa.", `c_tiposociedad` = ".$id_objetosocial.", `c_hoja_anexa` = '".$hoja_anexa."', `c_mostrada` = '".$soloan."', `c_fecha` = '".$fecha."', `fname` = '".$fname."', `name` = '".$name."', `copia` = '".$copia_c."', `plano` = '".$plano."' WHERE (`id_cotejo` = '".$id_cot."');";

    }




$resmodfam = $con->query($sentenciaf) or die ('<script type="text/javascript">alert("Error al Actulizar los Datos verifica los campos de ");</script>'.mysqli_error($con));
 $move =  move_uploaded_file($temp,"upload/".$fname);

?>
<script type="text/javascript">
	alert("Cotejo Actualizado Exitosamente");
	var fam = <?php echo $id_cot?>;
	var pag = <?php echo $pag?>;
  var no_libro = <?php echo $no_libro?>;
	window.location.href='consultar_contejosm.php?idfam='+fam+'&pag='+pag+'&no_libro='+no_libro;

</script>