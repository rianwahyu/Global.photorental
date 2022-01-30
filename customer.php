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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer List</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Customer</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Customer List</li>
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

                $query = " SELECT * FROM customer_tbl ";

                $result = mysqli_query($dbc, $query);

                $query2 = " SELECT MAX(customer_id) as customer_id FROM customer_tbl ";

                $result2 = mysqli_query($dbc, $query2);

                $rows = mysqli_fetch_array($result2);


                $customer_id = getCustomerID();

                function getMemberID()
                {
                    include 'config/connection.php';
                    $kode = "M";
                    $member_id = "";
                    $sql = "SELECT member_id FROM customer_tbl ORDER BY member_id DESC LIMIT 1 ";
                    $res  = mysqli_query($dbc, $sql);
                    $data = mysqli_fetch_assoc($res);
                    if (mysqli_num_rows($res) < 1) {
                        $member_id = $kode . "0001";
                    } else {
                        $id = $data["member_id"];
                        $id = substr($id, 1);

                        $member_id = $kode . str_pad($id + 1, 4, 0, STR_PAD_LEFT);
                    }

                    return $member_id;
                }


                function getCustomerID()
                {
                    include 'config/connection.php';
                    $kode = "C";
                    $customer_id = "";
                    $sql = "SELECT customer_id	FROM customer_tbl ORDER BY customer_id DESC LIMIT 1 ";
                    $res  = mysqli_query($dbc, $sql);
                    $data = mysqli_fetch_assoc($res);
                    if (mysqli_num_rows($res) < 1) {
                        $customer_id = $kode . "0001";
                    } else {
                        $id = $data["customer_id"];
                        $id = substr($id, 1);

                        $customer_id = $kode . str_pad($id + 1, 4, 0, STR_PAD_LEFT);
                    }

                    return $customer_id;
                }


                ?>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/customer/addCustomer.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                        <input type="text" class="form-control" name="customer_id" autocomplete="off" value="<?= $customer_id ?>" disabled>
                                        <input type="hidden" class="form-control" name="customer_id" autocomplete="off" value="<?= $customer_id ?>">
                                        <!-- <input type="text" class="form-control" name="customer_id" required disabled value=<?= $rows['customer_id'] + 1 ?> />
                                        <input type="hidden" class="form-control" name="customer_id" required disabled value=<?= $rows['customer_id'] + 1 ?> /> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" class="form-control" name="fullname" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile 2</label>
                                        <input type="text" class="form-control" name="mobile_2" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Job TItle</label>
                                        <input type="text" class="form-control" name="job" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Office Address</label>
                                        <input type="text" class="form-control" name="office_address" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Member ID</label>
                                        <input type="text" class="form-control" name="member_id" autocomplete="off" value="<?= getMemberID() ?>" reqired disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Registered Date</label>
                                        <input type="date" class="form-control" name="registered_date" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram ID</label>
                                        <input type="text" class="form-control" name="instagram_id" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Identity ID</label>
                                        <input type="text" class="form-control" name="identity_id" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Identity Type</label>
                                        <select name="identity_type" class="form-control">
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="NPWP">NPWP</option>
                                            <option value="Passport">Passport</option>
                                            <option value="KK">KK</option>
                                            <option value="Kartu Tanda Mahasiswa">Kartu Tanda Mahasiswa</option>
                                            <option value="Kartu Tanda Pegawai">Kartu Tanda Pegawai</option>
                                            <option value="BPKB">BPKB</option>
                                            <option value="STNK">STNK</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Member ID</label>
                                        <input type="text" class="form-control" name="member_id" autocomplete="off" reqired>
                                    </div> -->

                                    <div class="form-group">
                                        <label>Emergency Contact Name</label>
                                        <input type="text" class="form-control" name="emergency_contact_name" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Emergency Contact Mobile</label>
                                        <input type="text" class="form-control" name="emergency_contact_mobile" autocomplete="off" reqired>
                                    </div>

                                    <div class="form-group">
                                        <label>Emergency Contact Relation</label>
                                        <input type="text" class="form-control" name="emergency_contact_relation" autocomplete="off" reqired>
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
                                <h4 class="card-title">Customer List</h4>
                                <h5 class="card-subtitle">Customer List at Global Photorental</h5>

                                <?php

                                if (isset($_GET)) {
                                    $search = $_GET['search'];
                                }

                                // $customSearch = "1";
                                // $hasilPencarian = "";

                                // if (empty($search)) {
                                //     $customSearch = "1";
                                //     $hasilPencarian = "";
                                // } else {
                                //     $hasilPencarian = "Hasil Pencarian :  $search";
                                //     $customSearch = "(fullname LIKE '%$search%' OR customer_id LIKE '%$search%' OR member_id LIKE '%$search%') ";
                                // }


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
                                        $construct .= " AND (fullname LIKE '%$search_each%' ";
                                        $construct .= "OR address LIKE '%$search_each%' ";
                                        $construct .= "OR mobile LIKE '%$search_each%' ";
                                        $construct .= "OR mobile_2 LIKE '%$search_each%' ";
                                        $construct .= "OR email LIKE '%$search_each%' ";
                                        $construct .= "OR job LIKE '%$search_each%' ";
                                        $construct .= "OR office_address LIKE '%$search_each%' ";
                                        $construct .= "OR instagram_id LIKE '%$search_each%' ";
                                        $construct .= "OR mobile LIKE '%$search_each%' ";
                                        $construct .= "OR member_id  LIKE '%$search_each%' ";
                                        $construct .= "OR customer_id LIKE '%$search_each%' )";
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

                                $query = "SELECT *
                                            FROM `customer_tbl` 
                                            WHERE 1 $customSearch order by customer_id";

                                $result = mysqli_query($dbc, $query);

                                ?>

                                <a href="customer"><button class="btn btn-success text-center">Display All</button></a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Customer</button>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) { ?>
                                        <table id="example" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Customer ID</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Mobile</th>
                                                    <th scope="col">Mobile 2</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">Job Title</th>
                                                    <th scope="col">Office Address</th>
                                                    <th scope="col">Member ID</th>
                                                    <th scope="col">Registered Date</th>
                                                    <th scope="col">Instagram ID</th>
                                                    <th scope="col">Identity ID</th>
                                                    <th scope="col">Identity Type</th>
                                                    <!-- <th scope="col">Member ID</th> -->
                                                    <th scope="col">Emergency Contact Mobile</th>
                                                    <th scope="col">Emergency Contact Name</th>
                                                    <th scope="col">Emergency Contact Relation</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?= $data['customer_id']; ?></td>
                                                        <td><?= $data['fullname']; ?></td>
                                                        <td><?= $data['address']; ?></td>
                                                        <td><?= $data['mobile']; ?></td>
                                                        <td><?= $data['mobile_2']; ?></td>
                                                        <td><?= $data['email']; ?></td>
                                                        <td><?= $data['job']; ?></td>
                                                        <td><?= $data['office_address']; ?></td>
                                                        <td><?= $data['member_id']; ?></td>
                                                        <td><?= $data['registered_date']; ?></td>
                                                        <td><?= $data['instagram_id']; ?></td>
                                                        <td><?= $data['identity_id']; ?></td>
                                                        <td><?= $data['identity_type']; ?></td>
                                                        <!-- <td><?= $data['member_id']; ?></td> -->
                                                        <td><?= $data['emergency_contact_mobile']; ?></td>
                                                        <td><?= $data['emergency_contact_name']; ?></td>
                                                        <td><?= $data['emergency_contact_relation']; ?></td>
                                                        <td>

                                                            <a href="#" data-toggle="modal" data-target="#updateUser<?= $data['customer_id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i></button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteUser<?= $data['customer_id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i></button>
                                                            </a>

                                                            <div id="updateUser<?= $data['customer_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/customer/editCustomer.php" method="POST">
                                                                        <input type="hidden" name="customer_id" value="<?= $data['customer_id'] ?>" />
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Update Customer</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>

                                                                            <div class="modal-body">`
                                                                                <div class="form-group">
                                                                                    <label>Fullname</label>
                                                                                    <input type="text" class="form-control" name="fullname" value="<?= $data['fullname'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Address</label>
                                                                                    <input type="text" class="form-control" name="address" value="<?= $data['address'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Mobile</label>
                                                                                    <input type="text" class="form-control" name="mobile" value="<?= $data['mobile'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Mobile 2</label>
                                                                                    <input type="text" class="form-control" name="mobile_2" value="<?= $data['mobile_2'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>E-mail</label>
                                                                                    <input type="text" class="form-control" name="email" value="<?= $data['email'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Job Title</label>
                                                                                    <input type="text" class="form-control" name="job" value="<?= $data['job'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Office Address</label>
                                                                                    <input type="text" class="form-control" name="office_address" value="<?= $data['office_address'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Member ID</label>
                                                                                    <input type="text" class="form-control" name="member_id" value="<?= $data['member_id'] ?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Registered Date</label>
                                                                                    <input type="date" class="form-control" name="registered_date" value="<?= $data['registered_date'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Instagram ID</label>
                                                                                    <input type="text" class="form-control" name="instagram_id" value="<?= $data['instagram_id'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Identity ID</label>
                                                                                    <input type="text" class="form-control" name="identity_id" value="<?= $data['identity_id'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Identity Type</label>
                                                                                    <select name="identity_type" class="form-control">
                                                                                        <option value="KTP">KTP</option>
                                                                                        <option value="SIM">SIM</option>
                                                                                        <option value="NPWP">NPWP</option>
                                                                                        <option value="Passport">Passport</option>
                                                                                        <option value="KK">KK</option>
                                                                                        <option value="Kartu Tanda Mahasiswa">Kartu Tanda Mahasiswa</option>
                                                                                        <option value="Kartu Tanda Pegawai">Kartu Tanda Pegawai</option>
                                                                                        <option value="BPKB">BPKB</option>
                                                                                        <option value="STNK">STNK</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Member ID</label>
                                                                                    <input type="text" class="form-control" name="member_id" value="<?= $data['member_id'] ?>">
                                                                                </div>
                                                                            </div> -->

                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Emergency Contact Name</label>
                                                                                    <input type="text" class="form-control" name="emergency_contact_name" value="<?= $data['emergency_contact_name'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Emergency Contact Mobile</label>
                                                                                    <input type="text" class="form-control" name="emergency_contact_mobile" value="<?= $data['emergency_contact_mobile'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Emergency Contact Relation</label>
                                                                                    <input type="text" class="form-control" name="emergency_contact_relation" value="<?= $data['emergency_contact_relation'] ?>">
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

                                                            <div id="deleteUser<?= $data['customer_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="config/customer/deleteCustomer.php" method="POST">
                                                                        <input type="hidden" name="customer_id" value="<?= $data['customer_id'] ?>" />
                                                                        <div class="modal-content modal-filled bg-danger">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="fill-danger-modalLabel">Delete Customer
                                                                                </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Are you sure want to delete this customer?</p>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-outline-light">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php }

                                                mysqli_close($dbc); ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "<h4>No data display</h4>";
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>
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