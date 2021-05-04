<?php 
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<?php
  if(isset($_POST['btnSearch_vendor']))
  {
      $search_vendor = $_POST['search_vendor'];
      // search in all table columns
      // using concat mysql function
      $query = "SELECT * FROM `store` WHERE `isdelete` = 0 AND CONCAT(`StoreId`, `StoreName`, `Address`, `ContactNum`, `Email`) LIKE '%".$search_vendor."%'";
      $search_result = searchTable($query);    
  }
  else {
      $query = "SELECT * FROM `store` WHERE `isdelete` = 0";
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

<!-- add Store Modal -->
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
         <div class="form-group">
         
            <label>Store Name</label>
            <input type="text" name="StoreName" id="StoreName" class="form-control" placeholder="Store Name" required >      
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" required="" >
        </div>    
              
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="Email" id="Email" class="form-control" placeholder="Email" required="">
             
        </div>
        <div class="form-group">
            <label>Contact Number </label>
            <input type="number" name="ContactNum" id="ContactNum" class="form-control" placeholder="Contact Number" required="">
                
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="addstore">Save</button>
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
            <h1>Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a href="#add<?php echo $StoreId; ?>" data-toggle="modal">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addmodal" >
            <i class="fas fa-plus"></i> Add New Contact</button></a>
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
          <h3 class="card-title">Store</h3>
          
          <div class="card-tools">
          <form method="post">
               <div class="input-group input-group-sm" style="width: 300px; padding-top: 10px; position: relative;">
                    
                    <input type="text" name="search_vendor" class="form-control float-right" placeholder="Search" >

                    <div class="input-group-append" >
                      <button type="submit" class="btn btn-default" name="btnSearch_vendor"><i class="fas fa-search"></i></button>
                    </div>
                    
                </div>
            </form> 
        </div>
          
       
      </div>
       
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%; text-align: center;">
                           ID
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Store Name
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

                  $StoreId = $row['StoreId']; 
                  $StoreName= $row['StoreName'];                      
                  $Address = $row['Address'];
                  $Email = $row['Email'];
                  $ContactNum = $row['ContactNum']; 
                  // $Balance  = $row['Balance'];
                  // $Status  = $row['Status'];
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $StoreId; ?></td>
                    <td style="text-align: center;"><?php echo $StoreName; ?></td>
                    <td style="text-align: center;"><?php echo $Address;?></td>
                    <td style="text-align: center;"><?php echo $Email; ?></td>
                    <td style="text-align: center;"><?php echo $ContactNum;?></td>
                    <td style="text-align: center;">
                         <!-- <a href="#view<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                            
                         <a href="#edit<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-warning btn-sm ">
                         <i class="fas fa-pencil-alt"></i> Edit</button></a>

                         <a href="#delete<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-danger btn-sm " >
                         <i class="fas fa-trash"></i> Remove</button></a>
                      </td>



                      <!--Edit Store Modal -->
                    <div id="edit<?php echo $StoreId; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Contact</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="StoreId" value="<?php echo $StoreId; ?>">
                                        <div class="form-group">
                                            
                                            <label for="StoreName">Store Name:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="StoreName" name="StoreName" value="<?php echo $StoreName; ?>" placeholder="Store Name" required autofocus > 
                                            </div>

                                            <label for="Address">Address:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $Address; ?>" placeholder="Address" required autofocus > 
                                            </div>

                                            <label for="Email">Email:</label>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" placeholder="Email" required autofocus> 
                                            </div>

                                            <label for="ContactNum">Contact Number:</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $ContactNum; ?>" placeholder="Contact Number" required autofocus> 
                                            </div>
                          
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="editstore"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                     <!--Delete Store Modal -->
                      <div id="delete<?php echo $StoreId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                     
                                        <h4 class="modal-title">Remove</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="StoreId" value="<?php echo $StoreId; ?>">
                                        <div class="alert alert-danger">Are you sure you want to remove <strong>
                                                <?php echo $StoreName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="deletestore" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>



                  </tr>
                <?php endwhile; 

                      // edit store process
                  if(isset($_POST['editstore']))
                  {
                    $StoreId = $_POST['StoreId'];
                    $StoreName = $_POST['StoreName'];
                    $Address = $_POST['Address'];
                    $Email = $_POST['Email'];
                    $ContactNum = $_POST['ContactNum'];
                    // $Balance = $_POST['Balance'];
                    $sql = "UPDATE store SET 
                        StoreName='$StoreName',
                        Address='$Address',
                        Email='$Email',
                        ContactNum='$ContactNum'
                        -- Balance='$Balance'
                        WHERE StoreId='$StoreId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="pm-contact-vendor.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                      // softdelete process
                  if(isset($_POST['deletestore']))
                  {
                    $StoreId = $_POST['StoreId'];
                    $isdelete = '1';
                 
                    $sql = "UPDATE store SET 
                      
                      isdelete ='1'
                      WHERE StoreId ='$StoreId' ";
                    if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="pm-contact-vendor.php"</script>';
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                  }

                   //Add Store process
                if(isset($_POST['addstore']))
                {
               
                  $StoreName = $_POST['StoreName'];
                  $Address = $_POST['Address'];                
                  $Email = $_POST['Email'];
                  $ContactNum = $_POST['ContactNum'];
                  
                  $sql = "INSERT INTO store (StoreName,Address,Email,ContactNum)VALUES ('$StoreName','$Address','$Email','$ContactNum')";
                  if ($con->query($sql) === TRUE) 
                      {                  
                          echo '<script>window.location.href="pm-contact-vendor.php"</script>';
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