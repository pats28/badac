<?php
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
include('config.php');
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<!-- php -->
<?php
if (isset($_SESSION['add']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Category added!',
            showConfirmButton: false,
            // timer: 2000
        })
    </script>
<?php unset($_SESSION['add']); } ?>

<?php
if (isset($_SESSION['duplicate']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Category already exist!',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['duplicate']); } ?>

<?php
if (isset($_SESSION['edit']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Category updated',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['edit']); } ?>

<?php
if (isset($_SESSION['remove']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Category removed!',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['remove']); } ?>
<?php
$sqlCategory = "SELECT * FROM category WHERE IsDelete = 0 ORDER BY CategoryName ASC;";
$resultCategory = mysqli_query($con, $sqlCategory);
?>
<!-- end php -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Store Maintenance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
                        <li class="breadcrumb-item active">Store Maintenance</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->



    <div class="col-12">
        <div class="row">
            <!-- add category -->
            <div class="col-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Product Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="CategoryName">Category Name</label>
                                <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="#addCategory" data-toggle="modal">
                                <button type="button" class="btn btn-primary font-weight-bold btn-block ">
                                    Add Product Category</button></a>
                        </div>
                        <!-- modal -->
                        <div id="addCategory" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title">Add Product Category</h4>
                                        <button type="button" class="close font-weight-bolder text-white" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to add this product category?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="AddCategory"><span class="glyphicon glyphicon-edit"></span> Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['AddCategory'])) {
                        $CategoryName = $_POST['CategoryName'];
                        $checkCategory = "SELECT CategoryName FROM `category` WHERE CategoryName = '$CategoryName' AND IsDelete = 0";
                        // $checkResult = mysqli_query($con,$checkCategory);
                        if ($checkResult = mysqli_query($con,$checkCategory)) {
                            if (mysqli_num_rows($checkResult)>0) {
                                $_SESSION['duplicate'] = 1;
                                echo "<meta http-equiv='refresh' content='0'>";
                                echo '<script type="text/javascript">';
                                echo 'window.location.href="ar-store-category.php';
                                echo '</script>';
                            } else {
                                $CategoryName = $_POST['CategoryName'];
                                $sqlAddCategory = "INSERT INTO category (CategoryName) VALUES ('$CategoryName')";
                                mysqli_query($con, $sqlAddCategory);
                                $_SESSION['add'] = 1;
                                echo "<meta http-equiv='refresh' content='0'>";
                                echo '<script type="text/javascript">';
                                echo 'window.location.href="ar-store-category.php';
                                echo '</script>';
                            }
                            
                        } 
                            
                        
                    }
                    ?>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Product Category List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th style="width: 20px;" class="text-center">ID</th> -->
                                    <th>Category Name</th>
                                    <th class="w-25">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowCategory = mysqli_fetch_assoc($resultCategory)) :
                                    $CategoryId = $rowCategory['CategoryId'];
                                    $CategoryName = $rowCategory['CategoryName'];
                                ?>
                                    <tr>
                                        <!-- <td><?php echo $CategoryId; ?></td> -->
                                        <td class="text-capitalize"><?php echo $CategoryName; ?></td>
                                        <td><a href="#edit<?php echo $CategoryId; ?>" data-toggle="modal">
                                                <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold">
                                                    Edit</button></a>
                                            <a href="#remove<?php echo $CategoryId; ?>" data-toggle="modal">
                                                <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold">
                                                    Remove</button></a>
                                        </td>
                                    </tr>
                                    <!-- modal for edit -->
                                    <div id="edit<?php echo $CategoryId; ?>" class="modal fade" role="dialog">
                                        <form method="post">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h4 class="modal-title">Edit <?php echo $CategoryName; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="CategoryId" value="<?php echo $CategoryId ?>">
                                                        <div class="form-group">
                                                            <label for="CategoryName">Category Name:</label>
                                                            <input class="form-control" type="text" name="CategoryName" id="" value="<?php echo $CategoryName ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-primary" name="EditCategory"><span class="glyphicon glyphicon-edit"></span> Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- modal for remove -->
                                    <div id="remove<?php echo $CategoryId; ?>" class="modal fade" role="dialog">
                                        <form method="post">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title">Remove <?php echo $CategoryName; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="CategoryId" value="<?php echo $CategoryId; ?>">
                                                        Do you want to <span class="font-weight-bolder">remove</span> this product category?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-danger" name="RemoveCategory"><span class="glyphicon glyphicon-edit"></span> Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endwhile;
                                if (isset($_POST['EditCategory'])) {
                                    $CategoryId = $_POST['CategoryId'];
                                    $CategoryName = $_POST['CategoryName'];
                                    $sqlEditCategory = "UPDATE category SET CategoryName = '$CategoryName' WHERE CategoryId = '$CategoryId'";
                                    mysqli_query($con, $sqlEditCategory);
                                    $_SESSION['edit']=1;
                                    echo "<meta http-equiv='refresh' content='0'>";
                                    echo '<script type="text/javascript">';
                                    echo 'window.location.href="ar-store-category.php';
                                    echo '</script>';
                                }
                                if (isset($_POST['RemoveCategory'])) {
                                    $CategoryId = $_POST['CategoryId'];
                                    $sqlRemoveCategory = "UPDATE category SET IsDelete = 1 WHERE CategoryId = '$CategoryId'";
                                    mysqli_query($con, $sqlRemoveCategory);
                                    $_SESSION['remove']=1;
                                    echo "<meta http-equiv='refresh' content='0'>";
                                    echo '<script type="text/javascript">';
                                    echo 'window.location.href="ar-store-category.php';
                                    echo '</script>';
                                }
                                ?>
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- datatables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>