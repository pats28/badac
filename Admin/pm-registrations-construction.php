<?php
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<head>
    <style>
        .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
    </style>
</head>

<?php

  
 
    $query = "SELECT * FROM client as c, estimate as e, status as s where c.ClientId = e.ClientId AND s.StatusId = c.StatusId AND e.isdelete = 0 ORDER BY EstimateId DESC";
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
                        <li class="breadcrumb-item active">Building</li>
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
          <h3 class="card-title" style="color: white">Building</h3>
  
        </div>

        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">  
              <thead>
                  <tr>
                  
                      <th style="width: 15%" class="text-center">
                          Client Name
                      </th>
                      <th style="width: 12%" class="text-center">
                          Contact Number
                      </th>
                      <th style="width: 20%" class="text-center">
                          Address
                      </th>
                      <th style="width: 15%" class="text-center">
                          Email
                      </th>

                      <th style="width: 15%" class="text-center">
                          Estimate Details
                      </th>
                      <th style="width: 10%" class="text-center">
                          Status
                      </th>
                     <!--  <th style="width: 8%" class="text-center">
                          Status
                      </th> -->
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
                  $e_Property_Loc = $row['e_Property_Loc'];
                  $e_Lot_Area = $row['e_Lot_Area'];
                  $e_Length = $row['e_Length'];
                  $e_Width = $row['e_Width'];
                  $e_Floor_Area = $row['e_Floor_Area'];
                  $e_Floor_Levels = $row['e_Floor_Levels'];
                  $e_Rooms = $row['e_Rooms'];
                  $e_Toilet_Bath = $row['e_Toilet_Bath'];
                  $e_Car_Garage = $row['e_Car_Garage'];
                  $e_Classification = $row['e_Classification'];
                  $e_Preferred_Design = $row['e_Preferred_Design'];
                  $e_Preferred_Finish = $row['e_Preferred_Finish'];
                  $Description = $row['Description'];
                  $Drawing = $row['Drawing'];

                  
                  $sqlAccept = "SELECT * from acceptproject WHERE ClientId = '$ClientId'";
                  $resultAccept = mysqli_query($con, $sqlAccept);
                  $rowAccept = mysqli_fetch_assoc($resultAccept);
                  // $MaterialsCost = $row['MaterialsCost'];
                ?> 

                <tr>
                  <!--<td style="text-align: center;"><?php echo $ClientId; ?></td>-->
                  <td ><?php echo $FirstName." ".$LastName; ?></td>
                  <td ><?php echo $ContactNum; ?></td>
                  <td ><?php echo $Address;?></td>
                  <td ><?php echo $Email; ?></td>
                  <!--<td style="text-align: center;"><?php echo $Password;?></td>-->
                  <!-- <td style="text-align: center;"><?php echo $Progress; ?></td> -->
                  <td  style="text-align: center;">
                    
                    <a href="#view<?php echo $ClientId; ?>" data-toggle="modal">
                         <!--<button type="button" class="btn btn-info btn-sm " >-->
                         <i class="fas fa-eye"></i>&nbsp;View</a></i>
                   
                    <!--<a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">-->
                    <!--     <button type="button" class="btn btn-info btn-sm " >-->
                    <!--     <i class="fas fa-eye"></i>&nbsp;Drawing</button></a>-->
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
                      else if ($StatusId == 2)  {
                    ?>
                        <span class="badge badge-warning"><i> Proposed </i></span>  
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
                    
                    
                      <?php
                        if ($StatusId == 1) 
                        {                          
                      ?>
                          <a href="#accept<?php echo $ClientId; ?>" data-toggle="modal">
                          <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold"><i class="fas fa-check"></i>&nbsp;Accept</button></a>

                      <?php 
                        }
                        else if ($StatusId == 2) 
                        { 
                      ?>
                          <?php

                            $sqlMaterials = "SELECT * from acceptproject where ClientId = '$ClientId'";
                            $result = mysqli_query($con, $sqlMaterials);
                            $rowMaterials = mysqli_fetch_assoc($result);

                            if ($rowMaterials['MaterialsCost'] > 0)
                            {


                          ?>
                              <a href="pm-project-contract.php?ClientId=<?php echo $ClientId; ?>" target="_blank">
                              <button type="button" class="btn btn-info btn-sm btn-block font-weight-bold">&nbsp;Generate Contract</button></a>

                              <a href="#yes<?php echo $ClientId; ?>" data-toggle="modal">
                              <button type="button" class="btn btn-warning btn-sm btn-block mt-1 font-weight-bold"><i class="fas fa-plus"></i>&nbsp;Add to Project</button></a>
                          <?php
                            }
                            else if ($rowMaterials['MaterialsCost'] == 0)
                            {
                          ?>
                              <a href="#contract<?php echo $ClientId; ?>" data-toggle="modal">
                              <button type="button" class="btn btn-info btn-sm btn-block font-weight-bold" disabled="">&nbsp;Generate Contract</button></a>

                              <a href="#yes<?php echo $ClientId; ?>" data-toggle="modal">
                              <button type="button" class="btn btn-warning btn-sm btn-block mt-1 font-weight-bold" disabled=""><i class="fas fa-plus"></i>&nbsp;Add to Project</button></a>
                          <?php
                            }
                          ?>
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
                                                <?php echo $FirstName." ".$LastName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="deleteregi" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>


                     <!--  Accept Modal -->
                     <div id="accept<?php echo $ClientId; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="post" class="form-horizontal" role="form" >
                            <div class="modal-dialog modal-lg" role="document">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     <h5 class="modal-title">Accept Project</h5> 

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>                                  
                                    <div class="modal-body">
                                      <!--<p style="color: red; font-size: 11px;">Note: Put N/A or 0 if not applicable.</p>-->
                                        <div class="row">
                                          <div class="col-md-12 mt-2">
                                            <h5 class="modal-title" id="exampleModalLabel">Project Specifications</h5></center>
                                          </div>
                                          <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                          <div class="col-md-6 ">
                                            <label>Property Location<span class="text-danger">*</span></label>
                                            <input type="text" name="e_Property_Loc" id="Property_Loc" class="form-control" value="<?php echo $e_Property_Loc; ?>" placeholder="Property Location" required="" > 
                                          </div>
                                          <div class="col-md-6">
                                            <label>Classification<span class="text-danger">*</span></label>
               
                                            <select name="e_Classification" id="Classification" value="<?php echo $e_Classification; ?>" class="form-control" required >
                                              <option value="Residential">Residential
                                              <option value="Commercial">Commercial
                                              <option value="Industrial">Industrial
                                              <option value="Other">Other
                                            </select> 
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <label>Preferred Design<span class="text-danger">*</span></label>
 
                                              <select name="e_Preferred_Design" id="Preferred_Design" value="<?php echo $e_Preferred_Design; ?>" class="form-control" required>
                                                <option value="Asian">Asian
                                                <option value="Contemporary">Contemporary
                                                <option value="Mediterranean">Mediterranean
                                                <option value="Zen">Zen
                                                <option value="Other">Other
                                              </select>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <label>Preferred Finish<span class="text-danger">*</span></label>
                    
                                              <select name="e_Preferred_Finish" id="Preferred_Finish" value="<?php echo $e_Preferred_Finish; ?>" class="form-control" required >
                                                <option value="Basic">Basic
                                                <option value="Standard">Standard
                                                <option value="Semi-Elegant">Semi-Elegant
                                                <option value="Elegant">Elegant
                                                <option value="Other">Other
                                              </select>
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Lot Area<span class="text-danger">*</span></label>
                                              <input type="number" name="e_Lot_Area" id="Lot_Area" class="form-control" value="<?php echo $e_Lot_Area; ?>" placeholder="Lot Area" required > 
                                          </div> 
                                          <div class="col-md-3 mt-2">
                                            <label>Floor Area<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Floor_Area" id="Floor_Area" class="form-control" value="<?php echo $e_Floor_Area; ?>" placeholder="Floor Area" required > 
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Width<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Width" id="Width" class="form-control" value="<?php echo $e_Width; ?>" placeholder="Width" required > 
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Length<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Length" id="Length" class="form-control" value="<?php echo $e_Length; ?>" placeholder="Length" required > 
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Floor Levels<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Floor_Levels" id="Floor_Levels" class="form-control" value="<?php echo $e_Floor_Levels; ?>" placeholder="Floor Levels" required > 
                                          </div> 
                                          <div class="col-md-3 mt-2">
                                            <label>Rooms<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Rooms" id="Rooms" class="form-control" value="<?php echo $e_Rooms; ?>" placeholder="Rooms" required> 
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Toilet Bath<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Toilet_Bath" id="Toilet_Bath" class="form-control" value="<?php echo $e_Toilet_Bath; ?>" placeholder="Toilet Bath" required > 
                                          </div>
                                          <div class="col-md-3 mt-2">
                                            <label>Car Garage<span class="text-danger">*</span></label>
                                            <input type="number" name="e_Car_Garage" id="Car_Garage" class="form-control" value="<?php echo $e_Car_Garage; ?>" placeholder="Car Garage" required > 
                                          </div>
                                            

                                            <div class="col-md-6 mt-2">
                                                <label for="ProjectName"><span style = "color: red">*</span>Assign To:</label>
                                                <select class="form-control" name="EmpId" id="EmpId">
                                      <?php 

                                        $query2 = "SELECT e.EmpFirstName, e.EmpLastName, e.EmpId, (SELECT COUNT(p.EmpId) FROM project as p WHERE p.EmpId = e.EmpId AND p.Progress < 100)AS count_EmpId FROM employee as e WHERE e.DeptId = 3 ";

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
                                      ?>
                                          <?php endwhile; ?>
                                          <select></select>
                                          </div>
                                          
                                          <div class="col-md-6 mt-2">
                                              <label for="ProjectName"><span style = "color: red">*</span>Project Name</label>
                                                <input type="text" class="form-control" id="ProjectName" name="ProjectName"  placeholder="Project Name" required autofocus> 
                                          </div>
                                          <div class="col-md-6 mt-2">
                                              <label for="StartDate"><span style = "color: red">*</span>Start Date</label>
                                                <input type="date" class="form-control" id="StartDate" name="StartDate"  required autofocus> 
                                          </div>
                                          <div class="col-md-6 mt-2">
                                              <label for="DueDate"><span style = "color: red">*</span>Due Date</label>
                                                <input type="date" class="form-control" id="DueDate" name="DueDate"  required autofocus> 
                                          </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning" name="acceptproject"><span class="glyphicon glyphicon-edit"></span> Save </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    
                        
    <!-- View Project Modal -->
<div class="modal fade" id="view<?php echo $ClientId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="col-md-6">
                    <label>Property Location</label>
                    <input type="text" name="e_Property_Loc" id=e_Property_Loc" value="<?php echo $e_Property_Loc; ?>" class="form-control" disabled  > 
                </div>
                <div class="col-md-6">
                    <label>Classification</label>
                    <input type="text" name="e_Car_Garage" id="e_Car_Garage" value="<?php echo $e_Classification; ?>" class="form-control" disabled > 
                  
                </div>
                <div class="col-md-6">
                    <label>Preferred Design</label>
                    <input type="text" name="e_Preferred_Design" id="e_Preferred_Design" value="<?php echo $e_Preferred_Design; ?>" class="form-control"  disabled> 
                    
                </div>
                <div class="col-md-6">
                    <label>Preferred Finish</label>
                    <input type="text" name="e_Preferred_Finish" id="e_Preferred_Finish" value="<?php echo $e_Preferred_Finish; ?>" class="form-control" disabled > 
                   
                </div>
                <div class="col-md-3">
                    <label>Lot Area</label>
                    <input type="number" name="e_Lot_Area" id="e_Lot_Area" value="<?php echo $e_Lot_Area; ?>" class="form-control" disabled > 
                </div> 
                <div class="col-md-3">
                    <label>Floor Area</label>
                    <input type="number" name="e_Floor_Area" id="e_Floor_Area" value="<?php echo $e_Floor_Area; ?>" class="form-control" disabled > 
                </div>
                <div class="col-md-3">
                    <label>Width</label>
                    <input type="number" name="e_Width" id="e_Width" value="<?php echo $e_Width; ?>" class="form-control" disabled> 
                </div>
                <div class="col-md-3">
                    <label>Length</label>
                    <input type="number" name="e_Length" id="e_Length" value="<?php echo $e_Length; ?>" class="form-control" disabled > 
                </div>
                <div class="col-md-3">
                    <label>Floor Levels</label>
                    <input type="number" name="e_Floor_Levels" id="e_Floor_Levels" value="<?php echo $e_Floor_Levels; ?>" class="form-control" disabled > 
                </div> 
                <div class="col-md-3">
                    <label>Rooms</label>
                    <input type="number" name="e_Rooms" id="e_Rooms" value="<?php echo $e_Rooms; ?>" class="form-control" disabled > 
                </div>
                <div class="col-md-3">
                    <label>Toilet Bath</label>
                    <input type="number" name="e_Toilet_Bath" id="e_Toilet_Bath" value="<?php echo $e_Toilet_Bath; ?>"  class="form-control" disabled > 
                </div>
                <div class="col-md-3">
                    <label>Car Garage</label>
                    <input type="number" name="e_Car_Garage" id="e_Car_Garage" value="<?php echo $e_Car_Garage; ?>"  class="form-control" disabled> 
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <textarea name="Description" id="Description" class="form-control" rows = "4" disabled><?php echo $Description; ?></textarea> 
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
           <!--<button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

                   <!--Are you sure Modal -->
                      <div id="yes<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title"><i class="fa fa-question" ></i></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                        <div class="alert alert-warning">Are you sure you want to add <strong>
                                                <?php echo $FirstName." ".$LastName; ?></strong>'s Estimate to Project List? </div>
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
                    <div id="add<?php echo $ClientId; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="modal-dialog modal-lg" role="document">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     <h5 class="modal-title">Approved Project </h5> 

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>                                  
                                    <div class="modal-body">
                                      <!--<p style="color: red; font-size: 11px;">Note: Put N/A or 0 if not applicable.</p>-->
                                        <div class="row">
                                          <div class="col-md-12 mt-2">
                                            <!-- <h5 class="modal-title" id="exampleModalLabel">Project Specifications</h5></center> -->
                                          </div>
                                          <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                          
                                            <input type="hidden" name="e_Property_Loc" id="Property_Loc"  value="<?php echo $e_Property_Loc; ?>"> 
                                                                                   
                                            <input type="hidden" name="e_Classification" id="Classification"  value="<?php echo $e_Classification; ?>"> 

                                            <input type="hidden" name="e_Preferred_Design" id="Preferred_Design"  value="<?php echo $e_Preferred_Design; ?>"> 
                                           
                                            <input type="hidden" name="e_Preferred_Finish" id="Preferred_Finish" value="<?php echo $e_Preferred_Finish; ?>"> 

                                            <input type="hidden" name="e_Lot_Area" id="Lot_Area" value="<?php echo $e_Lot_Area; ?>"  > 
                                           
                                            <input type="hidden" name="e_Floor_Area" id="Floor_Area"  value="<?php echo $e_Floor_Area; ?>" > 
                                          
                                            <input type="hidden" name="e_Width" id="Width" value="<?php echo $e_Width; ?>"  > 
                                          
                                            <input type="hidden" name="e_Length" id="Length"  value="<?php echo $e_Length; ?>"  > 
                                          
                                            <input type="hidden" name="e_Floor_Levels" id="Floor_Levels"  value="<?php echo $e_Floor_Levels; ?>" > 
                                          
                                            <input type="hidden" name="e_Rooms" id="Rooms"  value="<?php echo $e_Rooms; ?>" > 
                                          
                                            <input type="hidden" name="e_Toilet_Bath" id="Toilet_Bath"  value="<?php echo $e_Toilet_Bath; ?>"  > 
                                          
                                            <input type="hidden" name="e_Car_Garage" id="Car_Garage" value="<?php echo $e_Car_Garage; ?>" > 
                                            <input type="hidden" name="StartDate" id="StartDate" value="<?php echo $rowAccept['StartDate']; ?>" > 
                                            <input type="hidden" name="Estimated_Finish_Date" id="Estimated_Finish_Date" value="<?php echo $rowAccept['DueDate']; ?>" > 
                                            
                                            <div class="col-md-6 mt-4">
                                                <label for="ProjectName"><span style = "color: red">*</span>Add Project to</label>
                                                <select class="form-control" name="EmpId" id="EmpId" >
                                      <?php 

                                        $query2 = "SELECT e.EmpFirstName, e.EmpLastName, e.EmpId, (SELECT COUNT(p.EmpId) FROM project as p WHERE p.EmpId = e.EmpId AND p.Progress < 100) AS count_EmpId FROM employee as e WHERE e.DeptId = 3 ";

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
                                      ?>
                                          <?php endwhile; ?>
                                          <select></select>
                                          </div>

                                          <div class="col-md-6 mt-4"> <!-- add computation here for total project cost -->
                                              <label for="Assessment"><span style = "color: red">*</span>Estimated Project Cost</label>
                                                <input type="text" class="form-control" name="Assessment"  value="₱<?php echo number_format($rowAccept['ProjectCost']); ?>" >  
                                          </div>
                                          <input type="hidden" name="Assessment" id="Assessment" value="<?php echo $rowAccept['ProjectCost']; ?>"  > 
                                          
                                          
                                          <div class="col-md-6 mt-2">
                                              <label for="ProjectName"><span style = "color: red">*</span>Project Name</label>
                                                <input type="text" class="form-control" id="ProjectName" name="ProjectName" value="<?php echo $rowAccept['ProjectName']; ?>" > 
                                          </div>
                                          <div class="col-md-6 mt-2">
                                              <label for="Initial_Payment"><span style = "color: red">*</span>Initial Payment</label>
                                                <input type="number" class="form-control" id="Initial_Payment" name="Initial_Payment"  placeholder="Enter Amount" required autofocus> 
                                          </div>
                                          <div class="col-md-6 mt-2">
                                              
                                            <label><span style = "color: red">*</span>Upload Signed Contract Agreement</label>
                                            <input type="file" name="Contract" id="Contract" required="">
                                             <!--<input type="submit" value="Upload Image" name="submit">-->
                                             
                                            <br><span style = "font-size: 11px; font-style: italic;">Please upload file in .docx or .pdf format.</span>
                                          </div>

                                          <!-- <div class="col-md-6 mt-2">
                                              <label for="Estimated_Finish_Date"><span style = "color: red">*</span>Estimated Finish Date</label>
                                                <input type="date" class="form-control" id="Estimated_Finish_Date" name="Estimated_Finish_Date"   required autofocus> 
                                          </div> -->
                            
                                          
                                          <div class="col-md-6 mt-2">
                                              <label for="Mode_Payment"><span style = "color: red">*</span>Mode of Payment</label>
                                                <!--<input type="text" class="form-control" id="Mode_Payment" name="Mode_Payment"  placeholder="Mode of Payment" required autofocus>-->
                                                <select class="form-control" name="Mode_Payment" id="Mode_Payment">
                                            <!-- <option value="" selected>Not Applicable -->
                                            <!--<option>-->
                                            <option value="Cash">Cash</option>
                                            <option value="GCash">GCash</option>
                                            
                                            <option value="Cheque">Cheque</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                          </div>
                                          <div class="col-md-6 mt-2"></div>
                                          
                                          <div class="col-md-6 mt-2">
                                              <label for="TransactionNum"><span style = "color: red">*</span>Reference Number</label>
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

                  //Accept Process
                if (isset($_POST['acceptproject']))
                {
                  $e_Property_Loc = $_POST['e_Property_Loc'];
                  $e_Lot_Area = $_POST['e_Lot_Area'];                
                  $e_Length = $_POST['e_Length'];
                  $e_Width = $_POST['e_Width'];      

                  $e_Floor_Area = $_POST['e_Floor_Area'];
                  $e_Floor_Levels = $_POST['e_Floor_Levels'];                
                  $e_Rooms = $_POST['e_Rooms'];
                  $e_Toilet_Bath = $_POST['e_Toilet_Bath'];  
                  $e_Car_Garage = $_POST['e_Car_Garage'];
                  $Description = $_POST['Description'];                
                  $Drawing = $_POST['Drawing'];
                  $e_Classification = $_POST['e_Classification'];
                  $e_Preferred_Design = $_POST['e_Preferred_Design'];                
                  $e_Preferred_Finish = $_POST['e_Preferred_Finish'];

                  $ProjectName = $_POST['ProjectName'];
                  $EmpId = $_POST['EmpId'];  
                  $ClientId = $_POST['ClientId'];
                  $DueDate = $_POST['DueDate'];
                  $StartDate = $_POST['StartDate'];

                  $sqlUpdate = "UPDATE estimate SET 
                      e_Property_Loc = '$e_Property_Loc',
                      e_Lot_Area = '$e_Lot_Area',
                      e_Length = '$e_Length',
                      e_Width = '$e_Width',
                      e_Floor_Area = '$e_Floor_Area',
                      e_Floor_Levels = '$e_Floor_Levels',
                      e_Rooms = '$e_Rooms',
                      e_Toilet_Bath = '$e_Toilet_Bath',
                      e_Car_Garage = '$e_Car_Garage',
                      e_Classification = '$e_Classification',
                      e_Preferred_Design = '$e_Preferred_Design',
                      e_Preferred_Finish = '$e_Preferred_Finish'
                      WHERE ClientId ='$ClientId' ";

                  $sqlInsert = "INSERT INTO acceptproject (ClientId, EmpId, ProjectName, DueDate, StartDate) VALUES ('$ClientId','$EmpId', '$ProjectName', '$DueDate', '$StartDate')";
                  $sqlStatus = "UPDATE client SET
                                StatusId = 2
                                WHERE ClientId = '$ClientId'";
                  if ($con->query($sqlUpdate) === TRUE && $con->query($sqlInsert) === TRUE && $con->query($sqlStatus) === TRUE ) 
                      {  
                        echo '<script type="text/javascript">';
                        echo ' alert("Submitted successfully!")';  
                        echo '</script>';

                        echo '<script>window.location.href="pm-registrations-construction.php"</script>';
                      }
                  else
                  {
                    echo "Error1: " . $sqlUpdate . "<br>" . $con->error;
                    echo "Error2: " . $sqlInsert . "<br>" . $con->error;
                    echo "Error3: " . $sqlStatus . "<br>" . $con->error;
                  }

                }

                   
                        // Add to Project process
                if(isset($_POST['addtoproject']))
                {
                  // $ProjectId = $_POST['ProjectId'];
                  $ProjectName = $_POST['ProjectName'];
                  $EmpId = $_POST['EmpId'];                
                  $ClientId = $_POST['ClientId'];
                  $BlueprintStatusId = 1;
                  $Estimated_Finish_Date = $_POST['Estimated_Finish_Date'];
                  
                  $e_Property_Loc = $_POST['e_Property_Loc'];
                  $e_Lot_Area = $_POST['e_Lot_Area'];                
                  $e_Length = $_POST['e_Length'];
                  $e_Width = $_POST['e_Width'];      

                  $e_Floor_Area = $_POST['e_Floor_Area'];
                  $e_Floor_Levels = $_POST['e_Floor_Levels'];                
                  $e_Rooms = $_POST['e_Rooms'];
                  $e_Toilet_Bath = $_POST['e_Toilet_Bath'];  
                  $e_Car_Garage = $_POST['e_Car_Garage'];
                  $Description = $_POST['Description'];                
                  $Drawing = $_POST['Drawing'];
                  $e_Classification = $_POST['e_Classification'];
                  $e_Preferred_Design = $_POST['e_Preferred_Design'];                
                  $e_Preferred_Finish = $_POST['e_Preferred_Finish'];

                  $Assessment = $_POST['Assessment'];
                  $Initial_Payment = $_POST['Initial_Payment'];

                 // $Contract = $_POST['$Contract'];     
                    
                  $Contract = $_FILES["Contract"]["name"];
                  $tmp_name = $_FILES["Contract"]["tmp_name"];
                  $path = "drawing/".$Contract;
                  $Contract1 = explode(".",$Contract);
                  $ext = $Contract1[1];
                  $allowed = array("jpg","png","jpeg","pdf","docx");
                 if(in_array($ext, $allowed))
                 {
                   move_uploaded_file($tmp_name, $path);
                  } //end if contract
                  $sql = "INSERT INTO project (ProjectName, EmpId, ClientId, BlueprintStatusId, ServiceTypeId, Estimated_Finish_Date, Contract)VALUES ('$ProjectName','$EmpId','$ClientId', '$BlueprintStatusId', 1, '$Estimated_Finish_Date', '$Contract' )";
                  $sql2 = "UPDATE client SET 
                      StatusId = 3,
                      Password = 55555
                      WHERE ClientId ='$ClientId' ";

                   $half = $Assessment/2;
                  if ($Initial_Payment >= $half && $Initial_Payment <= $Assessment)
                  {

                  if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE ) 
                      {  
                        $query = "SELECT MAX(ProjectId) as ProjectId FROM `project` order by MAX(ProjectId) DESC";
                        $result = mysqli_query($con, $query);
                        $MaxProjectId = mysqli_fetch_assoc($result);
                        $ProjectId = $MaxProjectId['ProjectId'];
                        $Balance  = $Assessment - $Initial_Payment;


                        $sql3 = "INSERT INTO payment (ProjectId, Assessment, Initial_Payment, Balance) VALUES ('$ProjectId', '$Assessment', '$Initial_Payment', '$Balance')";
                        $sql4 = "INSERT INTO desiredspecs (ProjectId, Floor_Area, Floor_Levels, Rooms, Toilet_Bath, Car_Garage, Description, Drawing, Property_Loc, Lot_Area, Length, Width, Classification, Preferred_Design, Preferred_Finish) VALUES ('$ProjectId', '$e_Floor_Area','$e_Floor_Levels','$e_Rooms', '$e_Toilet_Bath', '$e_Car_Garage', '$Description', '$Drawing', '$e_Property_Loc','$e_Lot_Area','$e_Length', '$e_Width', '$e_Classification', '$e_Preferred_Design', '$e_Preferred_Finish' )";
                        $sql5 = "UPDATE project SET 
                                  Progress = 10
                                  WHERE ProjectId ='$ProjectId' ";
                        
                        $sql8 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project approved by contractor')";                        
                        $sql9 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Project assigned to architect')";
                        $sql10 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'Signed contract and paid at least 50%')";

                        if ($con->query($sql3) === TRUE && $con->query($sql4) === TRUE && $con->query($sql5) === TRUE && $con->query($sql8) === TRUE && $con->query($sql9) === TRUE && $con->query($sql10) === TRUE)
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
                            echo '<script>window.location.href="pm-registrations-construction.php"</script>';
                          else echo "Error7: " . $sql7 . "<br>" . $con->error;

                          $half = $Assessment * .50;
                          if ($Initial_Payment == $half || $Initial_Payment > $half && $Balance != 0)
                          {
                            // $sql6 = "UPDATE project SET  
                            //       Progress = Progress + 10
                            //       WHERE ProjectId ='$ProjectId' ";
                            $sql6 = "INSERT INTO timeline (ProjectId, Description) VALUES ('$ProjectId', 'You paid $Initial_Payment')";
                          

                            if ($con->query($sql6) === TRUE)
                              echo '<script>window.location.href="pm-registrations-constuction.php"</script>';
                              // echo "okay";
                            else echo "Error: " . $sql6 . "<br>" . $con->error;
                          }
                          else echo '<script>window.location.href="pm-registrations-construction.php"</script>';

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
                  } //end  if ($Initial_Payment >= $half)
                   else
                        {
                          echo '<br><div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><i class="icon fas fa-ban"></i>Initial Payment should be at least 50% of Estimated Project Cost!</h6>
                          </div>';
                          // echo $Initial_Payment;
                           //echo $Assessment;
                          //echo $half;
                        }
                 
                 // else
                 //        {
                 //          echo '<br><div class="alert alert-danger alert-dismissible">
                 //            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 //            <h6><i class="icon fas fa-ban"></i>Please upload the allowed files only.</h6>
                 //          </div>';
                 //        }
                }
                
                      // softdelete process
                if(isset($_POST['deleteregi']))
                {
                  $ClientId = $_POST['ClientId'];
                  $isdelete = '1';
                 
                  $sql = "UPDATE estimate SET 
                      
                      isdelete ='1'
                      WHERE ClientId ='$ClientId' ";
                  if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="pm-registrations-construction.php"</script>';
                  } else {
                      echo "Error updating record: " . $con->error;
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

<?php include('includes/footer.php');?>
