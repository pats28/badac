<?php 
include('includes/header.php'); 
include('includes/sidebar.php');
include('includes/navbar.php');
include('includes/footer.php');
include ('config.php');
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php
  if(isset($_POST['btnSearch_client']))
  {
      $search_client = $_POST['search_client'];
      // search in all table columns
      // using concat mysql function
      $query = "SELECT * FROM client as c, project as pro, payment as pay  WHERE c.ClientId = pro.ClientId AND pro.ProjectId = pay.ProjectId AND c.isdelete = 0 AND CONCAT(c.ClientId, c.FirstName, c.LastName, c.Address, c.ContactNum, c.Email, pro.ProjectName, pay.Status) LIKE '%".$search_client."%'";
      $search_result = searchTable($query);    
  }
  else {
      $query = "SELECT * FROM client as c, project as pro, payment as pay  WHERE c.ClientId = pro.ClientId AND pro.ProjectId = pay.ProjectId AND c.isdelete = 0";
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
         <div class="form-group">
         
            <label>Client Name</label>
            <input type="text" name="Name" id="Name" class="form-control" required >      
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="Address" id="Address" class="form-control" required="" >
        </div>    
              
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="Email" id="Email" class="form-control" required="">
             
        </div>
        <div class="form-group">
            <label>Contact Number </label>
            <input type="text" name="ContactNum" id="ContactNum" class="form-control" required="">
                
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addclient">Save</button>
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
            <h1>Client</h1>
          </div>
          <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="projectmanager.php">Home</a></li>
                        <li class="breadcrumb-item active">Client</li>
                    </ol>
                </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
          <h3 class="card-title">Client</h3>

          <div class="card-tools">
            <form method="post">
              <div class="input-group input-group-sm" style="width: 300px;">    
                <input type="text" name="search_client" class="form-control float-right" placeholder="Search" >
                  <div class="input-group-append" >
                    <button type="submit" class="btn btn-default" name="btnSearch_client"><i class="fas fa-search"></i></button>
                  </div> 
              </div>
            </form> 
          </div> 
        </div> -->
        <!-- <div class="card-body p-0"> -->
        <div class="card-body">
          <!-- <table class="table table-striped projects"> -->
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <!--<th style="width: 5%; text-align: center;">-->
                      <!--    ID-->
                      <!--</th>-->
                      <th style="width: 15%; text-align: center;">
                          Name
                      </th>
                      <!--<th style="width: 10%; text-align: center;">-->
                      <!--    Last Name-->
                      <!--</th>-->
                      <th style="width: 15%; text-align: center;">
                          Contact Number
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Email
                      </th>
                      <!--<th style="width: 10%; text-align: center;">-->
                      <!--    Password-->
                      <!--</th>-->
                      <th style="width: 15%; text-align: center;">
                          Project
                      </th>
                      <th style="width: 10%; text-align: center;">
                          Payment Status
                      </th>
                      <th style="width: 10%; text-align: center;" >
                          Actions
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($search_result)): 

                  $ClientId = $row['ClientId'];
                 // $PaymentId = $row['PaymentId'];
                  $FirstName= $row['FirstName'];
                  $LastName= $row['LastName'];
                  $Email = $row['Email'];
                  $Password = $row['Password'];
                  $ContactNum = $row['ContactNum']; 
                  $ProjectName  = $row['ProjectName'];
                  $Status  = $row['Status'];
                ?>
                  <tr>
                    <!--<td style="text-align: center;"><?php echo $ClientId; ?></td>-->
                    <td style="text-align: center;"><?php echo $FirstName." ".$LastName; ?></td>
                    <!--<td style="text-align: center;"><?php echo $LastName;?></td>-->
                    <td style="text-align: center;"><?php echo $ContactNum; ?></td>
                    <td style="text-align: center;"><?php echo $Email;?></td>
                    <!--<td style="text-align: center;"><?php echo $Password;?></td>-->
                    <td style="text-align: center;"><?php echo $ProjectName;?></td>
                    <!--<td style="text-align: center;"><?php echo $Status;?></td>-->
                    <td style="text-align: center;">
                        
                        <?php 
                          if ($Status == "Not fully paid") 
                          {  // echo $Status; 
                        ?>
                          <span class="badge badge-danger"><i> Not fully paid </i></span><br>
                        <?php
                          }
                          else {
                        ?>
                            <span class="badge badge-success"><i> Fully paid </i></span><br> 
                        <?php      
                          }
                        ?>
                        <a href="#view<?php echo $ClientId; ?>" data-toggle="modal" style="font-size: 13px">View Payment History</a>
                          
                      </td>
                    <td style="text-align: center;">
                         <!-- <a href="#view<?php echo $StoreId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                            
                         <a href="#edit<?php echo $ClientId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold">
                         <i class="fas fa-pencil-alt"></i> Edit</button></a>

                         <!--<a href="#delete<?php echo $ClientId; ?>" data-toggle="modal">-->
                         <!--<button type="button" class="btn btn-danger btn-sm " >-->
                         <!--<i class="fas fa-trash"></i> Delete</button></a>-->
                         
                         <?php include('pm-modal.php'); ?>
                    </td>


                     
                  </tr>
                 <?php endwhile; 

                   // edit client process
                  if(isset($_POST['editclient']))
                  {
                    $ClientId = $_POST['ClientId'];
                    $FirstName = $_POST['FirstName'];
                    $LastName = $_POST['LastName'];
                    $ContactNum = $_POST['ContactNum'];
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];
                    // $Balance = $_POST['Balance'];
                    $sql = "UPDATE client SET 
                        FirstName='$FirstName',
                        LastName='$LastName',
                        Email='$Email',
                        ContactNum='$ContactNum',
                        Password='$Password'
                        WHERE ClientId='$ClientId' ";
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="pm-clients.php"</script>';
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

 