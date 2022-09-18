<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

require('fpdf.php');

$title = $_POST['title'];
$note = $_POST['note'];

if($title == '') {
	$_SESSION['error_msg'] = "Title cannot be empty!";
	$_SESSION['redirect'] = "note.php";
	header("location: error_handling.php");
	exit();
} else {
	$pdf = new FPDF('L', 'mm', 'A5');
	$pdf->AddPage();
	$pdf->Ln(6);
	$pdf->SetFont('Arial', 'B', 20);
	$pdf->Cell(85);
	$pdf->Cell(20, 10, $title, 0, 0, 'C');
	$pdf->Ln(12);
	$pdf->SetFont('Arial', '', 12);
	$pdf->MultiCell(190, 8, $note, 'C');
	$pdf->Output("$title.pdf","D");
}
?>