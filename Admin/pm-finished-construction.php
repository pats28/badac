<?php
error_reporting(0);

include('includes/header.php');
include('includes/sidebar.php');
include('config.php');
?>


<?php
if (isset($_POST['btnSearch_project'])) {
    $search_project = $_POST['search_project'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM project as p, client as c, employee as e, desiredspecs as d WHERE d.ProjectId = p.ProjectId AND c.ClientId = p.ClientId AND e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 1 AND CONCAT (p.ProjectName, c.FirstName, c.LastName, e.EmpFirstName, e.EmpLastName) LIKE '%" . $search_project . "%'";
    $search_result = searchTable2($query);
} else {

    $query = "SELECT * FROM project as p, client as c, employee as e, desiredspecs as d, payment as pay WHERE d.ProjectId = p.ProjectId AND  c.ClientId = p.ClientId AND e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 1 AND p.Progress = 100 AND p.ProjectId = pay.ProjectId";

    $search_result = searchTable2($query);
}

// function to connect and execute the query
function searchTable2($query)
{
    include('config.php');
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
                            <th style="width: 12%" class="text-center">
                                Project
                            </th>
                            <th style="width: 12%" class="text-center">
                                Architect Name
                            </th>
                            <th style="width: 10%" class="text-center">
                                Proj. Details
                            </th>
                            <th style="width: 10%" class="text-center">
                                Date Completed
                            </th>
                            <th style="width: 14%" class="text-center">
                                Payment Record
                            </th>
                            <th style="width: 14%" class="text-center">
                                Income Statement
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($search_result)) :

                            $ProjectId = $row['ProjectId'];
                            $ProjectName = $row['ProjectName'];
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

                            $Property_Loc = $row['Property_Loc'];
                            $Lot_Area = $row['Lot_Area'];
                            $Length = $row['Length'];
                            $Width = $row['Width'];
                            $Floor_Area = $row['Floor_Area'];
                            $Floor_Levels = $row['Floor_Levels'];
                            $Rooms = $row['Rooms'];
                            $Toilet_Bath = $row['Toilet_Bath'];
                            $Car_Garage = $row['Car_Garage'];
                            $Classification = $row['Classification'];
                            $Preferred_Design = $row['Preferred_Design'];
                            $Preferred_Finish = $row['Preferred_Finish'];
                            $Description = $row['Description'];
                            $Drawing = $row['Drawing'];

                            $Status = $row['Status'];

                            $queryProgress = "SELECT * FROM progressdescription as pd, project as p WHERE pd.ProgressId = '$Progress'";
                            $sqlProgress = mysqli_query($con, $queryProgress);
                            $rowProgress = mysqli_fetch_assoc($sqlProgress);

                            $count_expense = "SELECT SUM(Amount) as Total_expense FROM `expenses` WHERE ProjectId = $ProjectId";
                            $sql_expense = mysqli_query($con, $count_expense);
                            $total_expense = mysqli_fetch_assoc($sql_expense);
                        ?>

                            <tr>
                                <!--<td style="text-align: center;"><?php echo $ProjectId; ?></td>-->
                                <td style="text-align: center;">
                                    <p style="font-weight: bold;"><?php echo $ProjectName; ?></p><?php echo "Client: " . $FirstName . " " . $LastName; ?>
                                </td>
                                <td style="text-align: center;"><?php echo $EmpFirstName . " " . $EmpLastName; ?></td>
                                <!-- <td style="text-align: center;"><?php echo $FirstName . " " . $LastName; ?></td> -->
                                <!-- <td style="text-align: center;"><?php echo $newDateStarted . "<br>" . $newEstimatedFinishDate; ?></td> -->
                                <td style="text-align: center;">

                                    <a href="#view<?php echo $ProjectId; ?>" data-toggle="modal">
                                        <!--<button type="button" class="btn btn-info btn-sm " style = "font-size: 11px;" >-->
                                        <i class="fas fa-eye"></i>&nbsp;View</a></i>
                                </td>
                                <td style="text-align: center;"><?php echo $newEstimatedFinishDate; ?></td>
                                <td style="text-align: center;">

                                    <?php
                                    if ($Status == "Not fully paid") {  // echo $Status; 
                                    ?>
                                        <span class="badge badge-danger"><i> Not fully paid </i></span><br>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-success"><i> Fully paid </i></span><br>
                                    <?php
                                    }
                                    ?>
                                    <a href="#open<?php echo $ProjectId; ?>" data-toggle="modal" style="font-size: 13px">View Payment History</a>
                                    <?php include('pm-modal.php'); ?>
                                <?php
                                $assessmentss = "SELECT Assessment FROM `payment` WHERE ProjectId = $ProjectId";
                                $sql_assessments = mysqli_query($con, $assessmentss);
                                $row_totalPayment = mysqli_fetch_assoc($sql_assessments);
    
                                // $assess = $row_assessment['Assessment'];
                                $badac_expense = $total_expense['Total_expense'];
                                $profit_loss = $row_totalPayment['Assessment'] - $badac_expense;
                                ?>
                                <td style="text-align: center;">
                                    
                                        <strong>Est. Project Cost:</strong> <br>₱<?php echo number_format($row_totalPayment['Assessment']); ?><br>
                                        <strong>Expenses:</strong> <br>₱<?php echo number_format($total_expense['Total_expense']); ?><br>
                                        <strong>Profit/Loss:</strong> <br>₱<?php echo number_format($profit_loss,2); ?><br>
                                        <!-- <span class="<?php echo ($badac_expense > $row_totalPayment['Assessment']? "text-danger":"text-success" ); ?>">
                                            <i class="fas fa-arrow-up text-sm"></i>
                                            Profitable</span> -->
                                    
                                </td>

                                <!-- View Project Modal -->
                                <div class="modal fade" id="view<?php echo $ProjectId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <center>
                                                        <h4 class="modal-title" id="exampleModalLabel">Project Details</h4>
                                                    </center>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Date Started</label>
                                                            <input type="text" name="Date_Started" id="Date_Started" value="<?php echo $newDateStarted; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Date Completed</label>
                                                            <input type="text" name="Estimated_Finish_Date" id="Estimated_Finish_Date" value="<?php echo $newEstimatedFinishDate; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Property Location</label>
                                                            <input type="text" name="Property_Loc" id="Property_Loc" value="<?php echo $Property_Loc; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Classification</label>
                                                            <input type="text" name="Car_Garage" id="Car_Garage" value="<?php echo $Classification; ?>" class="form-control" disabled>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Preferred Design</label>
                                                            <input type="text" name="Car_Garage" id="Car_Garage" value="<?php echo $Preferred_Design; ?>" class="form-control" disabled>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Preferred Finish</label>
                                                            <input type="text" name="Car_Garage" id="Car_Garage" value="<?php echo $Preferred_Finish; ?>" class="form-control" disabled>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Lot Area</label>
                                                            <input type="number" name="Lot_Area" id="Lot_Area" value="<?php echo $Lot_Area; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Floor Area</label>
                                                            <input type="number" name="Floor_Area" id="Floor_Area" value="<?php echo $Floor_Area; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Width</label>
                                                            <input type="number" name="Width" id="Width" value="<?php echo $Width; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Length</label>
                                                            <input type="number" name="Length" id="Length" value="<?php echo $Length; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Floor Levels</label>
                                                            <input type="number" name="Floor_Levels" id="Floor_Levels" value="<?php echo $Floor_Levels; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Rooms</label>
                                                            <input type="number" name="Rooms" id="Rooms" value="<?php echo $Rooms; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Toilet Bath</label>
                                                            <input type="number" name="Toilet_Bath" id="Toilet_Bath" value="<?php echo $Toilet_Bath; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Car Garage</label>
                                                            <input type="number" name="Car_Garage" id="Car_Garage" value="<?php echo $Car_Garage; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Description</label>
                                                            <textarea name="Description" id="Description" class="form-control" rows="4" disabled><?php echo $Description; ?></textarea>
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
                                                    <!-- <button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php endwhile;
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

<?php include('includes/footer.php'); ?>