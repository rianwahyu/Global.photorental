<?php


require("fpdf16/fpdf.php");
//$dbc = mysqli_connect("localhost", "rige4492_root", "8umx9E5#RyNepdda", "rige4492_global_photorental");

if (isset($_POST)) {
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $fullname = $_POST['fullname'];
    $order_date = $_POST['order_date'];
    $pick_up_date = $_POST['pick_up_date'];
    $return_date = $_POST['return_date'];
    $diskon = $_POST['diskon'];
    $dp = $_POST['dp'];
    $totDays = $_POST['totDays'];    
    $myArray=unserialize($_POST['myArray']);
    $curYear = $_POST['curYear'];    

}

// $query = "SELECT a.*, b.item_name
//                 FROM order_value_tbl a 
//                 INNER JOIN item_tbl b ON a.item_id=b.item_id
//                 WHERE a.order_id='$order_id' ";
// $result = mysqli_query($dbc, $query);
// while ($data = mysqli_fetch_array($result)) {
//     $myArray[] = $data;
// }

// $queryHeader = "SELECT a.order_id, DATE_FORMAT(a.order_date, '%d/%m/%Y') as order_date, DATE_FORMAT(a.pick_up_date, '%d/%m/%Y') as pick_up_date, DATE_FORMAT (a.return_date, '%d-%m-%Y') as return_date, a.denda, a.diskon, a.dp, a.year, b.fullname, b.address, b.mobile
// FROM order_tbl a 
// INNER JOIN customer_tbl b ON a.customer_id=b.customer_id 
// WHERE a.order_id='$order_id'";
// $results = mysqli_query($dbc, $queryHeader);
// $row = mysqli_fetch_array($results);

// $order_date = $row['order_date'];
// $pick_up_date = $row['pick_up_date'];
// $return_date = $row['return_date'];
// $fullname = $row['fullname'];
// $address = $row['address'];
// $mobile = $row['mobile'];
// $denda = $row['denda'];
// $diskon = $row['diskon'];
// $price = $row['price'];
// $total_price = $row['total_price'];
// $dp = $row['dp'];
// $item_id = $row['item_id'];
// $item_name = $row['item_name'];

// $curYear= date('Y');

// $date1 = date_create($row['pick_up_date']);
// $date2 = date_create($row['return_date']);
// $diff = date_diff($date1, $date2);

// $totDays = (round($diff->format("%d")));
// if ($totDays <= 0) {
//     $totDays = 1;
// }

// if (empty($diskon)) {
//     $diskon = 0;
// }

// if (empty($dp)) {
//     $dp = 0;
// }

$totDays = (round($diff->format("%d")));
if ($totDays <= 0) {
    $totDays = 1;
}

if (empty($diskon)) {
    $diskon = 0;
}

if (empty($dp)) {
    $dp = 0;
}

class PDF extends FPDF
{

    function Header()
    {

        $this->Image('src/assets/images/global.JPG', 20, 10, 25, 0);

        // $this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',60,30,90,0,'PNG');

        $this->SetFont('Courier', 'B', '16');
        $this->SetFillColor(255, 255, 255);
        $this->SetX(85);
        $this->Cell(100, 5, 'INVOICE', 0, 0, 'R', true);
        $this->SetY(20);

        $this->SetFont('Courier', 'B', '9');
        $this->SetFillColor(255, 255, 255);
        $this->SetX(110);
        $this->Cell(80, 5, 'GLOBAL.PHOTORENTAL', 0, 0, 'L', true);
        $this->SetY(25);
        $this->SetFont('Courier', '', '8');
        $this->SetFillColor(255, 255, 255);
        $this->SetX(110);
        // $this->Cell(80, 5, 'Jalan Kepu IV No. 138a, Bungur, Senen, Jakarta Pusat', 0, 0, 'L', true);
        // $this->SetY(29);
        // $this->SetX(110);
        // $this->Cell(80, 5, 'Whatsapp: 0812-1234-9564', 0, 0, 'L', true);
        // $this->SetY(33);
        // $this->SetX(110);
        // $this->Cell(80, 5, 'Instagram: Global.photorental', 0, 0, 'L', true);

        $this->SetY(35);
        $this->SetX(20);
        $this->Cell(72, 5, 'Customer : ', 0, 0, 'L', true);
        $this->SetY(39);
        $this->SetX(20);
        $this->Cell(100, 5, $GLOBALS['fullname'], 0, 0, 'L', true);
        $this->SetY(43);
        $this->SetX(20);
        //$this->Cell(100, 5, $GLOBALS['address'], 0, 0, 'L', true);
        $this->SetY(47);
        $this->SetX(20);
        //$this->Cell(100, 5, $GLOBALS['mobile'], 0, 0, 'L', true);


        $this->SetFont('Courier', 'B', '7');
        $this->SetFillColor(245, 245, 245);
        $this->SetY(47);
        $this->SetX(116);
        $this->Cell(60, 5, 'INVOICE NO ' , 0, 0, 'L', true);
        $this->SetX(160);
        $this->Cell(25, 5, $GLOBALS['order_id'].'/INV/GPR/'.$GLOBALS['curYear'], 0, 0, 'R', true);
        $this->SetFont('Courier', '', '7');
        $this->SetFillColor(245, 245, 245);
        $this->SetY(52);
        $this->SetX(116);
        $this->Cell(60, 5, 'Tanggal Order', 0, 0, 'L', true);
        $this->SetX(160);
        $this->Cell(25, 5, $GLOBALS['order_date'], 0, 0, 'R', true);
        $this->SetY(56);
        $this->SetX(116);
        $this->Cell(60, 5, 'Tanggal Penyerahan', 0, 0, 'L', true);
        $this->SetX(160);
        $this->Cell(25, 5, $GLOBALS['pick_up_date'], 0, 0, 'R', true);
        $this->SetY(60);
        $this->SetX(116);
        $this->Cell(60, 5, 'Tanggal Pengembalian', 0, 0, 'L', true);
        $this->SetX(160);
        $this->Cell(25, 5, str_replace('-', '/', $GLOBALS['return_date']), 0, 0, 'R', true);
        $this->Ln();
        $this->Ln();
    }

    function Footer()
    {
        //$ffoot=$GLOBALS['username'];		
        $timezone = "Europe/Athens";
        $ok = date("M-d-Y");
        $this->SetY(-15);
        $this->SetFont('Arial', '', 6);
        $this->SetX(10);
        $this->Cell(50, 10, 'Print By :  Global Photorental, ' . $ok, 0, 0, 'C');
        $this->SetX(185);
        $this->Cell(100, 10, 'Page ' . $this->PageNo() . " ", 0, 0, 'C');
    }
}

$pdf = new PDF('P', 'mm', array(210, 277));
$pdf->AddPage('P', 'A4', 'C');

$pdf->SetFillColor(160, 82, 45);
$pdf->SetFont('Courier', 'B', 7);
$pdf->GetY();
$pdf->SetX(20);
$pdf->Cell(8, 6, 'NO', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'Uraian', 1, 0, 'C', 1);
$pdf->Cell(10, 6, 'Qty', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'No Serial', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Harga', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Total', 1, 0, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Courier', '', 8);
$pdf->Ln();

$i = 1;
$totalPrices = 0;
$grandTotal = 0;
foreach ($myArray as $data) {
    $totalPrices = $totDays * $data['price'];
    $grandTotal = $grandTotal + $totalPrices;
    $pdf->SetX(20);
    $pdf->Cell(8, 6, $i++, 1, 0, 'C', 1);
    $pdf->Cell(50, 6, $data['item_name'], 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $totDays . ' days', 1, 0, 'C', 1);
    $pdf->Cell(25, 6, $data['item_id'], 1, 0, 'C', 1);
    $pdf->Cell(35, 6, rupiah($data['price']), 1, 0, 'R', 1);
    $pdf->Cell(40, 6, rupiah($totalPrices), 1, 0, 'R', 1);
    $pdf->Ln();
}
$pdf->SetX(20);
$pdf->Cell(93, 6, '', 1, 0, 'C', 0);
$pdf->Cell(35, 6, 'Jumlah', 1, 0, 'L', 1);
$pdf->Cell(40, 6, rupiah(round($grandTotal)), 1, 0, 'R', 1);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(93, 6, '', 1, 0, 'C', 0);
$pdf->Cell(35, 6, 'Diskon', 1, 0, 'L', 1);
$pdf->Cell(40, 6, rupiah(round($diskon)), 1, 0, 'R', 1);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(93, 6, '', 1, 0, 'C', 0);
$pdf->Cell(35, 6, 'Down Payment', 1, 0, 'L', 1);
$pdf->Cell(40, 6, rupiah(round($dp)), 1, 0, 'R', 1);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(93, 6, '', 1, 0, 'C', 0);
$pdf->Cell(35, 6, 'Total', 1, 0, 'L', 1);
$pdf->Cell(40, 6, rupiah(($grandTotal - $diskon) - $dp), 1, 0, 'R', 1);
$finalTotal = ($grandTotal - $diskon) - $dp;

$pdf->Ln();
$pdf->Ln();
$pdf->SetX(20);
$pdf->MultiCell(80, 5, 'Terbilang :'.  "\n". terbilang($finalTotal) , 1, 'L', false);



$pdf->Ln();
$pdf->SetX(116);
$pdf->Cell(20, 5, 'Terima kasih', 0, 0, 'L', true);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(116);
$pdf->Cell(20, 5, 'Global photo rental', 0, 0, 'L', true);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(245, 245, 245);
$pdf->SetFont('Courier', '', 7);
$pdf->SetX(20);
$pdf->MultiCell(170, 5, 'Ketentuan Sewa:'.  "\n". 
'1. Sewa dihitung per 24 jam sesuai jam yang ditulis pada form booking di WA. Toleransi keterlambatan diberikan 1 jam setelah konfirmasi terlebih dahulu. Keterlambatan 2-3 jam akan dikenakan denda 30% dari total biaya sewa. Apabila terlambat lebih dari 3 jam maka dihitung perpanjang sehari.' ."\n". 
'2. Alat yang sudah dipesan dan sudah dilakukan pembayaran tidak dapat dibatalkan atau refund.' ."\n". 
'3. Meninggalkan 2 jenis identitas asli dan aktif (KTP wajib) pada saat pengambilan/pengantaran alat. Kedua identitas harus identik dengan orang yang akan mengambil alat. '."\n". 
'4. Segala jenis kerusakan dan/atau kehilangan dari barang yang disewa sepenuhnya menjadi tanggung jawab penyewa.' , 0, 'L', true);


$namePDF = "Invoice Global Photorental - $order_id.pdf";

// $pdf->Output();
//$pdf->Output('F','Invoice GLobal-'.time().'.pdf', true);
//$pdf->Output('I','file.pdf');
//$pdf->Output('F', public_path('/pdf/higher2.pdf'));
// $path=$_SERVER['DOCUMENT_ROOT']."/download/test3.pdf";
// $pdf->Output($path,'F');
//$pdf->Output('yourfilename.pdf','F');
//$pdf->Output('yourfilename.pdf','D');

$pdf->Output('download/'.$namePDF,'I');







function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
