<?PHP

require_once "php/conexion.php";  
$con= conectar();

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

$id_familia = ($_GET['idfam']);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="js/input.js"></script>

        <script>
            
            $(function(){
                // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
                $("#adicional").on('click', function(){
                    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
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

<form method="post" action="agregar_int2.php">                   
                <table class="table bg-info"  id="tabla">

                    <tr class="fila-fija">


                    <input type="hidden" name="id_fam" value="<?php echo $id_familia; ?>">
                       <td><select id="cbx_parentesco" name="cbx_parentesco[]">
                        <option value="0">Parentesco</option>
                        <?php while($rowpar = $reslutpar->fetch_assoc()) {?>
                        <option value=" <?php echo $rowpar['idparentesco']; ?>" ><?php echo $rowpar['p_parentesco']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>                    
                        <td><input name="nombre[]" placeholder="nombre" maxlength="20" onkeypress="letrasMayus(this);"/></td>
                        <td><input name="apellido_pat[]" placeholder="apellido_pat" maxlength="20" onkeypress="letrasMayus(this);" /></td>
                        <td><input name="apellido_mat[]" placeholder="apellido_mat"maxlength="20" onkeypress="letrasMayus(this);" /></td>
                        <td><input name="edad[]" placeholder="edad" maxlength="3" onkeypress="return soloNumeros(event);"/></td>
                        <td><select id="cbx_sexo" name="cbx_sexo[]">
                        <option value="0">Sexo</option>
                        <?php while($rowsex = $resultsex->fetch_assoc()) {?>
                        <option value=" <?php echo $rowsex['idsexo']; ?>" ><?php echo $rowsex['s_sexo']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        
                        <td><select id="cbx_bautizado" name="cbx_bautizado[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        <td><select id="cbx_pcom" name="cbx_pcom[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>
                        
                        <td><select id="cbx_confirmacion" name="cbx_confirmacion[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        
                        <td><select id="cbx_gma" name="cbx_gma[]">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                        </select>
                        </td>

                        <td><select id="cbx_escolaridad" name="cbx_escolaridad[]">
                        <option value="0">Escolaridad</option>
                        <?php while($rowesc = $resultesc->fetch_assoc()) {?>
                        <option value=" <?php echo $rowesc['idescolaridad']; ?>" ><?php echo $rowesc['e_numero'].")".$rowesc['e_escolaridad']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><select id="cbx_ocupacion" name="cbx_ocupacion[]">
                        <option value="0">Ocupacion</option>
                        <?php while($rowocu = $resultocu->fetch_assoc()) {?>
                        <option value=" <?php echo $rowocu['idocupacion']; ?>" ><?php echo $rowocu['l_ocupacion'].") ".$rowocu['o_ocupacion']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><select id="cbx_religion" name="cbx_religion[]">
                        <option value="0">Religion</option>
                        <?php while($rowrel = $resultrel->fetch_assoc()) {?>
                        <option value=" <?php echo $rowrel['idreligion']; ?>" ><?php echo $rowrel['n_religion'].") ".$rowrel['r_religion']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>

                        <td><select id="cbx_padecimiento" name="cbx_padecimiento[]">
                        <option value="0">Padecimiento</option>
                        <?php while($rowpad = $resultpadecimiento->fetch_assoc()) {?>
                        <option value=" <?php echo $rowpad['idpadecimiento']; ?>" ><?php echo $rowpad['l_padecimiento'].")".$rowpad['p_padecimiento']; ?></option>
                        <?PHP
                        ;}
                        ?>
                        </select></td>
                        <td><input name="tipo_pad[]" placeholder="Tipo" maxlength="20" onkeypress="letrasMayus(this);"/></td>


                        <td class="eliminar"><input type="button"   value="Menos -"/></td>
                    </tr>
                </table>

                <div class="btn-der">
                    <input type="submit" name="insertar" value="Agregar Integrantes" class="btn btn-info"/>
                    <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más + </button>

                </div>
            </form>

</body>
</html>