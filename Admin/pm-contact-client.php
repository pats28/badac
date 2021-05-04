<?php 
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<?php
  if(isset($_POST['btnSearch_client']))
  {
      $search_client = $_POST['search_client'];
      // search in all table columns
      // using concat mysql function
      $query = "SELECT * FROM `client` WHERE `isdelete` = 0 AND CONCAT(`ClientId`, `FirstName`, `LastName`, `Address`, `ContactNum`, `Email`) LIKE '%".$search_client."%'";
      $search_result = searchTable($query);    
  }
  else {
      $query = "SELECT * FROM `client` WHERE `isdelete` = 0";
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

<!-- add Client Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form method="post" >
      <div class="modal-header">
         <center> <h4 class="modal-title" id="exampleModalLabel">Add New Contact</h4></center>
       
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class = "row">  
         <div class="col-md-12">
            <label>Client Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" name="FirstName" id="FirstName" class="form-control"  placeholder="First Name" required >      
        </div>
        <div class="col-md-6">
            <input type="text" name="LastName" id="LastName" class="form-control"  placeholder="Last Name" required >      
        </div>
        <div class="col-md-12">
            <label>Address</label>
            <input type="text" name="Address" id="Address" class="form-control"  placeholder="Address" required="" >
        </div>    
              
        <div class="col-md-12">
            <label>Email</label>
            <input type="email" name="Email" id="Email" class="form-control"  placeholder="Address" required="">
             
        </div>
        <div class="col-md-12">
            <label>Contact Number </label>
            <input type="number" name="ContactNum" id="ContactNum" class="form-control"  placeholder="Contact Number" required="">
                
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="addclient">Save</button>  
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
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
            <h1>Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addmodal" >
            <i class="fas fa-plus"></i> Add New Client</button></a>
          
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
          <h3 class="card-title">Client</h3>
          <!--Redundant Search already define in data table pero it's up to you guys if want this, pero kapag hindi tanggaling niyo nalang 'yung ID doon sa table (id="example1")-->
          <!-- <div class= "card-tools">-->
          <!--<form method="post">-->
          <!--     <div class="input-group input-group-sm" style="width: 300px; padding-top: 10px; position: relative; ">-->
                    
          <!--          <input type="text" name="search_client" class="form-control float-right" placeholder="Search" >-->

          <!--          <div class="input-group-append" >-->
          <!--            <button type="submit" class="btn btn-default" name="btnSearch_client"><i class="fas fa-search"></i></button>-->
          <!--          </div>-->
                    
          <!--      </div>-->
          <!--  </form> -->
          <!--  </div>-->

          
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects" id="example1">
              <thead>
                  <tr>
                      <th style="width: 1%; text-align: center;">
                          ID
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Client Name
                      </th>
                      <th style="width: 20%; text-align: center;">
                          Address
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Email
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Contact Number
                      </th>
                      <th style="width: 20%; text-align: center;" >
                          Actions
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($search_result)): 

                  $ClientId = $row['ClientId']; 
                  $FirstName= $row['FirstName']; 
                  $LastName= $row['LastName'];
                  $Address = $row['Address'];
                  $Email = $row['Email'];
                  $ContactNum = $row['ContactNum']; 
                  // $Balance  = $row['Balance'];
                  // $Status  = $row['Status'];
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $ClientId; ?></td>
                    <td style="text-align: center;"><?php echo $FirstName." ".$LastName; ?></td>
                    <td style="text-align: center;"><?php echo $Address;?></td>
                    <td style="text-align: center;"><?php echo $Email; ?></td>
                    <td style="text-align: center;"><?php echo $ContactNum;?></td>
                    <td style="text-align: center;">
                         <!-- <a href="#view<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                            
                         <a href="#edit<?php echo $ClientId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-warning btn-sm ">
                         <i class="fas fa-pencil-alt"></i> Edit</button></a>

                         <a href="#delete<?php echo $ClientId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-danger btn-sm " >
                         <i class="fas fa-trash"></i> Remove</button></a>
                      </td>


                      <!--Edit Client Modal -->
                    <div id="edit<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Contact</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <label for="Name">Client Name:</label>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>" placeholder="First Name" required autofocus > 
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName; ?>" placeholder="Last Name" required autofocus > 
                                            </div>

                                            
                                            <div class="col-md-12">
                                                <label for="Address">Address:</label>
                                                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $Address; ?>" placeholder="Address" required autofocus > 
                                            </div>

                                            
                                            <div class="col-md-12">
                                                <label for="Email">Email:</label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" placeholder="Email" required autofocus> 
                                            </div>

                                            
                                            <div class="col-md-12">
                                                <label for="ContactNum">Contact Number:</label>
                                                <input type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $ContactNum; ?>" placeholder="Contact Number" required autofocus> 
                                            </div>
                          
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="editclient"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                     <!--Delete Store Modal -->
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
                                            <button type="submit" name="deleteclient" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>


                  </tr>
                 <?php endwhile; 

                   // edit client process
                  if(isset($_POST['editclient']))
                  {
                    $ClientId = $_POST['ClientId'];
                    $FirstName = $_POST['FirstName'];
                    $LastName = $_POST['LastName'];
                    $Address = $_POST['Address'];
                    $Email = $_POST['Email'];
                    $ContactNum = $_POST['ContactNum'];
                    // $Balance = $_POST['Balance'];
                    $sql = "UPDATE client SET 
                        FirstName='$FirstName',
                        LastName='$LastName',
                        Address='$Address',
                        Email='$Email',
                        ContactNum='$ContactNum'
                        -- Balance='$Balance'
                        WHERE ClientId='$ClientId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="pm-contact-client.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                       // softdelete process
                  if(isset($_POST['deleteclient']))
                  {
                    $ClientId = $_POST['ClientId'];
                    $isdelete = '1';
                 
                    $sql = "UPDATE client SET 
                      
                      isdelete ='1'
                      WHERE ClientId ='$ClientId' ";
                    if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="pm-contact-client.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                      //Add Client process
                if(isset($_POST['addclient']))
                {
                  $LastName = $_POST['LastName'];
                  $FirstName = $_POST['FirstName'];
                  $Address = $_POST['Address'];                
                  $Email = $_POST['Email'];
                  $ContactNum = $_POST['ContactNum'];
                  
                  $sql = "INSERT INTO client (FirstName, LastName, Address,Email,ContactNum)VALUES ('$FirstName','$LastName','$Address','$Email','$ContactNum')";
                  if ($con->query($sql) === TRUE) 
                      {                  
                          echo '<script>window.location.href="pm-contact-client.php"</script>';
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

 
