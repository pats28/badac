<?php
include('includes/fm-header.php');
include('includes/fm-sidebar.php');
include('includes/fm-navbar.php');
include('includes/footer.php');
include('config.php');
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php
if (isset($_POST['btnSearch_expenses'])) {
    $search_expenses = $_POST['search_expenses'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM expenses as ex, project as p, employee as em WHERE ex.ProjectId = p.ProjectId AND em.EmpId = ex.EmpId AND ex.isdelete = 0 AND CONCAT (ex.ExpenseId, p.ProjectName, ex.Description, ex.Amount, ex.Date, em.EmpFirstName, em.EmpLastName) LIKE '%" . $search_expenses . "%'";
    $search_result = searchTable2($query);
} else {

    $query = "SELECT * FROM expenses as ex, project as p, employee as em WHERE ex.ProjectId = p.ProjectId AND em.EmpId = ex.EmpId AND ex.isdelete = 0";
    $search_result = searchTable2($query);
}

// function to connect and execute the query
function searchTable2($query)
{
    include('config.php');
    // $connect = mysqli_connect("localhost", "root", "", "badacdb");
    $search_Result = mysqli_query($con, $query);
    return $search_Result;
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Materials Expenses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="financialmanager.php">Home</a></li>
                        <li class="breadcrumb-item active">Materials Expenses</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <!--   <h3 class="card-title">Expenses</h3> -->

                <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addmodal" margin-right: 10px;">
                        <i class="fas fa-plus"></i> &nbsp; &nbsp;Add New Expense</button></a>

                <!-- <div class="card-tools">

              <form method="post">
                <div class="input-group input-group-sm" style="width: 300px;">
                    
                    <input type="text" name="search_expenses" class="form-control float-right" placeholder="Search" >

                    <div class="input-group-append" >
                      <button type="submit" class="btn btn-default" name="btnSearch_expenses"><i class="fas fa-search"></i></button>
                    </div>
                    
                </div>
            </form> 
          </div> -->

            </div>
            <div class="card-body">

                <!--  <table class="table table-striped projects"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">
                                 Reference ID
                            </th>
                            <th style="width: 15%; text-align: center;">
                                Project Name
                            </th>
                            <th style="width: 25%; text-align: center;">
                                Description
                            </th>
                            <th style="width: 12%; text-align: center;">
                                Amount
                            </th>
                            <th style="width: 12%; text-align: center;">
                                Date
                            </th>
                            <th style="width: 15%; text-align: center;">
                                Employee Name
                            </th>
                            <!-- <th style="width: 15%; text-align: center; " > class="text-center"
                          Status
                      </th> -->
                            <th style="width: 15%; text-align: center;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($search_result)) :

                            $ExpenseId = $row['ExpenseId'];
                            $ProjectName = $row['ProjectName'];
                            $Description = $row['Description'];
                            $Amount = $row['Amount'];
                            $Account = $row['Account'];
                            $Date = $row['Date'];
                            $EmpFirstName  = $row['EmpFirstName'];
                            $EmpLastName  = $row['EmpLastName'];
                            // $Status  = $row['Status'];
                            if ($Account == 1) {
                                $acc = "Client's Account";
                            } else if ($Account == 2) {
                                $acc = "Badac's Account";
                            } else {
                                $acc = "Client's Account";
                            }
                        ?>

                            <tr>
                                <td style="text-align: center;"><?php echo $ExpenseId; ?></td>
                                <td style="text-align: center;"><?php echo $ProjectName; ?></td>
                                <td style="text-align: center;"><?php echo $Description; ?></td>
                                <td style="text-align: center;">₱ <?php echo number_format($Amount); ?><br><span class="badge badge-info">From: <?php echo $acc;?></span></td>
                                <td style="text-align: center;"><?php echo $Date; ?></td>
                                <td style="text-align: center;"><?php echo $EmpFirstName . " " . $EmpLastName; ?></td>
                                <!-- <td style="text-align: center;"><?php echo $Status; ?></td> -->
                                <td style="text-align: center;">

                                    <a href="#edit<?php echo $ExpenseId; ?>" data-toggle="modal">
                                        <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold">
                                            <i class="fas fa-pencil-alt"></i> Edit</button></a>

                                    <a href="#delete<?php echo $ExpenseId; ?>" data-toggle="modal">
                                        <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold">
                                            <i class="fas fa-trash"></i> Remove</button></a>

                                    <?php include('fm-modal.php'); ?>
                                </td>


                            </tr>

                        <?php endwhile;

                        // edit expenses process
                        if (isset($_POST['editexpenses'])) {
                            $ExpenseId = $_POST['ExpenseId'];
                            // $ProjectId = $_POST['ProjectId'];
                            $Description = $_POST['Description'];
                            $Amount = $_POST['Amount'];
                            $Date = $_POST['Date'];
                            // $EmpId = $_POST['EmpId'];
                            $sql = "UPDATE expenses SET 

                        Description='$Description',
                        Amount='$Amount',
                        Date='$Date',
                        EmpId='$EmpId'
                        WHERE ExpenseId='$ExpenseId' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="fm-materials.php"</script>';
                            } else {
                                echo "Error updating record: " . $con->error;
                            }
                        }

                        // softdelete process
                        if (isset($_POST['deleteexpenses'])) {
                            $ExpenseId = $_POST['ExpenseId'];
                            $isdelete = '1';

                            $sql = "UPDATE expenses SET 
                      
                      isdelete ='1'
                      WHERE ExpenseId ='$ExpenseId' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="fm-materials.php"</script>';
                            } else {
                                echo "Error updating record: " . $con->error;
                            }
                        }

                        //Add Expense process
                        if (isset($_POST['addexpense'])) {

                            $ProjectId = $_POST['ProjectId'];
                            $Description = $_POST['Description'];
                            $Account = $_POST['Account'];
                            $Amount = $_POST['Amount'];
                            $Date = $_POST['Date'];
                            $EmpId = $_POST['EmpId'];

                            $sql = "INSERT INTO expenses (ProjectId, Description, Amount,Account, Date, EmpId, ApprovedBy)VALUES ('$ProjectId','$Description','$Amount','$Account','$Date', '$EmpId', '$EmpId')";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="fm-materials.php"</script>';
                            } else {
                                echo "Error: " . $sql . "<br>" . $con->error;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->



</div>
<!-- /.content-wrapper -->

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