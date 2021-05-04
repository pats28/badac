 <?php 
include('../config.php');
if(isset($_POST['ID']))
{
$ID = $_POST['ID'];
 $query = "SELECT * FROM project as p, employee as e, desiredspecs as d WHERE d.ProjectId = p.ProjectId AND  e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 1 AND p.Progress < 100 AND d.ProjectId = '$ID'";
$search_Result = mysqli_query($con, $query);
$row = mysqli_fetch_array($search_Result);
$ProjectId = $row['ProjectId'];
$ProjectName = $row['ProjectName'];
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
}
 ?>
<div class="row">
    <div class="col-md-6">
        <label>Date Started</label>
        <input type="text" name="Date_Started" id="Date_Started" value="<?php echo $newDateStarted; ?>" class="form-control" disabled>
    </div>
    <div class="col-md-6">
        <label>Estimated Finish Date</label>
        <input type="text" name="Estimated_Finish_Date" id="Estimated_Finish_Date" value="<?php echo $newEstimatedFinishDate; ?>" class="form-control" disabled>
    </div>
    <div class="col-md-6">
        <label>Property Location</label>
        <input type="text" name="Property_Loc" id="Property_Loc" value="<?php echo $Property_Loc; ?>" class="form-control" disabled>
    </div>
    <div class="col-md-6">
        <label>Classification</label>
        <input type="text" name="Car_Garage" id="classification" value="<?php echo $Classification; ?>" class="form-control" disabled>

    </div>
    <div class="col-md-6">
        <label>Preferred Design</label>
        <input type="text" name="Car_Garage" id="preferred_design" value="<?php echo $Preferred_Design; ?>" class="form-control" disabled>

    </div>
    <div class="col-md-6">
        <label>Preferred Finish</label>
        <input type="text" name="Car_Garage" id="preferred_finish" value="<?php echo $Preferred_Finish; ?>" class="form-control" disabled>

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