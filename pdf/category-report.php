<?php
date_default_timezone_set('Asia/Manila');

require('mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
    $this->SetFont('Arial','',18);
    $this -> image ('logo3.png',10,10,25,25);
    // $this->Cell(0,6,'Report',0,1,'C');
    $this->SetFontSize(20);
    // $this->SetTextColor(119,119,119);
    $this->Text(93,20,'Found`em');
    $this->SetFontSize(13);
    $this->Text(83,27,'(Lost and Found System)');
    $this->SetFont('Helvetica','',18);
    $this->SetFontSize(40);
    $this->SetTextColor(102,102,255);
    $this->Text(60,45,'Category Rank');
    $this->SetTextColor(0,0,0);
    $this->SetFontSize(12);
    $this->SetFont('Arial','i');
    $this->Text(74,52,date("l, F d, Y g:i A"));

    $this->Ln(50);
    // Ensure table header is printed
    parent::Header();
}
}

$link = mysqli_connect('localhost','root','','lostfound');

$lost_items = mysqli_num_rows(mysqli_query($link, "SELECT * from lostitemtbl where status = 0 and month(DatePosted) = month(CURRENT_TIMESTAMP)"));
$found_items = mysqli_num_rows(mysqli_query($link, "SELECT * from founditemtbl where status = 1"));
$retrieved = mysqli_num_rows(mysqli_query($link, "SELECT * FROM `lostitemtbl` where Status = 2  and month(DateRetrieved) = month(CURRENT_TIMESTAMP)"));
$surrendered = mysqli_num_rows(mysqli_query($link, "SELECT * FROM `founditemtbl` where Status = 3  and month(DateSurrendered) = month(CURRENT_TIMESTAMP)"));
// Connect to database


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFillColor(119,119,119);
$pdf->SetTitle('Category Report');
$pdf->SetFont('Helvetica','');
$pdf->SetFontSize(15);


$pdf->SetFont('Helvetica','b');
$pdf->Ln(10);
$pdf->Write(0,'Found Items');
$pdf->Ln(5);
$pdf->Table($link,'SELECT  COUNT(*) as Number,c.CategoryName from founditemtbl as l join categorytbl as c on l.CategoryID = c.CategoryID GROUP by c.CategoryName order by COUNT(*) desc ');

$pdf->SetFontSize(15);
$pdf->SetFont('Helvetica','b');
$pdf->Ln(10);
$pdf->Write(0,'Lost Items');
$pdf->Ln(5);
$pdf->Table($link,'SELECT COUNT(*) as Number,c.CategoryName from lostitemtbl as l join categorytbl as c on l.CategoryID = c.CategoryID GROUP by c.CategoryName order by COUNT(*) desc');




// First table: output all columns
//$pdf->Table($link,'select AccountID,FullName,MessengerLink from accounttbl order by AccountID');

// $pdf -> Text (10,10,"{$count9}\n",'c');
// Second table: specify 3 columns


$pdf->Output();
?>