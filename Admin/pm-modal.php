 
 <!--Edit Client Modal -->
                    <div id="edit<?php echo $ClientId; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Client</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ClientId" value="<?php echo $ClientId; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="FirstName">First Name:</label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>" placeholder="First Name" required autofocus > 
                                            </div>
                                            <div class="col-md-6">
                                                <label for="LastName">Last Name:</label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName; ?>" placeholder="First Name" required autofocus > 
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <br>
                                                <label for="ContactNum">Contact Number:</label>
                                                <input type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $ContactNum; ?>" placeholder="Contact Number" required autofocus > 
                                            </div>

                                            <div class="col-md-12">
                                                <br>
                                                <label for="Email">Email:</label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" placeholder="Email" required autofocus> 
                                            </div>

                                            <div class="col-md-12">
                                                <br>
                                                <label for="Password">Password:</label>
                                                <input type="text" class="form-control" id="Password" name="Password" value="<?php echo $Password; ?>" placeholder="Password" required autofocus> 
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

    <?php
      $queryPayment= "SELECT * FROM payment WHERE ProjectId = '$ProjectId'";
      $resultPayment = mysqli_query($con, $queryPayment);
      $rowPayment = mysqli_fetch_assoc($resultPayment);
    ?>
                    
                                       <!--View Payment History Modal -->
    <div id="open<?php echo $ProjectId; ?>" class="modal fade" role="dialog">
      <!--<div class="modal-dialog">-->
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Payment History</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
              <h5 style="text-align: left;">Client Name: <?php echo $FirstName." ".$LastName; ?></h5>
              <div class="d-flex justify-content-between card-header">
                                                    <!--<h3 class="card-title">Payment History</h3>-->
                                                    <span>Total Assessment: <span class="badge badge-success" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Assessment']); ?></span></span>
                                                    <span class="ml-auto">Total Payment: <span class="badge badge-success" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Initial_Payment']); ?></span></span>
                                                    <span class="ml-auto">Balance: <span class="badge badge-danger" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Balance']); ?></span></span>
                                                </div>
             
             <table class="table">
               <thead>
                    <tr>
                        <th style=" text-align: center;">Transaction Number</th>
                        <th style=" text-align: center;">Amount</th>
                        <th style=" text-align: center;">Date</th>
                        <th style=" text-align: center;">Mode of Payment</th>
                    </tr>
                </thead>
                 <?php
                      'Content-Type: text/plain';
                //   $query = "SELECT ProjectId FROM project WHERE ProjectId = '$ProjectId'";
                //   $sql = mysqli_query($con, $query);
                //   $Project = mysqli_fetch_assoc($sql);
                //   $ProjectId = $Project ['ProjectId'];
                  
                  $query2 = "SELECT Amount, Date_Payment, Mode_Payment, PaymentId, TransactionNum FROM paymentbreakdown WHERE PaymentId = (SELECT PaymentId FROM payment WHERE ProjectId = '$ProjectId') ";
                  $result = mysqli_query($con, $query2);
                  while ($row = mysqli_fetch_array($result)){
                          $Amount= $row['Amount']; 
                          $Date_Payment= $row['Date_Payment'];
                          $Mode_Payment= $row['Mode_Payment'];
                          $PaymentId= $row['PaymentId'];
                          $TransactionNum= $row['TransactionNum']; 
                 ?>
                <tbody>
                  <tr>
                      <td style=" text-align: center;"><?php echo $TransactionNum; ?></td>
                      <td style=" text-align: center;">₱ <?php echo number_format($Amount); ?></td>
                      <td style=" text-align: center;"><?php echo $Date_Payment; ?></td>
                      <td style=" text-align: center;"><?php echo $Mode_Payment; ?></td>
                  </tr>
                </tbody>
               <?php } ?>
            </table> 
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  
                    
