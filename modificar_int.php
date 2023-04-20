<?PHP

require_once "php/conexion.php";  
$con = conectar();


  session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

  }

$modint = $_GET['idint'];

$querypar = "SELECT idparentesco, p_parentesco FROM parentesco;";
$resultparen = mysqli_query($con, $querypar);

$querysex = "SELECT idsexo, s_sexo FROM sexo;";
$resultsex = mysqli_query($con, $querysex);

$queryesc ="SELECT idescolaridad, e_escolaridad, e_numero FROM u494342329_censo.escolaridad;";
$resultesc = mysqli_query($con, $queryesc);

$queryocu = "SELECT idocupacion, o_ocupacion, l_ocupacion FROM u494342329_censo.ocupacion;";
$resultocu = mysqli_query($con, $queryocu);

$queryrel = "SELECT idreligion, r_religion, n_religion FROM u494342329_censo.religion;";
$resultrel = mysqli_query($con, $queryrel);

$querypad = "SELECT idpadecimiento, p_padecimiento, l_padecimiento FROM u494342329_censo.padecimiento;";
$resultpadecimiento = mysqli_query($con, $querypad);

$queryINT = "SELECT idintegrante, idparentesco1, i_nombre, i_apellido_pat, i_apellido_mat, i_edad, idsexo1, i_bautizo, i_1com, i_confirmacion, i_gru_mov_aso, idescolatidad, idocupacion, idreligion FROM censo_san_cristobal_h.integrante where idfamilia1 = ".$modint.";";

$resINTEGRANTES = $con->query($queryINT);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
                  <?php
                  while ($registroIntegrante = $resINTEGRANTES->fetch_array(MYSQLI_BOTH)){
                  ?>
                  <tr class="fila-fija">


                        <td><input name="nombre[]" value="<?php echo $registroIntegrante['i_nombre'];?>"/></td>

                        <td><input name="apellido_pat[]" value="<?php echo $registroIntegrante['i_apellido_pat'];?>"/></td>

                        <td><input name="apellido_mat[]" value="<?php echo $registroIntegrante['i_apellido_mat'];?>"/></td>

                        <td><input name="edad[]" value="<?php echo $registroIntegrante['i_edad'];?>"/></td>

                        <td><select id="cbx_sexo" name="cbx_sexo[]">
                        <?php while($rowsex = $resultsex->fetch_assoc()) {
                        if($rowsex['idsexo'] == $registroIntegrante['idsexo1']){
                        ?>
                        <option value=" <?php echo $rowsex['idsexo']; ?>" selected><?php echo $rowsex['s_sexo']; ?></option>
                        <?php 
                        }else{
                        ?>
                        <option value=" <?php echo $rowsex['idsexo']; ?>"><?php echo $rowsex['s_sexo']; ?></option>
                        <?PHP
                        }
                        ;}
                        ?>
                        </select></td>
                        
                        <td><select id="cbx_bautizado" name="cbx_bautizado[]">
                        <option value="<?php echo $registroIntegrante['i_bautizo'];?>"><?php echo $registroIntegrante['i_bautizo'];?></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select></td>


                        <td><select id="cbx_pcom" name="cbx_pcom[]">
                        <option value="<?php echo $registroIntegrante['i_1com'];?>"><?php echo $registroIntegrante['i_1com'];?></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>
                        
                        <td><select id="cbx_confirmacion" name="cbx_confirmacion[]">
                        <option value="<?php echo $registroIntegrante['i_confirmacion'];?>"><?php echo $registroIntegrante['i_confirmacion'];?></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        
                        <td><select id="cbx_gma" name="cbx_gma[]">
                        <option value="<?php echo $registroIntegrante['i_gru_mov_aso'];?>"><?php echo $registroIntegrante['i_gru_mov_aso'];?></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select></td>

                        <td><select id="cbx_escolaridad" name="cbx_escolaridad[]">
                        <?php while($rowesc = $resultesc->fetch_assoc()) {
                        if($rowesc['idescolaridad'] == $registroIntegrante['idescolatidad']){
                        ?>
                        <option value=" <?php echo $rowesc['idescolaridad']; ?>" selected><?php echo $rowesc['e_numero'].")".$rowesc['e_escolaridad']; ?></option>
                        <?php 
                        }else{
                        ?>
                        <option value=" <?php echo $rowesc['idescolaridad']; ?>" ><?php echo $rowesc['e_numero'].")".$rowesc['e_escolaridad']; ?></option>
                        <?PHP
                        }
                        ;}
                        ?>
                        </select></td>

                        <td><select id="cbx_ocupacion" name="cbx_ocupacion[]">
                        <?php while($rowocu = $resultocu->fetch_assoc()) {
                        if($rowocu['idocupacion'] == $registroIntegrante['idocupacion']){
                        ?>
                        <option value=" <?php echo $rowocu['idocupacion']; ?>" selected><?php echo $rowocu['l_ocupacion'].") ".$rowocu['o_ocupacion']; ?></option>
                        <?PHP
                        }else{                        
                        ?>
                        <option value=" <?php echo $rowocu['idocupacion']; ?>"><?php echo $rowocu['l_ocupacion'].") ".$rowocu['o_ocupacion']; ?></option>
                        <?PHP
                        }
                        ;}
                        ?>
                        </select></td>

                        <td><select id="cbx_religion" name="cbx_religion[]">
                        <?php while($rowrel = $resultrel->fetch_assoc()) {
                        if($rowrel['idreligion'] == $registroIntegrante['idreligion']){
                        ?>
                        <option value=" <?php echo $rowrel['idreligion']; ?>" selected><?php echo $rowrel['n_religion'].") ".$rowrel['r_religion']; ?></option>
                        <?PHP
                        }else{
                        ?>
                        <option value=" <?php echo $rowrel['idreligion']; ?>" ><?php echo $rowrel['n_religion'].") ".$rowrel['r_religion']; ?></option>
                        <?PHP
                        }
                        ;}                        
                        ?>
                        </select></td>
                        </tr>

                        <td><select id="cbx_padecimiento" name="cbx_padecimiento[]">
                        <option value="0">Padecimiento</option>
                        <?php while($rowpad = $resultpadecimiento->fetch_assoc()) {?>
                        <option value=" <?php echo $rowpad['idpadecimiento']; ?>" ><?php echo $rowpad['l_padecimiento'].")".$rowpad['p_padecimiento']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><input name="tipo_pad[]" placeholder="Tipo"/></td>
                  

</body>
</html>