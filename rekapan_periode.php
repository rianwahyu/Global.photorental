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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Report</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Report</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">By Period</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
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

                if (isset($_GET)) {
                    $text = $_GET['text'];
                    $dateStart = $_GET['dateStart'];
                    $dateEnd = $_GET['dateEnd'];
                }


                $query = "SELECT a.item_id, c.item_name, DATE_FORMAT(b.order_date, '%d-%m-%Y') as orderDate, b.pick_up_date as pickupDate, b.return_date as returnDate, b.return_date_real as returnDateReal, a.total_price as total, c.price
                FROM order_value_tbl a
                INNER JOIN order_tbl b ON a.order_id=b.order_id
                INNER JOIN item_tbl c ON a.item_id=c.item_id
                WHERE b.status='Done' AND (a.item_id LIKE '%$text%' OR c.item_name LIKE '%$text%')  AND (b.order_date BETWEEN '$dateStart 00:00:00' AND '$dateEnd 23:00:00') ";
                $result = mysqli_query($dbc, $query);

                //echo $query;
                ?>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Report</h4>
                                <h6 class="card-subtitle">By Period</h6>

                                <form class="form-inline" action="" method="GET">

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Input serial number / name" name="text" value="<?= $item_id ?>">
                                    </div>

                                    <div class="input-group ml-1">
                                        <input type="date" class="form-control" placeholder="Date Start" name="dateStart" value="<?= $dateStart ?>">
                                        <label class="ml-2"> to </label>
                                        <input type="date" class="form-control ml-2" placeholder="Date End" name="dateEnd" value="<?= $dateEnd ?>">

                                        <button type="submit" class="btn btn-primary ml-3" type="button">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rekapan</h4>
                                <h6 class="card-subtitle">Rekapan Order</h6>
                                <a href="rekapan_periode"><button class="btn btn-success text-center">Display All</button></a>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Data</button> -->
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {

                                        $grandTotal = 0;

                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        }
                                    ?>
                                        <form action="download/downloadExcelPeriode.php" method="POST" >
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="dateStart" value="<?= $dateStart ?>" />
                                            <input type="hidden" name="dateEnd" value="<?= $dateEnd ?>" />
                                            <input type="hidden" name="text" value="<?= $text ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <br><br>
                                        <table class="table table-bordered mt-4">
                                            <tr>
                                                <th>No</th>
                                                <th>Serial Number</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Pick up Date</th>
                                                <th>Return Date</th>
                                                <th>Total</th>
                                            </tr>

                                            <?php
                                            $i = 1;
                                            foreach ($myArray as $d) {
                                                //$grandTotal = $grandTotal + $d['total'];
                                                $date1 = date_create($d['pickupDate']);

                                                $dateReturn = new DateTime($d['returnDate']);
                                                $dateReal = new DateTime($d['returnDateReal']);

                                                $diff = $dateReal->diff($dateReturn);
                                                $hours = $diff->h;
                                                $hours = $hours + ($diff->days * 24);

                                                if ($hours >= 1) {
                                                    $date2 = $dateReturn;
                                                } else {
                                                    $date2 = date_create($d['returnDate']);
                                                }

                                                $diff = date_diff($date1, $date2);
                                                // $grandTotal = $grandTotal + (round($diff->format("%d")) * $d['total']);
                                                $grandTotal = $grandTotal +  $d['total'];

                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $d['item_id'] ?></td>
                                                    <td><?= $d['item_name'] ?></td>
                                                    <td><?= rupiah(round($d['price'])) ?></td>
                                                    <td><?= $d['pickupDate'] ?></td>
                                                    <!-- <td><?= $d['returnDate'] ?><br><?= $d['returnDateReal'] ?></td> -->
                                                    <td><?= $d['returnDate'] ?> <br> <?= ($hours >= 1) ? '<strong>Late return</strong>' : '' ?> </td>
                                                    <td class="text-right"><?= rupiah($d['total']) ?></td>
                                                </tr>

                                            <?php }
                                            ?>

                                            <tr>
                                                <th class="text-center" colspan="6">Grand Total</th>
                                                <th class="text-right"><?= rupiah($grandTotal) ?></th>
                                            </tr>

                                        </table>
                                    <?php } else {
                                        echo "<h4>Belum ada data</h4>";
                                    }
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

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="mt-2" action="config/buku/addBukuKasWarung.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Buku Kas Warung</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="username" value="<?php echo $username ?>" />
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="date" required />
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Debit</label>
                                            <!-- <input type="text" class="form-control text-right" name="debit" onkeypress="return isNumberKey(event)"> -->
                                            <select class="form-control" name="jenis" required>
                                                <option value="debit">Debit</option>
                                                <option value="kredit">Kredit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nilai</label>
                                            <input type="text" class="form-control text-right" name="nilai" onkeypress="return isNumberKey(event)" required>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="note" />
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <?php

            function bulan($arr)
            {
                $month = array();
                $i = 0;
                $monthTemp = "";
                foreach ($arr as $val) {
                    if ($monthTemp != $val["month"]) {
                        $month[$i] = $val["month"];
                        $month = $val["month"];
                        $i++;
                    }
                }
                return $month;
            }
            ?>

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

    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
</body>

</html>