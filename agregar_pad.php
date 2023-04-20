<?php
include_once "php/conexion.php";  
$con = conectar();

session_start();

$id_familia = ($_GET['idfam']);

$querypad = "SELECT idpadecimiento, p_padecimiento, l_padecimiento FROM u494342329_censo.padecimiento;";
$resultpadecimiento = mysqli_query($con, $querypad);

$queryint = "SELECT idintegrante, i_nombre FROM u494342329_censo.familia
inner join integrante on familia.idfamilia = integrante.idfamilia1
where idfamilia1 =".$id_familia.";";
$resnomint = mysqli_query($con, $queryint);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<title>Agregar Padecimiento</title>
</head>

<body>


<form method="post" action="agregar_pad2.php">                   
                <table class="table bg-info"  id="tabla">
                	<tr class="fila-fija">
                		<input type="hidden" name="id_fam" value="<?php echo $id_familia; ?>">
						
						<td><select id="cbx_inte" name="cbx_inte[]">
                        <?php while($rowint = $resnomint->fetch_assoc()) {?>
                        <option value="<?php echo $rowint['idintegrante']; ?>"> <?php echo $rowint['i_nombre'];?> </option>
                        <?PHP
                        }
                        ?>
                        </select></td>
                        
                        <td><select id="cbx_padecimiento" name="cbx_padecimiento[]">
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

<input type="submit" name="insertar" value="Insertar Integrantes" class="btn btn-info"/>
<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más + </button>

</form>


</body>
</html>
