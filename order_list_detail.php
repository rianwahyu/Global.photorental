<?php include 'include/head.php'; ?>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'include/header.php'; ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'include/aside.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order Detail</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pesanan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Item Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <a href="order_list">
                    <button type="button" class="btn waves-effect waves-light btn-warning mt-3">Kembali</button>
                </a>
            </div>

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <?php
                include 'config/connection.php';

                $myArray4 = array();

                $order_id = "";
                if (isset($_GET)) {
                    $order_id = $_GET['order_id'];
                }

                $query = "SELECT a.*, b.item_name
                FROM order_value_tbl a 
                INNER JOIN item_tbl b ON a.item_id=b.item_id
                WHERE a.order_id='$order_id' ";
                $result = mysqli_query($dbc, $query);

                $query2 = "SELECT a.*, b.fullname
                FROM order_tbl a 
                INNER JOIN customer_tbl b on a.customer_id = b.customer_id 
                INNER JOIN order_value_tbl c ON a.order_id=c.order_id
                WHERE a.order_id='$order_id' GROUP BY a.order_id";
                $result2 = mysqli_query($dbc, $query2);
                $rows = mysqli_fetch_array($result2);


                while ($data = mysqli_fetch_array($result)) {
                    $myArray[] = $data;
                }


                $diskon = $rows['diskon'];
                $dp = $rows['dp'];
                $date1 = date_create($rows['pick_up_date']);
                $date2 = date_create($rows['return_date']);
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

                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Order Data Main</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Order ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['order_id'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Customer ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['customer_id'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Customer Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['fullname'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Order Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['order_date'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Pickup Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['pick_up_date'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Return Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['return_date'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Year Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['year'] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Item List</h4>
                                <h6 class="card-subtitle">Daftar Item Order</h6>
                                <form action="download_invoice_order" method="POST" enctype="multipart/form-data" target="_blank">
                                    <input type="hidden" name="order_id" value="<?= $rows['order_id'] ?>" />
                                    <input type="hidden" name="customer_id" value="<?= $rows['customer_id'] ?>" />
                                    <input type="hidden" name="fullname" value="<?= $rows['fullname'] ?>" />
                                    <input type="hidden" name="order_date" value="<?= $rows['order_date'] ?>" />
                                    <input type="hidden" name="pick_up_date" value="<?= $rows['pick_up_date'] ?>" />
                                    <input type="hidden" name="return_date" value="<?= $rows['return_date'] ?>" />
                                    <input type="hidden" name="diskon" value="<?= $rows['diskon'] ?>" />
                                    <input type="hidden" name="dp" value="<?= $rows['dp'] ?>" />
                                    <input type="hidden" name="totDays" value="<?= $totDays ?>" />
                                    <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                    <input type="hidden" name="curYear" value="<?= $rows['year'] ?>" />
                                    <button class="btn btn-warning float-right mb-4">Download PDF</button>
                                </form>
                                <!-- <a href="download_invoice_order?order_id=<?= $order_id ?>" target="_blank" class="btn btn-warning float-right mb-4">Download PDF</a> -->
                                <div class="table-responsive mt-4">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                    ?>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Item ID</th>
                                                    <th class="text-center">Item Name</th>
                                                    <th class="text-center">Qty (Days)</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $totalPrices = 0;
                                                foreach ($myArray as $data) {
                                                    $totalPrices = $totDays * $data['price'];
                                                    $grandTotal = $grandTotal + $totalPrices;
                                                ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['item_id'] ?></td>
                                                        <td><?= $data['item_name'] ?></td>
                                                        <td><?= $totDays . ' days' ?></td>
                                                        <td class="text-right"><?= rupiah($data['price']) ?></td>
                                                        <td class="text-right"><?= rupiah($totalPrices) ?></td>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" colspan="5">Sum Total</th>
                                                    <th class="text-right"><?= rupiah($grandTotal) ?></th>
                                                </tr>

                                                <tr>
                                                    <th class="text-center" colspan="5">Diskon</th>
                                                    <th class="text-right"><?= rupiah($diskon) ?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="5">Down Payment</th>
                                                    <th class="text-right"><?= rupiah(round($dp))  ?></th>
                                                </tr>

                                                <tr>
                                                    <th class="text-center" colspan="5">Total harus dibayar</th>
                                                    <th class="text-right"><?= rupiah(($grandTotal - $diskon) - $dp) ?></th>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    <?php }
                                    function rupiah($angka)
                                    {

                                        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                                        return $hasil_rupiah;
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>



                </div>




                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'include/footer.php'; ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php include 'include/footer_jquery.php'; ?>

    <script type="text/javascript">
        $('#test').change(function() {
            var span = $(this).next('span');
            span.text(span.data('val') * parseInt(this.value, 10))
        })
    </script>

</body>

</html>