<?php 
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>
<?php
  if(isset($_POST['btnSearch_fitout']))
  {
    $search_fitout = $_POST['search_fitout'];
      // search in all table columns
      // using concat mysql function
    $query = "SELECT * FROM project as p, client as c, employee as e, fitout as f, payment as pay WHERE f.ProjectId = p.ProjectId AND c.ClientId = p.ClientId AND e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 3 AND p.ProjectId = pay.ProjectId AND  CONCAT (p.ProjectName, c.FirstName, c.LastName, e.EmpFirstName, e.EmpLastName) LIKE '%".$search_fitout."%'";
      $search_result = searchTable2($query);
  }
  else 
  {

   $query = "SELECT * FROM project as p, client as c, employee as e, fitout as f, progressdescription as pd, payment as pay WHERE f.ProjectId = p.ProjectId AND c.ClientId = p.ClientId AND e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 3 AND pd.ProgressId = p.Progress AND p.ProjectId = pay.ProjectId";
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
                        <li class="breadcrumb-item"><a href="projectmanager.php">Home</a></li>
                        <li class="breadcrumb-item active">Fit-Out</li>
                    </ol>
                </div>
         <!--  <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
            <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addmodal"  margin-right: 3px;">
            <i class="fas fa-plus"></i> &nbsp;  &nbsp;Add New Project</button> </a>
            </ol>
          </div> -->
          
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header" style="background-color: #708090">
          <h3 class="card-title" style="color: white">Fit-Out</h3>

          <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-success float-right shadow" data-toggle="modal" data-target="#addmodal"  margin-right: 3px;">
            <i class="fas fa-plus"></i> &nbsp;  &nbsp; Add New Project </button> </a>

         <!--  <div class="card-tools">
            
            <form method="post">
              <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="search_fitout" class="form-control float-right" placeholder="Search" >
                  <div class="input-group-append" >
                    <button type="submit" class="btn btn-default" name="btnSearch_fitout"><i class="fas fa-search"></i></button>
                  </div> 
              </div>
            </form> 
          </div>   -->    
        </div>
        <div class="card-body">
          
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th style="width: 12%" class="text-center">
                          Project Name
                      </th>
                      <th style="width: 12%" class="text-center">
                          Architect Name
                      </th>
                      <th style="width: 10%" class="text-center">
                          Project Details
                      </th>
                       <th style="width: 15%" class="text-center">
                          Payment Record
                      </th>
                      <th style="width: 12%" class="text-center">
                          Project Progress
                      </th>
                      <th style="width: 15%" class="text-center">
                          Action
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
                  $EmpFirstName  = $row['EmpFirstName'];
                  $EmpLastName  = $row['EmpLastName'];
                  $BlueprintStatusId  = $row['BlueprintStatusId'];
                  $Date_Started = $row['Date_Started'];
                  $Estimated_Finish_Date = $row['Estimated_Finish_Date'];
                  $newDateStarted = date("F j, Y", strtotime($Date_Started));
                  $newEstimatedFinishDate = date("F j, Y", strtotime($Estimated_Finish_Date));

                  $FurnitureType = $row['FurnitureType'];
                  $Length = $row['Length'];
                  $Width = $row['Width'];
                  $Description = $row['Description'];
                  $Drawing = $row['Drawing'];
                  $Quantity = $row['Quantity'];
                  $Status = $row['Status'];

                  $queryProgress = "SELECT * FROM progressdescription as pd, project as p WHERE pd.ProgressId = '$Progress'";
                  $sqlProgress = mysqli_query($con, $queryProgress);
                  $rowProgress = mysqli_fetch_assoc($sqlProgress);
                ?> 

                <tr>
                  <td style="text-align: center;">
                    <strong><?php echo $ProjectName; ?></strong></br>
                    <?php echo $FirstName." ".$LastName;?>
                  </td>
                  <td style="text-align: center;"><?php echo $EmpFirstName." ".$EmpLastName; ?></td>
                  <td style="text-align: center;">
                    
                    <a href="#view<?php echo $ProjectId; ?>" data-toggle="modal">
                         <!--<button type="button" class="btn btn-info btn-sm " style = "font-size: 13px;" >-->
                         <i class="fas fa-eye"></i>&nbsp;View</a></i>
                  </td>
                  <td style="text-align: center;">
                     <?php if ($Status == "Not fully paid") { ?>
                          <span class="badge badge-danger"><i> Not fully paid </i></span><br>
                        <?php } else { ?>
                            <span class="badge badge-success"><i> Fully paid </i></span><br> 
                        <?php } ?>
                        <a href="#open<?php echo $ProjectId; ?>" data-toggle="modal" style="font-size: 13px">View Payment History</a>

                        <?php include('pm-modal.php'); ?>
                  </td>

                  <td class="project_progress" style="text-align: center;">
                    <div class="progress progress-sm">
                      <div class="progress-bar progress-bar-striped " role="progressbar" aria-volumenow="<?php  echo $Progress;?>" aria-volumemin="0" aria-volumemax="100" style="width: <?php  echo $Progress;?>%"> <i style="color: black"><?php  echo $Progress;?>% </i>
                      </div>
                    </div>
                    <small><i>
                      <?php
                        if ($Progress == $rowProgress['ProgressId'])
                        {
                      ?> 
                          <?php  echo $rowProgress['Description'];?><br>
                          <a href="#viewtimeline<?php echo $ProjectId; ?>" data-toggle="modal">
                         
                          <i class="fas fa-eye"></i>&nbsp;View</a></i>
                      <?php
                        }
                      ?>
                    </i>
                    </small>
                    <?php
                      if ($Progress == 50)
                      {
                    ?>    
                        <a href="#first<?php echo $ProjectId; ?>" data-toggle="modal">
                        <button type="button" class="btn btn-info btn-sm btn-block mt-2 font-weight-bold" style = "font-size: 12px;">
                        Undergo 1st Stage</button></a>
                    <?php    
                      }

                      else if ($Progress == 60)
                      {
                    ?>
                        <a href="#second<?php echo $ProjectId; ?>" data-toggle="modal">
                        <button type="button" class="btn btn-info btn-sm btn-block mt-2 font-weight-bold" style = "font-size: 12px;">
                        Undergo 2nd Stage</button></a>
                    <?php
                      }

                      else if ($Progress == 80)
                      {
                    ?>
                        <a href="#complete<?php echo $ProjectId; ?>" data-toggle="modal">
                        <button type="button" class="btn btn-info btn-sm btn-block mt-2 font-weight-bold" style = "font-size: 12px;">
                        Mark as Complete</button></a>
                    <?php
                      }

                      else if ($Progress == 100)
                      {
                    ?>
                        <br>
                        <span class="right badge badge-success mt-2">Completed</span>
                    <?php
                      }
                    ?>

                  </td>
                  <td style="text-align: center;">
                        <!--  <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                            
                    <a href="#edit<?php echo $ProjectId; ?>" data-toggle="modal">
                     <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" style = "font-size: 13px;">
                     <i class="fas fa-pencil-alt"></i> Edit</button></a>

                    <a href="#delete<?php echo $ProjectId; ?>" data-toggle="modal">
                      <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold" style = "font-size: 13px;">
                      <i class="fas fa-trash"></i> Remove</button></a>
                  </td>

                  <!--View Fitout Details Modal -->
                        <div id="view<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Fit-Out Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <div class="modal-body">
                                <div class="row">
                               <!--  <h5>Fit-Out Details</h5> -->
                                <div class="col-md-12">
                                  <label>Type of Furniture</label>
                                  <input type="text" name="FurnitureType" id="FurnitureType" value="<?php echo $FurnitureType; ?>" class="form-control"   required="" disabled > 
                                </div> 
                                <div class="col-md-12">
                                  <label>Quantity</label>
                                  <input type="text" name="Quantiy" id="Quantiy" value="<?php echo $Quantity; ?>" class="form-control" disabled > 
                                </div> 
                                <div class="col-md-12">
                                  <label>Length</label>
                                  <input type="text" name="Length" id="Length" value="<?php echo $Length; ?>" class="form-control" disabled > 
                                </div> 
                                <div class="col-md-12">
                                  <label>Width</label>
                                  <input type="text" name="Width" id="Width" value="<?php echo $Width; ?>" class="form-control"  disabled> 
                                </div> 
                                <div class="col-md-12">
                                  <label>Date Started</label>
                                  <input type="text" name="newDateStarted" id="newDateStarted" value="<?php echo $newDateStarted; ?>" class="form-control" disabled >
                                </div>
                                <div class="col-md-12">
                                  <label>Estimated Finish Date</label>
                                  <input type="text" name="newEstimatedFinishDate" id="newEstimatedFinishDate" value="<?php echo $newEstimatedFinishDate; ?>" class="form-control" disabled >
                                </div>
                                <div class="col-md-12">
                                  <label>Description</label>
                                  <textarea  class="form-control"  disabled ><?php echo $Description; ?></textarea>
                                  <br>
                                </div>
                                <div class="col-md-3">
                                  <label>Drawing</label>
                                </div>
                                <div class="col-md-9">
                                  <a href="../Admin/drawing/<?php echo $row["Drawing"] ?>"><?php echo $row['Drawing']; ?></a>
                                </div> 
                                </div>  

                               
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>



                  <!--Edit Project Modal -->
                    <div id="edit<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Project</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-12">
                                              <label for="ProjectName">Project Name:</label>
                                                <input type="text" class="form-control" id="ProjectName" name="ProjectName" value="<?php echo $ProjectName; ?>" placeholder="Project Name" required autofocus > 
                                            </div>
 
                                            
                                            <div class="col-md-12">
                                            <label for="Estimated_Finish_Date">Estimated Finish Date:</label>
                                            <input type="date" class="form-control" id="Estimated_Finish_Date" name="Estimated_Finish_Date" value="<?php echo $Estimated_Finish_Date; ?>"  required autofocus> 
                                            
                                            </div>

                                            
                                            <div class="col-md-12">
                                            <label for="ArchitectName">Architect Name:</label>
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
                                                    // $$count_EmpId ['COUNT(EmpId)'];
                                                endwhile;
                                            ?>
                                             <select></select>
                                            </div>

                                   
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="editproject"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>                                     
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    


                    <!--Delete Project Modal -->
                      <div id="delete<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Remove</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-danger">Are you sure you want to remove <strong>
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
                      
                      <!--Edit Approve Modal -->
                      <div id="editapprove<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <!-- <h4  class="fas fa-exclamation-triangle"></h4> -->
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-default">Are you sure you want to approve <strong>
                                                <?php echo $Blueprint; ?>?</strong> </div>


                                        <div class="modal-footer">
                                         <!--  <div style="padding-left: 50px;">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                          </div>
                                           -->

                                          <button type="submit" name="editapprove" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Approve</button>

                                          <button type="submit" name="editreject" class="btn btn-danger" ><span class="glyphicon glyphicon-remove-circle"></span> Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                      <!--First Stage Modal -->
                      <div id="first<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                         <h4>Confirm</h4> 
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-info">Are you sure this project will undergo 1st stage structure?</div>


                                        <div class="modal-footer">
                                          <button type="submit" name="first" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Yes</button>

                                           <button type="button" class="btn btn-default" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-circle"></span> No</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                      <!--Second Stage Modal -->
                      <div id="second<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                         <h4>Confirm</h4> 
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-info">Are you sure this project will undergo 2nd stage of structure?</div>


                                        <div class="modal-footer">
                                          <button type="submit" name="second" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Yes</button>

                                           <button type="button" class="btn btn-default" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-circle"></span> No</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                      <!--Complete Modal -->
                      <div id="complete<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                         <h4>Confirm</h4> 
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                                        <div class="alert alert-info">Are you sure you want to tag this project as 100% complete?</div>


                                        <div class="modal-footer">
                                          <button type="submit" name="complete" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Yes</button>

                                           <button type="button" class="btn btn-default" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-circle"></span> No</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                      <!-- View Timeline -->
                      <div id="viewtimeline<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4>Activity Timeline</h4> 
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <?php
                                                    while ($rowTimeline = mysqli_fetch_array($resultTimeline)) :
                                                        $Description = $rowTimeline['Description'];
                                                        $originalDate = $rowTimeline['Date'];
                                                        $newDate = date("F j, Y", strtotime($originalDate));
                                                    ?>
                                                        <!-- <li class="timeline-inverted"> -->
                                                           <!--  <div class="timeline-badge bg-success"><i class="fa fa-hard-hat text-white"></i></div> -->
                                                            <div class="timeline-panel" style="padding-bottom: 3px;">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title" style="font-size: 14px;"><?php echo $newDate; ?></h4>
                                                                    <!-- <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p> -->
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <blockquote>
                                                                        <p><?php echo $Description; ?></p>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        <!-- </li> -->
                                                        <?php endwhile; ?>
                            </div>                    
                          </div>
                        </div>
                      </div>
                    
                </tr>

              <?php endwhile; 

                 // edit project process
                  if(isset($_POST['editproject']))
                  {
                     $ProjectId = $_POST['ProjectId'];
                     $ProjectName = $_POST['ProjectName'];
                     $EmpId = $_POST['EmpId'];
                     $Estimated_Finish_Date = $_POST['Estimated_Finish_Date'];
                  
                   
                    $sql = "UPDATE project SET 
                        ProjectName='$ProjectName',
                        EmpId='$EmpId',
                        Estimated_Finish_Date='$Estimated_Finish_Date'
                        WHERE ProjectId='$ProjectId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="pm-projects-fitout.php"</script>';
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
                      echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  } else {
                      echo "Error updating record: " . $con->error;
                  }
                }
                
                    // edit approve process
                if(isset($_POST['editapprove']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $BlueprintStatusId = 3;
                 
                  $sql = "UPDATE project SET 
                      
                      BlueprintStatusId = '$BlueprintStatusId',
                      Progress = Progress + 10
                      WHERE ProjectId ='$ProjectId' ";
                
                  $sql2 = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Proposed design has been approved')";
                  if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE) {
                      echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  } else {
                      echo "\nError: " . $sql . "<br>" . $con->error; 
                      echo "\nError2: " . $sql2 . "<br>" . $con->error; 
                  }
                }

                    // edit reject process
                if(isset($_POST['editreject']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $BlueprintStatusId = 4;
                 
                  $sql = "UPDATE project SET 
                      
                      BlueprintStatusId = '$BlueprintStatusId'
                      WHERE ProjectId ='$ProjectId' ";
                      
                  $sql2 = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Proposed design has been rejected')";
                  if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE) {
                      echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  } else {
                      echo "\nError: " . $sql . "<br>" . $con->error; 
                      echo "\nError2: " . $sql2 . "<br>" . $con->error;
                  }
                }
                
                
                    // Add new project process
                if(isset($_POST['addproject']))
                {
                    
                  $FirstName = $_POST['FirstName'];
                  $LastName = $_POST['LastName'];
                  $Email = $_POST['Email'];
                  $ContactNum = $_POST['ContactNum'];
                  $Address = $_POST['Address'];
                //   $ClientId = $_POST['ClientId'];
                  $StatusId = 3;
                  $Password = 55555;
                  
                  $FurnitureType = $_POST['FurnitureType'];               
                  $Length = $_POST['Length'];
                  $Width = $_POST['Width'];      
                  $Description = $_POST['Description'];                
                  $Quantity = $_POST['Quantity'];
                  
                  $Assessment = $_POST['Assessment'];
                  $Initial_Payment = $_POST['Initial_Payment'];
                  $Mode_Payment = $_POST['Mode_Payment'];
                  $Balance  = $Assessment - $Initial_Payment;
                  $TransactionNum = $_POST['TransactionNum'];
                  
                  $ProjectName = $_POST['ProjectName'];
                  $EmpId = $_POST['EmpId']; 
                  $BlueprintStatusId = 1;
                  $ServiceTypeId = 3;
                  $Estimated_Finish_Date = $_POST['Estimated_Finish_Date'];
                  
                  $sql1 = "INSERT INTO client (FirstName, LastName, Email, ContactNum, Address, StatusId, Password) VALUES ('$FirstName', '$LastName', '$Email', '$ContactNum', '$Address', '$StatusId', '$Password')";
                  
                  if ($con->query($sql1) === TRUE )
                  {
                      $query = "SELECT MAX(ClientId) as ClientId FROM `client` order by MAX(ClientId) DESC";
                      $result = mysqli_query($con, $query);
                      $MaxClientId = mysqli_fetch_assoc($result);
                      $ClientId = $MaxClientId['ClientId'];
                        
                      $sql2 = "INSERT INTO project (ProjectName, EmpId, BlueprintStatusId, ServiceTypeId, ClientId, Estimated_Finish_Date, Progress) VALUES ('$ProjectName', '$EmpId', '$BlueprintStatusId', '$ServiceTypeId', '$ClientId', '$Estimated_Finish_Date', 20)";
                      
                      if ($con->query($sql2) === TRUE )
                      {
                         $query2 = "SELECT MAX(ProjectId) as ProjectId FROM `project` order by MAX(ProjectId) DESC";
                         $result2 = mysqli_query($con, $query2);
                         $MaxProjectId = mysqli_fetch_assoc($result2);
                         $ProjectId = $MaxProjectId['ProjectId'];
                         
                        $Drawing = $_FILES["Drawing"]["name"];
                        $tmp_name = $_FILES["Drawing"]["tmp_name"];
                        $path = "../Admin/drawing/".$Drawing;
                        $Drawing1 = explode(".",$Drawing);
                        $ext = $Drawing1[1];
                        $allowed = array("jpg","png","jpeg","pdf","docx");
                        if(in_array($ext, $allowed))
                        {
                          move_uploaded_file($tmp_name, $path);  
                        }
                         
                            $sql3 = "INSERT INTO fitout (FurnitureType, Length, Width, Description, Drawing, ProjectId, Quantity) VALUES ('$FurnitureType', '$Length', '$Width', '$Description','$Drawing', '$ProjectId', '$Quantity')";
                         
                            $sql4 = "INSERT INTO payment (Assessment, Initial_Payment, ProjectId, Balance) VALUES ('$Assessment', '$Initial_Payment', '$ProjectId', '$Balance')";
                            
                            $sql8 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project approved by contractor')";
                        
                            $sql9 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project assigned to architect')";
                         
                            if ($con->query($sql3) === TRUE && $con->query($sql4) === TRUE && $con->query($sql8) === TRUE && $con->query($sql9) === TRUE )
                            {
                                $query3 = "SELECT MAX(PaymentId) as PaymentId FROM `payment` order by MAX(PaymentId) DESC";
                                $result3 = mysqli_query($con, $query3);
                                $MaxPaymentId = mysqli_fetch_assoc($result3);
                                $PaymentId = $MaxPaymentId['PaymentId'];
                                $Mode_Payment = $_POST['Mode_Payment'];
                            
                                $sql5 = "INSERT INTO paymentbreakdown (Amount, Mode_Payment, PaymentId, TransactionNum) VALUES ('$Initial_Payment', '$Mode_Payment', '$PaymentId', '$TransactionNum')";
                            
                                if ($con->query($sql5) === TRUE )
                                {
                                    echo '<script>window.location.href="pm-projects-fitout.php"</script>';  
                                }
                                else
                                {
                                    echo "\nError5: " . $sql5 . "<br>" . $con->error;  
                                }
                            }
                            else
                            {
                                echo "\nError3: " . $sql3 . "<br>" . $con->error;
                                echo "\nError4: " . $sql4 . "<br>" . $con->error;
                                echo "\nError8: " . $sql8 . "<br>" . $con->error;
                            }
                        
                      }
                      else
                      {
                        echo "\nError2: " . $sql2 . "<br>" . $con->error;   
                      }
                  }
                  else
                  {
                    echo "\nError1: " . $sql1 . "<br>" . $con->error;
                  }
                }

                if (isset($_POST['first']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $Progress = 60;

                  $sqlProgress = "UPDATE project SET Progress = '$Progress' WHERE ProjectId = '$ProjectId'";
                  $sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', '1st stage of structure has started')";

                  if ($con->query($sqlProgress) === TRUE && $con->query($sqlTimeline) === TRUE)
                  {
                    echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  }
                  else 
                  {
                    echo "\nError1: " . $sqlProgress . "<br>" . $con->error;
                    echo "\nError2: " . $sqlTimeline . "<br>" . $con->error;
                  }
                }

                if (isset($_POST['second']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $Progress = 80;

                  $sqlProgress = "UPDATE project SET Progress = '$Progress' WHERE ProjectId = '$ProjectId'";
                  $sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', '2nd stage of structure has started')";

                  if ($con->query($sqlProgress) === TRUE && $con->query($sqlTimeline) === TRUE)
                  {
                    echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  }
                  else 
                  {
                    echo "\nError1: " . $sqlProgress . "<br>" . $con->error;
                    echo "\nError2: " . $sqlTimeline . "<br>" . $con->error;
                  }
                }

                if (isset($_POST['complete']))
                {
                  $ProjectId = $_POST['ProjectId'];
                  $Progress = 100;

                  $sqlProgress = "UPDATE project SET Progress = '$Progress' WHERE ProjectId = '$ProjectId'";
                  $sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Project is complete')";

                  if ($con->query($sqlProgress) === TRUE && $con->query($sqlTimeline) === TRUE)
                  {
                    echo '<script>window.location.href="pm-projects-fitout.php"</script>';
                  }
                  else 
                  {
                    echo "\nError1: " . $sqlProgress . "<br>" . $con->error;
                    echo "\nError2: " . $sqlTimeline . "<br>" . $con->error;
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
  
                          <!-- add Project Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <center><h4 class="modal-title" id="exampleModalLabel">Add New Project</h4></center>
       
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLabel">Client's Information</h5></center>
            <div class = "row"> 
                <div class="col-md-6">
                    <label>First Name<span class="text-danger">*</span></label>
                    <input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="First Name" required > 
                </div>
                <div class="col-md-6">
                    <label>Last Name<span class="text-danger">*</span></label>
                    <input type="text" name="LastName" id="LastName" class="form-control" placeholder="Last Name" required > 
                </div>
                <div class="col-md-6">
                    <label>Contact Number<span class="text-danger">*</span></label>
                    <input type="number" name="ContactNum" id="ContactNum" class="form-control" placeholder="Contact Number" required > 
                </div>
                <div class="col-md-6">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="email" name="Email" id="Email" class="form-control" placeholder="Email" required > 
                </div>
                <div class="col-md-12">
                    <label>Address<span class="text-danger">*</span></label>
                    <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" required > 
                </div>   
                <div class="col-md-12">
                    <br>
                    <h5 class="modal-title" id="exampleModalLabel">Project Specifications</h5></center>
                </div>
                <!-- <div class="col-md-6">
                    <label>Type of Furniture</label>
                    <input type="text" name="FurnitureType" id="FurnitureType" class="form-control" placeholder="Property Location" required="" > 
                </div> -->
                <div class="col-md-6">
                    <label>Type of Furniture<span class="text-danger">*</span></label>
                    <!--<input type="number" name="Car_Garage" id="Car_Garage" class="form-control" placeholder="Car Garage" required="" > -->
                    <select name="FurnitureType" id="FurnitureType" class="form-control" required="" >
                    <option value="Cabinet">Cabinet
                    <option value="Chair">Chair
                    <option value="Desk">Desk
                    <option value="Table">Table
                    <option value="Other">Other
                    </select> 
                </div>
                <div class="col-md-6">
                    <label>Quantity<span class="text-danger">*</span></label>
                    <input type="number" name="Quantity" id="Quantity" class="form-control" placeholder="Quantity" required > 
                </div>
                <div class="col-md-6">
                    <label>Length<span class="text-danger">*</span></label>
                    <input type="number" name="Length" id="Length" class="form-control" placeholder="Length" required > 
                </div>
                <div class="col-md-6">
                    <label>Width<span class="text-danger">*</span></label>
                    <input type="number" name="Width" id="Width" class="form-control" placeholder="Width" required > 
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <textarea name="Description" id="Description" class="form-control" rows = "4" placeholder="Description"></textarea> 
                </div>
                <div class="col-md-6">
                    <label>Upload a Drawing</label>
                    <input type="file" name="Drawing" id="Drawing">
                    <!--<input type="submit" value="Upload Image" name="submit">-->
                </div>
                               
                <div class="col-md-12">
                    <br>
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5></center>
                </div>
                <div class="col-md-3">
                    <label for="Assessment">Assessment<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="Assessment" name="Assessment"  placeholder="Enter Amount" required autofocus> 
                </div>

                <div class="col-md-3">
                    <label for="Initial_Payment">Initial Payment</label>
                    <input type="number" class="form-control" id="Initial_Payment" name="Initial_Payment"  placeholder="Enter Amount"> 
                </div>
                                          
                <div class="col-md-3">
                    <label for="Mode_Payment">Mode of Payment</label>
                    <input type="text" class="form-control" id="Mode_Payment" name="Mode_Payment"  placeholder="Mode of Payment">
                </div>
                <div class="col-md-3">
                    <label for="TransactionNum">Transaction Number</label>
                    <input type="text" class="form-control" id="TransactionNum" name="TransactionNum"  placeholder="Transaction Number">
                </div>
                <div class="col-md-12">
                    <br>
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5></center>
                </div>
                
                <div class="col-md-4">
                    <label for="EmpId">Assign To<span class="text-danger">*</span></label>
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
                                    // $$count_EmpId ['COUNT(EmpId)'];
                                endwhile;
                    ?>
                    <select></select>
                </div>

                <div class="col-md-4">
                    <label for="ProjectName">Project Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ProjectName" name="ProjectName"  placeholder="Project Name" required autofocus>
                </div>
                <div class="col-md-4">
                    <label for="Estimated_Finish_Date">Estimated Finish Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="Estimated_Finish_Date" name="Estimated_Finish_Date"   required autofocus>
                </div>
            </div>
          </div>
          
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="addproject">Save</button>    
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php');?>
 