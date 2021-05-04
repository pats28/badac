<?php
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
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
    $query = "SELECT * FROM budgetrequest, project, status WHERE budgetrequest.ProjectId = project.ProjectId AND status.StatusId = budgetrequest.Status AND project.EmpId = '$EmpId' AND budgetrequest.isdelete = 0";
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
            <div class="card-header" style="background-color: #708090">
                <!-- <h3 class="card-title">Add product</h3> -->
                <a href="#addaddmodal" data-toggle="modal">
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addmodal" >
                <i class="fas fa-plus"></i>&nbsp;  &nbsp; Add New Request</button></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">Reference ID</th>
                            <th>Project Name</th>
                            <th>Amount</th>
                            <th>Proof of Request</th>
                            <th>Description / Note</th>
                            <th>Status</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) :
                            $BudgetRequestId = $row['BudgetRequestId'];
                            $ProjectName = $row['ProjectName'];
                            $Amount = $row['Amount'];
                            $Status = $row['Status'];
                            $Description = $row['Description'];
                            $DateRequested = $row['DateRequested'];
                        ?>
                            <tr>
                                <td><?php echo $BudgetRequestId; ?></td>
                                <td><?php echo $ProjectName; ?></td>
                                <td>₱ <?php echo number_format($Amount); ?></td>
                                <td><a href="blueprint/<?php echo $row["Proof_Request"] ?>"><?php echo $row['Proof_Request']; ?></a></td>
                                <td><?php echo $Description; ?></td>
                                <td>
                                    <?php 
                                        if ($Status == 1) 
                                        {  // echo $Status; 
                                    ?>
                                            <span class="badge badge-danger"><i> New </i></span>
                                    <?php
                                        }
                                        else if ($Status == 2)  {
                                    ?>
                                    <span class="badge badge-warning"><i> Proposed </i></span>  
                                    <?php      
                                        }
                                        else if ($Status == 3)  {
                                    ?>
                                    <span class="badge badge-success"><i> Approved </i></span>  
                                    <?php      
                                        }   
                                    ?>
                                    <!-- <?php echo $StatusDesc; ?> -->
                                        
                                </td>
                                <td>
                                    <a href="#send<?php echo $BudgetRequestId; ?>" data-toggle="modal">
                                        <?php 
                                            if ($Status == 1) 
                                            { 
                                        ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold " >
                                                <i class="fas fa-paper-plane"></i> Send Request</button></a>
                                        <?php
                                            }
                                            else {
                                        ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" disabled>
                                                <i class="fas fa-paper-plane"></i> Request Sent</button></a>
                                        <?php      
                                            }
                                        ?>

                                    <!-- <button type="button" class="btn btn-warning btn-sm  " >
                                    <i class="fas fa-paper-plane"></i> Send Request</button></a> -->

                                    <a href="#delete<?php echo $BudgetRequestId; ?>" data-toggle="modal">
                                    <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold " >
                                    <i class="fas fa-trash"></i> Remove</button></a>
                                </td>

                                <!--Are you sure Modal -->
                      <div id="send<?php echo $BudgetRequestId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title"><i class="fa fa-question" ></i></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="BudgetRequestId" value="<?php echo $BudgetRequestId; ?>">
                                        <div class="alert alert-warning">Are you sure you want to send this budget request?</div>
                                        <div class="modal-footer">
                                           
                                            <button type="submit" name="yes" class="btn btn-warning" ><span class="glyphicon glyphicon-trash"></span> YES</button>
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
                            if (isset($_POST['addrequest']))
                            {
                                $ProjectId = $_POST['ProjectId'];
                                $Amount = $_POST['Amount'];
                                $Description = $_POST['Description'];

                                $Proof_Request = $_FILES["Proof_Request"]["name"];
                                $tmp_name = $_FILES["Proof_Request"]["tmp_name"];
                                $path = "blueprint/".$Proof_Request;
                                $Proof_Request1 = explode(".",$Proof_Request);
                                $ext = $Proof_Request1[1];
                                $allowed = array("jpg","png","jpeg","pdf","docx");
                                if(in_array($ext, $allowed))
                                {
                                  move_uploaded_file($tmp_name, $path);
                                

                                  $sqlRequest = "INSERT INTO budgetrequest (ProjectId, Amount, Description, Status, Proof_Request) VALUES ('$ProjectId', '$Amount', '$Description', 1, '$Proof_Request')";

                                  if ($con->query($sqlRequest) === TRUE)
                                  {
                                    echo '<script>window.location.href="ar-budget-request.php"</script>';
                                  }
                                  else 
                                  {
                                    echo "Error: " . $sqlRequest . "<br>" . $con->error;
                                  }

                                } //end if contract
                                else
                                {
                                  echo '<br><div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h6><i class="icon fas fa-ban"></i>Please upload the allowed files only.</h6>
                                    </div>';
                                }
                            } //end if addrequest

                            if (isset($_POST['yes']))
                            {
                                $BudgetRequestId = $_POST['BudgetRequestId'];
                                $sqlUpdate = "UPDATE budgetrequest SET Status = '2' WHERE BudgetRequestId = '$BudgetRequestId'";

                                if ($con->query($sqlUpdate) === TRUE)
                                {
                                    echo '<script>window.location.href="ar-budget-request.php"</script>';
                                }
                                else echo "Error2: " . $sqlUpdate . "<br>" . $con->error;

                            }

                            if (isset($_POST['delete']))
                            {
                                $BudgetRequestId = $_POST['BudgetRequestId'];
                                $sqlRemove = "UPDATE budgetrequest SET isdelete = '1' WHERE BudgetRequestId = '$BudgetRequestId'";

                                if ($con->query($sqlRemove) === TRUE)
                                {
                                    echo '<script>window.location.href="ar-budget-request.php"</script>';
                                }
                                else echo "Error3: " . $sqlRemove . "<br>" . $con->error;
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



<!--ADD NEW EXPENSE Modal -->
                    <div id= "addmodal" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Add New Request</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="BudgetRequestId" value="<?php echo $BudgetRequestId ?>">
                                        <div class="form-group">
                                            
                                            <label for="ProjectName">Project Name:</label>
                                            <div class="form-group">
                                                <select class="form-control" name="ProjectId" id="ProjectId">
                                                    <?php
                                                    $queryProject = "SELECT ProjectId, ProjectName from project where EmpId = '$EmpId' AND Progress < 100";
                                                    $resultProject = mysqli_query($con, $queryProject);
                                                    while ($row = mysqli_fetch_array($resultProject))
                                                    {
                                                        $ProjectName= $row['ProjectName']; 
                                                        $ProjectId= $row['ProjectId'];
                                                        echo "<option value =".$ProjectId. ">" .$ProjectName. "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <label for="Amount">Amount:</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Amount" required autofocus > 
                                            </div>

                                            <label for="Description">Description / Note:</label>
                                            <div class="form-group">
                                                <textarea class="form-control" name="Description"></textarea> 
                                            </div>
                                            
                                            <label>Upload Proof of Request:</label>
                                            <div class="form-group">
                                              <input type="file" name="Proof_Request" id="Proof_Request" required="">
                                            </div>

                                           <!--  <label for="ContactNum">Contact Number:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $ContactNum; ?>" placeholder="Contact Number" required autofocus> 
                                            </div>
                           -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="addrequest"><span class="glyphicon glyphicon-edit"></span> Save </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

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