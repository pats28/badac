<?php
include('includes/fm-header.php');
include('includes/fm-sidebar.php');
include('includes/fm-navbar.php');
include('includes/footer.php');
include('config.php');

$EmpId = $_SESSION['EmpId'];
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<!-- php -->
<!-- <?php
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
        } ?> -->
<?php
$query = "SELECT * FROM budgetrequest, project, status, employee WHERE budgetrequest.ProjectId = project.ProjectId AND status.StatusId = budgetrequest.Status AND project.EmpId = employee.EmpId AND budgetrequest.isdelete = 0 AND (budgetrequest.Status = 2 or budgetrequest.Status = 3 or budgetrequest.Status = 4)";
$result = mysqli_query($con, $query);
?>
<!-- end php -->



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Budget Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
                        <li class="breadcrumb-item active">Budget Request</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                             <th>Rerefence ID</th> 
                            <th>Project Name</th>
                            <th>Architect Name</th>
                            <th>Proof of Request</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) :
                            $BudgetRequestId = $row['BudgetRequestId'];
                            $ProjectId = $row['ProjectId'];
                            $ProjectName = $row['ProjectName'];
                            $EmpId = $row['EmpId'];
                            $EmpFirstName = $row['EmpFirstName'];
                            $EmpLastName = $row['EmpLastName'];
                            // $Proof_Request = $row['Proof_Request'];
                            $Amount = $row['Amount'];
                            $Status = $row['Status'];
                            $Description = $row['Description'];
                            $DateRequested = $row['DateRequested'];
                            $newDateRequested = date("F j, Y", strtotime($DateRequested));
                        ?>
                            <tr>
                                 <td><?php echo $BudgetRequestId; ?></td> 
                                <td><?php echo $ProjectName; ?></td>
                                <td><?php echo $EmpFirstName . " " . $EmpLastName; ?></td>
                                <td><a href="blueprint/<?php echo $row['Proof_Request'] ?>"><?php echo $row['Proof_Request']; ?></a></td>
                                <td>₱ <?php echo number_format($Amount); ?></td>
                                <td><?php echo $Description; ?></td>
                                <td><?php echo $newDateRequested; ?></td>
                                <td>
                                    <?php
                                    if ($Status == 2) {  // echo $Status; 
                                    ?>
                                        <span class="badge badge-info"><i> New </i></span>
                                    <?php
                                    } else if ($Status == 3) {
                                    ?>
                                        <span class="badge badge-success"><i> Approved </i></span>
                                    <?php
                                    } else if ($Status == 4) {
                                    ?>
                                        <span class="badge badge-danger"><i> Declined </i></span>
                                    <?php
                                    }
                                    ?>
                                    <!-- <?php echo $StatusDesc; ?> -->

                                </td>
                                <td>
                                    <a href="#approve<?php echo $BudgetRequestId; ?>" data-toggle="modal">
                                        <?php
                                        if ($Status == 2) {
                                        ?>
                                            <button type="button" class="btn btn-warning btn-sm  btn-block font-weight-bold">
                                                <i class="fas fa-paper-plane"></i> Approve</button></a>
                                <?php
                                        } else if ($Status == 3) {
                                ?>
                                    <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" disabled>
                                        <i class="fas fa-paper-plane"></i> Approved</button></a>
                                <?php
                                        }
                                ?>

                                <!-- <button type="button" class="btn btn-warning btn-sm  " >
                                    <i class="fas fa-paper-plane"></i> Send Request</button></a> -->

                                <a href="#delete<?php echo $BudgetRequestId; ?>" data-toggle="modal">
                                    <button type="button" class="btn btn-danger btn-sm  btn-block mt-1 font-weight-bold" style="size: 13px">
                                        <i class="fas fa-trash"></i> Remove</button></a>
                                </td>

                                <!--Are you sure Modal -->
                                <div id="approve<?php echo $BudgetRequestId; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <form method="post">

                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title"><i class="fa fa-question"></i></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="BudgetRequestId" value="<?php echo $BudgetRequestId; ?>">
                                                    <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                                    <input type="hidden" name="ProjectName" value="<?php echo $ProjectName; ?>">
                                                    <input type="hidden" name="Description" value="<?php echo $Description; ?>">
                                                    <input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
                                                    <input type="hidden" name="EmpFirstName" value="<?php echo $EmpFirstName; ?>">
                                                    <input type="hidden" name="EmpLastName" value="<?php echo $EmpLastName; ?>">
                                                    <input type="hidden" name="EmpId" value="<?php echo $EmpId; ?>">

                                                    <div class="alert alert-warning">Are you sure you want to approve this budget request?</div>
                                                    <div class="form-group">
                                                        <label>Which account would you like to use?</label>
                                                        <select name="Account" id="" class="form-control" required>
                                                            <!-- 1: Client / 2:Badac -->
                                                            <option value="" disabled selected>Choose account</option>
                                                            <option value="1">Client's Account</option>
                                                            <option value="2">Badac's Account</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" name="yes" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                                        <!-- <a href="#expense<?php echo $BudgetRequestId; ?>" data-toggle="modal">
                                            <button type="button" name="yes" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> YES</button></a> -->
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                                <!--Delete Rquest Modal -->
                                <div id="delete<?php echo $BudgetRequestId; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <form method="post">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Remove</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="BudgetRequestId" value="<?php echo $BudgetRequestId; ?>">
                                                    <div class="alert alert-danger">Are you sure you want to remove this request? </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </tr>

                        <?php endwhile;


                        if (isset($_POST['yes'])) {
                            $ProjectId = $_POST['ProjectId'];
                            $Amount = $_POST['Amount'];
                            $Description = $_POST['Description'];
                            $EmpId = $_POST['EmpId'];
                            $DateNow = date("Y-m-d");
                            $BudgetRequestId = $_POST['BudgetRequestId'];
                            $Account = $_POST['Account'];

                            $sqlTimeline = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId','Preparing materials for the project')";

                            $sqlExpense = "INSERT INTO expenses (ProjectId, Description, Amount,Account, Date, EmpId, ApprovedBy, isdelete) VALUES ('$ProjectId','$Description', '$Amount','$Account', '$DateNow', '$EmpId', '$EmpId', 0)";

                            $sqlUpdate = "UPDATE budgetrequest SET Status = '3' WHERE BudgetRequestId = '$BudgetRequestId'";
                            $sqlProgress = "UPDATE project SET Progress = 50 WHERE ProjectId = '$ProjectId'";

                            if ($con->query($sqlTimeline) === TRUE && $con->query($sqlUpdate) === TRUE && $con->query($sqlProgress) === TRUE && $con->query($sqlExpense) === TRUE) {
                                echo '<script>window.location.href="fm-budget-request.php"</script>';
                            } else {
                                echo "Error: " . $sqlTimeline . "<br>" . $con->error;
                                echo "Error2: " . $sqlUpdate . "<br>" . $con->error;
                                echo "Error3: " . $sqlProgress . "<br>" . $con->error;
                                echo "Error4: " . $sqlExpense . "<br>" . $con->error;
                            }
                        }

                        if (isset($_POST['delete'])) {
                            $BudgetRequestId = $_POST['BudgetRequestId'];
                            $sqlRemove = "UPDATE budgetrequest SET isdelete = '1' WHERE BudgetRequestId = '$BudgetRequestId'";

                            if ($con->query($sqlRemove) === TRUE) {
                                echo '<script>window.location.href="fm-budget-request.php"</script>';
                            } else echo "Error3: " . $sqlRemove . "<br>" . $con->error;
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