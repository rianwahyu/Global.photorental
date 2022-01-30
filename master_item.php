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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Master Item</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Global Photorental</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Master Item</li>
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

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <?php
                        include 'config/connection.php';

                        $querys = "SELECT item_id from item_tbl order by item_id DESC LIMIT 1";
                        $results = mysqli_query($dbc, $querys);
                        $rows = mysqli_fetch_assoc($results);

                        $query = "select id, name from merk_tbl order by id ";
                        $result = mysqli_query($dbc, $query);

                        $query2 = "select id, category_name from category_tbl order by id ";
                        $result2 = mysqli_query($dbc, $query2);

                        $item_id = getSerialNumber();

                        function getSerialNumber()
                        {
                            include 'config/connection.php';
                            $kode = "A";
                            $item_id  = "";
                            $sql = "SELECT item_id 	FROM item_tbl ORDER BY item_id  DESC LIMIT 1 ";
                            $res  = mysqli_query($dbc, $sql);
                            $data = mysqli_fetch_assoc($res);
                            if (mysqli_num_rows($res) < 1) {
                                $item_id  = $kode . "0001";
                            } else {
                                $id = $data["item_id"];
                                $id = substr($id, 1);

                                $item_id  = $kode . str_pad($id + 1, 4, 0, STR_PAD_LEFT);
                            }

                            return $item_id;
                        }

                        ?>
                        <form class="mt-2" action="config/item/addItem" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Item</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <!-- <input type="text" class="form-control" name="item_id" required disabled value=<?= $item_id ?> /> -->
                                        <input type="text" class="form-control" name="item_id" required>
                                        <!-- <input type="text" class="form-control" name="item_id"> -->
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="item_name">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Merk</label>
                                        <select class="form-control" name="merk">
                                            <option selected disabled>Choose Merk</option>
                                            <?php while ($data = mysqli_fetch_array($result)) { ?>
                                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Category</label>
                                        <select class="form-control" name="category">
                                            <option selected disabled>Choose Category</option>
                                            <?php while ($data = mysqli_fetch_array($result2)) { ?>
                                                <option value="<?= $data['id'] ?>"><?= $data['category_name'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>

                                    <!-- <div class="form-group mt-2">
                                        <label>Stock</label>
                                        <input type="number" class="form-control" name="stock">
                                    </div> -->

                                    <!-- <div class="form-group mt-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Ready">Ready</option>
                                            <option value="Pending Down Payment">Pending Down Payment</option>
                                            <option value="Booked">Booked</option>
                                            <option value="On Going">On Going</option>
                                            <option value="Done">Done</option>
                                            <option value="Cancel">Cancel</option>
                                        </select>
                                    </div> -->

                                    <div class="form-group mt-2">
                                        <label>Purchase Date</label>
                                        <input type="date" class="form-control" name="tgl_pembelian">
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


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Master Item</h4>
                                <h6 class="card-subtitle">Master Item List</h6>
                                <a href="master_item"><button class="btn btn-success text-center">Display All</button></a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Item</button>
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>


                                <!-- <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form> -->

                                <?php

                                if (isset($_GET)) {
                                    $search = $_GET['search'];
                                }

                                $customSearch = "";
                                $hasilPencarian = "";

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
                                        $construct .= " AND (a.item_name LIKE '%$search_each%' ";
                                        $construct .= "OR b.name LIKE '%$search_each%' ";
                                        $construct .= "OR c.category_name LIKE '%$search_each%' ";
                                        $construct .= "OR a.item_id  LIKE '%$search_each%' ";
                                        $construct .= "OR e.status  LIKE '%$search_each%' ";
                                        $construct .= "OR a.merk LIKE '%$search_each%' )";
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

                                $query = "SELECT a.item_id, a.item_name, b.name, c.category_name, a.price, a.category, a.merk,  e.status,  DATE_FORMAT(a.tgl_pembelian, '%d-%m-%Y') as tgl_pembelian, DATE_FORMAT(e.pick_up_date, '%d-%m-%Y %H:%i%:%s') as pick_up_date, DATE_FORMAT(e.return_date, '%d-%m-%Y %H:%i%:%s') as return_date 
                                FROM `item_tbl` a 
                                left outer join merk_tbl b on b.id = a.merk 
                                left outer join category_tbl c on a.category = c.id 
                                LEFT OUTER JOIN order_value_tbl d ON a.item_id = d.item_id 
                                LEFT OUTER JOIN order_tbl e on d.order_id = e.order_id 
                                
                                WHERE 1 $customSearch order by e.pick_up_date DESC";

                                //echo $query;

                                $result = mysqli_query($dbc, $query);

                                ?>

                                <div class="table-responsive mt-5">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>

                                        <!-- <form action="config/item/downloadExcelItem.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form> -->
                                        <h4><?= $hasilPencarian ?></h4>
                                        <table id="example" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Serial Number</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Merk</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Price</th>
                                                    <!-- <th scope="col">Stock</th> -->
                                                    <th scope="col">Purchase Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Pick Up Date</th>
                                                    <th scope="col">Return Date</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['item_id']; ?></td>
                                                        <td><?= $data['item_name']; ?></td>
                                                        <td><?= $data['name']; ?></td>
                                                        <td><?= $data['category_name']; ?></td>
                                                        <td><?= rupiah($data['price']); ?></td>
                                                        <!-- <td><?= $data['stock']; ?></td> -->
                                                        <td><?= $data['tgl_pembelian']; ?></td>
                                                        <td><?= $data['status']; ?></td>
                                                        <td><?= $data['pick_up_date']; ?></td>
                                                        <td><?= $data['return_date']; ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateItem<?= $data['item_id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> </button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteItem<?= $data['item_id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> </button>
                                                            </a>
                                                        </td>

                                                        <div id="updateItem<?= $data['item_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <?php
                                                                include 'config/connection.php';

                                                                // $querys = "SELECT * FROM category ";
                                                                // $results = mysqli_query($dbc, $querys);

                                                                $querys = "SELECT id, name from merk_tbl order by id ";
                                                                $results = mysqli_query($dbc, $querys);

                                                                $querys2 = "SELECT id, category_name from category_tbl order by id ";
                                                                $results2 = mysqli_query($dbc, $querys2);


                                                                ?>?
                                                                <form class="mt-2" action="config/item/editItem" method="POST">
                                                                    <input type="hidden" name="item_id" value="<?= $data['item_id'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Update Item</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="form-group mt-2">
                                                                                <label>Item Name</label>
                                                                                <input type="text" class="form-control" name="item_name" value="<?= $data['item_name'] ?>">
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Merk</label>
                                                                                <select class="form-control" name="merk">
                                                                                    <option selected disabled>Choose Merk</option>
                                                                                    <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                                                                        <option value="<?= $datas['id'] ?>" <?= ($data['merk'] == $datas['id']) ? 'selected' : '' ?>><?= $datas['name'] ?></option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Category</label>
                                                                                <select class="form-control" name="category">
                                                                                    <option selected disabled>Choose Category</option>
                                                                                    <?php while ($datas = mysqli_fetch_array($results2)) { ?>
                                                                                        <option value="<?= $datas['id'] ?>" <?= ($data['category'] == $datas['id']) ? 'selected' : '' ?>><?= $datas['category_name'] ?></option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </div>


                                                                            <div class="form-group mt-2">
                                                                                <label>Price</label>
                                                                                <input type="number" class="form-control" name="price" value="<?= round($data['price']) ?>">
                                                                            </div>

                                                                            <!-- <div class="form-group mt-2">
                                                                                <label>Stock</label>
                                                                                <input type="number" class="form-control" name="stock" value="<?= $data['stock'] ?>">
                                                                            </div> -->

                                                                            <!-- <div class="form-group mt-2">
                                                                                <label>Status</label>
                                                                                <select name="status" class="form-control" disabled>
                                                                                    <option value="Ready" <?= ($data['status'] == "Ready") ? 'selected' : '' ?>>Ready</option>
                                                                                    <option value="Pending Down Payment" <?= ($data['status'] == "Pending Down Payment") ? 'selected' : '' ?>>Pending Down Payment</option>
                                                                                    <option value="Booked" <?= ($data['status'] == "Booked") ? 'selected' : '' ?>>Booked</option>
                                                                                    <option value="On Going" <?= ($data['status'] == "On Going") ? 'selected' : '' ?>>On Going</option>
                                                                                    <option value="Done" <?= ($data['status'] == "Done") ? 'selected' : '' ?>>Done</option>
                                                                                    <option value="Cancel" <?= ($data['status'] == "Cancel") ? 'selected' : '' ?>>Cancel</option>
                                                                                </select>
                                                                            </div> -->

                                                                            <div class="form-group mt-2">
                                                                                <label>Purchase Date</label>
                                                                                <input type="date" class="form-control" name="tgl_pembelian" value="<?= $data['tgl_pembelian'] ?>">
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

                                                        <div id="deleteItem<?= $data['item_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/item/deleteItem" method="POST">
                                                                    <input type="hidden" name="item_id" value="<?= $data['item_id'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Delete Item
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Are you sure want to delete this item?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-outline-light">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>


                                                    </tr>
                                                <?php }


                                                mysqli_close($dbc); ?>
                                            </tbody>
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