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
if (isset($_SESSION['addproduct']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Product added!',
            showConfirmButton: true,
            timer: 2000
        })
    </script>
<?php unset($_SESSION['addproduct']);
} ?>
<?php
$sqlStore = "SELECT * FROM store WHERE isdelete = 0 ORDER BY StoreName ASC;";
$resultStore = mysqli_query($con, $sqlStore);
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
    <section class="content">
        <div class="card">
            <div class="card-header" style="background-color: #708090">
                <h3 class="card-title" style="color: white">Add product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rowStore = mysqli_fetch_assoc($resultStore)) :
                            $StoreId = $rowStore['StoreId'];
                            $StoreName = $rowStore['StoreName'];
                            $Address = $rowStore['Address'];
                            $Email = $rowStore['Email'];
                        ?>
                            <tr>
                                <td><?php echo $StoreName; ?></td>
                                <td><?php echo $Address; ?></td>
                                <td><?php echo $Email; ?></td>
                                <td><a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
                                        <button type="button" class="btn btn-primary btn-sm btn-block font-weight-bold shadow">
                                            Add product to <span class="text-capitalize"><?php echo $StoreName; ?></span></button></a></td>
                            </tr>
                            <!-- modal for add product -->
                            <div id="add<?php echo $StoreId; ?>" class="modal fade" role="dialog">
                                <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-md rounded">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary shadow-sm">
                                                <h4 class="modal-title">Add product to <?php echo $StoreName; ?></h4>
                                                <button type="button" class="close text-white text-bold" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="StoreId" value="<?php echo $StoreId; ?>">
                                                <div class="form-group">
                                                    <label for="EquipImage">Product Image:</label>
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" accept="image/x-png,image/gif,image/jpeg" name="image" required>
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <label for="ProductName">Product Name:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-capitalize" id="ProductName" name="EquipName" required autofocus>
                                                    </div>
                                                    <label for="Category">Product Category:</label>
                                                    <div class="form-group">
                                                        <select class="form-control" name="Category" required>
                                                            <option hidden="" disabled="disabled" selected="selected" value="">Choose Category</option>
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
                                                            <input type="number" class="form-control" id="Price" name="Price" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="callout callout-info shadow">
                                                        <!-- <h5>I am an info callout!</h5> -->
                                                        <p>Product description can be products dimension, weight, quantity per unit etc. e.g. 100 x 100 x 90</p>
                                                    </div>
                                                    <label for="Description">Product Description:</label>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="Description" rows="2" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                <button type="submit" class="btn btn-primary shadow" name="AddProduct"><span class="glyphicon glyphicon-edit"></span> Add product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endwhile;
                        if (isset($_POST['AddProduct'])) {
                            // $ImageName = $_FILES['photo']['name'];
                            $fileElementName = 'image';
                            $path = 'images/';
                            $location = $path . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $location);
                            $EquipImage = $_FILES['image']['name'];
                            $EquipName = $_POST['EquipName'];
                            $CategoryId = $_POST['Category'];
                            $Price = $_POST['Price'];
                            $Description = $_POST['Description'];
                            $StoreId = $_POST['StoreId'];
                            $isdelete = 0;
                            $sqlAddProduct = "INSERT INTO materialslist (EquipImage,EquipName,Price,Description,CategoryId,StoreId,IsDelete) VALUES ('$EquipImage','$EquipName','$Price','$Description','$CategoryId','$StoreId','$isdelete')";
                            mysqli_query($con, $sqlAddProduct);
                            $_SESSION['addproduct'] = 1;
                            echo '<script>window.location.href="ar-store-add-product.php"</script>';
                        }
                        ?>
                        </tfoot>
                </table>
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