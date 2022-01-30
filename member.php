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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Master Member</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Member</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Member List</li>
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

                $query = " SELECT a.member_id, a.customer_id, b.fullname, a.register_date FROM member_tbl a left outer join customer_tbl b on b.customer_id = a.customer_id ";

                $result = mysqli_query($dbc, $query);

                // $query2 = " SELECT MAX(id) as id FROM member_tbl ";

                // $result2 = mysqli_query($dbc, $query2);

                // $rows = mysqli_fetch_array($result2);

                $query2 = "select customer_id, fullname from customer_tbl order by customer_id ";
                $result2 = mysqli_query($dbc, $query);

                ?>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/merk/addMerk.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Member</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Member ID</label>
                                        <!-- <input type="text" class="form-control" name="id" required disabled value=<?= $rows['id']+1?> />
                                        <input type="hidden" class="form-control" name="id" required disabled value=<?= $rows['id']+1?> /> -->
                                        <input type="text" class="form-control" name="member_id" autocomplete="off" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Customer ID</label>
                                        <select class="form-control" name="merk">
                                            <option selected disabled>Choose Customer ID</option>
                                            <?php while ($data = mysqli_fetch_array($result2)) { ?>
                                                <option value="<?= $data['customer_id'] ?>"><?= $data['customer_id'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>                                   
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" class="form-control" name="fullname" autocomplete="off" required>
                                    </div>                                                                        
                                    <div class="form-group">
                                        <label>Regitered Date</label>
                                        <input type="date" class="form-control" name="register_date" autocomplete="off" required>
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
                                <h4 class="card-title">Member List</h4>
                                <h5 class="card-subtitle">Member List at Global Photorental</h5>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Member</button>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Merk ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>  
                                                        <td><?= $i++ ?></td>                                                      
                                                        <!-- <td><?= $data['id']; ?></td> -->
                                                        <td><?= $data['name']; ?></td>
                                                        <td>

                                                            <a href="#" data-toggle="modal" data-target="#updateUser<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> </button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteUser<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> </button>
                                                            </a>

                                                            <div id="updateUser<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/merk/editMerk.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Update Merk</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Name</label>
                                                                                    <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>">
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

                                                            <div id="deleteUser<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/merk/deleteMerk.php" method="POST">
                                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Delete Merk
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Are you sure want to delete this merk?</p>

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