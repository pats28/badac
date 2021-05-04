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
<?php
$query = "SELECT * FROM project, employee WHERE project.EmpId = employee.EmpId";
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
                    <h1>Expenses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
                        <li class="breadcrumb-item active">Expenses</li>
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
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Project</th>
                            <th>Architect</th>
                            <th>Est. Project Cost</th>
                            <th>Total Expenses</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) :
                            // $BudgetRequestId = $row['BudgetRequestId'];
                            $ProjectId = $row['ProjectId'];
                            $ProjectName = $row['ProjectName'];
                            $EmpId = $row['EmpId'];
                            $EmpFirstName = $row['EmpFirstName'];
                            $EmpLastName = $row['EmpLastName'];
                            $Amount = $row['Amount'];
                            $Status = $row['Status'];
                            // $Description = $row['Description'];
                            // $DateRequested = $row['DateRequested'];
                            $ClientId = $row['ClientId'];
                            // $newDateRequested = date("F j, Y", strtotime($DateRequested));
                            // select client names
                            $client_name = "SELECT * FROM client WHERE ClientId = $ClientId";
                            $res_client_name = mysqli_query($con, $client_name);
                            $client_name_row = mysqli_fetch_assoc($res_client_name);
                            //select est proj cost
                            $proj_cost = "SELECT * FROM payment WHERE ProjectId = $ProjectId";
                            $res_proj_cost = mysqli_query($con, $proj_cost);
                            $proj_cost_row = mysqli_fetch_assoc($res_proj_cost);
                            //count all expenses from clients account
                            $expenses_cost = "SELECT SUM(Amount) as TotalExpenses FROM expenses WHERE ProjectId = $ProjectId AND Account = 1";
                            $res_expenses_cost = mysqli_query($con, $expenses_cost);
                            $expenses_cost_row = mysqli_fetch_assoc($res_expenses_cost);
                            //count all expenses from badacs account
                            $expenses_cost_badac = "SELECT SUM(Amount) as TotalExpensesBadac FROM expenses WHERE ProjectId = $ProjectId AND Account = 2";
                            $res_expenses_cost_badac = mysqli_query($con, $expenses_cost_badac);
                            $expenses_cost_row_badac = mysqli_fetch_assoc($res_expenses_cost_badac);
                            // grand total
                            $GrandTotalExpense = $expenses_cost_row_badac['TotalExpensesBadac'] + $expenses_cost_row['TotalExpenses'];
                        ?>
                            <tr>
                                <td><strong><?php echo $ProjectName; ?></strong><br>Client: <?php echo $client_name_row['FirstName'] . " " . $client_name_row['LastName']; ?></td>
                                <td><?php echo $EmpFirstName . " " . $EmpLastName; ?></td>
                                <td class="text-center">₱ <?php echo number_format($proj_cost_row['Assessment']); ?><br>
                                    <?php
                                    if ($proj_cost_row['Assessment'] != $proj_cost_row['Initial_Payment']) {  // echo $Status; 
                                    ?>
                                        <span class="badge badge-danger"><i> Not fully paid </i></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-success"><i> Fully paid </i></span>
                                    <?php
                                    }
                                    ?>
                                    <br><a href="#viewmodal<?php echo $proj_cost_row['PaymentId']; ?>" data-toggle="modal" data-target="#viewmodal" style="font-size: 13px"></a></td>
                                    <!-- expenses -->
                                <td class="text-center">₱ <?php echo number_format($GrandTotalExpense, 2) ?><br>From Clients:₱ <?php echo number_format($expenses_cost_row['TotalExpenses'], 2) ?><br> From Badacs:₱ <?php echo number_format($expenses_cost_row_badac['TotalExpensesBadac'], 2) ?></td>
                                <?php
                                $diff = 0;
                                $t_exp = $expenses_cost_row['TotalExpenses'];
                                $t_pay = $proj_cost_row['Initial_Payment'];
                                $diff = $proj_cost_row['Assessment'] - $t_exp;
                                $funds = $t_pay - $t_exp;
                                ?>
                                <td>Total Payments: ₱ <?php echo number_format($proj_cost_row['Initial_Payment']); ?><br>Balance: ₱ <?php echo number_format($proj_cost_row['Balance']); ?><br>Funds:₱ <?php echo number_format($funds); ?></span><br><span class="badge badge-md badge-info">Expected Profit:₱ <?php echo number_format($diff); ?></td>

                                <!-- Modal -->
                            <div class="modal fade" id="viewmodal<?php echo $proj_cost_row['PaymentId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <?php echo $proj_cost_row['PaymentId']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </tr>
                            
                        <?php endwhile;
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
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
        $("#example3").DataTable();
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