<?php
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
include('config.php');
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<!-- php -->
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
            <!-- <div class="card-header">
                <h3 class="card-title">Update products</h3>
            </div> -->
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
                                <td class="text-capitalize"><?php echo $StoreName; ?></td>
                                <td><?php echo $Address; ?></td>
                                <td><?php echo $Email; ?></td>
                                <td><a href="ar-store-view-product.php?StoreId=<?php echo $StoreId; ?>">
                                        <button type="button" class="btn btn-primary btn-sm btn-block font-weight-bold shadow">
                                            View <span class="text-capitalize"><?php echo $StoreName; ?>'s</span> Products</button></a></td>
                            </tr>
                        <?php endwhile; ?>
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