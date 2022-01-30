<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT * FROM item_tbl WHERE item_id='$id' ";
$result = mysqli_query($dbc, $query);


$querys = "SELECT customer_id, fullname FROM `customer_tbl` WHERE 1";
$results = mysqli_query($dbc, $querys);

$orderID = getIDOrder();

function getIDOrder()
{
    include 'config/connection.php';
    $kode = "ORD";
    $order_id = "";
    $sql = "SELECT order_id FROM order_tbl ORDER BY order_id DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $order_id = $kode . "0000001";
    } else {
        $id = $data["order_id"];
        $id = substr($id, 3);

        $order_id = $kode . str_pad($id + 1, 7, 0, STR_PAD_LEFT);
    }

    return $order_id;
}

?>

<div id="itemDetail">

    <?php
    while ($d = mysqli_fetch_array($result)) {
    ?>

        <div class="form-group mt-4">
            <label>Item Name</label>
            <input type="text" class="form-control" name="item_name" value="<?= $d['item_name'] ?>" disabled />
        </div>
        <div class="form-group mt-4">
            <label>Order ID</label>
            <input type="text" class="form-control" name="order_id" value="<?= $orderID ?>" disabled />
            <input type="hidden" class="form-control" name="order_id" value="<?= $orderID ?>" />
        </div>
        <div class="form-group mt-4">
            <label>Order Date</label>
            <input type="datetime-local" class="form-control" name="order_date" value="<?= $d['order_date'] ?>" />
        </div>
        <div class="form-group mt-4">
            <label>Customer ID</label>

            <select class="form-control js-example-basic-single2" style="width: 100%;" name="customer_id">
                <option selected>Choose Customer</option>
                <?php while ($datas = mysqli_fetch_array($results)) { ?>
                    <option value="<?= $datas['customer_id'] ?>"><?= $datas['customer_id'] . "-" . $datas['fullname'] ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- <div class="form-group mt-4">
            <label>Customer Name</label>
            <input type="text" class="form-control" name="fullname" value="<?= $d['fullname'] ?>" />
        </div> -->
        <div class="form-group mt-4">
            <label>Pick Up Date</label>
            <input type="datetime-local" class="form-control" name="pick_up_date" value="<?= $d['pick_up_date'] ?>" />
        </div>
        <div class="form-group mt-4">
            <label>Return Date</label>
            <input type="datetime-local" class="form-control" name="return_date" value="<?= $d['return_date'] ?>" />
        </div>
        <div class="form-group">
            <label>Penalty Amount</label>
            <input type="number" class="form-control" name="denda" value="<?= $data['denda'] ?>" />
        </div>
        <div class="form-group">
            <label>Discount</label>
            <input type="number" class="form-control" name="diskon" value="<?= $data['diskon'] ?>" />
        </div>
        <!-- <div class="form-group mt-4">
            <label>Quantity</label>
            <input type="text" class="form-control" name="quantity" value="<?= $d['quantity'] ?>" onkeypress="return isNumberKey(event)" required />
        </div> -->
        <div class="form-group">
            <label>Price per Item</label>
            <input type="text" class="form-control" value="<?= rupiah($d['price']) ?>" name="price" disabled />
            <input type="hidden" class="form-control" value="<?= $d['price'] ?>" name="price" />
        </div>
        
        <div class="form-group">
            <label>Down Payment (DP)</label>
            <input type="number" class="form-control" name="dp" />            
        </div>

        <div class="form-group">
            <label>Total</label>
            <input type="text" class="form-control" name="total_price" disabled />
        </div>

    <?php
    }

    function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
    ?>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
    });
</script>