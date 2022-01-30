<?php

if (isset($_POST)) {    
    $myArray = unserialize($_POST['myArray']);
}

date_default_timezone_set('Asia/Jakarta');
require_once "../PHPExcel-1.8/Classes/PHPExcel.php";

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Report By Customer')
    
    ->setCellValue('A3', 'No')
    ->setCellValue('B3', 'Customer ID')
    ->setCellValue('C3', 'Customer Name')
    ->setCellValue('D3', 'Member ID')
    ->setCellValue('E3', 'Registered Date')
    ->setCellValue('F3', 'Total Order')
    ->getStyle('A3:F3')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');

$i = 3;
$grandTotal = 0;
$grandqty = 0;
$no = 1;
$remark = "";
foreach ($myArray as $d) {

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), $no++)
        ->setCellValue('B' . ($i + 1), $d['customer_id'])
        ->setCellValue('C' . ($i + 1), $d['fullname'])
        ->setCellValue('D' . ($i + 1), $d['member_id'])
        ->setCellValue('E' . ($i + 1), $d['registered_date'])
        ->setCellValue('F' . ($i + 1), $d['jml']);
    $i++;
}

// $objPHPExcel->setActiveSheetIndex(0)
//     ->setCellValue('A' . ($i + 1), 'Grand Total')
//     ->setCellValue('I' . ($i + 1), $grandTotal);

// $objPHPExcel->getActiveSheet()->mergeCells('A' . ($i + 1) . ':H' . ($i + 1) . '');

for ($col = 'A'; $col !== 'E'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()
    ->getStyle('A3:E' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()
    ->getStyle('F3:I' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);


$objPHPExcel->getActiveSheet()->getStyle('A3:E' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Report By Customer" . date("Y-m-d h:i:sa") . " .xlsx";
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
unset($objPHPExcel);

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0);
    return $hasil_rupiah;
}

function convtoPercent($percent)
{
    return $percent;
}
