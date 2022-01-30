<?php

if (isset($_POST)) {
    $myArray = unserialize($_POST['myArray']);
    $myArrayPackage = unserialize($_POST['myArrayPackage']);
    $myArray1 = unserialize($_POST['myArray1']);
    $tahun = $_POST['tahun'];
}

date_default_timezone_set('Asia/Jakarta');
require_once "../PHPExcel-1.8/Classes/PHPExcel.php";


$jumMonth = 1;
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Rekapan Tahun : ' . $tahun)
    ->setCellValue('A3', 'Item Name');

foreach ($myArray1 as $data1) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue(getNameFromNumber($jumMonth) . '3', $data1['month']);
    $jumMonth++;
}

$objPHPExcel->getActiveSheet()->getStyle('A3:' . getNameFromNumber($jumMonth) . '3')->getAlignment()->applyFromArray(
    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
);

$i = 3;
$grandTotal = 0;
$grandqty = 0;
$no = 1;
$remark = "";
$jumMonthData = 1;

foreach ($myArrayPackage as $dataPackage) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), $dataPackage['item_name']);
    foreach ($myArray1 as $data1) {

        foreach ($myArray as $data) {
            if ($dataPackage['item_id'] == $data['item_id']) {
                if ($data['month'] == $data1['month']) {
                    //echo rupiah($data['total']);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue(getNameFromNumber(intval($data1['monthNumber'])) . ($i + 1), rupiah($data['total']));
                    $grandTotal = $grandTotal + $data['total'];
                } elseif ($data['month'] == "-") {
                    //echo rupiah(0);                                        
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue(getNameFromNumber(intval($data1['monthNumber'])) . ($i + 1), rupiah(0));
                    $grandTotal = $grandTotal + 0;
                    //$jumMonthData++;
                }
            }
        }
    }
    $i++;
}


for ($col = 'A'; $col !== getNameFromNumber($jumMonth - 1); $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()
    ->getStyle('A3:A' . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()
    ->getStyle(getNameFromNumber($jumMonth - 1) . '3:' . getNameFromNumber($jumMonth - 1) . ($i + 1))
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);


$objPHPExcel->getActiveSheet()->getStyle('A3:' . getNameFromNumber($jumMonth - 1) . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Rekapan " . date("Y-m-d h:i:sa") . " .xlsx";
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

function getNameFromNumber($num)
{
    $numeric = $num % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval($num / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2 - 1) . $letter;
    } else {
        return $letter;
    }
}
