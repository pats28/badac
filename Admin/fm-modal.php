<!--Edit Payment Modal -->
<div id="edit<?php echo $PaymentId; ?>" class="modal fade" role="dialog">
    <form method="post" class="form-horizontal" role="form">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <input type="hidden" name="PaymentId" value="<?php echo $PaymentId; ?>">
                    <div class="form-group">

                        <!-- <label for="ProjectName">Project Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="ProjectName" name="ProjectName" value="<?php echo $ProjectName; ?>" placeholder="Project Name" required autofocus disabled> 
                        </div>

                        <label for="ClientName">Client Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $Name; ?>" placeholder="Client Name " required autofocus disabled> 
                        </div> -->
                        <input type="hidden" name="Initial_Payment" value="<?php echo $Initial_Payment; ?>">
                        <input type="hidden" name="Balance" value="<?php echo $Balance; ?>">
                        <input type="hidden" name="Status" value="<?php echo $Status; ?>">


                        <div class="form-group">
                            <label for="Assessment">Assessment:</label>
                            <input type="number" class="form-control" id="Assessment" name="Assessment" value="<?php echo $Assessment; ?>" placeholder="Assessment" required>
                        </div>

                        <label for="NewPayment">Amount:</label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="Amount" name="Amount" placeholder="0" min="1" max="<?php echo $Balance; ?>" required autofocus>
                        </div>


                        <label>Date of Payment:</label>
                        <div class="form-group">

                            <input type="date" name="Date_Payment" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required="required">
                        </div>

                        <label for="ModePayment">Mode of Payment:</label>
                        <!--<div class="form-group">-->
                        <!--    <input type="text" class="form-control" id="Mode_Payment" name="Mode_Payment" placeholder="Mode of Payment" required autofocus>-->
                        <!--</div>-->
                        <div class="form-group">
                            <!--<label for="Mode_Payment">Mode of Payment<span class="text-danger">*</span></label>-->
                            <!--<input type="text" class="form-control" id="Mode_Payment" name="Mode_Payment"  placeholder="Mode of Payment" >-->
                            <select class="form-control" name="Mode_Payment" id="Mode_Payment">
                                            <!--<option value="" selected>Not Applicable-->
                                            <!--<option>-->
                                            <option value="Cash">Cash</option>
                                            <option value="GCash">GCash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                        </div>


                        <label for="TransactionNum">Transaction Number:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="TransactionNum" name="TransactionNum" placeholder="Transaction Number" required autofocus>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="editpayment"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>

                </div>
            </div>
        </div>
    </form>
</div>

<!--Delete Payment Modal -->
<div id="delete<?php echo $PaymentId; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Remove</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="PaymentId" value="<?php echo $PaymentId; ?>">
                    <div class="alert alert-danger">Are you sure you want to remove <strong>
                            <?php echo $ProjectName; ?>?</strong> </div>
                    <div class="modal-footer">
                        <button type="submit" name="deletepayment" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--View Payment History Modal -->
<div id="view<?php echo $PaymentId; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment History</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <h5 style="text-align: left;">Client Name: <?php echo $FirstName . " " . $LastName; ?></h5>
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
                    $query2 = "SELECT Amount, Date_Payment, Mode_Payment, PaymentId, TransactionNum FROM paymentbreakdown WHERE PaymentId = '$PaymentId'";
                    $result = mysqli_query($con, $query2);
                    while ($row = mysqli_fetch_array($result)) {
                        $Amount = $row['Amount'];
                        $Date_Payment = $row['Date_Payment'];
                        $Mode_Payment = $row['Mode_Payment'];
                        $PaymentId = $row['PaymentId'];
                        $TransactionNum = $row['TransactionNum'];

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

                <h5><?php //echo $Name; 
                    ?></h5>
                <?php


                ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Delete Expense Modal -->
<div id="delete<?php echo $ExpenseId; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Remove</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ExpenseId" value="<?php echo $ExpenseId; ?>">
                    <div class="alert alert-danger">Are you sure you want to remove <strong>
                            <?php echo $ProjectName; ?>?</strong> </div>
                    <div class="modal-footer">
                        <button type="submit" name="deleteexpenses" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--Edit Expense Modal -->
<div id="edit<?php echo $ExpenseId; ?>" class="modal fade" role="dialog">
    <form method="post" class="form-horizontal" role="form">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Expense</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <input type="hidden" name="ExpenseId" value="<?php echo $ExpenseId; ?>">
                    <div class="form-group">

                        <label for="ProjectName">Project Name:</label>
                        <!-- <label>Project Name</label> -->

                        <div class="form-group">
                            <select name="ProjectId" class="form-control" disabled>
                                <option value="<?php echo $ProjectId; ?>" disabled selected hidden><?php echo $ProjectName; ?></option>
                                <?php
                                $sql = mysqli_query($con, "SELECT ProjectName, ProjectId from project");

                                while ($row = $sql->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo $row['ProjectId'] ?>" style="border: outset;"><?php echo $row['ProjectName']; ?></option>
                                <?php } ?>
                            </select>

                        </div>

                        <label for="Description">Description:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echo $Description; ?>" placeholder="Description " required autofocus>
                        </div>

                        <label for="Amount">Amount:</label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="Amount" name="Amount" value="<?php echo $Amount; ?>" placeholder="Amount" required autofocus>
                        </div>

                        <label for="Date">Date:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="Date" name="Date" value="<?php echo $Date; ?>" placeholder="Date" required autofocus>
                        </div>

                        <label for="EmpName">Employee Name </label>
                        <div class="form-group">
                            <select name="EmpId" class="form-control">
                                <option value="<?php echo $EmpId; ?>" disabled selected hidden><?php echo $EmpFirstName . " " . $EmpLastName; ?></option>
                                <?php
                                $sql = mysqli_query($con, "SELECT EmpFirstName, EmpLastName, EmpId from employee");

                                while ($row = $sql->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo $row['EmpId'] ?>" style="border: outset;"><?php echo $row['EmpFirstName'] . " " . $row['EmpLastName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="editexpenses"><span class="glyphicon glyphicon-edit"></span> Save Changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>

                </div>
            </div>
        </div>
    </form>
</div>

<!-- add Expenses Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="exampleModalLabel">Add New Expense</h4>
                    </center>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label>Project Name</label>
                    <!-- <input type="text" name="ProjectName" id="ProjectName" class="form-control" required >  -->
                    <div class="form-group">
                        <select name="ProjectId" class="form-control">
                            <?php
                            $sql = mysqli_query($con, "SELECT ProjectName, ProjectId from project");

                            while ($row = $sql->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['ProjectId'] ?>" style="border: outset;"><?php echo $row['ProjectName']; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="Description" id="Description" class="form-control" required="">
                    </div>

                    <div class="form-group">
                        <label>Which account would you like to use?</label>
                        <select name="Account" id="" class="form-control">
                                <!-- 1: Client / 2:Badac -->
                                <option value="2">Client's Account</option>
                                <option value="1">Badac's Account</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="Amount" id="Amount" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Date </label>
                        <input type="date" name="Date" id="Date" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Employee Name </label>
                        <!-- <input type="text" name="EmpName" id="EmpName" class="form-control" required=""> -->
                        <select name="EmpId" class="form-control">
                            <?php
                            $sql = mysqli_query($con, "SELECT EmpFirstName,EmpLastName, EmpId from employee");

                            while ($row = $sql->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['EmpId'] ?>" style="border: outset;"><?php echo $row['EmpFirstName'] . " " . $row['EmpLastName']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
            <label>Status </label>
            <input type="text" name="Status" id="Status" class="form-control" required="">              
          </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addexpense">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>