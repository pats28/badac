<?php
session_start();
// require('fpdf181/fpdf.php');
date_default_timezone_set('Asia/Manila');
// $ProjectId = $_SESSION['ProjectId'];
if (isset($_SESSION['ProjectId'])) {
    $ProjectId = $_SESSION['ProjectId'];
} if (isset($_GET['ProjectId'])) {
    $ProjectId = $_GET['ProjectId'];
}
// require('config.php');
// $con=mysqli_connect("localhost","id14620765_badacdb2","c-DMKcd+9\s4Iuq8");
//$con = mysqli_connect("localhost","root","", "id14620765_badacdb");
$con=mysqli_connect("localhost","id15633953_badackonstruk","jwJkQkb2&fBc259z", "id15633953_badacdb");

mysqli_select_db($con,'id15633953_badacdb');

require('fpdf181/fpdf.php');
//add new page
$pdf = new FPDF('P','mm','A4');
class PDF extends FPDF {
    function Header(){
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
    }
    function Footer() {
        $this->Text(90,290,'Badac Konstruk Inc. 2020');
    }
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->Line(50,47,200,47);
$pdf->SetFontSize(15);
$pdf->Cell(0,75,'Project Details',0,1,'L');
// $pdf-> Text(10,45,'Project Details');
$pdf->SetFontSize(25);
$pdf-> SetFont('Arial','b',11);

$pdf-> Text(10,55,'Project Name:');
$pdf-> Text(10,60,'Client Name:');
$pdf-> Text(10,65,'Architect:');
$pdf-> Text(10,70,'Project Manager:');
$pdf-> Text(10,75,'Date Printed:');
// 
$projquery=mysqli_query($con,"SELECT employee.EmpFirstName,employee.EmpLastName,ProjectName FROM employee JOIN project ON project.EmpId = employee.EmpId AND project.ProjectId = $ProjectId");
$rowproj = mysqli_fetch_array($projquery);
// 
$accept=mysqli_query($con,"SELECT * FROM acceptproject JOIN client ON client.ClientId = acceptproject.ClientId AND acceptproject.AcceptId = $ProjectId");
$rowaccept = mysqli_fetch_array($accept);
// 
$clientquery=mysqli_query($con,"SELECT * FROM project JOIN client ON project.ClientId = client.ClientId AND project.ProjectId = $ProjectId ");
$rowclient = mysqli_fetch_array($clientquery);
$pdf-> SetFont('Arial','',12);
$projmanager=mysqli_query($con,"SELECT * FROM employee WHERE DeptId = 1");
$rowpm = mysqli_fetch_array($projmanager);

$pdf-> Text(37,55,$rowaccept['ProjectName']);
$pdf-> Text(35,60,$rowaccept['FirstName'].' '.$rowaccept['LastName']);
$pdf-> Text(29,65,$rowproj['EmpFirstName'].' '.$rowproj['EmpLastName']);
$pdf-> Text(42,70,$rowpm['EmpFirstName'].' '.$rowpm['EmpLastName']);
$pdf-> Text(35,75,date("l, F d, Y g:i A"));
// $pdf-> Text(35,80,);

$pdf->SetTextColor(0,0,0);
$pdf->Line(10,85,165,85);
$pdf->SetFontSize(15);
$pdf->Cell(0,0,'Materials List',0,1,'R');
$pdf->SetFontSize(11);

// $pdf->Line(20,70,200,70);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(180,180,255);
$pdf->SetDrawColor(50,50,100);
$pdf->Cell(55,6,'Equipment Name',1,0,'C',true);
$pdf->Cell(40,6,'Store Name',1,0,'C',true);
$pdf->Cell(30,6,'Unit Price',1,0,'C',true);
$pdf->Cell(30,6,'Quantity',1,0,'C',true);
$pdf->Cell(35,6,'Total Price',1,1,'C',true);

$query=mysqli_query($con,"SELECT materialslist.EquipName, StoreName, Price, Quantity, TotalPrice FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = $ProjectId AND materialsneeded.IsDelete = 0 ORDER by materialslist.StoreId");
while ($row=mysqli_fetch_array($query)){
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(55,6,$row['EquipName'],1,0,'C');
    $pdf->Cell(40,6,$row['StoreName'],1,0,'C');
    $pdf->Cell(30,6,'Php '.number_format($row['Price']),1,0,'C');
    $pdf->Cell(30,6,$row['Quantity'],1,0,'C');
    $pdf->Cell(35,6,'Php '.number_format($row['TotalPrice']),1,1,'C');
}
$storequery=mysqli_query($con,"SELECT store.StoreName as Storename, SUM(materialsneeded.TotalPrice) as GrandTotal FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = $ProjectId AND materialsneeded.IsDelete = 0 GROUP by materialslist.StoreId");
    while ($rowstore=mysqli_fetch_array($storequery)){
        $pdf->Cell(155,6,$rowstore['Storename'],1,0,'R');
        $pdf->Cell(35,6,'Php '.number_format($rowstore['GrandTotal']),1,1,'C');
    }
$sumquery=mysqli_query($con,"SELECT SUM(TotalPrice) FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = $ProjectId AND materialsneeded.IsDelete = 0 ORDER by materialslist.StoreId ");
$rowsum = mysqli_fetch_array($sumquery);
$sum = $rowsum['SUM(TotalPrice)'];
$pdf->SetFont('Arial','B',12);
$pdf->Cell(155,9,'Grand Total:',1,0,'R');
$pdf->Cell(35,9,'Php '.number_format($sum),1,1,'C');
$pdf->Ln(15);
$pdf->Cell(130);
$pdf->SetFont('Arial','',9);
$pdf->Cell(60,7,'Approved by: '.$rowproj['EmpFirstName'].' '.$rowproj['EmpLastName'].' (Architect)','T',1,'C');
$pdf -> Output();
