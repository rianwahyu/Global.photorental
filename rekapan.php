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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Sold Item</li>
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
                    $tahun = $_GET['tahun'];
                }


                $queryPackage = "SELECT item_id,item_name FROM `item_tbl` WHERE 1";
                $resultpackage = mysqli_query($dbc, $queryPackage);
                while ($dataPackage = mysqli_fetch_array($resultpackage)) {
                    $myArrayPackage[] = $dataPackage;
                }

                $query1 = " SELECT month, monthNumber FROM 
                (SELECT DATE_FORMAT(order_date, '%M') as month, DATE_FORMAT(order_date, '%m') as monthNumber 
                FROM order_tbl  
                WHERE YEAR(order_date)='$tahun') a 
                GROUP BY month ORDER BY monthNumber ASC ";
                $result1 = mysqli_query($dbc, $query1);
                while ($data1 = mysqli_fetch_array($result1)) {
                    $myArray1[] = $data1;
                }


                $query = "SELECT item_id, item_name, month, SUM(total_price) as total 
                FROM (SELECT a.item_id, a.item_name, IFNULL(DATE_FORMAT(c.order_date, '%M'), '-') as month , DATEDIFF(`return_date_real`, `pick_up_date`) AS days, COALESCE(b.total_price,0) as total_price 
                      FROM item_tbl a 
                      LEFT JOIN order_value_tbl b ON a.item_id=b.item_id 
                      LEFT JOIN order_tbl c ON b.order_id=c.order_id AND YEAR(c.order_date) = '$tahun' AND c.status='Done'
                      WHERE 1  GROUP BY a.item_id, DATE_FORMAT(c.order_date, '%M') ) a GROUP BY a.item_id, month ";
                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tahun Rekapan</h4>
                                <h6 class="card-subtitle">Pilih tahun rekapan</h6>

                                <form class="form-inline" action="" method="GET">
                                    <div class="input-group">
                                        <input class="ml-2" type="text" class="form-control" placeholder="Tahun" name="tahun" value="<?= $tahun ?>">

                                        <button type="submit" class="btn btn-outline-secondary ml-4" type="button">Cari</button>
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
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Data</button> -->
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result1) >= 1) {

                                         

                                        $grandTotal = 0;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        }
                                    ?>
                                        <form action="download/downloadExcelRekapan.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArrayPackage" value="<?php echo htmlentities(serialize($myArrayPackage)); ?>" />
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="myArray1" value="<?php echo htmlentities(serialize($myArray1)); ?>" />
                                            <input type="hidden" name="tahun" value="<?= $tahun ?>"/>
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table table-bordered">

                                            <tr>
                                                <th class="text-center" scope="col">ITEM NAME</th>
                                                <?php foreach ($myArray1 as $data1) {
                                                    echo "<th class='text-center'>" . $data1['month'] . "</th>";
                                                }
                                                ?>
                                            </tr>

                                            <?php

                                            foreach ($myArrayPackage as $dataPackage) {
                                                echo "<tr>";
                                                echo "<td>" . $dataPackage['item_name'] . "</td>";

                                                foreach ($myArray1 as $data1) {
                                                    echo "<td class='text-right'>";
                                                    foreach ($myArray as $data) {
                                                        if ($dataPackage['item_id'] == $data['item_id']) {
                                                            if ($data['month'] == $data1['month']) {
                                                                echo rupiah($data['total']);
                                                                $grandTotal = $grandTotal + $data['total'];
                                                            } elseif ($data['month'] == "-") {
                                                                echo rupiah(0);
                                                                $grandTotal = $grandTotal + 0;
                                                            }
                                                        }
                                                    }
                                                    echo "</td>";
                                                }
                                                echo "</tr>";
                                            }
                                            ?>

                                            <tr>
                                                <th class="text-center" scope="col">Grand Total</th>
                                                <?php foreach ($myArray1 as $data1) {
                                                    echo "<th class='text-right'>" . rupiah($grandTotal) . "</th>";
                                                }
                                                ?>
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