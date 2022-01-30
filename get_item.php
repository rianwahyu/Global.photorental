<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT * FROM item_tbl WHERE item_id='$id' ";
$result = mysqli_query($dbc, $query);

?>

<div id="itemDetail">

    <?php
    while ($d = mysqli_fetch_array($result)) {
    ?>
        <div class="form-group mt-4">
            <label>Item Name</label>
            <input type="text" class="form-control" name="item_name" value="<?= $d['item_name'] ?>" disabled />
        </div>

        <div class="form-group">
            <label>Price per Item</label>
            <input type="text" class="form-control" value="<?= rupiah($d['price']) ?>" name="price" disabled />
            <input type="hidden" class="form-control" value="<?= $d['price'] ?>" name="price" />
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