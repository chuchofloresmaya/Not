<?php
 require 'vendor/autoload.php';

 use PhpOffice\PhpSpreadsheet\SpreadSheet;
 //use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 use PhpOffice\PhpSpreadsheet\IOFactory;

 $spreadsheet= new SpreadSheet();
 $spreadsheet->getProperties()->setCreator("Jesus AFM")->setTitle("Mi Excel");

 $spreadsheet->setActiveSheetIndex(0);
 $hojaActiva = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma');
$spreadsheet->getDefaultStyle()->getFont()->setSize(15);

$hojaActiva->getColumnDimension('A')->setWidth(20);
$hojaActiva->getColumnDimension('B')->setWidth(40);

 $hojaActiva->setCellValue('A1', 'CODIGOS DE PROGRAMACION');
 $hojaActiva->setCellValue('B2', '123,456');


 $hojaActiva->setCellValue('C1', 'Jesus AFM')->setCellValue('D1', 'Hola mundo');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Cotejos.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

 /*$writer = new Xlsx($spreadsheet);
 $writer->save('Mi excel.xlsx');*/

?>