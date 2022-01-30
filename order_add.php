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
                    $querys = "SELECT customer_id, fullname FROM `customer_tbl` WHERE 1";
                    $results = mysqli_query($dbc, $querys);
                    ?>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Form Data</h4>
                                <h6 class="card-subtitle"></h6>

                                <div class="form-body mt-4">
                                    <label>Customer</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select class="form-control js-example-basic-single2" style="width: 100%;" name="customer_id" id="customer_id">
                                                        <option selected>Choose Customer</option>
                                                        <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                                            <option value="<?= $datas['customer_id'] ?>"><?= $datas['customer_id'] . "-" . $datas['fullname'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Order Date</label>
                                                    <input type="datetime-local" class="form-control" name="order_date" id="order_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Pickup Date</label>
                                                    <input type="datetime-local" class="form-control" name="pick_up_date" id="pick_up_date" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Return Date</label>
                                                    <input type="datetime-local" class="form-control" name="return_date" id="return_date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input type="number" class="form-control" name="diskon" id="diskon" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Down Payment (DP)</label>
                                                    <input type="number" class="form-control" name="dp" id="dp" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="text-right">
                                            <button id="submitHeader" name="submitHeader" class="btn btn-info">Submit</button>
                                            <!-- <button type="reset" class="btn btn-dark">Reset</button> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Item List</h4>
                                <h6 class="card-subtitle">Item List</h6>

                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Add Item</button>
                                <div class="table-responsive mt-4">
                                    <div id="data-cart">
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="text-right">
                                    <button id="submitConfirmOrder" name="submitConfirmOrder" class="btn btn-success">Confirm Order List</button>
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

                    //$querys = "SELECT * FROM item_tbl ";
                    $querys = "SELECT a.item_id, a.item_name, IFNULL(c.order_id,'') as order_id, IFNULL(c.return_date, '') as return_date, IFNULL(c.status,'') as status
                    FROM item_tbl a 
                    LEFT JOIN order_value_tbl b ON a.item_id=b.item_id
                    LEFT JOIN order_tbl c ON b.order_id=c.order_id and c.status not in ('Booked','On Going')
                    where a.item_id not in 
                    (select ov.item_id from order_value_tbl ov left join order_tbl o on ov.order_id = o.order_id 
                    where now() between o.pick_up_date and o.return_date and o.status in ('Booked','On Going'))
                    GROUP BY a.item_id;";
                    $results = mysqli_query($dbc, $querys);

                    ?>
                    <form role="form" action="" id="form-add-cart" name="form-add-cart" method="POST">
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
                                <button id="submitCart" name="submitCart" type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <?php include 'include/footer.php'; ?>

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
            $('.js-example-basic-single2').select2();
            $('.js-example-basic-single').select2();
        });
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

            load_data();

            $("#form-add-cart").submit(function(e) {
                e.preventDefault();

                var dataform = $("#form-add-cart").serialize();
                $.ajax({
                    url: "config/order/addTempOrder2.php",
                    type: "POST",
                    data: dataform,
                    beforeSend: function() {
                        // Show image container
                        //$("#overlay").show();
                    },
                    success: function(result) {
                        var hasil = JSON.parse(result);
                        if (hasil.hasil !== "success") {} else {
                            $('#myModal').modal('hide');
                            load_data();
                        }
                    }
                });
            });

            $(document).on('click', '#deleteTemp', function(e) {
                e.preventDefault();

                //var dataform = $("#form-add-cart").serialize();
                var id= $(this).attr('data-id');
                $.ajax({
                    url: "config/order/deleteTempOrder.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        // Show image container
                        //$("#overlay").show();
                    },
                    success: function(result) {
                        var hasil = JSON.parse(result);
                        if (hasil.hasil !== "success") {} else {                            
                            load_data();
                        }
                    }
                });
            });

            $("#submitHeader").click(function() {
                var order_date = $("#order_date").val();
                var return_date = $("#return_date").val();
                var pick_up_date = $("#pick_up_date").val();

                var diskon = $("#diskon").val();
                var dp = $("#dp").val();

                load_data(pick_up_date, return_date, diskon, dp);

            });

            function load_data(pick_up_date, return_date, diskon, dp) {
                $.ajax({
                    url: "order_add_data.php",
                    method: "POST",
                    data: {
                        pick_up_date: pick_up_date,
                        return_date: return_date,
                        diskon: diskon,
                        dp: dp
                    },
                    success: function(data) {
                        $('#data-cart').html(data);
                    }
                })
            }

            $("#submitConfirmOrder").click(function() {
                var customer_id = $("#customer_id").val();
                var order_date = $("#order_date").val();
                var return_date = $("#return_date").val();
                var pick_up_date = $("#pick_up_date").val();

                var diskon = $("#diskon").val();
                var dp = $("#dp").val();

                $.ajax({
                    url: "config/order/addOrder.php",
                    method: "POST",
                    data: {
                        customer_id: customer_id,
                        order_date: order_date,
                        pick_up_date: pick_up_date,
                        return_date: return_date,
                        diskon: diskon,
                        dp: dp
                    },
                    success: function(result) {
                        var hasil = JSON.parse(result);
                        if (hasil.hasil == "success") {
                            alert("Sukses");
                            window.location = "order_list.php";
                        } else {
                        }

                    }
                })

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