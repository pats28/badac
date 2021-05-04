<?php
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
include('config.php');

$EmpId = $_SESSION['EmpId'];
$EmpFirstName = $_SESSION['EmpFirstName'];
$EmpLastName = $_SESSION['EmpLastName'];
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php


// p.ProjectId, p.ProjectName, p.Blueprint, p.Progress, c.Name, p.Status
$query = "SELECT * FROM estimate as es, client as c,  employee as em, acceptproject as a WHERE c.ClientId = es.ClientId AND em.EmpId = a.EmpId AND em.EmpId = '$EmpId' AND c.ClientId = a.ClientId";
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
                    <h1>Estimate Material Cost</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
                        <li class="breadcrumb-item active">Estimate Material Cost</li>
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
                <h3 class="card-title" style="color: white">Building</h3> <!-- <?php //echo $EmpName; 
                                                                                ?> -->
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!--<th style="width: 1%">-->
                            <!--    ID-->
                            <!--</th>-->
                            <th style="width: 15%" class="text-center">
                                Project Name
                            </th>
                            <th style="width: 15%" class="text-center">
                                Client Name
                            </th>
                            <th style="width: 10%" class="text-center">
                                Project Details
                            </th>
                            <th style="width: 20%" class="text-center">
                                List Materials
                            </th>
                            <th style="width: 8%" class="text-center">
                                Estimated Materials Cost
                            </th>
                            <!--<th style="width: 15%" class="text-center">-->
                            <!--    Status-->
                            <!--</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($search_result)) :

                            $ClientId = $row['ClientId'];
                            // $ProjectId = $row['ProjectId'];
                            $ProjectName = $row['ProjectName'];
                            $FirstName = $row['FirstName'];
                            $LastName = $row['LastName'];
                            $EmpFirstName = $row['EmpFirstName'];
                            $EmpLastName = $row['EmpLastName'];
                            $MaterialsCost = $row['MaterialsCost'];
                            $AcceptId = $row['AcceptId'];
                            // $Progress = $row['Progress']; 
                            // $Balance  = $row['Balance'];
                            // $BlueprintStatusId  = $row['BlueprintStatusId'];

                            $e_Property_Loc  = $row['e_Property_Loc'];
                            $e_Lot_Area  = $row['e_Lot_Area'];
                            $e_Length  = $row['e_Length'];
                            $e_Width  = $row['e_Width'];
                            $e_Floor_Area  = $row['e_Floor_Area'];
                            $e_Floor_Levels  = $row['e_Floor_Levels'];
                            $e_Rooms  = $row['e_Rooms'];
                            $e_Toilet_Bath = $row['e_Toilet_Bath'];
                            $e_Car_Garage = $row['e_Car_Garage'];
                            $Description = $row['Description'];
                            $e_Classification = $row['e_Classification'];
                            $e_Preferred_Design = $row['e_Preferred_Design'];
                            $e_Preferred_Finish = $row['e_Preferred_Finish'];
                        ?>

                            <tr>
                                <!--<td style="text-align: center;"><?php echo $ProjectId; ?></td>-->
                                <td style="text-align: center;"><?php echo $ProjectName; ?></td>
                                <td style="text-align: center;"><?php echo $FirstName . " " . $LastName; ?></td>
                                <td class="project_progress" style="text-align: center;">

                                    <!--<?php echo $Progress; ?>% Complete-->

                                    <a href="#view<?php echo $ClientId; ?>" data-toggle="modal">

                                        <i class="fas fa-eye"></i>&nbsp; View</a>

                                </td>
                                <td style="text-align: center;">
                                    <a target="_blank" href="../pdf/pdf-materials.php?ProjectId=<?php echo $AcceptId; ?>">Print materials needed</a>
                                    <span style="color: black; font-weight: bold;">&#128438;</span>
                                    <a href="../shop/shop-index.php?category=1&ProjectId=<?php echo $AcceptId; ?>" target="_blank" class="btn btn-primary btn-sm" <?php echo ($Progress >= 60) ? "disabled=" : ""; ?>>Shop for materials</a>
                                </td>
                                <td style="text-align: center;">Php <?php echo number_format($MaterialsCost,2); ?></td>
                                <!--<td style="text-align: center;">-->
                                    
                                <!--    <a href="#send<?php echo $ClientId; ?>" data-toggle="modal">-->
                                <!--        <button type="button" class="btn btn-warning btn-sm ">-->
                                <!--            <i class="fas fa-check"></i> Send</button></a>-->
                                  
                                <!--</td>-->



                                <!-- View Project Modal -->
                                <div class="modal fade" id="view<?php echo $ClientId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <!-- <div class="col-md-12">
                    <br>
                    <h5 class="modal-title" id="exampleModalLabel">Project Specifications</h5></center>
                </div> -->
                                                        <input type="text" name="ClientId" id="ClientId" value="<?php echo $ClientId; ?>" class="form-control" hidden>
                                                        <div class="col-md-6">
                                                            <label>Property Location</label>
                                                            <input type="text" name="e_Property_Loc" id="e_Property_Loc" value="<?php echo $e_Property_Loc; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Classification</label>
                                                            <input type="text" name="e_Classification" id="e_Classification" value="<?php echo $e_Classification; ?>" class="form-control">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Preferred Design</label>
                                                            <input type="text" name="e_Preferred_Design" id="e_Preferred_Design" value="<?php echo $e_Preferred_Design; ?>" class="form-control">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Preferred Finish</label>
                                                            <input type="text" name="e_Preferred_Finish" id="e_Preferred_Finish" value="<?php echo $e_Preferred_Finish; ?>" class="form-control">

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Lot Area</label>
                                                            <input type="number" name="e_Lot_Area" id="e_Lot_Area" value="<?php echo $e_Lot_Area; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Floor Area</label>
                                                            <input type="number" name="e_Floor_Area" id="e_Floor_Area" value="<?php echo $e_Floor_Area; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Width</label>
                                                            <input type="number" name="e_Width" id="e_Width" value="<?php echo $e_Width; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Length</label>
                                                            <input type="number" name="e_Length" id="e_Length" value="<?php echo $e_Length; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Floor Levels</label>
                                                            <input type="number" name="e_Floor_Levels" id="e_Floor_Levels" value="<?php echo $e_Floor_Levels; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Rooms</label>
                                                            <input type="number" name="e_Rooms" id="e_Rooms" value="<?php echo $e_Rooms; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Toilet Bath</label>
                                                            <input type="number" name="e_Toilet_Bath" id="e_Toilet_Bath" value="<?php echo $e_Toilet_Bath; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Car Garage</label>
                                                            <input type="number" name="e_Car_Garage" id="e_Car_Garage" value="<?php echo $e_Car_Garage; ?>" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </tr>

                        <?php
                            error_reporting(E_ERROR);

                        endwhile;

                        // edit project process
                        if (isset($_POST['editproject'])) {
                            $ProjectId = $_POST['ProjectId'];
                            // $ProjectName = $_POST['ProjectName'];
                            // $Name = $_POST['Name'];
                            // $Blueprint = $_POST['Blueprint'];
                            // $Progress = $_POST['Progress'];
                            // $Balance = $_POST['Balance'];

                            $Property_Loc  = $_POST['Property_Loc'];
                            $Lot_Area  = $_POST['Lot_Area'];
                            $Length  = $_POST['Length'];
                            $Width  = $_POST['Width'];
                            $Floor_Area  = $_POST['Floor_Area'];
                            $Floor_Levels  = $_POST['Floor_Levels'];
                            $Rooms  = $_POST['Rooms'];
                            $Toilet_Bath = $_POST['Toilet_Bath'];
                            $Car_Garage = $_POST['Car_Garage'];
                            $Description = $_POST['Description'];
                            $Classification = $_POST['Classification'];
                            $Preferred_Design = $_POST['Preferred_Design'];
                            $Preferred_Finish = $_POST['Preferred_Finish'];


                            $sql = "UPDATE desiredspecs SET 
                        
                        Property_Loc='$Property_Loc',
                        Lot_Area='$Lot_Area',
                        Length='$Length',
                        Width='$Width',
                        Floor_Area='$Floor_Area',
                        Floor_Levels='$Floor_Levels',
                        Rooms='$Rooms',
                        Toilet_Bath='$Toilet_Bath',
                        Car_Garage='$Car_Garage',
                        Description='$Description',
                        Classification='$Classification',
                        Preferred_Design='$Preferred_Design',
                        Preferred_Finish = '$Preferred_Finish'
                        WHERE ProjectId='$ProjectId' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="ar-projects.php"</script>';
                            } else {
                                echo "Error updating record: " . $con->error;
                            }
                        }

                        // softdelete process
                        if (isset($_POST['deleteproject'])) {
                            $ProjectId = $_POST['ProjectId'];
                            $isdelete = '1';

                            $sql = "UPDATE project SET 
                      
                      isdelete ='1'
                      WHERE ProjectId ='$ProjectId' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="ar-projects.php"</script>';
                            } else {
                                echo "Error updating record: " . $con->error;
                            }
                        }


                        //Submit file process
                        if (isset($_POST["submit"])) {
                            $ProjectId = $_POST['ProjectId'];
                            //echo $ApplicantId;
                            $file = $_FILES["file"]["name"];
                            $tmp_name = $_FILES["file"]["tmp_name"];
                            $path = "../Admin/blueprint/" . $file;
                            $file1 = explode(".", $file);
                            $ext = $file1[1];
                            $allowed = array("jpg", "png", "jpeg", "pdf", "docx");
                            if (in_array($ext, $allowed)) {


                                if (($_FILES["file"]["size"] > 100000)) {
                                    $response = array("type" => "Error: ", "message" => "Error: File dimension should be within 100kb only!");
                                    echo '<script type="text/javascript">';
                                    echo ' alert("File dimension should be within 100kb only!")';
                                    echo '</script>';
                                } else {
                                    move_uploaded_file($tmp_name, $path);
                                    // $sql = mysqli_query ($con,"insert into project (ProjectId, blueprint) values ('$ProjectId','$file')");

                                    $sql2 = "UPDATE project set Blueprint = '$file', BlueprintStatusId = 2, Progress = 30 where ProjectId = $ProjectId";


                                    if ($con->query($sql2) === true) {
                                        echo $_FILES["file"]["size"];
                                        echo '<script>window.location.href="ar-projects.php"</script>';
                                    } else {
                                        echo "Error:";
                                    }
                                }
                            } else {
                                echo '<script type="text/javascript">';
                                echo ' alert("Please upload the allowed file!")';
                                echo '</script>';
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
<!-- <script>
    $(function() {
        $("#example1").DataTable({
            "order": [[ 5, "desc" ]],
           
        });
        
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script> -->