<?php

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/PDF/FPDF/fpdf.php');
require_once('/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/PDF/FPDI/src/autoload.php');

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/PDF/VelkomstBrev.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$navn = "Ole Marius";
$dato = date("Y-m-d");
$by = "Kristiansand,";
$bilde = "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/PDF/ProfilBilde.jpeg";

$pdf->addPage();
$pdf->useImportedPage($pageId, 1, 1, 200);

$pdf->SetFont('Helvetica');
$pdf->SetFontSize(12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(35, 0);
$pdf->Write(195.7, $navn);
$pdf->SetXY(155, 0);
$pdf->Write(195.7, $dato);
$pdf->SetXY(130, 0);
$pdf->Write(195.7, $by);

$pdf->Image($bilde, 137, 200, 40, 55);






$pdf->Output('I', 'generated.pdf');
