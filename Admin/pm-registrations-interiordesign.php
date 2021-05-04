<?php
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<head>
</head>

<?php
  
    $query = "SELECT * FROM client as c, interiordesign as id, status as s WHERE c.ClientId = id.ClientId AND s.StatusId = c.StatusId AND id.isdelete = 0";
      $search_result = searchTable2($query);
  

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
            <h1>Registrations</h1>
          </div>
          <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="projectmanager.php">Home</a></li>
                        <li class="breadcrumb-item active">Interior Design</li>
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
          <h3 class="card-title" style="color: white">Interior Design</h3>
     
        </div>
        <!-- <div class="card-body table-responsive p-0" class="scrollbar scrollbar-primary"> -->
        <div class="card-body">
          <!-- <table class="table table-hover text-nowrap" > --> <!-- class="table table-striped projects"  -->
          <table id="example1" class="table table-bordered table-striped">  
              <thead>
                  <tr>
                      <!--<th style="width: 1%">-->
                      <!--    ID-->
                      <!--</th>-->
                      <th style="width: 12%" class="text-center">
                          Client Name
                      </th>
                      <th style="width: 12%" class="text-center">
                          Contact Number
                      </th>
                      <th style="width: 12%" class="text-center">
                          Address
                      </th>
                      <th style="width: 12%" class="text-center">
                          Email
                      </th>
                      <th style="width: 12%" class="text-center">
                          Site Location
                      </th>
                      <th style="width: 12%" class="text-center">
                          Visitation Date
                      </th>
                      
                      <th style="width: 8%" class="text-center">
                          Overview Description
                      </th>
                      <th style="width: 10%" class="text-center">
                          Status
                      </th>
                      <th style="width: 15%" class="text-center">
                          Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($search_result)): 

                  $ClientId = $row['ClientId']; 
                  $FirstName= $row['FirstName'];  
                  $LastName= $row['LastName'];
                  $Email = $row['Email'];
                  $Password = $row['Password'];
                  $Address = $row['Address']; 
                  $ContactNum  = $row['ContactNum'];
                  $StatusId  = $row['StatusId']; 

                  $SiteLocation = $row['SiteLocation'];
                  $VisitationDate = $row['VisitationDate'];
                  $newVisitationDate = date("F j, Y", strtotime($VisitationDate));
                  $OverviewDescription = $row['OverviewDescription'];
                  
                ?> 

                <tr>
                  <!--<td style="text-align: center;"><?php echo $ClientId; ?></td>-->
                  <td style="text-align: center;"><?php echo $FirstName." ".$LastName; ?></td>
                  <td style="text-align: center;"><?php echo $ContactNum; ?></td>
                  <td style="text-align: center;"><?php echo $Address;?></td>
                  <td style="text-align: center;"><?php echo $Email; ?></td>
                  <td style="text-align: center;"><?php echo $SiteLocation;?></td>
                  <td style="text-align: center;"><?php echo $newVisitationDate; ?></td>
                  <td  style="text-align: center;">
                    
                    <a href="#view<?php echo $ClientId; ?>" data-toggle="modal">
                         <!--<button type="button" class="btn btn-info btn-sm " >-->
                         <i class="fas fa-eye"></i>&nbsp;View</a></i>
                   
                    <!-- <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>&nbsp;Drawing</button></a> -->
                  </td>
                  <td  style="text-align: center;">
                    <?php 
                      if ($StatusId == 1) 
                      {  // echo $Status; 
                    ?>
                        <span class="badge badge-danger"><i> New </i></span>
                    <?php
                       }
                      else if ($StatusId == 3)  {
                    ?>
                        <span class="badge badge-success"><i> Approved </i></span>  
                    <?php      
                      }
                    ?>
                  </td>
                  <td style="text-align: center;">
                        <!--  <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                    <!-- <p>
                    <a href="#edit<?php echo $ProjectId; ?>" data-toggle="modal">
                     <button type="button" class="btn btn-warning btn-sm ">
                     <i ></i> Add to Contact</button></a></p> -->     
                    
                    <a href="#yes<?php echo $ClientId; ?>" data-toggle="modal">
                      
                      <?php 
                        if ($StatusId == 1) 
                        { 
                      ?>
                        <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold"><i class="fas fa-plus"></i> &nbsp;  
                        Add to Project</button></a>
                      <?php
                        }
                        else if ($StatusId == 3) {
                      ?>
                        <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" disabled><i class="fas fa-plus"></i> &nbsp;
                        Added  </button></a>
                      <?php      
                        }
                      ?>

                    <a href="#delete<?php echo $ClientId; ?>" data-toggle="modal">
                      <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold" >
                      <i class="fas fa-trash"></i> Remove</button></a>
                  </td>

                  <!--Delete register Modal -->
                      <div id="delete<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Remove</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                        <div class="alert alert-danger">Are you sure you want to remove <strong>
                                                <?php echo $FirstName." ".$LastName; ?></strong>'s registration? </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="deleteregi" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>


                      <!--View Estimate Modal -->
                        <div id="view<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Overview Description</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <div class="modal-body">
                                <div class="row">
                               <!--  <h5>Fit-Out Details</h5> -->
                                
                                <div class="col-md-12">
                                  <label>Description</label>
                                  <textarea  class="form-control"  disabled ><?php echo $OverviewDescription; ?></textarea>
                                  <br>
                                </div>
                                
                                </div>  

                               
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                   <!--Are you sure Modal -->
                      <div id="yes<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Confirm</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                        <div class="alert alert-warning">Are you sure you want to add <strong>
                                                <?php echo $FirstName." ".$LastName; ?></strong>'s registration to Project List? </div>
                                        <div class="modal-footer">
                                           <a href="#add<?php echo $ClientId; ?>" data-toggle="modal">
                                            <button type="button" name="addproject" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> YES</button></a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                       <!--Add to project  Modal -->
                    <div id="add<?php echo $ClientId; ?>" class="modal fade" role="dialog"  tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="post" >
                            <div class="modal-dialog modal-lg" role="document">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Approved Project Details</h5> 

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>                                  
                                    <div class="modal-body">
                                      <!--<p style="color: red; font-size: 11px;">Note: Put N/A or 0 if not applicable.</p>-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="ProjectName"><span style = "color: red">*</span>Add Project to:</label>
                                                <select class="form-control" name="EmpId" id="EmpId">
                                      <?php 

                                        $query2 = "SELECT e.EmpFirstName, e.EmpLastName, e.EmpId, (SELECT COUNT(p.EmpId) FROM project as p WHERE p.EmpId = e.EmpId)AS count_EmpId FROM employee as e WHERE e.DeptId = 3";

                                        $result = mysqli_query($con, $query2);
                                        while ($row2 = mysqli_fetch_array($result))
                                        {
                                          $EmpFirstName= $row2['EmpFirstName']; 
                                          $EmpLastName= $row2['EmpLastName'];
                                          $EmpId_count= $row2['count_EmpId']; 
                                          echo "<option value =" .$row2['EmpId']. ">" .$EmpFirstName." ".$EmpLastName. "&emsp;(" .$EmpId_count. " projects) </option>";
                                        }


                                        $search_Result = mysqli_query($con, $query2);

                                        while ($row = mysqli_fetch_array($search_Result)): 
                                          $EmpFirstName= $row['EmpFirstName']; 
                                          $EmpLastName= $row['EmpLastName']; 
                                          $EmpId_count= $row['count_EmpId']; 
         
                                      ?>

                                      <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                      <input type="hidden" name="SiteLocation" value="<?php echo $SiteLocation; ?>">
                                      <input type="hidden" name="VisitationDate" value="<?php echo $VisitationDate; ?>">
                                      <input type="hidden" name="OverviewDescription" value="<?php echo $OverviewDescription; ?>">
                                      <!-- <input type="hidden" name="f_Width" value="<?php echo $f_Width; ?>">
                                      <input type="hidden" name="f_Drawing" value="<?php echo $f_Drawing; ?>"> -->

                                          <?php endwhile; ?>
                                          </div>
                                          <br>
                                          <div class="col-md-6">
                                              <label for="ProjectName"><span style = "color: red">*</span>Project Name:</label>
                                                <input type="text" class="form-control" id="ProjectName" name="ProjectName"  placeholder="Project Name" required autofocus> 
                                          </div>
                                          <div class="col-md-6">
                                              <label for="DesignStyle"><span style = "color: red">*</span>Design Style:</label>
                                                <select name="DesignStyle" id="DesignStyle" class="form-control" required="" >
                                                  <option value="Residential">Residential
                                                  <option value="Commercial">Commercial
                                                  <option value="Industrial">Industrial
                                                  <option value="Other">Other
                                                </select> 
                                          </div>
                                          <div class="col-md-3">
                                              <label for="SpaceType"><span style = "color: red">*</span>Space Type:</label>
                                                <input type="text" class="form-control" id="SpaceType" name="SpaceType"  placeholder="e.g. Living Area, Dining Area, Bedroom, etc" required autofocus> 
                                          </div>
                                          <div class="col-md-3">
                                              <label for="Length"><span style = "color: red">*</span>Length:</label>
                                                <input type="number" class="form-control" id="Length" name="Length"  placeholder="in meter" required autofocus> 
                                          </div>

                                          <div class="col-md-3">
                                              <label for="Width"><span style = "color: red">*</span>Width:</label>
                                                <input type="number" class="form-control" id="Width" name="Width"  placeholder="in meter" required autofocus> 
                                          </div>

                                          <div class="col-md-3">
                                              <label for="Estimated_Finish_Date"><span style = "color: red">*</span>Estimated Finish Date:</label>
                                                <input type="date" class="form-control" id="Estimated_Finish_Date" name="Estimated_Finish_Date"   required autofocus> 
                                          </div>
                                          
                                          <div class="col-md-6">
                                              <label for="Assessment"><span style = "color: red">*</span>Assessment:</label>
                                                <input type="number" class="form-control" id="Assessment" name="Assessment"  placeholder="Enter Amount" required autofocus> 
                                          </div>

                                          <div class="col-md-6">
                                              <label for="Initial_Payment">Initial Payment:</label>
                                                <input type="number" class="form-control" id="Initial_Payment" name="Initial_Payment"  placeholder="Enter Amount" required autofocus> 
                                          </div>
                                          
                                          <div class="col-md-6">
                                              <label for="Mode_Payment">Mode of Payment:</label>
                                                <input type="text" class="form-control" id="Mode_Payment" name="Mode_Payment"  placeholder="Mode of Payment" required autofocus>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="TransactionNum">Transaction Number:</label>
                                                <input type="text" class="form-control" id="TransactionNum" name="TransactionNum"  placeholder="Transaction Number" required autofocus>
                                          </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning" name="addtoproject"><span class="glyphicon glyphicon-edit"></span> Save </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </tr>

              <?php endwhile; 

                        // Add to Project process
                if(isset($_POST['addtoproject']))
                {
                  // $ProjectId = $_POST['ProjectId'];
                  $ProjectName = $_POST['ProjectName'];
                  $EmpId = $_POST['EmpId'];                
                  $ClientId = $_POST['ClientId'];
                  $BlueprintStatusId = 1;
                  $Estimated_Finish_Date = $_POST['Estimated_Finish_Date'];
                  $ServiceTypeId = 2;
                  $DesignStyle = $_POST['DesignStyle'];               
                  $SpaceType = $_POST['SpaceType'];
                  $Length = $_POST['Length'];  
                  $Width = $_POST['Width'];
                  

                  $Assessment = $_POST['Assessment'];
                  $Initial_Payment = $_POST['Initial_Payment'];          
                  

                  $sql = "INSERT INTO project (ProjectName, EmpId, ClientId, BlueprintStatusId, ServiceTypeId, Estimated_Finish_Date)VALUES ('$ProjectName','$EmpId','$ClientId', '$BlueprintStatusId', '$ServiceTypeId', '$Estimated_Finish_Date' )";
                  $sql2 = "UPDATE client SET  
                      StatusId = 3,
                      Password = 55555
                      WHERE ClientId ='$ClientId' ";


                  if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE ) 
                      {  
                        $query = "SELECT MAX(ProjectId) as ProjectId FROM `project` order by MAX(ProjectId) DESC";
                        $result = mysqli_query($con, $query);
                        $MaxProjectId = mysqli_fetch_assoc($result);
                        $ProjectId = $MaxProjectId['ProjectId'];
                        $Balance  = $Assessment - $Initial_Payment;

                        $sql3 = "INSERT INTO payment (ProjectId, Assessment, Initial_Payment, Balance) VALUES ('$ProjectId', '$Assessment', '$Initial_Payment', '$Balance')";
                        $sql4 = "UPDATE interiordesign SET
                                  DesignStyle = '$DesignStyle',
                                  SpaceType = '$SpaceType',
                                  Length = '$Length',
                                  Width = '$Width'
                                  WHERE ClientId = '$ClientId'";
                        $sql5 = "UPDATE project SET  
                                  Progress = Progress + 10
                                  WHERE ProjectId ='$ProjectId' ";
                        
                        $sql8 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project approved by contractor')";
                        
                        $sql9 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project assigned to architect')";

                        if ($con->query($sql3) === TRUE && $con->query($sql4) === TRUE && $con->query($sql5) === TRUE && $con->query($sql8) === TRUE && $con->query($sql9) === TRUE )
                        {
                          $query2 = "SELECT MAX(PaymentId) as PaymentId FROM `payment` order by MAX(PaymentId) DESC";
                          $result2 = mysqli_query($con, $query2);
                          $MaxPaymentId = mysqli_fetch_assoc($result2);
                          $PaymentId = $MaxPaymentId['PaymentId'];
                          $Mode_Payment = $_POST['Mode_Payment'];
                          $TransactionNum = $_POST['TransactionNum'];

                          $sql7 = "INSERT INTO paymentbreakdown (Amount, TransactionNum, Mode_Payment, PaymentId) VALUES ('$Initial_Payment', '$TransactionNum', '$Mode_Payment', '$PaymentId')";

                           // echo '<script>window.location.href="pm-registrations.php"</script>';
                          if ($con->query($sql7) === TRUE)
                            echo '<script>window.location.href="pm-registrations-interiordesign.php"</script>';
                          else echo "Error7: " . $sql7 . "<br>" . $con->error;

                          $half = $Assessment * .50;
                          if ($Initial_Payment == $half || $Initial_Payment > $half && $Balance != 0)
                          {
                            $sql6 = "UPDATE project SET  
                                  Progress = Progress + 10
                                  WHERE ProjectId ='$ProjectId' ";
                          

                            if ($con->query($sql6) === TRUE)
                              echo '<script>window.location.href="pm-registrations-interiordesign.php"</script>';
                              // echo "okay";
                            else echo "Error: " . $sql6 . "<br>" . $con->error;
                          }
                          else echo '<script>window.location.href="pm-registrations-interiordesign.php"</script>';

                        }
                        else
                        {
                          echo "Error1: " . $sql3 . "<br>" . $con->error;
                          echo "\nError2: " . $sql4 . "<br>" . $con->error;
                          echo "\nError3: " . $sql5 . "<br>" . $con->error;
                          echo "\nError8: " . $sql8 . "<br>" . $con->error;
                        } 
                      } 
                      else 
                      {
                          echo "\nError4: " . $sql . "<br>" . $con->error;
                          echo "\n";
                          echo "\nError5: " . $sql2 . "<br>" . $con->error;
                      }
                }

                if (isset($_POST['deleteregi']))
                {
                  $ClientId = $_POST['ClientId'];

                  $sqlDelete = "UPDATE interiordesign SET isdelete = 1 WHERE ClientId = '$ClientId'";

                  if ($con->query($sqlDelete) === TRUE)
                  {
                    echo '<script>window.location.href="pm-registrations-interiordesign.php"</script>';
                  }
                  else echo "Error: " . $sqlDelete . "<br>" . $con->error;

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

<?php include('includes/footer.php');?>

 