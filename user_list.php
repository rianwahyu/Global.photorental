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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Guest List</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Guest</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Guest List</li>
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

                $query = " SELECT * FROM guest_tbl ";

                $result = mysqli_query($dbc, $query);

                $query2 = " SELECT MAX(guest_id) as guest_id FROM guest_tbl ";

                $result2 = mysqli_query($dbc, $query2);

                $rows = mysqli_fetch_array($result2);

                ?>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/users/addUsers.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Guest</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Guest ID</label>
                                        <input type="text" class="form-control" name="guest_id" required disabled value=<?= $rows['guest_id']+1?> />
                                        <input type="hidden" class="form-control" name="guest_id" required disabled value=<?= $rows['guest_id']+1?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Visit Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" class="form-control" name="name" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" autocomplete="off" reqired>
                                    </div>
                                    <div class="form-group">
                                        <label>Information Source</label>
                                        <input type="text" class="form-control" name="source_info" autocomplete="off" reqired>
                                    </div>

                                    <!-- <div class="form-group mt-2">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="itemDescription" autocomplete="off" reqired>
                                    </div> -->

                                    <!-- <div class="form-group mt-2">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option>Pilih Role / Jabatan</option>
                                            <option value="Karyawan">Guest</option>
                                        </select>
                                    </div> -->

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
                                <h4 class="card-title">Guest List</h4>
                                <h5 class="card-subtitle">Guest Name List at Senatah Adventure</h5>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Guest</button>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Guest ID</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Information Source</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>                                                        
                                                        <td><?= $data['guest_id']; ?></td>
                                                        <td><?= $data['date']; ?></td>
                                                        <td><?= $data['name']; ?></td>
                                                        <td><?= $data['address']; ?></td>
                                                        <td><?= $data['source_info']; ?></td>
                                                        <td>

                                                            <a href="#" data-toggle="modal" data-target="#updateUser<?= $data['guest_id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> Update</button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteUser<?= $data['guest_id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>
                                                            </a>

                                                            <div id="updateUser<?= $data['guest_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/users/editUsers.php" method="POST">
                                                                        <input type="hidden" name="guest_id" value="<?= $data['guest_id'] ?>" />
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Update Guest</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Visit Date</label>
                                                                                    <input type="date" class="form-control" name="date" value="<?= $data['date'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Fullname</label>
                                                                                    <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>">
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
                                                                                    <label>Information Source</label>
                                                                                    <input type="text" class="form-control" name="source_info" value="<?= $data['source_info'] ?>">
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

                                                            <div id="deleteUser<?= $data['guest_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/users/deleteUsers.php" method="POST">
                                                                    <input type="hidden" name="guest_id" value="<?= $data['guest_id'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Delete Guest
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Are you sure want to delete this guest?</p>

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
</body>

</html>