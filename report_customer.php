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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Rekap Customer Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div> -->
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
                <div class="row">
                    <?php

                    include 'config/connection.php';
                    $query = "select a.customer_id, b.fullname, b.member_id, b.registered_date, count(a.order_id) as jml from order_tbl a
                    inner join customer_tbl b on a.customer_id = b.customer_id group by a.customer_id order by a.customer_id ";
                    $result = mysqli_query($dbc, $query);

                    ?>

                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rekapan Customer</h4>
                                <h6 class="card-subtitle">Rekapan Customer</h6>

                                <a href="report_customer"><button class="btn btn-success text-center">Display All</button></a>

                                <?php

                                if (isset($_GET)) {
                                    $search = $_GET['search'];
                                }

                                $customSearch = "1";
                                $hasilPencarian = "";

                                if (empty($search)) {
                                    $customSearch = "1";
                                    $hasilPencarian = "";
                                } else {
                                    $hasilPencarian = "Hasil Pencarian :  $search";
                                    $customSearch = "(a.customer_id LIKE '%$search%' OR b.fullname LIKE '%$search%' OR b.member_id LIKE '%$search%') ";
                                }
                                ?>

                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <form action="" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="Search Here" value="<?= $search ?>" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-4"></div>
                                </div>


                                <?php
                                include 'config/connection.php';

                                $query = "SELECT b.customer_id, c.fullname, c.member_id, c.registered_date, count(a.order_id) as jml 
                                from order_value_tbl a
                                INNER JOIN order_tbl b ON a.order_id=b.order_id
                                inner join customer_tbl c on b.customer_id = c.customer_id 
                                WHERE $customSearch AND b.status='Done' 
                                Group by b.customer_id order by b.customer_id ";
                                // echo $query;
                                $result = mysqli_query($dbc, $query);

                                while ($data = mysqli_fetch_array($result)) {
                                    $myArray[] = $data;
                                }


                                ?>

                                <div class="table-responsive mt-4">

                                    <form action="download/downloadExcelCustomer.php" method="POST">
                                        <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                        <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                    </form>
                                    <br><br>

                                    <table class="table" style="width: 100%;">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-center">Customer ID</th>
                                                <th class="text-center">Customer Name</th>
                                                <th class="text-center">Member ID</th>
                                                <th class="text-center">Registered Date</th>
                                                <th class="text-center">Jumlah Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($myArray as $data) { ?>
                                                <tr>
                                                    <!-- <td><?= $i++ ?></td> -->
                                                    <td><?= $data['customer_id'] ?></td>
                                                    <td><?= $data['fullname'] ?></td>
                                                    <td><?= $data['member_id'] ?></td>
                                                    <td><?= $data['registered_date'] ?></td>
                                                    <td><?= $data['jml'] ?></td>

                                                    </td>
                                                </tr>
                                            <?php }

                                            function rupiah($angka)
                                            {

                                                $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                                                return $hasil_rupiah;
                                            }
                                            ?>
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    <?php include 'include/footer_jquery.php' ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        // $(document).ready(function() {
        //     $('.js-example-basic-single2').select2();
        // });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#itemDetail").hide();
            $('body').on("change", "#item_id", function() {
                var id = $(this).val();
                var data = "id=" + id;
                $.ajax({
                    type: 'POST',
                    url: "get_item.php",
                    data: data,
                    success: function(hasil) {
                        $('.js-example-basic-single2').select2();
                        $("#itemDetail").html(hasil);
                        $("#itemDetail").show();
                    }
                });
            });
        });
    </script>

    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <script>
        var el = $('.item_id').combobox();

        el.on('change', function(e) {
            if ($(this).data('item_id').$element.val() == '') {
                console.log('Its triggered incorrectly');
                return false;
            }

            var dic = $(this).data('item_id').map,
                val = $(this).val(),
                clean = true;

            for (var i in dic) {
                if (!dic.hasOwnProperty(i)) continue;
                if (dic[i] == val) {
                    console.log(dic[i], i); // dic[i] = value, i = label
                    clean = false;
                    break;
                }
            }

            if (clean)
                console.log('Input was cleared');
        })
    </script>
</body>

</html>