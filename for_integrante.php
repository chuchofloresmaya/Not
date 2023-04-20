<?PHP
$querypar = "SELECT idparentesco, p_parentesco FROM parentesco;";
$reslutpar = mysqli_query($con, $querypar);

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

?>


<script>
    		$(function(){
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(1)").clone().removeClass('fila-fija').appendTo("#tabla");
				});
			 
				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
		</script>
 
 </head>



<body>

<form method="post" action="registro_integrantes.php" onSubmit="return validacion_int()">                   

<table class="table table-active"  id="tabla">
<tr>
            <td >Parentesco</td>
            <td>Nombre  </td>
            <td>A. Paterno</td>
            <td>A. Materno</td>
            <td>Edad</td>
            <td>Sexo</td>
            <td>Bau.</td>
            <td>1Com</td>
            <td>Conf</td>
            <td>GMA</td>
            <td>Escolaridad</td>
            <td>Ocupación</td>
            <td>Religión</td>
            <td>Padecimiento</td>
      </tr>            
            <input type="hidden" name="idfamily" id="idfam" value="<?php echo $ultimo_id; ?>">
                    <tr class="fila-fija">
                        <td><select class="btn btn-outline-secondary btn-sm" id="cbx_parentesco" name="cbx_parentesco[]">
                        <option value="">Parentesco</option>
                        <?php while($rowpar = $reslutpar->fetch_assoc()) {?>
                        <option value=" <?php echo $rowpar['idparentesco']; ?>" ><?php echo $rowpar['p_parentesco']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><input name="nombre[]" id="nombre" placeholder="NOMBRE" size="15" maxlength="20" onkeypress="letrasMayus(this);" pattern="[A-Z ]+"/></td>
                        <td><input name="apellido_pat[]" id="ape_pat" placeholder="AP PATERNO" size="10" maxlength="20" onkeypress="letrasMayus(this);" /></td>
                        <td><input name="apellido_mat[]" id="ape_mat" placeholder="AP MATERNO" size="10 " maxlength="20" onkeypress="letrasMayus(this);" /></td>
                        <td><input name="edad[]" id="edad" placeholder="EDAD"  size="3" maxlength="3" onkeypress="return soloNumeros(event);"/></td>
                        <td><select id="cbx_sexo" class="btn btn-outline-secondary btn-sm" name="cbx_sexo[]">
                        <option value="">Sexo</option>
                        <?php while($rowsex = $resultsex->fetch_assoc()) {?>
                        <option value=" <?php echo $rowsex['idsexo']; ?>" ><?php echo $rowsex['s_sexo']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        
                        <td><select id="cbx_bautizado" class="btn btn-outline-secondary btn-sm" name="cbx_bautizado[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        <td><select id="cbx_pcom" class="btn btn-outline-secondary btn-sm" name="cbx_pcom[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>
                        
                        <td><select id="cbx_confirmacion" class="btn btn-outline-secondary btn-sm" name="cbx_confirmacion[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        
                        <td><select id="cbx_gma" class="btn btn-outline-secondary btn-sm" name="cbx_gma[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        <td><select id="cbx_escolaridad" class="btn btn-outline-secondary btn-sm" name="cbx_escolaridad[]">
                        <option value="">Escolaridad</option>
                        <?php while($rowesc = $resultesc->fetch_assoc()) {?>
                        <option value=" <?php echo $rowesc['idescolaridad']; ?>" ><?php echo $rowesc['e_numero'].")".$rowesc['e_escolaridad']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><select id="cbx_ocupacion" class="btn btn-outline-secondary btn-sm" name="cbx_ocupacion[]">
                        <option value="">Ocupación</option>
                        <?php while($rowocu = $resultocu->fetch_assoc()) {?>
                        <option value=" <?php echo $rowocu['idocupacion']; ?>" ><?php echo $rowocu['l_ocupacion'].") ".$rowocu['o_ocupacion']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><select id="cbx_religion" class="btn btn-outline-secondary btn-sm" name="cbx_religion[]">
                        <option value="">Religión</option>
                        <?php while($rowrel = $resultrel->fetch_assoc()) {?>
                        <option value=" <?php echo $rowrel['idreligion']; ?>" ><?php echo $rowrel['n_religion'].") ".$rowrel['r_religion']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>

                        <td><select id="cbx_padecimiento" class="btn btn-outline-secondary btn-sm" name="cbx_padecimiento[]">
                        <option value="0">Padecimiento</option>
                        <?php while($rowpad = $resultpadecimiento->fetch_assoc()) {?>
                        <option value=" <?php echo $rowpad['idpadecimiento']; ?>" ><?php echo $rowpad['l_padecimiento'].")".$rowpad['p_padecimiento']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><input name="tipo_pad[]" id="pad_tipo" placeholder="Tipo" maxlength="20" onkeypress="letrasMayus(this);"/></td>


                        <td class="eliminar"><input type="button" class="btn btn-outline-danger"   value="Menos -"/></td>
                    </tr>
                </table>

                <div class="btn-der">
					<input type="submit" name="insertar" value="Finalizar Registro" class="btn btn-success disables"/>
					<button id="adicional" name="adicional" type="button" class="btn btn-warning disable"> Más + </button>

                </div>
            </form>
</body>
</html>