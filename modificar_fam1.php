<?php 
include_once "php/conexion.php";  
$con = conectar();

  session_start();
  
if(isset($_SESSION['usuario'])){
  $user = $_SESSION['usuario'];
}else{
    echo 'Inicie una session';
    header('location: login.php');
    die();

  }

$conidfam = $_GET['idfam'];


$querymodfam = "SELECT idfamilia, idsector2, f_manzana, f_familia, f_calle, f_numero, hoja FROM u494342329_censo.familia where idfamilia =".$conidfam.";";
$resultcfam = mysqli_query($con, $querymodfam);
$fila = $resultcfam->fetch_assoc();

$queryest = "SELECT idfam_est, idfamilia2, e_estado_c, idestado_civil1 FROM u494342329_censo.fam_est
inner join estado_civil on idestado_civil1 = idestado_civil
where idfamilia2 = ".$conidfam.";";
$resest = $con->query($queryest);


$query = "SELECT u_nombre, idusuario, idsector, s_sector FROM u494342329_censo.usuario
inner join usu_sec on usuario.idusuario = usu_sec.idusuario1
inner join sector on usu_sec.idsector1 = sector.idsector
where idusuario=".$user.";";

$resultado = mysqli_query($con, $query);
$resultado1 = mysqli_query($con, $query);



$querypar = "SELECT idparentesco, p_parentesco FROM parentesco;";
$reslutparent = mysqli_query($con, $querypar);

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

$queryINT = "SELECT idintegrante, idparentesco1, i_nombre, i_apellido_pat, i_apellido_mat, i_edad, idsexo1, i_bautizo, i_1com, i_confirmacion, i_gru_mov_aso, idescolatidad, idocupacion, idreligion FROM u494342329_censo.integrante where idfamilia1 = ".$conidfam.";";
$resINTEGRANTES = $con->query($queryINT);

$queryIPAD = "SELECT idpad_int, idintegrante, i_nombre, idpadecimiento1, p_tipo FROM u494342329_censo.integrante
inner join pad_int on integrante.idintegrante = pad_int.idintegrante1
where idfamilia1 = ".$conidfam.";";
$resultIPAD = $con->query($queryIPAD)

?>
<?php
include ("nav.php");
?>
<br>
<br>
<br>
<br>


<?php


$row1 = $resultado1->fetch_assoc();
echo $row1['u_nombre']."<br>"; 

?>
<form method="post" action="modificar_fam2.php">
<table class="">

			
			<input type="hidden" name="idfamily" value="<?php echo $fila['idfamilia']; ?>">
        	<div> Selecciona Sector: <select id="cbx_sector" name="cbx_sector">
            <?php while($row = $resultado->fetch_assoc()) {
           	if($row['idsector'] == $fila['idsector2']){
            ?>
            <option value="<?php echo $row['idsector']; ?>" selected><?php echo $row['s_sector']; ?></option>
            <?php 
        	}else{
            ?>
			<option value="<?php echo $row['idsector']; ?>"><?php echo $row['s_sector']; ?></option>
            <?PHP 
			};}
            ?>
            </select>
            </div>


            <div>Ingresa una Manzana: <input type="text" name="n_manzana" id="manzana" value="<?php echo $fila['f_manzana']; ?>" placeholder="14" maxlength="2" onkeypress="return soloNumeros(event);"></div>
            <div>Familia: <input type="text" name="n_familia" id="familia" value="<?php echo $fila['f_familia']; ?>" onkeypress="letrasMayus(this);"></div>
            <div>Calle: <input type="text" name="n_calle" id="calle" value="<?php echo $fila['f_calle']; ?>" placeholder="Independencia" onkeyup="letrasMayus(this)"></div>
            <div>Numero: #<input type="text" name="n_numero" id="numero" value="<?php echo $fila['f_numero'];?>" placeholder="14" maxlength="4" onkeypress="return soloNumeros(event);"></div>
            

        <?php
        $boton=1;
         while ($fila1 = $resest->fetch_array(MYSQLI_BOTH)){
            $queryEC = "SELECT idestado_civil, e_estado_c FROM u494342329_censo.estado_civil;";
            $resultadoEC = mysqli_query($con, $queryEC);


        ?>            
            
        <?php if ($boton == 1){ ?>
            <input type="hidden" name="idestado" value="<?php echo $fila1['idfam_est']; ?>">
            <div>Selecciona Estado Civil <select id="cbx_estado_c" name="cbx_estado_c">
            <?php while($rowEC = $resultadoEC->fetch_assoc()) {                
            if($rowEC['idestado_civil'] == $fila1['idestado_civil1']){
            ?>
            <option value=" <?php echo $rowEC['idestado_civil']; ?>" selected><?php echo $rowEC['e_estado_c']; ?></option>
            <?php 
        	}else{
            ?>
            <option value="<?php echo $rowEC['idestado_civil']; ?>"><?php echo $rowEC['e_estado_c']; ?></option>
            <?PHP         	
            }
            mysqli_free_result($rowEC);            
			}
            echo "</select>";
            $boton++;
            }else if ($boton >= 2) {                
                echo 'Estado Civil2: '.$fila1['e_estado_c'].'<a href="eliminar_estado_c.php?idestadp='.$fila1['idfam_est'].'&idfam='.$fila['idfamilia'].'"><button type="button"> Eliminar Estado </button></a>';
            $boton++;
            }
            ?>            
            
        <?php
        }
        
        if($boton == 2){
            echo '<a href="agregar_estado.php?idfam='.$fila['idfamilia'].'"><button type="button"> Agregar Estado Civil2 </button></a>';

        }
        ?>
        </div>
            <div>Numero de Hoja: <input type="text" name="n_no_hoja" id="no_hoja" value="<?php echo $fila['hoja'];?>" maxlength="3" onkeypress="return soloNumeros(event);"></div>
            <div><a href="eliminar_fam.php?idfamelim=<?php echo $fila['idfamilia']; ?>"><button type="button"> Elimiar Familia y sus integrantes </button></a></div>

            
            	<?php
            	while ($registroIntegrante = $resINTEGRANTES->fetch_array(MYSQLI_BOTH)){
            	?>
            	<tr class="fila-fija">
                                   		
            			<input type="hidden" name="id_int[]" value="<?php echo $registroIntegrante['idintegrante']; ?>"></td>
                        <td><select id="cbx_parentesco" name="cbx_parentesco[]">
                        <?php while($rowpar = $reslutparent->fetch_assoc()) {                        
                        if($rowpar['idparentesco'] == $registroIntegrante['idparentesco1']){
                        ?>                                               
                        <option value="<?php echo $rowpar['idparentesco'];?>" selected><?php echo $rowpar['p_parentesco']; ?></option>
                        <?php 
                        }else{
                        ?>
                        <option value="<?php echo $rowpar['idparentesco'];?>"><?php echo $rowpar['p_parentesco']; ?></option>
                        <?PHP 
                        }                
                        }
                        mysqli_free_result($reslutparent);
                        $querypar = "SELECT idparentesco, p_parentesco FROM parentesco;";
						$reslutparent = mysqli_query($con, $querypar);

                        ?>
                        </select></td>

                        <td><input name="nombre[]" value="<?php echo $registroIntegrante['i_nombre'];?>" placeholder="nombre" maxlength="20" onkeypress="letrasMayus(this);"/></td>

                        <td><input name="apellido_pat[]" value="<?php echo $registroIntegrante['i_apellido_pat'];?>" placeholder="apellido_pat" maxlength="20" onkeypress="letrasMayus(this);"/></td>

                        <td><input name="apellido_mat[]" value="<?php echo $registroIntegrante['i_apellido_mat'];?>" placeholder="apellido_mat" maxlength="20" onkeypress="letrasMayus(this);"/></td>

                        <td><input name="edad[]" value="<?php echo $registroIntegrante['i_edad'];?>" placeholder="edad" maxlength="3" onkeypress="return soloNumeros(event);"/></td>

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
                        }
                        mysqli_free_result($resultsex);
                        $querysex = "SELECT idsexo, s_sexo FROM sexo;";
						$resultsex = mysqli_query($con, $querysex);
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
                        }
                        mysqli_free_result($resultesc);
                        $queryesc ="SELECT idescolaridad, e_escolaridad, e_numero FROM u494342329_censo.escolaridad;";
						$resultesc = mysqli_query($con, $queryesc);

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
                        }
                        mysqli_free_result($resultocu);
                        $queryocu = "SELECT idocupacion, o_ocupacion, l_ocupacion FROM u494342329_censo.ocupacion;";
						$resultocu = mysqli_query($con, $queryocu);
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
                        }
                        mysqli_free_result($resultrel);
                        $queryrel = "SELECT idreligion, r_religion, n_religion FROM u494342329_censo.religion;";
						$resultrel = mysqli_query($con, $queryrel);                        
                        ?>
                        </select></td>

                        <td><a href="eliminar_int.php?idintelim=<?php echo $registroIntegrante['idintegrante']; ?>&idfam=<?php echo $fila['idfamilia']; ?>"><button type="button"> Eliminar Integrante </button></a></td>
					</tr>                                           

<?php
}
?>

<td><a href="agregar_int.php?idfam=<?php echo $fila['idfamilia']; ?>"><button type="button"> Agregar un Integrante </button></a></td>

	<?php
    while ($registroIPAD = $resultIPAD->fetch_array(MYSQLI_BOTH)){
        
    ?>
    <tr>
    	<input type="hidden" name="id_int_pad[]" value="<?php echo $registroIPAD['idpad_int']; ?>">
        <td>Integrante: <?php echo $registroIPAD['i_nombre'];?> Tiene una: </td>
        <td><select id="cbx_padecimiento" name="cbx_padecimiento[]">
        <?php while($rowpad = $resultpadecimiento->fetch_assoc()){
        if($rowpad['idpadecimiento'] == $registroIPAD['idpadecimiento1']){
        ?>
        <option value=" <?php echo $rowpad['idpadecimiento']; ?>" selected><?php echo $rowpad['l_padecimiento'].") ".$rowpad['p_padecimiento']; ?></option>
        <?PHP
        }else{
        ?>
        <option value=" <?php echo $rowpad['idpadecimiento']; ?>" ><?php echo $rowpad['l_padecimiento'].") ".$rowpad['p_padecimiento']; ?></option>
        <?PHP
        }
        }
        mysqli_free_result($resultpadecimiento);
        $querypad = "SELECT idpadecimiento, p_padecimiento, l_padecimiento FROM u494342329_censo.padecimiento;";
		$resultpadecimiento = mysqli_query($con, $querypad);
        ?>
        </select> de </td>
        <td><input name="tipo_pad[]" value="<?php echo $registroIPAD['p_tipo']; ?>" placeholder="DIABETES" maxlength="20" onkeypress="letrasMayus(this);"/></td>


        <td><a href="eliminar_pad.php?idpadec=<?php echo $registroIPAD['idpad_int'];?>&idfam=<?php echo $fila['idfamilia']; ?>"><button type="button"> Eliminar Padecimiento </button></a></td>
    <tr>
    <?PHP
    }
    ?>


</table>
<input type="submit" name="insertar" value="Actualizar datos" class="btn btn-info"/>
<a href="agregar_pad.php?idfam=<?php echo $fila['idfamilia']; ?>"><button type="button"> Agregar padecimiento </button></a>
</form>
<!-- Archivos de boostrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>