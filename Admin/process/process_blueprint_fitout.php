<?php 
include('../config.php');

$action = $_POST['action'];
$checklist = "";

if(isset($_POST['no_error']))
{
    $checklist .= "5~";
}else{ $checklist .= "0~"; }

if(isset($_POST['note']))
{
    $note = $_POST['note'];
    $checklist .= $note;
}

if ($action == "Approve") {
    $ProjectId = $_POST['ID'];
    $BlueprintStatusId = 3;

    $sql = "UPDATE project SET 
    note = '$checklist',
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
else  {// edit reject process
    $ProjectId = $_POST['ID'];
    $BlueprintStatusId = 4;

    $sql = "UPDATE project SET 
    note = '$checklist',
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
