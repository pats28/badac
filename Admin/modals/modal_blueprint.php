 <?php 
include('../config.php');
/*
1 new
2 proposed
3 approved
4 reject
*/
if(isset($_POST['ID']))
{
$ID = $_POST['ID'];
 $query = "SELECT * FROM project as p, employee as e, desiredspecs as d WHERE d.ProjectId = p.ProjectId AND  e.EmpId = p.EmpId AND p.isdelete = 0 AND p.ServiceTypeId = 1 AND p.Progress < 100 AND d.ProjectId = '$ID'";
$search_Result = mysqli_query($con, $query);
$row = mysqli_fetch_array($search_Result);
$Lot_Area = $row['Lot_Area'];
$Floor_Area = $row['Floor_Area'];
$Floor_Levels = $row['Floor_Levels'];
$Rooms = $row['Rooms'];
$Toilet_Bath = $row['Toilet_Bath'];
$checklist = $row['Note'];
$status = $row['BlueprintStatusId'];
$progressbarValue = 0; //Set Progress Bar value to 0
    if(!empty($checklist))
    {
        list($cb1, $cb2, $cb3, $cb4, $cb5, $note) = explode("~", $checklist, 6); //split string
        $array_checklist = explode("~", $checklist, 6); //convert to array
        foreach($array_checklist as $item)
        {
            if($item != 0)//getting the value of checklist
            {
                $progressbarValue += 20;    //increase progress bar
                
            }
        }
    }
    else
    {
        list($cb1, $cb2, $cb3, $cb4, $cb5, $note) = "";
    }

$disabled = $status == 3 ? "disabled": "";
}
 ?>
 <div class="row">
    <div class="col-6">
        <!-- <h4 class="mt-1 mb-2">Blueprint Criteria</h4> -->
        <div class="callout callout-info">
            <h6>Reminder!</h6>
            <p>Checking all the blueprint criteria means approving the current blueprint.</p>
            <input type="hidden" value="<?php echo $ID?>" id="project-id"></input>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cb-floor-area" onClick="progressBar(this)" value="Floor area is <?php echo $Floor_Area; ?>sqm" <?php echo $cb1!=0 ? "checked" : ""?> <?php echo $disabled?>>
            <label class="form-check-label h5" id="floor-area">Floor area is <?php echo $Floor_Area; ?>sqm</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cb-lot" onClick="progressBar(this)" value="Lot area is <?php echo $Lot_Area; ?>sqm" <?php echo $cb2!=0 ? "checked" : ""?> <?php echo $disabled?>>
            <label class="form-check-label h5"id="lot">Lot area is <?php echo $Lot_Area; ?>sqm</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cb-floor-levels" onClick="progressBar(this)" value="Has <?php echo $Floor_Levels; ?> floor levels." <?php echo $cb3!=0 ? "checked" : ""?> <?php echo $disabled?>>
            <label class="form-check-label h5"id="floor-levels">Has <?php echo $Floor_Levels; ?> floor levels.</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cb-rooms" onClick="progressBar(this)" value="Has <?php echo $Rooms; ?> room/s and <?php echo $Toilet_Bath; ?> bath/s" <?php echo $cb4!=0 ? "checked" : ""?> <?php echo $disabled?>>
            <label class="form-check-label h5"id="rooms">Has <?php echo $Rooms; ?> room/s and <?php echo $Toilet_Bath; ?> bath/s</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cb-no-error" onClick="progressBar(this)" value="No errors in measurement." <?php echo $cb5!=0 ? "checked" : ""?> <?php echo $disabled?>>
            <label class="form-check-label h5" id="no-error">No errors in measurement.</label>
        </div>
        <!-- <div class="form-check">
            <input class="form-check-input" type="checkbox">
            <label class="form-check-label h5">Lot area is 90sqm</label>
        </div> -->
        <div class="form-group mt-2">
            <textarea class="form-control" rows="5" id="note" placeholder="Project Manager's note to architect." <?php echo $disabled?>><?php echo !empty($note) ? $note : ""?></textarea>
        </div>
        <div id="myProgress">
            <input type="hidden" id="progressBarValue" name="progressBarValue" value="<?php echo $progressbarValue?>">
          <div class="progress-bar" id="myBar" style="width:<?php echo $progressbarValue?>%;"><?php echo $progressbarValue?>%</div>
        </div>
        <br>
        <?php if($status == 3){ ?>
        <button type="button" class="btn btn-block btn-success" disabled>Approved</button>
        <?php } else { ?>
        <button type="button" class="btn btn-block btn-danger" id="approveBtn">Reject</button>
        <?php } ?>
    </div>
    <div class="col-6">
        <embed src="../Admin/blueprint/<?php echo $row["Blueprint"] ?>#page=1&zoom=100" width="350" height="350">
        <!-- <iframe src="../Admin/blueprint/<?php echo $row["Blueprint"] ?>" >
        </iframe> -->
    </div>
    </div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var progress= parseInt($("#progressBarValue").val()); //Get current progress bar value
    var elem = document.getElementById("myBar");
    function progressBar(e){
        if(e.checked)
        {
          progress+=20; 
          $('#myProgress .progress-bar').attr("style","width:" + progress + "%");
          elem.style.width = progress + "%";
          $('#myBar').text(progress + "%");
          
        }
        else
        {
          progress-=20;
          $('#myProgress .progress-bar').attr("style","width:" + progress + "%");
          elem.style.width = progress + "%";
          $('#myBar').text(progress + "%");
          document.getElementById('approveBtn').innerHTML = "Reject";
          document.getElementById('approveBtn').className = "btn btn-block btn-danger";
        }
        if(progress == 100)
        { 
            document.getElementById('approveBtn').innerHTML = "Approve";
            document.getElementById('approveBtn').className = "btn btn-block btn-success";
        }
    }
    
     $("#approveBtn").click(function(e) 
     { 
         e.preventDefault();
         var ID = $("#project-id").val();
         var action = document.getElementById('approveBtn').innerHTML;
         var floor_area = $('input[id="cb-floor-area"]:checked').val();
         var lot = $('input[id="cb-lot"]:checked').val();
         var floor_levels = $('input[id="cb-floor-levels"]:checked').val();
         var rooms = $('input[id="cb-rooms"]:checked').val();
         var no_error = $('input[id="cb-no-error"]:checked').val();
         var note = $('#note').val();
         var progressBarValue = $('#progressBarValue').val();
         
         $.ajax({
           url: "process/process_blueprint.php",
           method: 'POST',
           data: {
               ID:ID,
               action:action, 
               floor_area:floor_area, 
               lot:lot, 
               floor_levels:floor_levels, 
               rooms:rooms, 
               no_error:no_error, 
               note:note,
               progressBarValue:progressBarValue
           },success: function(data){
               swal({
                  title: "Record Saved!",
                  icon: "success",
                  button: "OK",
                });
           }
         });

     }); 
</script>