<?php
error_reporting(0);
include('config.php');
include_once('includes/header.php');
include_once('includes/sidebar.php');
?>
<?php


$query = "SELECT * FROM project as p, employee as e, desiredspecs as d WHERE d.ProjectId = p.ProjectId AND  e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 1 AND p.Progress < 100";
$search_result = searchTable2($query);

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
                    <h1>Blueprints</h1>
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

                <!-- <table class="table table-striped projects" class="table table-bordered table-striped"> -->
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
                            <th style="width: 14%" class="text-center">
                                Blueprint
                            </th>
                            <th style="width: 15%" class="text-center">
                                Status
                            </th>

                            <th style="width: 14%" class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($search_result)) :

                            $ProjectId = $row['ProjectId'];
                            $ProjectName = $row['ProjectName'];
                            // $FirstName = $row['FirstName'];
                            // $LastName = $row['LastName'];
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

                            // $queryProgress = "SELECT * FROM progressdescription as pd, project as p WHERE pd.ProgressId = '$Progress'";
                            // $sqlProgress = mysqli_query($con, $queryProgress);
                            // $rowProgress = mysqli_fetch_assoc($sqlProgress);

                        ?>

                            <tr>
                                <td style="text-align: center;"><?php echo $ProjectName; ?></td>
                                <td style="text-align: center;"><?php echo $EmpFirstName . " " . $EmpLastName; ?></td>

                                <td style="text-align: center;">

                                    <a href="javascript:void(0)" id="<?php echo $ProjectId; ?>" class="show-project" data-toggle="modal">
                                        <i class="fas fa-eye"></i>&nbsp;View</a></i>
                                </td>
                                <td style="text-align: center;">

                                    <a href="../Admin/blueprint/<?php echo $row["Blueprint"] ?>"><?php echo $row['Blueprint']; ?></a>


                                    <?php
                                    if ($BlueprintStatusId == 1) {
                                    ?>
                                        <p style="font-style: italic; color: red;">Not yet submitted.</p>
                                    <?php
                                    }
                                    ?>

                                </td>
                                <!-- <td style="text-align: center;"><?php echo $Progress; ?></td> -->
                                <td style="text-align: center;">
                                    <?php 
                                        switch($BlueprintStatusId){
                                            case 4:
                                                $disable_validate = false;
                                                echo '<span class="right badge badge-danger">Rejected</span>';
                                                break;
                                            case 3:
                                                $disable_validate = false;
                                                echo '<span class="right badge badge-success">Approved</span>';
                                                break;
                                            case 2:
                                                $disable_validate = false;
                                                echo '<span class="right badge badge-info">New</span>';
                                                break;
                                            default:
                                                $disable_validate = true;
                                                echo '<p style="font-style: italic; color: red;">Not yet submitted.</p>';
                                                break;
                                        }
                                    ?>
                                    <!--<?php if ($BlueprintStatusId == 3) { ?>-->
                                    
                                    <!--    <span class="right badge badge-success">Approved</span>-->
                                        
                                    <!--<?php } else if ($BlueprintStatusId == 4) { ?>-->
                                    
                                    <!--    <span class="right badge badge-danger">Rejected</span>-->
                                        
                                    <!--<?php } else if ($BlueprintStatusId == 2) { ?>-->
                                    
                                    <!--    <span class="right badge badge-info">New</span>-->

                                    <!--<?php } else { $disable_validate = true; ?>-->
                                    
                                    <!--    <p style="font-style: italic; color: red;">Not yet submitted.</p>-->
                                        
                                    <!--<?php } ?>-->
                                </td>
                                <!--<td style="text-align: center;">-->
                                <!--    <a href="#blueprint<?php echo $ProjectId; ?>" data-toggle="modal">-->
                                <!--        <button type="button" <?php echo ($disable_validate == true || $BlueprintStatusId == 3) ? "disabled" : " "; ?> class="btn btn-warning btn-sm btn-block font-weight-bold" style="font-size: 13px;">-->
                                <!--            <i class="fas fa-check"></i> <?php echo ($BlueprintStatusId == 3) ? "Already Approved" : "Validate Blueprint"; ?></button></a>-->
                                <!--</td>-->
                                <td style="text-align: center;">
                                    <button type="button" id="<?php echo $ProjectId; ?>" data-toggle="modal" <?php echo $disable_validate ? "disabled" : " "; ?> class="show-blueprint btn btn-warning btn-sm btn-block font-weight-bold" style="font-size: 13px;">
                                            <i class="fas fa-check"></i><?php echo ($BlueprintStatusId == 3) ? "Already Approved" : "Validate Blueprint"; ?></button>
                                </td>
                            </tr>

                        <?php endwhile;

                        
                        // edit approve process
                        if (isset($_POST['editapprove'])) {
                            $ProjectId = $_POST['ProjectId'];
                            $BlueprintStatusId = 3;

                            $sql = "UPDATE project SET 
                      
                      BlueprintStatusId = '$BlueprintStatusId',
                      Progress = Progress + 10
                      WHERE ProjectId ='$ProjectId' ";

                            $sql2 = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Proposed blueprint has been approved')";
                            if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE) {
                                echo '<script>window.location.href="pm-projects-construction.php"</script>';
                            } else {
                                echo "\nError: " . $sql . "<br>" . $con->error;
                                echo "\nError2: " . $sql2 . "<br>" . $con->error;
                            }
                        }

                        // edit reject process
                        if (isset($_POST['editreject'])) {
                            $ProjectId = $_POST['ProjectId'];
                            $BlueprintStatusId = 4;

                            $sql = "UPDATE project SET 
                      
                      BlueprintStatusId = '$BlueprintStatusId'
                      WHERE ProjectId ='$ProjectId' ";

                            $sql2 = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Proposed blueprint has been rejected')";
                            if ($con->query($sql) === TRUE && $con->query($sql2) === TRUE) {
                                echo '<script>window.location.href="pm-projects-construction.php"</script>';
                            } else {
                                echo "\nError: " . $sql . "<br>" . $con->error;
                                echo "\nError2: " . $sql2 . "<br>" . $con->error;
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
<?php include_once('includes/footer.php');?>
<!--Don't redeclare scripts that already define-->
<!-- jQuery -->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<!--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!-- AdminLTE App -->
<!--<script src="dist/js/adminlte.min.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="dist/js/demo.js"></script>-->

<!-- datatables -->
<!--<script src="plugins/datatables/jquery.dataTables.js"></script>-->
<!--<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>-->
<!--<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>-->

<!--<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
<script>
    $(function() {
        $("#example1").DataTable({
            "order": [
                [3, "asc"]
            ]
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>-->
