<?php 
include('includes/ar-header.php'); 
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
include ('config.php');

$EmpId = $_SESSION['EmpId'];
$EmpFirstName = $_SESSION['EmpFirstName'];
$EmpLastName = $_SESSION['EmpLastName'];
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php

  if(isset($_POST['btnSearch_project']))
  {
    $search_project = $_POST['search_project'];
      // search in all table columns
      // using concat mysql function
    $query = "SELECT * FROM project as p, client as c, fitout as f, employee as e WHERE c.ClientId = p.ClientId AND p.ProjectId = f.ProjectId AND e.EmpId = p.EmpId AND e.EmpId = '$EmpId' AND p.isdelete = 0 AND CONCAT (p.ProjectName, c.FirstName, c.LastName) LIKE '%".$search_project."%'";
      $search_result = searchTable2($query);
  }
  else 
  {
    // p.ProjectId, p.ProjectName, p.Blueprint, p.Progress, c.Name, p.Status
   $query = "SELECT * FROM project as p, client as c, fitout as f, employee as e WHERE c.ClientId = p.ClientId AND p.ProjectId = f.ProjectId AND e.EmpId = p.EmpId AND e.EmpId = '$EmpId' AND p.isdelete = 0";
      $search_result = searchTable2($query);
  }

  // function to connect and execute the query
  function searchTable2($query)
  {
    include ('config.php');
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
            <h1>Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
              <li class="breadcrumb-item active">Fit-Out</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header" style="background-color: #708090">
          <h3 class="card-title" style="color: white">Fit-Out</h3> <!-- <?php //echo $EmpName; ?> -->

          <!-- <div class="card-tools">
            <form method="post">
              <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="search_project" class="form-control float-right" placeholder="Search" >
                  <div class="input-group-append" >
                    <button type="submit" class="btn btn-default" name="btnSearch_project"><i class="fas fa-search"></i></button>
                  </div> 
              </div>
            </form> 
          </div>  -->     
        </div>
        <div class="card-body">
          <!--<div class="col-12">-->
          <!--  <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">-->
          <!--  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addmodal" style="margin-top: 10px; margin-right: 10px;">-->
          <!--  <i class="fas fa-plus"></i> &nbsp;  &nbsp;Add New Project</button></a>-->
          <!--</div>-->
          <!-- <table class="table table-striped projects"> -->
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <!--<th style="width: 1%">-->
                      <!--    ID-->
                      <!--</th>-->
                      <th style="width: 15%" class="text-center">
                          Project Name
                      </th>
                      <th style="width: 15%" class="text-center">
                          Client Name
                      </th>
                      
                      <th style="width: 10%" class="text-center">
                          Details
                      </th>
                      <th style="width: 25%" class="text-center">
                          Design
                      </th>
                    <!--  <th style="width: 8%" class="text-center">
                          Status
                      </th> -->
                      <th style="width: 20%" class="text-center">
                          Materials
                      </th>
                      <th style="width: 20%" class="text-center">
                          Status
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($search_result)): 

                  $ProjectId = $row['ProjectId']; 
                  $ProjectName= $row['ProjectName'];                      
                  $FirstName = $row['FirstName'];
                  $LastName = $row['LastName'];
                  $Blueprint = $row['Blueprint'];
                  $Progress = $row['Progress']; 
                  // $Balance  = $row['Balance'];
                  $BlueprintStatusId  = $row['BlueprintStatusId'];
                  $FurnitureType  = $row['FurnitureType'];
                  $Length  = $row['Length'];
                  $Width  = $row['Width'];
                  $Description = $row['Description'];
                  $Quantity = $row['Quantity'];
                ?> 

                <tr>
                  <!--<td style="text-align: center;"><?php echo $ProjectId; ?></td>-->
                  <td style="text-align: center;"><?php echo $ProjectName; ?></td>
                  <td style="text-align: center;"><?php echo $FirstName." ".$LastName;?></td>
                  <td class="project_progress" style="text-align: center;">
                    
                    <a href="#edit<?php echo $ProjectId; ?>" data-toggle="modal">
                      
                      <i class="fas fa-eye"></i>&nbsp; View</a>

                  </td>
                  <td style="text-align: center;">
                    <a href="../Admin/blueprint/<?php echo $row["Blueprint"] ?>"><?php echo $row['Blueprint']; ?></a>
                    <?php 
                      if ($BlueprintStatusId == 3)
                      {

                    ?>
                        <span style="color: green;">&#10004;</span> <!-- for check icon -->
                    <?php
                      }

                      else if ($BlueprintStatusId == 4)
                      {
                    ?>
                        <span style="color: red;">&#10008;</span> <!-- for check icon -->
                    <?php
                      }
                      else if ($BlueprintStatusId == 2) {
                    ?>
                        <span style="color: black; font-weight: bold;">&#8230;</span> <!-- for ellipsis icon -->

                      <!-- <a href="#editapprove<?php echo $ProjectId; ?>" data-toggle="modal">
                        <button type="button" style="border-style: none; background: transparent;">
                        <i class="fas fa-pencil-alt"></i></button></a>
                    <span class="right badge badge-danger">New</span> -->
                    <!-- <span class="fas fa-check" style="color: green;"></span> -->
                    <?php
                      }
                      else  
                      {
                    ?>
                        <i class="fa" style="font-style: italic; color: red;">&#xf071 Please submit.</i>

                    <?php
                      }
                    ?>
                    <p></p>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden"  name="ProjectId" value="<?php echo $ProjectId ?>" class="form-control" id="ProjectId" >
                      
                      <input type="file" name="file" style="font-size: 12px;">
                      <input type="submit" value="Save" name="submit" style="font-size: 12px;">
                    </form>
                  </td>
                  <!-- <td style="text-align: center;"><?php echo $Progress; ?></td> -->
                  <td style="text-align: center;">
                  <a target="_blank" href="../pdf/pdf-materials.php?ProjectId=<?php echo $row["ProjectId"] ?>">Print materials needed <span style="color: black; font-weight: bold;">&#128438;</span></a>
                        
                  <a href="../shop/shop-index.php?category=1&ProjectId=<?php echo $row["ProjectId"] ?>" target="_blank" class="btn btn-primary btn-sm">Shop for materials</a>
                  </td>
                  <td  style="text-align: center;">
                        <!--  <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">
                        <button type="button" class="btn btn-info btn-sm " >
                        <i class="fas fa-eye"></i>View</button></a> -->
                            
                    <!-- <a href="#edit<?php echo $ProjectId; ?>" data-toggle="modal">
                    <button type="button" class="btn btn-warning btn-sm ">
                    <i class="fas fa-pencil-alt"></i> Edit</button></a> -->

                    <!-- <a href="#delete<?php echo $ProjectId; ?>" data-toggle="modal">
                      <button type="button" class="btn btn-danger btn-sm btn-block font-weight-bold" >
                      <i class="fas fa-trash"></i> Remove</button></a> -->

                      <?php 
                      if ($Progress < 60) 
                      {  // echo $Status; 
                    ?>
                        <span class="badge badge-info"><i> On-going </i></span>
                    <?php
                       }
                      else if ($StatusId >= 60)  {
                    ?>
                        <span class="badge badge-success"><i> Done </i></span>  
                    <?php      
                      }
                    ?>
                  </td>

                 
                    
                      <!-- View and Edit Project Modal -->
<div class="modal fade" id="edit<?php echo $ProjectId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <center><h4 class="modal-title" id="exampleModalLabel">Project Details</h4></center>
       
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class = "row"> 
                <!-- <div class="col-md-12">
                    <br>
                    <h5 class="modal-title" id="exampleModalLabel">Project Specifications</h5></center>
                </div> -->
                <input type="text" name="ProjectId" id="ProjectId" value="<?php echo $ProjectId; ?>" class="form-control" hidden > 
                <div class="col-md-3">
                    <label>Furniture Type</label>
                    <input type="text" name="FurnitureType" id="FurnitureType" value="<?php echo $FurnitureType; ?>" class="form-control"  > 
                </div>
                <div class="col-md-3">
                    <label>Quantity</label>
                    <input type="number" name="Quantity" id="Quantity" value="<?php echo $Quantity; ?>" class="form-control" > 
                </div>
                          
                <div class="col-md-3">
                    <label>Width</label>
                    <input type="number" name="Width" id="Width" value="<?php echo $Width; ?>" class="form-control" > 
                </div>
                <div class="col-md-3">
                    <label>Length</label>
                    <input type="number" name="Length" id="Length" value="<?php echo $Length; ?>" class="form-control"  > 
                </div>
                
                
               
                <div class="col-md-6">
                    <label>Description</label>
                    <textarea name="Description" id="Description" class="form-control" rows = "4" ><?php echo $Description; ?></textarea> 
                </div>
                
                <div class="col-md-3">
                    <br>
                    <label>Drawing</label>
                </div>
                <div class="col-md-3">
                    <br>
                    <a href="../Admin/drawing/<?php echo $row["Drawing"] ?>"><?php echo $row['Drawing']; ?></a>
                </div> 
               
            </div>
          </div>
          
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="editproject">Save Changes</button>   
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

                    <!--Delete Project Modal -->
                      <div id="delete<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Delete</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-danger">Are you sure you want to delete <strong>
                                                <?php echo $ProjectName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="deleteproject" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                   
                </tr>

              <?php
              error_reporting(E_ERROR);
              endwhile; 

                 // edit project process
                  if(isset($_POST['editproject']))
                  {
                     $ProjectId = $_POST['ProjectId'];
                     $FurnitureType  = $_POST['FurnitureType'];
                     $Length  = $_POST['Length'];
                     $Width  = $_POST['Width'];
                     $Description = $_POST['Description'];
                     $Quantity = $_POST['Quantity'];
                    // $Balance = $_POST['Balance'];
                  
                    $sql = "UPDATE fitout SET 
                        
                        FurnitureType='$FurnitureType',
                        Length='$Length',
                        Width='$Width',
                        Description = '$Description',
                        Quantity = '$Quantity'
                        WHERE ProjectId='$ProjectId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="ar-projects-fitout.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                     // softdelete process
                if(isset($_POST['deleteproject']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $isdelete = '1';
                 
                  $sql = "UPDATE project SET 
                      
                      isdelete ='1'
                      WHERE ProjectId ='$ProjectId' ";
                  if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="ar-projects-fitout.php"</script>';
                  } else {
                      echo "Error updating record: " . $con->error;
                  }
                }

                       //Add Project process
                // if(isset($_POST['addproject']))
                // {
               
                //   $ProjectName = $_POST['ProjectName'];
                //   $ClientId = $_POST['ClientId'];                
                //   // $Email = $_POST['Email'];
                //   // $Initial_Payment = $_POST['Initial_Payment'];
                //   // $Balance = $_POST['Balance'];

                //   $sql = "INSERT INTO project (ProjectName, ClientId)VALUES ('$ProjectName','$ClientId')";
                //   if ($con->query($sql) === TRUE) 
                //       {                  
                //           echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                //       } 
                //       else 
                //       {
                //           echo "Error: " . $sql . "<br>" . $con->error;
                //       }
                 
                // }

                  //Submit file process
                if(isset($_POST["submit"]))
                {
                  $ProjectId = $_POST['ProjectId'];
                  //echo $ApplicantId;
                  $file = $_FILES["file"]["name"];
                  $tmp_name = $_FILES["file"]["tmp_name"];
                  $path = "../Admin/blueprint/".$file;
                  $file1 = explode(".",$file);
                  $ext = $file1[1];
                  $allowed = array("jpg","png","jpeg","pdf","docx");
                  if(in_array($ext, $allowed))
                  {
    
 
                    if(($_FILES["file"]["size"] > 100000))
                    {
                      $response = array("type" => "Error: ","message" => "Error: File dimension should be within 100kb only!");   
                    }
                    else
                    {
                      move_uploaded_file($tmp_name, $path);
                      // $sql = mysqli_query ($con,"insert into project (ProjectId, blueprint) values ('$ProjectId','$file')");
  
                      $sql2 = "UPDATE project set Blueprint = '$file', BlueprintStatusId = 2, Progress = 30 where ProjectId = $ProjectId";
                      $sql3 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Proposed project design was submitted')";

                      if($con->query($sql2) === true && $con->query($sql3) === true)
                      {
                        // echo $_FILES["file"]["size"];
                        echo '<script>window.location.href="ar-projects-fitout.php"</script>';
                      }
                      else
                      {
                          echo "Error:";
                      }
                    }
  
                  }
                  else
                  {
                      echo '<script type="text/javascript">';
		   		      echo ' alert("Please upload a file!")';  
		   		      echo '</script>';
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

 