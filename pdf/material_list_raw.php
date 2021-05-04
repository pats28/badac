<?php
date_default_timezone_set('Asia/Manila');

require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
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
    // $this->SetFont('Helvetica','',20);
    // $this->SetFont('Arial','B',18);
    // $this->SetFontSize(25);
    // $this->SetTextColor(0,123,255);
    // $this->Cell(0,75,'Project',0,1,'L');
    // $this->Cell(0,0,'Materials',0,2,'C');
    // $this->Text(70,60,'Materials');
    // $this->SetTextColor(0,0,0);
    // $this->SetFontSize(12);
    // $this->SetFont('Arial','i');
    // $this->Text(74,52,date("l, F d, Y g:i A"));
    // $this->Ln(50);
    // Ensure table header is printed
    parent::Header();
}
}
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
$pdf-> Text(40,60,'Two Storey Building');
$pdf-> Text(33,65,'Kim C. Torrina');
$pdf-> Text(47,70,'Fatima Macud');
$pdf-> Text(40,75,date("l, F d, Y g:i A"));
$pdf->SetTextColor(0,0,0);
$pdf->Line(10,85,145,85);
$pdf->SetFontSize(25);
$pdf->Cell(0,0,'Materials List',0,1,'R');
$pdf->Ln(7);
$pdf->SetFontSize(11);
// $pdf->Cell(1);
// $pdf->SetDrawColor(241,241,24);
$pdf-> Cell(70,10,'Product Name',1,0,'C');
$pdf-> Cell(20,10,'Unit Price',1,0,'C');
$pdf-> Cell(20,10,'Quantity',1,0,'C');
$pdf-> Cell(50,10,'Store Name',1,0,'C');
$pdf-> Cell(30,10,'Total Price',1,1,'C');
// $pdf->Cell(1);

$pdf-> Cell(70,10,'Bistay',1,0,'C');
$pdf-> Cell(20,10,'P 35.00',1,0,'C');
$pdf-> Cell(20,10,'15',1,0,'C');
$pdf-> Cell(50,10,'Store Name',1,0,'C');
$pdf-> Cell(30,10,'P 525.00',1,1,'C');

$pdf-> Cell(70,10,'Hollow Blocks',1,0,'C');
$pdf-> Cell(20,10,'P 17.00',1,0,'C');
$pdf-> Cell(20,10,'150',1,0,'C');
$pdf-> Cell(50,10,'Store Name',1,0,'C');
$pdf-> Cell(30,10,'P 2,550.00',1,1,'C');

$pdf-> Cell(70,10,'Eagle Cement Advance',1,0,'C');
$pdf-> Cell(20,10,'P 217.00',1,0,'C');
$pdf-> Cell(20,10,'9',1,0,'C');
$pdf-> Cell(50,10,'Store Name',1,0,'C');
$pdf-> Cell(30,10,'P 1,953.00',1,1,'C');

$pdf-> Cell(70,10,'Cement Trowel',1,0,'C');
$pdf-> Cell(20,10,'P 220.00',1,0,'C');
$pdf-> Cell(20,10,'5',1,0,'C');
$pdf-> Cell(50,10,'Store Name',1,0,'C');
$pdf-> Cell(30,10,'P 1,100.00',1,1,'C');
$pdf-> SetFont('Arial','B',12);
$pdf->Cell(160,10,'Grand Total',1,0,'R');
$pdf->Cell(30,10,'P 3,053.00',1,1,'C');





// First table: output all columns
//$pdf->Table($link,'select AccountID,FullName,MessengerLink from accounttbl order by AccountID');

// $pdf -> Text (10,10,"{$count9}\n",'c');
// Second table: specify 3 columns


$pdf -> Output();
?>
