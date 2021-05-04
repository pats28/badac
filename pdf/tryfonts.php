<?php

require('fpdf181/fpdf.php');
require('fpdf181/font/BRUSHSCI.php');

$pdf = new FPDF();
$pdf->AddFont('BrushScriptMT','','BRUSHSCI.php');
$pdf->AddPage();
$pdf->SetFont('BrushScriptMT','',35);
$pdf -> SetTextColor (86, 210, 88);
$pdf->Cell(0,10,'Certification');
$pdf->Output();
?>