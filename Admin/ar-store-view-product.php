<?php
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
include('config.php');
$StoreId = $_GET['StoreId'];
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<!-- php -->
<?php
$sqlStore = "SELECT * FROM store WHERE isdelete = 0 AND StoreId = '$StoreId';";
$resultStore = mysqli_query($con, $sqlStore);
$rowStore = mysqli_fetch_assoc($resultStore);

$sqlProducts = "SELECT * FROM `materialslist` JOIN category on materialslist.CategoryId = category.CategoryId WHERE StoreId = '$StoreId' AND materialslist.IsDelete = 0;";
$resultProducts = mysqli_query($con, $sqlProducts);
// $rowStore = mysqli_fetch_assoc($resultStore);
?>
<!-- end php -->
<!-- Content Wrapper. Contains page content -->
<?php
if (isset($_SESSION['remove']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Product removed',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['remove']);
} ?>
<?php
if (isset($_SESSION['update']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Product updated',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['update']);
} ?>
<!--  -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update products from <span class="font-weight-bolder text-capitalize"><?php echo $rowStore['StoreName']; ?></span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="ar-store-update-product.php">Store Maintenance</a></li>
                        <li class="breadcrumb-item active">Update Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <!-- <div class="card-header">
                <h3 class="card-title">Update products</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rowProducts = mysqli_fetch_assoc($resultProducts)) :
                            $EquipId = $rowProducts['EquipId'];
                            $EquipImage = $rowProducts['EquipImage'];
                            $EquipName = $rowProducts['EquipName'];
                            $CategoryName = $rowProducts['CategoryName'];
                            $CategoryId = $rowProducts['CategoryId'];
                            $Price = $rowProducts['Price'];
                            $ProdDescription = $rowProducts['Description'];
                        ?>
                            <tr>
                                <td class="text-center"><img src='images/<?php echo $EquipImage; ?>' style='min-height: 40px;min-width: 40px;height:60px;width:60px;'></td>
                                <td class="text-capitalize"><?php echo $EquipName; ?></td>
                                <td><?php echo $CategoryName; ?></td>
                                <td>₱ <?php echo number_format($Price, 2, '.', ''); ?></td>
                                <td style="max-width: 90px;" class="text-truncate"><?php echo $ProdDescription; ?></td>
                                <td><a href="#update<?php echo $EquipId; ?>" data-toggle="modal">
                                        <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold ">
                                            Update</button></a>
                                    <a href="#remove<?php echo $EquipId; ?>" data-toggle="modal">
                                        <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold">
                                            Remove</button></a>
                                </td>
                            </tr>
                            <!-- end tr -->
                            <!-- modal for update -->
                            <div id="update<?php echo $EquipId; ?>" class="modal fade" role="dialog">
                                <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-md">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning shadow-sm">
                                                <h4 class="modal-title">Update <?php echo $EquipName; ?></h4>
                                                <button type="button" class="close text-white font-weight-bolder" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="card mt-3 ml-2">
                                                            <!-- <h6 for="">Product Image</h6> -->
                                                            <img src="images/<?php echo $EquipImage; ?>" class="img-fluid shadow rounded" alt="" srcset="">
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="EquipId" value="<?php echo $EquipId; ?>">
                                                            <div class="form-group">
                                                                <label for="EquipImage">Product Image:</label>
                                                                <div class="form-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="customFile" accept="image/x-png,image/gif,image/jpeg" name="image" value="images/<?php echo $EquipImage; ?>">
                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                <label for="ProductName">Product Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ProductName" name="EquipName" value="<?php echo $EquipName ?>" required autofocus>
                                                                </div>
                                                                <label for="Category">Product Category:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="Category" required>
                                                                        <option selected="selected" value="<?php echo $CategoryId ?>"><?php echo $CategoryName ?></option>
                                                                        <?php
                                                                        $sqlCategory = "SELECT * FROM category WHERE IsDelete = 0;";
                                                                        $resultCategory = mysqli_query($con, $sqlCategory);
                                                                        while ($rowCategory = mysqli_fetch_assoc($resultCategory)) :
                                                                            $CategoryId = $rowCategory['CategoryId'];
                                                                            $CategoryName = $rowCategory['CategoryName']; ?>
                                                                            <option value="<?php echo $CategoryId; ?>"><?php echo $CategoryName; ?></option>;
                                                                        <?php endwhile; ?>
                                                                    </select>
                                                                </div>
                                                                <label for="Price">Price:</label>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text text-lg-center font-weight-bolder">₱</span>
                                                                        </div>
                                                                        <input type="number" class="form-control" id="Price" name="Price" value="<?php echo $Price ?>" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <label for="Description">Product Description:</label>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="Description" rows="3" required><?php echo $ProdDescription ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                            <button type="submit" class="btn btn-primary shadow" name="UpdateProduct"><span class="glyphicon glyphicon-edit"></span> Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                </form>
                            </div>

            </div>
        </div>
</div>
<!-- end modal update -->
<!-- modal for remove -->
<div id="remove<?php echo $EquipId; ?>" class="modal fade" role="dialog">
    <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Remove product from the list </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="EquipId" value="<?php echo $EquipId; ?>">
                    Are you sure you want to remove <span class="font-weight-bolder"><?php echo $EquipName; ?></span> from the list?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                    <button type="submit" class="btn btn-danger" name="RemoveProduct"><span class="glyphicon glyphicon-edit"></span> Remove Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- end modal update -->
<?php endwhile;
                        if (isset($_POST['UpdateProduct'])) {
                            $EquipId = $_POST['EquipId'];
                            // $image = $_FILES['photo']['name'];
                            $fileElementName = 'image';
                            $path = 'images/';
                            $location = $path . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $location);
                            $image = $_FILES['image']['name'];
                            $EquipName = $_POST['EquipName'];
                            $CategoryId = $_POST['Category'];
                            $Price = $_POST['Price'];
                            $Description = $_POST['Description'];
                            if (!empty($_FILES['image']['name'])) {
                                $sqlUpdateProduct = "UPDATE materialslist SET EquipImage = '$image', EquipName = '$EquipName', CategoryId = '$CategoryId', Price = '$Price', Description = '$Description' WHERE EquipId = '$EquipId'";
                                mysqli_query($con, $sqlUpdateProduct);
                            } else {
                                $sqlUpdateProduct = "UPDATE materialslist SET EquipName = '$EquipName', CategoryId = '$CategoryId', Price = '$Price', Description = '$Description' WHERE EquipId = '$EquipId'";
                                mysqli_query($con, $sqlUpdateProduct);
                            }
                            // $page = $_SERVER['REQUEST_URI'];
                            $_SESSION['update'] = 1;
                            echo "<meta http-equiv='refresh' content='0'>";
                            echo '<script type="text/javascript">';
                            echo 'window.location.href="ar-store-view-product.php?"$StoreId";';
                            echo '</script>';
                        }
                        if (isset($_POST['RemoveProduct'])) {
                            $EquipIdd = $_POST['EquipId'];
                            $sqlRemoveProduct = "UPDATE materialslist SET IsDelete = '1' WHERE EquipId = '$EquipIdd'";
                            mysqli_query($con, $sqlRemoveProduct);
                            // $page = $_SERVER['REQUEST_URI'];
                            $_SESSION['remove'] = 1;
                            echo "<meta http-equiv='refresh' content='0'>";
                            echo '<script type="text/javascript">';
                            echo 'window.location.href="ar-store-view-product.php?"$StoreId";';
                            echo '</script>';
                        }
?>
</tbody>
</table>

<!-- end modal -->
</div>
<!-- /.card-body -->
</div>
</section>
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
<!-- tusta -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- datatables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- SweetAlert2 -->

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