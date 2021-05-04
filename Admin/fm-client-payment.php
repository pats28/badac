<?php 
include('includes/fm-header.php'); 
include('includes/fm-sidebar.php');
include('includes/fm-navbar.php');
include('includes/footer.php');
include ('config.php');
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php
  if(isset($_POST['btnSearch_payment']))
  {
    $search_payment = $_POST['search_payment'];
      // search in all table columns
      // using concat mysql function
    $query = "SELECT * FROM payment as p, client as c, project as pro WHERE p.isdelete = 0 AND p.ProjectId = pro.ProjectId AND pro.ClientId = c.ClientId AND CONCAT (p.PaymentId, c.FirstName, c.LastName, p.Assessment, p.Initial_Payment, p.Balance, pro.ProjectName, p.Status) LIKE '%".$search_payment."%'";
      $search_result = searchTable2($query);
  }
  else 
  {

   $query = "SELECT * FROM payment as p, client as c, project as pro WHERE p.isdelete = 0 AND p.ProjectId = pro.ProjectId AND pro.ClientId = c.ClientId";
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
            <h1>Client's Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="financialmanager.php">Home</a></li>
              <li class="breadcrumb-item active">Client's Payment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
      

        <div class="card-body">
          
          <!-- <table class="table table-striped projects"> -->
          <table id="example1" class="table table-bordered table-striped">  
              <thead>
                  <tr>
                      <!--<th style="width: 1%; text-align: center;">-->
                      <!--     ID-->
                      <!--</th>-->
                      <th style="width: 15%; text-align: center;">
                          Project Name
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Client
                      </th>
                      <th style="width: 10%; text-align: center;">
                          Assessment
                      </th>
                      <th style="width: 15%; text-align: center;">
                          Amount Paid
                      </th>
                      <th style="width: 10%; text-align: center;" >
                          Balance
                      </th>
                      <th style="width: 10%; text-align: center; " > <!-- class="text-center" -->
                          Status
                      </th>
                      <th style="width: 15%; text-align: center;" >
                          Actions
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php 

                  while ($row = mysqli_fetch_array($search_result)): 

                  $PaymentId = $row['PaymentId']; 
                  $ProjectName= $row['ProjectName'];                      
                  $FirstName = $row['FirstName'];
                  $LastName = $row['LastName'];
                  $Assessment = $row['Assessment'];
                  $Initial_Payment = $row['Initial_Payment']; 
                  $Balance  = $row['Balance'];
                  $Status  = $row['Status'];

                  $ProjectId = $row['ProjectId'];

                  // $Amount = $row['Amount'];
                  // $Mode_Payment = $row['Mode_Payment']; 
                  // $Date_Payment  = $row['Date_Payment'];
                  // $BreakdownId  = $row['BreakdownId'];
                ?>  

                  <tr>
                      <form method="POST">
                        <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                      
                      <td style="text-align: center;"><?php echo $ProjectName; ?></td>
                      <td style="text-align: center;"><?php echo $FirstName." ".$LastName;?></td>
                      <td style="text-align: center;">₱ <?php echo number_format($Assessment); ?></td>
                      <td style="text-align: center;">₱ <?php echo number_format($Initial_Payment); ?><br>
                        <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal" style="font-size: 13px">View History</a>
                     </td>
                      <td style="text-align: center; color: red;">₱ <?php 
                        //$Balance = $Assessment-$Initial_Payment; 
                        echo number_format($Balance); ?></td>

                      <td style="text-align: center;">
                        
                        <?php 
                          if ($Assessment != $Initial_Payment) 
                          {  // echo $Status; 
                        ?>
                          <span class="badge badge-danger"><i> Not fully paid </i></span>
                        <?php
                          }
                          else {
                        ?>
                            <span class="badge badge-success"><i> Fully paid </i></span>  
                        <?php      
                          }
                        ?>
                          
                      </td>
                      <td style="text-align: center;">
                        <!--  <a href="#view<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-info btn-sm " >
                         <i class="fas fa-eye"></i>View</button></a> -->
                         <?php
                          if ($Balance == 0)
                         ?>
                            
                         <a href="#edit<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-warning btn-sm btn-block font-weight-bold" <?php echo ($Balance == 0) ? 'disabled=""' : ""; ?>>
                         <i class="fas fa-pencil-alt"></i> Update</button></a>

                         <a href="#delete<?php echo $PaymentId; ?>" data-toggle="modal">
                         <button type="button" class="btn btn-danger btn-sm btn-block mt-1 font-weight-bold" >
                         <i class="fas fa-trash"></i> Remove</button></a>
                          <?php include('fm-modal.php'); ?>
                      </td>
                      </form>
                      
                  </tr>


                  
                  <?php endwhile;

                        // edit payment process
                    if(isset($_POST['editpayment']))
                    {
                      $ProjectId = $_POST['ProjectId'];
                      $PaymentId = $_POST['PaymentId'];
                      $Amount = $_POST['Amount'];
                      $Date_Payment = $_POST['Date_Payment'];
                      $Mode_Payment = $_POST['Mode_Payment'];
                      $TransactionNum = $_POST['TransactionNum'];

                      $sql = "INSERT INTO paymentbreakdown (Amount, Date_Payment, Mode_Payment, PaymentId, TransactionNum) values ('$Amount', '$Date_Payment', '$Mode_Payment', '$PaymentId', '$TransactionNum')";

                      if ($con->query($sql) === TRUE) 
                      { 
                        $Initial_Payment = $_POST['Initial_Payment'];
                        $Assessment = $_POST['Assessment'];


                        $sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Paid an amount.')";

                        $Initial_Payment = $Initial_Payment + $Amount;
                        $Balance = $Assessment - $Initial_Payment; 

                        if ($Assessment != $Initial_Payment)
                          $Status = "Not fully paid";
                        else $Status = "Fully paid";

                        $sql2 = "UPDATE payment SET 
                        
                        Assessment ='$Assessment',
                        Initial_Payment = '$Initial_Payment',
                        Balance = '$Balance',
                        Status = '$Status'
                        WHERE PaymentId='$PaymentId' ";
                        
                        

                        if ($con->query($sql2) === TRUE && $con->query($sqlTimeline) === TRUE) {
                          echo '<script>window.location.href="fm-client-payment.php"</script>';
                        } else {
                        echo "Error updating record: " . $con->error;
                        }                 
                          //echo '<script>window.location.href="fm-client-payment.php"</script>';
                      } 
                      else 
                      {
                          echo "Error: " . $sql . "<br>" . $con->error;
                      }
                    }

                   // softdelete process
                if(isset($_POST['deletepayment']))
                {
                  $PaymentId = $_POST['PaymentId'];
                  $isdelete = '1';
                 
                  $sql = "UPDATE payment SET 
                      
                      isdelete ='1'
                      WHERE PaymentId ='$PaymentId' ";
                  if ($con->query($sql) === TRUE) {
                      echo '<script>window.location.href="fm-client-payment.php"</script>';
                  } else {
                      echo "Error updating record: " . $con->error;
                  }
                }

                      //Add Payment process
                // if(isset($_POST['addpayment']))
                // {
               
                //   // $ProjectName = $_POST['ProjectName'];
                //   $Assessment = $_POST['Assessment'];                
                //   $Email = $_POST['Email'];
                //   $Initial_Payment = $_POST['Initial_Payment'];
                //   $Balance = $_POST['Balance'];

                //   $sql = "INSERT INTO payment (Assessment, Initial_Payment, Balance, ClientId)VALUES ('$Assessment','$Initial_Payment','$Balance','$ClientId')";
                //   if ($con->query($sql) === TRUE) 
                //       {                  
                //           echo '<script>window.location.href="fm-client-payment.php"</script>';
                //       } 
                //       else 
                //       {
                //           echo "Error: " . $sql . "<br>" . $con->error;
                //       }
                 
                // }

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
// <script>
//     $(function() {
//         $("#example1").DataTable({
//             "order": [[ 0, "desc" ]]
//         });
//         $('#example2').DataTable({
//             "paging": true,
//             "lengthChange": false,
//             "searching": false,
//             "ordering": true,
//             "info": true,
//             "autoWidth": false,
//         });
//     });
// </script>

