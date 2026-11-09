<?php
// Include FPDF library
require('./fpdf/fpdf.php');

// Include your connection and session
include('includes/connection.php');
session_start();

// Ensure the user is logged in
if(empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

// Retrieve data from the database
$id = $_GET['id']; // assuming id is passed in URL to get specific record
$query = "SELECT * FROM tbl_patients WHERE id = '$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result); // Fetch the data

// Create PDF with A4 paper size (Landscape)
$pdf = new FPDF('L', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 16);

// Add Document Title with Background
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(0, 12, 'MATERNAL HEALTH RECORD', 0, 1, 'C', true);
$pdf->Ln(7);

// Mother Information Section
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 8, 'MOTHER\'S INFORMATION', 1, 1, 'L', true);
$pdf->Ln(2);

// Details in two-column layout
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Full Name:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_first_name'] . " " . $row['m_middle_name'] . " " . $row['m_last_name'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['m_dob'], 0,  1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Cell Phone:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_phone'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Landline', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['m_landline'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Blood Type:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_type_blood'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Occupation', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['m_occupation'], 0, 1, 'L');

$pdf->Ln(2);

// Father Information Section
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 8, 'FATHER\'S INFORMATION', 1, 1, 'L', true);
$pdf->Ln(2);

// Example formatting for Father's details (similar to mother's)
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Full Name:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['f_first_name'] . " " . $row['f_middle_name'] . " " . $row['f_last_name'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['f_dob'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Cell Phone:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['f_phone'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Landline', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['f_landline'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Blood Type:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['f_type_blood'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Occupation', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['f_occupation'], 0, 1, 'L');

// Repeat similar sections for children's information, emergency contact, etc.
$pdf->Ln(2);

$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 8, 'CHILD / CHILDREN INFORMATION', 1, 1, 'L', true);
$pdf->Ln(2);

// Example formatting for Father's details (similar to mother's)
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Children Name:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['children1'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['dob1'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, '                         :', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['children2'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['dob2'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, '                         :', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['children3'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(40, 6, $row['dob3'], 0, 1, 'L');

$pdf->Ln(2);

$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 8, '', 1, 1, 'L', true);
$pdf->Ln(2);

// Example formatting for Father's details (similar to mother's)
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Address:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['addr'], 0, 0, 'L');

$pdf->Ln(8);

// Emergency Contact Section
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 8, 'IN CASE OF EMERGENCY', 1, 1, 'L', true);
$pdf->Ln(2);

// Example Emergency Contact formatting
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Name:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['g_name'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Relationship:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['g_rel'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Birthday:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['g_dob'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Cell Phone:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['g_phone'], 0, 1, 'L');

$pdf->Ln(2);

$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 8, '', 1, 1, 'L', true);
$pdf->Ln(2);

// Example Emergency Contact formatting
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(55, 6, 'Date of First Check-up:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(65, 6, $row['dofcu'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Age:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(68, 6, $row['m_age'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Weight:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_weight'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(35, 6, 'Height:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_height'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(85, 6, 'Nutritional status based on Body Mass Index:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_bmi'], 0, 1, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(55, 6, 'Date of Last Menstrual Period:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(65, 6, $row['m_dolp'], 0, 0, 'L');

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(50, 6, 'Expected Date of Delivery:', 0, 0, 'L');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(85, 6, $row['m_edod'], 0, 1, 'L');

// Output the PDF
$pdf->Output();
?>
