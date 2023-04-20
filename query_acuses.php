	require_once "php/conexion.php";
	$con= conectar();

		//Conulta para el cotejo
	  $queryruta = "SELECT fecha, hora, Nombre_del_lugar, lugar_no_comun, persona, motivo, documentos, notas, u_nombre  FROM not190.rutas LEFT JOIN lugares on rutas.id_lugar1 = lugares.id_lugares LEFT JOIN motivo_ruta on rutas.id_motivo1 = motivo_ruta.id_motivo inner join usuarios on rutas.id_ususario2 = usuarios.idusuario where fecha='".$iddia."';";
