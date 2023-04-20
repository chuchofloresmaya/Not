<?php
 require 'librerias/phpexcel/vendor/autoload.php';

 use PhpOffice\PhpSpreadsheet\SpreadSheet;
 //use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 use PhpOffice\PhpSpreadsheet\IOFactory;

 $spreadsheet= new SpreadSheet();
 $spreadsheet->getProperties()->setCreator("SmartNot")->setTitle("");

 $spreadsheet->setActiveSheetIndex(0);
 $hojaActiva = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma');
$spreadsheet->getDefaultStyle()->getFont()->setSize(15);

$hojaActiva->getColumnDimension('A')->setWidth(8.7);
$hojaActiva->getColumnDimension('B')->setWidth(15);
$hojaActiva->getColumnDimension('C')->setWidth(50);
$hojaActiva->getColumnDimension('D')->setWidth(5);
$hojaActiva->getColumnDimension('E')->setWidth(5);
$hojaActiva->getColumnDimension('F')->setWidth(40);
$hojaActiva->getColumnDimension('G')->setWidth(10);

 $hojaActiva->setCellValue('A1', 'No. Cotejo');
 $hojaActiva->setCellValue('B1', 'Fecha');
 $hojaActiva->setCellValue('C1', 'Solicitud');
 $hojaActiva->setCellValue('D1', 'Fojas');
 $hojaActiva->setCellValue('E1', 'Tantos');
 $hojaActiva->setCellValue('F1', 'Documento');
 $hojaActiva->setCellValue('G1', 'Precio');
 $hojaActiva->setCellValue('H1', 'IVA');
 $hojaActiva->setCellValue('I1', 'Total');

require_once "php/conexion.php";
$multiplicador = ($_GET['pag']-1)*50;

$queryfam = "SELECT id_cotejo, c_nocotejo, c_libro, c_hoja, c_tantos_soli, c_tamaño, h_tamaño, c_lados, l_lado, m_lados ,c_persona, p_nombre, c_empresa, e_nombre, c_tiposociedad, t_sociedad, c_hoja_anexa, hoja_anexa, copia, c_fecha, fname, name ,id_usuario3, u_nombre, id_acta, n_tipo, tipo_esc, ac_esc, vol_tipo, ac_vol, a_targeta, tipo_targetas, tipo_factura, a_factura, tipo_identificacion, a_idmex, tipo_otros, a_otro, ac_manual,ac_contenido FROM not190.cotejos 
        inner join hojas on cotejos.c_tamaño = hojas.id_hoja 
        inner join lados on cotejos.c_lados = lados.id_lado 
        inner join mostrado on cotejos.c_mostrada = mostrado.id_mostrado 
        LEFT JOIN personas ON cotejos.c_persona = personas.id_persona 
        LEFT JOIN empresas ON cotejos.c_empresa = empresas.id_empresa 
        LEFT JOIN tiposociedad ON cotejos.c_tiposociedad = tiposociedad.id_tiposociedad 
        inner join hojas_anexas on cotejos.c_hoja_anexa = hojas_anexas.id_hoja_anexa 
        inner join usuarios on cotejos.id_usuario3 = usuarios.idusuario 
        LEFT join actas on actas.id_cotejo1 = cotejos.id_cotejo 
        LEFT join ac_tipos on actas.id_tipo1 = ac_tipos.id_ac_tipo
        LEFT join esc_tipo on actas.id_esc_tipo = esc_tipo.id_esc_tipo
        left join vol_tipo on actas.id_esc_vol = vol_tipo.id_vol_tipo
        LEFT JOIN acta_targetas on actas.id_targetas1 = acta_targetas.id_targetas
        LEFT JOIN ac_facturas on actas.id_factura1 = ac_facturas.id_factura
        LEFT JOIN ac_identificaciones on actas.ac_idoficial1 = ac_identificaciones.ac_idoficial
        LEFT JOIN ac_idotros on actas.id_otro = ac_idotros.ac_idotro
        LEFT JOIN ac_contenidos on actas.id_contenido = ac_contenidos.id_contenido
        order by c_nocotejo DESC LIMIT ".$multiplicador.",50";
$con1= conectar();
$resultfam = $con1->query($queryfam);

$i=2;
 while ($rowfam = $resultfam->fetch_array(MYSQLI_BOTH)){  
    $solicitud = $rowfam['p_nombre']."".$rowfam['e_nombre']."".$rowfam['t_sociedad'];

    $documento = $rowfam['n_tipo']." ".$rowfam['tipo_esc']." ".$rowfam['ac_esc']." ".$rowfam['vol_tipo']." ".$rowfam['ac_vol']." ".$rowfam['a_targeta']." ".$rowfam['tipo_targetas']." ".$rowfam['tipo_factura']." ".$rowfam['a_factura']." ".$rowfam['tipo_identificacion']." ".$rowfam['a_idmex']." ".$rowfam['tipo_otros']." ".$rowfam['a_otro']." ".$rowfam['ac_manual']." ".$rowfam['ac_contenido'];

      $fojas = $rowfam['c_hoja']-1;
      $tantos = $rowfam['c_tantos_soli'];
      $precio = (($fojas*20)+220)*($tantos);
  
    $iva = $precio*0.16;
    $total = $precio + $iva;

        $hojaActiva->setCellValue('A'.$i, $rowfam['c_nocotejo'])->setCellValue('B'.$i, $rowfam['c_fecha'])->setCellValue('C'.$i, $solicitud )->setCellValue('D'.$i, $rowfam['c_hoja'])->setCellValue('E'.$i, $rowfam['c_tantos_soli'])->setCellValue('F'.$i, $documento)->setCellValue('G'.$i, $precio)->setCellValue('H'.$i, $iva)->setCellValue('I'.$i, $total);

$i++;
 }
 

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Cotejos.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

 /*$writer = new Xlsx($spreadsheet);
 $writer->save('Mi excel.xlsx');*/

?>