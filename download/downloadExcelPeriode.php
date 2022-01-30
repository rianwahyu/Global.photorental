<?php

if (isset($_POST)) {
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $text = $_POST['text'];
    $myArray = unserialize($_POST['myArray']);
}

date_default_timezone_set('Asia/Jakarta');
require_once "../PHPExcel-1.8/Classes/PHPExcel.php";

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Report By Periode')
    ->setCellValue('A2', 'Item Name / Serial Number : ' . $text)
    ->setCellValue('A3', 'Periode : ' . $dateStart . ' to ' . $dateEnd)

    ->setCellValue('A5', 'No')
    ->setCellValue('B5', 'Serial Number')
    ->setCellValue('C5', 'Item Name')
    ->setCellValue('D5', 'Price')
    ->setCellValue('E5', 'Pickup Date')
    ->setCellValue('F5', 'Retun Date')
    ->setCellValue('G5', 'Return Date Real')
    ->setCellValue('H5', 'Remark')
    ->setCellValue('I5', 'Total')
    ->getStyle('A5:I5')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:D3');

$i = 5;
$grandTotal = 0;
$grandqty = 0;
$no = 1;
$remark = "";
foreach ($myArray as $d) {
    $date1 = date_create($d['pickupDate']);

    $dateReturn = new DateTime($d['returnDate']);
    $dateReal = new DateTime($d['returnDateReal']);

    $diff = $dateReal->diff($dateReturn);
    $hours = $diff->h;
    $hours = $hours + ($diff->days * 24);

    if ($hours >= 1) {
        $date2 = $dateReturn;
        $remark = "Terlambat mengembalikan";
    } else {
        $date2 = date_create($d['returnDate']);
        $remark = "";
    }

    $diff = date_diff($date1, $date2);
    $grandTotal = $grandTotal +  $d['total'];

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), $no++)
        ->setCellValue('B' . ($i + 1), $d['item_id'])
        ->setCellValue('C' . ($i + 1), $d['item_name'])
        ->setCellValue('D' . ($i + 1), rupiah(round($d['price'])))
        ->setCellValue('E' . ($i + 1), $d['pickupDate'])
        ->setCellValue('F' . ($i + 1), $d['returnDate'])
        ->setCellValue('G' . ($i + 1), $d['returnDateReal'])
        ->setCellValue('H' . ($i + 1), $remark)
        ->setCellValue('I' . ($i + 1), rupiah($d['total']));
    $i++;
}

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A' . ($i + 1), 'Grand Total')
    ->setCellValue('I' . ($i + 1), $grandTotal);

$objPHPExcel->getActiveSheet()->mergeCells('A' . ($i + 1) . ':H' . ($i + 1) . '');



for ($col = 'A'; $col !== 'I'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()
    ->getStyle('A5:H' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()
    ->getStyle('I5:I' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$objPHPExcel->getActiveSheet()
    ->getStyle('A' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->getStyle('A5:I' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Report Periode_" . date("Y-m-d h:i:sa") . " .xlsx";
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
