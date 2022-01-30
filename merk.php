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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Master Merk</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Merk</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Merk List</li>
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

                $query = " SELECT * FROM merk_tbl ";

                $result = mysqli_query($dbc, $query);

                $query2 = " SELECT MAX(id) as id FROM merk_tbl ";

                $result2 = mysqli_query($dbc, $query2);

                $rows = mysqli_fetch_array($result2);

                ?>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/merk/addMerk.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Merk</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Merk ID</label>
                                        <input type="text" class="form-control" name="id" required disabled value=<?= $rows['id']+1?> />
                                        <input type="hidden" class="form-control" name="id" required disabled value=<?= $rows['id']+1?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" autocomplete="off" required>
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
                                <h4 class="card-title">Merk List</h4>
                                <h5 class="card-subtitle">Merk List at Global Photorental</h5>

                                <?php

                                if (isset($_GET)) {
                                    $search = $_GET['search'];
                                }

                              

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
                                        $construct .= " AND (name LIKE '%$search_each%' ";
                                        // $construct .= "OR b.name LIKE '%$search_each%' ";
                                        // $construct .= "OR c.category_name LIKE '%$search_each%' ";
                                        // $construct .= "OR a.item_id  LIKE '%$search_each%' ";
                                        $construct .= "OR id LIKE '%$search_each%' )";
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
                                                <input type="text" class="form-control" name="search" placeholder="Search Here" value="<?=$search?>" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit" >Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-4"></div>
                                </div>


                                <?php
                                include 'config/connection.php';

                                $query = "SELECT a.id, a.name
                                            FROM `merk_tbl` a 
                                            WHERE 1 $customSearch order by a.id";

                                $result = mysqli_query($dbc, $query);

                                ?>
                               
                                <a href="merk"><button class="btn btn-success text-center">Display All</button></a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Merk</button> 

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) { ?>
                                        <table id="example" class="table table-striped table-bordered no-wrap">
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