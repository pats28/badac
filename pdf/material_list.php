<?php
session_start();
// require('fpdf181/fpdf.php');
date_default_timezone_set('Asia/Manila');
// $ProjectId = $_SESSION['ProjectId'];
if (isset($_SESSION['ProjectId'])) {
    $ProjectId = $_SESSION['ProjectId'];
    // $project = mysqli_query($con, "SELECT * FROM project JOIN employee ON project.EmpId = employee.EmpId WHERE project.ProjectId = '$ProjectId'");
    // $rowProject = mysql_fetch_assoc($project);
} if (isset($_GET['ProjectId'])) {
    $ProjectId = $_GET['ProjectId'];
    
}
require('mysql_table.php');
require('config.php');


class PDF extends PDF_MySQL_Table
{
function Header()
{
    //  $project = mysqli_query($con, "SELECT EmpFirstName, EmpLastName FROM project JOIN employee ON project.EmpId = client.EmpId WHERE project.ProjectId = '$ProjectId'");
    // $project=mysqli_query("SELECT * FROM project JOIN client ON project.ClientId = client.ClientId WHERE project.ProjectId = 22",$con);
    //  $rowProject = mysql_fetch_assoc($project);
    // $ProjectName = $rowProject["ProjectName"];
    // $sql=mysql_query('SELECT * FROM project JOIN client ON project.ClientId = client.ClientId WHERE project.ProjectId = 29');
    // $records=mysql_query($sql);
    // $fetch=mysql_fetch_assoc($sql);
    // Title
    $this->SetFont('Arial','B',18);
    $this -> image ('new-logo.jpg',10,10,55,30);
    // $this->Cell(0,6,'Report',0,1,'C');
    $this->SetFontSize(25);
    // $this->SetTextColor(119,119,119);
    $this->Text(115,19,'Badac Konstruk Inc.');
    $this->SetFont('Arial','',10);
    $this->Text(115,25,'Lot 24/23 Navarro Compound, Rose Ann Subdivision,');
    $this->Text(159,29,'San Roque, Cainta, Rizal');
    $this->Text(175,33,'(02) 86533791');
    $this->Text(150,37,'badackonstrukinc@yahoo.com');
    $this->SetTextColor(0,0,0);
    $this->Line(40,47,200,47);
    parent::Header();
}
}

// $project = mysqli_query($con, "SELECT EmpFirstName, EmpLastName FROM project JOIN employee ON project.EmpId = client.EmpId WHERE project.ProjectId = '$ProjectId'");
// $rowProject = mysql_fetch_assoc($project);

$pdf = new PDF();
// $a = "&#8369;";
// $b = iconv('UTF-8', 'windows-1252', $a);
$pdf->AddPage();
$pdf->SetFontSize(25);
$pdf->Cell(0,75,'Project',0,1,'L');
$pdf-> SetFont('Arial','BI',12);
$pdf-> Text(10,60,'Project Name: ');
$pdf-> Text(10,65,'Architect: ');
$pdf-> Text(10,70,'Project Manager: ');
$pdf-> Text(10,75,'Date Printed: ');

$pdf-> SetFont('Arial','',12);
$pdf-> Text(40,60, 'Two storey');
// $pdf-> Text(33,65,$rowProject['EmpFirstName']);
$pdf-> Text(33,65, 'Zahra Macud');
$pdf-> Text(47,70, 'Fatima Macud');
$pdf-> Text(40,75,date("l, F d, Y g:i A"));
$pdf->SetTextColor(0,0,0);
$pdf->Line(10,85,145,85);
$pdf->SetFontSize(25);
$pdf->Cell(0,0,'Materials List',0,1,'R');
$pdf->Ln(7);
$pdf->SetFontSize(11);
// $pdf->Cell(1);
// $pdf->SetDrawColor(241,241,24);
$pdf->Table($con,"SELECT materialslist.EquipName, StoreName, Price, Quantity, TotalPrice FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId ='$ProjectId' AND materialsneeded.IsDelete = 0 ORDER by materialslist.StoreId ");

$pdf->Table($con,"SELECT SUM(TotalPrice) FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId ='$ProjectId' AND materialsneeded.IsDelete = 0 ORDER by materialslist.StoreId ");

// $totals ="SELECT TotalPrice FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId ='$ProjectId' ORDER by materialslist.StoreId ";
// $result = mysqli_query($con,$totals);
// $rowGrandTotal = mysqli_fetch_assoc($result);

// $ProjectId = $_SESSION['ProjectId'];
// $sqlMaterialList = "SELECT * FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = '$ProjectId' ORDER by materialslist.StoreId";

// $pdf->Cell(160,10,'Grand Total',1,0,'R');
// $pdf->Cell(30,10,'sd',1,1,'C');

// First table: output all columns
//$pdf->Table($link,'select AccountID,FullName,MessengerLink from accounttbl order by AccountID');

// $pdf -> Text (10,10,"{$count9}\n",'c');
// Second table: specify 3 columns
$pdf -> Output();
?>
