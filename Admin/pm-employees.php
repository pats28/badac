<?php 
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<?php
  if(isset($_POST['btnSearch_employee']))
  {
      $search_employee = $_POST['search_employee'];
      // search in all table columns
      // using concat mysql function
      $query = "SELECT * FROM employee as e, department as d WHERE e.isdelete = 0 AND e.DeptId = d.DeptId AND CONCAT(e.EmpId, e.EmpFirstName, e.EmpLastName, e.ContactNum, e.Email, e.Username, d.DeptName) LIKE '%".$search_employee."%'";
      $search_result = searchTable($query);    
  }
  else {
      $query = "SELECT * FROM employee as e, department as d WHERE e.isdelete = 0 AND e.DeptId = d.DeptId";
      $search_result = searchTable($query);
  }

  // function to connect and execute the query
  function searchTable($query)
  { 
      include ('config.php');
      // $connect = mysqli_connect("localhost", "root", "", "psgdb");
      $search_Result = mysqli_query($con, $query);
      return $search_Result;
  }
?>
 
<!-- add Employee Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form method="post" >
      <div class="modal-header">
         <center> <h4 class="modal-title" id="exampleModalLabel">Add New Employee</h4></center>
       
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <label>First Name</label>
                <input type="text" name="EmpFirstName" id="EmpFirstName" class="form-control" required >      
            </div>
            
            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="EmpLastName" id="EmpLastName" class="form-control" required >      
            </div>
            
            <div class="col-md-12">
                <label>Address</label>
                <input type="text" name="Address" id="Address" class="form-control" required="" >
            </div>    
              
            <div class="col-md-12">
                <label>Email</label>
                <input type="email" name="Email" id="Email" class="form-control" required="">
            </div>
            <div class="col-md-12">
                <label>Contact Number </label>
                <input type="number" name="ContactNum" id="ContactNum" class="form-control" required="">
            </div>
            
            <div class="col-md-6">
                <label>Username</label>
                <input type="text" name="Username" id="Username" class="form-control" required >      
            </div>
            
            <div class="col-md-6">
                <label>Password</label>
                <input type="text" name="Password" id="Password" class="form-control" required >      
            </div>

            <div class="col-md-12">
                <label>Department</label>
            <!-- <input type="text" name="DeptName" id="DeptName" class="form-control" required=""> -->
                <select name="DeptName" id="DeptName" class="form-control" required="" >
                    <option value="Architect">Architect
                    <option value="Finance">Finance
                    <option value="Construction">Construction
                </select>        
            </div>    
                
         </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="addemployee">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </form>
    </div>
  </div>
</div> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees</h1>
          </div>  
          <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="projectmanager.php">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div>
          
           <!-- <div class="col-12">
              <a href="#add<?php echo $EmpId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addmodal" style="margin-top: 10px;">
            <i class="fas fa-plus"></i> Add New Employee</button></a>
          </div> -->
          
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header" style="background-color: #708090">
          <!-- <h3 class="card-title">Employee</h3> -->
          <a href="#add<?php echo $EmpId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-success float-right shadow" data-toggle="modal" data-target="#addmodal" >
            <i class="fas fa-plus"></i>&nbsp;  &nbsp; Add New Employee</button></a>

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
          <!-- <table class="table table-striped projects"> -->
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                     <!--<th style="width: 1%; text-align: center;">-->
                     <!--      ID-->
                     <!-- </th>-->
                      <th style="width: 15%; text-align: center;">
                          Name
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Department
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Contact Number
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Email
                      </th>
                      <th style="width: 10%; text-align: center;">
                          Username
                      </th>
                      <!--<th style="width: 10%; text-align: center;">-->
                      <!--    Password-->
                      <!--</th>-->
                      <th style="width: 15%; text-align: center;" >
                          Actions
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($search_result)): 

                  $EmpId = $row['EmpId']; 
                  $EmpFirstName= $row['EmpFirstName']; 
                  $EmpLastName= $row['EmpLastName'];
                  $Password = $row['Password'];
                  $Email = $row['Email'];
                  $ContactNum = $row['ContactNum']; 
                  $Username  = $row['Username'];
                  $DeptName  = $row['DeptName'];
                ?>
                  <tr>
                    <!--<td style="text-align: center;"><?php echo $EmpId; ?></td>-->
                    <td style="text-align: center;"><?php echo $EmpFirstName." ".$EmpLastName; ?></td>
                    <td style="text-align: center;"><?php echo $DeptName;?></td>
                    <td style="text-align: center;"><?php echo $ContactNum;?></td>
                    <td style="text-align: center;"><?php echo $Email; ?></td>
                    <td style="text-align: center;"><?php echo $Username; ?></td>
                    <!--<td style="text-align: center;"><?php echo $Password; ?></td> -->
                    <td style="text-align: center;">
                         <!-- <a href="#view<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                            
                         <a href="#edit<?php echo $EmpId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" style = "font-size: 13px;">
                         <i class="fas fa-pencil-alt"></i> Edit</button> </a>

                         <a href="#delete<?php echo $EmpId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold" style = "font-size: 13px;">
                         <i class="fas fa-trash"></i> Remove</button></a>
                    </td>
 
                     <!--Edit Employee Modal -->
                    <div id="edit<?php echo $EmpId; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Employee</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="EmpId" value="<?php echo $EmpId; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="EmpFirstName">First Name:</label>
                                                <input type="text" class="form-control" id="EmpFirstName" name="EmpFirstName" value="<?php echo $EmpFirstName; ?>" placeholder="First Name" required autofocus > 
                                            </div>
                                            <div class="col-md-6">
                                                <label for="EmpLastName">Last Name:</label>
                                                <input type="text" class="form-control" id="EmpLastName" name="EmpLastName" value="<?php echo $EmpLastName; ?>" placeholder="Last Name" required autofocus > 
                                            </div>
                                            <div class="col-md-12">
                                            <label>Department:</label>
                                                <!-- <input type="text" name="DeptName" id="DeptName" class="form-control" required=""> -->
                                                <select name="DeptName" id="DeptName" class="form-control" required="" >
                                                  <option value="Architect">Architect
                                                  <option value="Finance">Finance
                                                  <option value="Construction">Construction
                                                </select>        
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label for="ContactNum">Contact Number:</label>
                                                <input type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $ContactNum; ?>" placeholder="Contact Number" required autofocus> 
                                            </div>

                                            
                                            <div class="col-md-12">
                                                <label for="Email">Email:</label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" placeholder="Email" required autofocus> 
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label for="Username">Username:</label>
                                                <input type="text" class="form-control" id="Username" name="Username" value="<?php echo $Username; ?>" placeholder="Username" required autofocus> 
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label for="Password">Password:</label>
                                                <input type="text" class="form-control" id="Password" name="Password" value="<?php echo $Password; ?>" placeholder="Password" required autofocus > 
                                            </div>

                                            

                                            <!-- <label for="DeptName">Department:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="DeptName" name="DeptName" value="<?php echo $DeptName; ?>" placeholder="Department" required autofocus> 
                                            </div> -->


                                             
                          
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="editemployee"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--Delete Employee Modal -->
                      <div id="delete<?php echo $EmpId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Remove</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="EmpId" value="<?php echo $EmpId; ?>">
                                        <div class="alert alert-danger">Are you sure you want to remove <strong>
                                                <?php echo $EmpFirstName." ".$EmpLastName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="deleteemployee" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>

                  </tr>

                <?php endwhile;

                 // edit employee process
                  if(isset($_POST['editemployee']))
                  {
                    $EmpId = $_POST['EmpId'];
                    $EmpFirstName = $_POST['EmpFirstName'];
                    $EmpLastName = $_POST['EmpLastName'];
                    $Password = $_POST['Password'];
                    $Email = $_POST['Email'];
                    $Username = $_POST['Username'];
                    $ContactNum = $_POST['ContactNum'];
                    $DeptName = $_POST['DeptName'];

                    if ($DeptName == "Architect")
                    {
                      $DeptId = 3;
                    }

                    else if ($DeptName == "Finance")
                    {
                      $DeptId = 2;
                    }
                    else $DeptId = 1;

                    $sql = "UPDATE employee SET 
                        EmpFirstName = '$EmpFirstName',
                        EmpLastName = '$EmpLastName',
                        Password = '$Password',
                        Email = '$Email',
                        Username = '$Username',
                        ContactNum = '$ContactNum',
                        DeptId = '$DeptId'
                        WHERE EmpId = '$EmpId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="pm-employees.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                       // softdelete process
                  if(isset($_POST['deleteemployee']))
                  {
                    $EmpId = $_POST['EmpId'];
                    $isdelete = '1';
                 
                    $sql = "UPDATE employee SET 
                      
                      isdelete ='1'
                      WHERE EmpId ='$EmpId' ";
                    if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="pm-contact-employee.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                     //Add Employee process
                if(isset($_POST['addemployee']))
                {
                  $EmpLastName = $_POST['EmpLastName'];
                  $EmpFirstName = $_POST['EmpFirstName'];
                  $Address = $_POST['Address'];                
                  $Email = $_POST['Email'];
                  $ContactNum = $_POST['ContactNum'];
                  $DeptName = $_POST['DeptName'];
                  $Username = $_POST['Username'];
                  $Password = $_POST['Password'];

                  if ($DeptName == "Architect")
                    {
                      $DeptId = 3;
                    }

                    else if ($DeptName == "Finance")
                    {
                      $DeptId = 2;
                    }
                    else $DeptId = 1;

                  $sql = "INSERT INTO employee (EmpFirstName, EmpLastName, Address, Email, ContactNum, Username, Password, DeptId)VALUES ('$EmpFirstName', '$EmpLastName', '$Address','$Email','$ContactNum', '$Username', '$Password', '$DeptId')";
                  if ($con->query($sql) === TRUE) 
                      {                  
                          echo '<script>window.location.href="pm-employees.php"</script>';
                      } 
                      else 
                      {
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

   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php');?>

 