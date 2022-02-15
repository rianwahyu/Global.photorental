<?php

include 'config/connection.php';

if (isset($_POST)) {
    $pick_up_date = $_POST['pick_up_date'];
    $return_date = $_POST['return_date'];
    $diskon = $_POST['diskon'];
    $dp = $_POST['dp'];
}

$date1 = date_create($pick_up_date);
$date2 = date_create($return_date);
$diff = date_diff($date1, $date2);

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
//echo $totDays;

$query = "SELECT a.*, b.item_name
FROM cart_temp a 
INNER JOIN item_tbl b ON a.item_id=b.item_id
WHERE 1";
$result = mysqli_query($dbc, $query);


if (mysqli_num_rows($result) >=   1) {
    $countTemp = mysqli_num_rows($result);
} else {
    $countTemp = 0;
}

//echo $countTemp;

$grandTotal = 0;
$finalTOtal = 0;
?>

<table id="example" class="table table-striped table-bordered no-wrap">
    <thead class="bg-primary text-white">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Item ID</th>
            <th class="text-center">Item Name</th>
            <th class="text-center">Qty (Days)</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total Price</th>
            <th class="text-center">Option</th>

        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        $totalPrices = 0;
        while ($data = mysqli_fetch_array($result)) {
            $totalPrices = $totDays * $data['price'];
            $grandTotal = $grandTotal + $totalPrices;
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $data['item_id'] ?></td>
                <td><?= $data['item_name'] ?></td>
                <td><?= $totDays . ' days' ?></td>
                <td class="text-right"><?= $data['price'] ?></td>
                <td class="text-right"><?= $totalPrices ?></td>
                <td class="text-right"><a href="#" id="deleteTemp" data-id="<?php echo $data['idCart']; ?>">
                        <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> </button>
                    </a></td>

            </tr>

        <?php } ?>
    </tbody>

    <tfoot>
        <tr>
            <th class="text-center" colspan="5">Sum Total</th>
            <th class="text-right"><?= $grandTotal ?></th>
        </tr>

        <tr>
            <th class="text-center" colspan="5">Diskon</th>
            <th class="text-right"><?= $diskon ?></th>
        </tr>
        <tr>
            <th class="text-center" colspan="5">Down Payment</th>
            <th class="text-right"><?= $dp ?></th>
        </tr>

        <tr>
            <th class="text-center" colspan="5">Total harus dibayar</th>
            <th class="text-right"><?= ($grandTotal - $diskon) - $dp ?></th>
        </tr>

    </tfoot>

</table>