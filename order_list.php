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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order Form</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Order</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Add Order</li>
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
                    $query = "SELECT a.*, b.item_name, c.fullname, b.price 
                    FROM order_tbl a 
                    INNER JOIN item_tbl b ON a.item_id=b.item_id 
                    INNER JOIN customer_tbl c on a.customer_id = c.customer_id ";
                    $result = mysqli_query($dbc, $query);

                    ?>

                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Item List</h4>
                                <h6 class="card-subtitle">Item List</h6>

                                <a href="order_list"><button class="btn btn-success text-center">Display All</button></a>
                                <a href="order_add"><button class="btn btn-dark">Add Order</button></a>
                                <!-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Add Order</button> -->

                                <?php

                                if (isset($_GET)) {
                                    $search = $_GET['search'];
                                }

                                $myArrayTemp = array();

                                $customSearch = "";
                                $hasilPencarian = "";

                               /*  if (empty($search)) {
                                    $customSearch = "";
                                    $hasilPencarian = "";
                                } else {
                                    $hasilPencarian = "Hasil Pencarian :  $search";
                                    $customSearch = "(a.order_id LIKE '%$search%' OR a.order_date LIKE '%$search%' OR a.customer_id LIKE '%$search%' OR b.fullname LIKE '%$search%') ";
                                } */

                                if (empty($search)) {
                                    $customSearch = "";
                                    $hasilPencarian = "";
                                } else {

                                    $value = explode(' ', $search);
                                    $i = 0;
                                    $len = count($value);
                                    $q = "";
                                    foreach ($value as $val) {
                                        $q .= $val;
                                        if ($i != $len - 1) {
                                            $q .= " |";
                                        }
                                        $i++;
                                    }
                                    $hasilPencarian = "Hasil Pencarian :  $search";                                
                                    $search_exploded = explode(" ", $search);
                                    $x = 0;
                                    $construct = " ";
                                    foreach ($search_exploded as $search_each) {
                                        $x++;
                                        $construct .= " AND (a.order_id LIKE '%$search_each%' ";
                                        $construct .= "OR a.order_date LIKE '%$search_each%' ";
                                        $construct .= "OR a.customer_id LIKE '%$search_each%' ";
                                        $construct .= "OR a.status LIKE '%$search_each%' ";
                                        $construct .= "OR b.fullname LIKE '%$search_each%' )";
                                    }
                                    $construct .= "";
                                    $customSearch = $construct;
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

                                $query = "SELECT a.order_id, DATE_FORMAT(a.order_date, '%d-%m-%Y %H:%i:%s' ) as order_date, DATE_FORMAT(a.pick_up_date, '%d-%m-%Y %H:%i:%s') as pick_up_date, DATE_FORMAT(a.return_date, '%d-%m-%Y %H:%i:%s') as return_date, a.denda, a.diskon, a.dp,  b.fullname, SUM(c.total_price) as total_price, a.customer_id, a.status
                                FROM order_tbl a 
                                INNER JOIN customer_tbl b on a.customer_id = b.customer_id 
                                INNER JOIN order_value_tbl c ON a.order_id=c.order_id
                                WHERE 1 $customSearch AND a.status!='Done' GROUP BY a.order_id
                                ";
                                //echo $query;
                                $result = mysqli_query($dbc, $query);

                               

                                

                                ?>

                                <div class="table-responsive mt-4">
                                    <?=  $countTemp; ?>
                                    <!-- <table class="table" style="width: 100%;"> -->
                                    <table id="example" class="table table-striped table-bordered no-wrap">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-center">Order ID</th>
                                                <th class="text-center">Order Date</th>
                                                <th class="text-center">Customer ID</th>
                                                <th class="text-center">Customer Name</th>
                                                <th class="text-center">Pick Up Date</th>
                                                <th class="text-center">Return Date</th>
                                                <th class="text-center">Total Days</th>
                                                <th class="text-center">Penalty Amount</th>
                                                <th class="text-center">Discount</th>
                                                <th class="text-center">DP</th>
                                                <th class="text-center">Total Order</th>
                                                <th class="text-center">Underpayment</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($result)) {
                                                $myArrayTemp[] = $data;
                                                $date1 = date_create($data['pick_up_date']);
                                                $date2 = date_create($data['return_date']);
                                                $diff = date_diff($date1, $date2);
                                            ?>
                                                <tr>
                                                    <td><?= $data['order_id'] ?></td>
                                                    <td><?= $data['order_date'] ?></td>
                                                    <td><?= $data['customer_id'] ?></td>
                                                    <td><?= $data['fullname'] ?></td>
                                                    <td><?= str_replace('-', '-', $data['pick_up_date']) ?></td>
                                                    <td><?= str_replace('-', '-', $data['return_date']) ?></td>
                                                    <td><?= $diff->format("%d days") ?></td>
                                                    <td class="text-right"><?= rupiah($data['denda']) ?></td>
                                                    <td class="text-right"><?= rupiah($data['diskon']) ?></td>
                                                    <td class="text-right"><?= rupiah($data['dp']) ?></td>
                                                    <td class="text-right"><?= rupiah($data['total_price']) ?></td>
                                                    <td class="text-right"><?= rupiah(($data['total_price']) - $data['dp'])  ?></td>
                                                    <td><?= $data['status'] ?></td>
                                                    <td>

                                                        <a href="order_list_detail?order_id=<?= $data['order_id'] ?>">
                                                            <button type="button" class="btn btn-info btn-rounded"><i class="fas fa-eye"></i> </button>
                                                        </a>

                                                        <a href="#" data-toggle="modal" data-target="#updateOrder<?= $data['order_id']; ?>">
                                                            <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> </button>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#deleteOrder<?= $data['order_id']; ?>">
                                                            <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> </button>
                                                        </a>

                                                        <div id="updateOrder<?= $data['order_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <?php
                                                                include 'config/connection.php';

                                                                $order_date2 = $data['order_date'];
                                                                $pick_up_date2 = $data['pick_up_date'];
                                                                $return_date2 = $data['return_date'];

                                                                ?>?
                                                                <form class="mt-2" action="config/order/editTempOrder" method="POST">
                                                                    <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>" />
                                                                    <input type="hidden" name="item_id" value="<?= $data['item_id'] ?>" />
                                                                    <input type="hidden" name="price" value="<?= $data['price'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Update Order Data</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Order ID</label>
                                                                                <input type="text" class="form-control" name="order_id" value="<?= $data['order_id'] ?>" disabled />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Order Date</label>
                                                                                <input type="datetime-local" class="form-control" name="order_date" value="<?php echo
                                                                                                                                                            date('Y-m-d\TH:i', strtotime($order_date2)); ?>" />

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Customer ID</label>
                                                                                <input type="text" class="form-control" name="customer_id" value="<?= $data['customer_id'] ?>" disabled />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Customer Name</label>
                                                                                <input type="text" class="form-control" name="fullname" value="<?= $data['fullname'] ?>" disabled />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Pick Up Date</label>
                                                                                <input type="datetime-local" class="form-control" name="pick_up_date" value="<?php echo
                                                                                                                                                                date('Y-m-d\TH:i', strtotime($pick_up_date2)); ?>" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Return Date</label>
                                                                                <input type="datetime-local" class="form-control" name="return_date" value="<?php echo
                                                                                                                                                            date('Y-m-d\TH:i', strtotime($return_date2)); ?>" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Penalty Amount</label>
                                                                                <input type="number" class="form-control" name="denda" value="<?= $data['denda'] ?>" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Discount</label>
                                                                                <input type="number" class="form-control" name="diskon" value="<?= $data['diskon'] ?>" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Total Order</label>
                                                                                <input type="text" class="form-control" name="total_price" value="<?= rupiah(round($data['total_price'])) ?>" disabled />
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Down Payment (DP)</label>
                                                                                <input type="number" class="form-control" name="dp" value="<?= round($data['dp']) ?>" />
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Underpayment</label>
                                                                                <input type="text" class="form-control" value="<?= rupiah($data['total_price'] - $data['dp']) ?>" disabled />
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Status</label>
                                                                                <select name="status" class="form-control">
                                                                                    <option value="Pending Down Payment" <?= ($data['status'] == "Pending Down Payment") ? 'selected' : '' ?>>Pending Down Payment</option>
                                                                                    <option value="Booked" <?= ($data['status'] == "Booked") ? 'selected' : '' ?>>Booked</option>
                                                                                    <option value="On Going" <?= ($data['status'] == "On Going") ? 'selected' : '' ?>>On Going</option>
                                                                                    <option value="Done" <?= ($data['status'] == "Done") ? 'selected' : '' ?>>Done</option>
                                                                                    <option value="Cancel" <?= ($data['status'] == "Cancel") ? 'selected' : '' ?>>Cancel</option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                        <div id="deleteOrder<?= $data['order_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/order/deleteOrder" method="POST">
                                                                    <input type="text" name="order_id" value="<?= $data['order_id'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Hapus Barang
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin menghapus barang terpilih ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-outline-light">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </form>                                                                
                                                            </div>
                                                        </div>

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

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php
                    include 'config/connection.php';

                    $querys = "SELECT * FROM item_tbl ";
                    $results = mysqli_query($dbc, $querys);

                    ?>
                    <form class="mt-2" action="config/order/addTempOrder" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Order</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>


                            <div class="modal-body">
                                <input type="hidden" name="username" value="<?php echo $username ?>" />
                                <div class="form-group">
                                    <label>Item ID</label>
                                    <select class="form-control js-example-basic-single" name="item_id" id="item_id" style="width: 100%;">
                                        <option selected>Choose Item</option>
                                        <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                            <option value="<?= $datas['item_id'] ?>"><?= $datas['item_id'] ?> - <?= $datas['item_name'] ?></option>
                                        <?php } ?>
                                    </select>



                                    <div id="itemDetail">

                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>

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
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            "searching": false,
            "ordering": false
        });


        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>