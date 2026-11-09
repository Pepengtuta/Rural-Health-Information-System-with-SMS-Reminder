<?php
require('fpdf/fpdf.php');

session_start();
if (empty($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}

include('includes/connection.php');

$i_number = isset($_GET['i_number']) ? mysqli_real_escape_string($connection, $_GET['i_number']) : '';
$i_id = isset($_GET['i_id']) ? mysqli_real_escape_string($connection, $_GET['i_id']) : '';

if (empty($i_id)) {
    die("Invalid ID provided.");
}

$ret = "SELECT * FROM tbl_immunization WHERE i_id=?";
$stmt = $connection->prepare($ret);
if ($stmt === false) {
    die("SQL Prepare failed: " . $connection->error);
}

$stmt->bind_param('i', $i_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    die("No record found.");
}

$row = $res->fetch_assoc();

$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Child Immunization Record', 0, 1, 'C');
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Name of Child:');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, $row['i_name'], 0, 1);
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(50, 10, 'VACCINE', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'DOSED', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'DATE OF VACCINATION', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'REMARKS', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);

function addRow($pdf, $vaccine, $doses, $date, $remarks) {
    $lineHeight = 8; 
    
    $vaccineLines = ceil($pdf->GetStringWidth($vaccine) / 40);
    $dosesLines = ceil($pdf->GetStringWidth($doses) / 50);
    $dateLines = ceil($pdf->GetStringWidth($date) / 50);
    $remarksLines = ceil($pdf->GetStringWidth($remarks) / 50);

    $maxLines = max($vaccineLines, $dosesLines, $dateLines, $remarksLines);

    $rowHeight = $maxLines * $lineHeight;

    $x = $pdf->GetX();
    $y = $pdf->GetY(); 
    $pdf->MultiCell(50, $lineHeight, $vaccine, 1, 'C');
    $pdf->SetXY($x + 50, $y); 
    $x = $pdf->GetX();
    $pdf->MultiCell(50, $lineHeight, $doses, 1, 'C');
    $pdf->SetXY($x + 50, $y);

    $x = $pdf->GetX();
    $pdf->MultiCell(50, $lineHeight, $date, 1, 'C');
    $pdf->SetXY($x + 50, $y);

    $pdf->MultiCell(40, $lineHeight, $remarks, 1, 'C');

    $pdf->SetXY($pdf->GetX(), $y + $rowHeight);
}

function formatDate($date) {
    if (empty($date)) {
        return '   '; 
    }

    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    return $dateObj ? $dateObj->format('m-d-Y') : '   '; 
}


addRow($pdf, 'BCG', '1 dose', formatDate($row['i_bcg_d1']), $row['i_bcg_rem']);
addRow($pdf, 'HEPATITIS B', '1 dose', formatDate($row['i_hep_d1']), $row['i_hep_rem']);
addRow($pdf, '            PENTAVALENT                       VACCINE             (DPT-Hep B-HiB)', "3 doses \n 1 1/2, 2 1/2 & \n 3 1/2 months",
    formatDate($row['i_dpt_d1']) . "\n" . 
    formatDate($row['i_dpt_d2']) . "\n" . 
    formatDate($row['i_dpt_d3']),
    ($row['i_dpt_rem1'] ? $row['i_dpt_rem1'] : '   ') . "\n" . 
    ($row['i_dpt_rem2'] ? $row['i_dpt_rem2'] : '   ') . "\n" . 
    ($row['i_dpt_rem3'] ? $row['i_dpt_rem3'] : '   ')
);

addRow(
    $pdf, 
    '             ORAL POLIO                              VACCINE                (OPV)', 
    "3 doses \n 1 1/2, 2 1/2 & \n 3 1/2 months", 
    formatDate($row['i_opv_d1']) . "\n" . 
    formatDate($row['i_opv_d2']) . "\n" . 
    formatDate($row['i_opv_d3']), 
    ($row['i_opv_rem1'] ? $row['i_opv_rem1'] : '   ') . "\n" . 
    ($row['i_opv_rem2'] ? $row['i_opv_rem2'] : '   ') . "\n" . 
    ($row['i_opv_rem3'] ? $row['i_opv_rem3'] : '   ')
);

addRow(
    $pdf, 
    'INACTIVATED POLIO VACCINE (IPV)', 
    "1 dose \n 3 1/2 months", 
    formatDate($row['i_ipv_d1']) . "\n \n", 
    ($row['i_ipv_rem'] ? $row['i_ipv_rem'] : '   ') . "\n \n"
);

addRow(
    $pdf, 
    'PNEUMOCOCCAL CONJUGATE VACCINE (PCV)', 
    "3 doses \n 1 1/2, 2 1/2 & \n 3 1/2 months", 
    formatDate($row['i_pcv_d1']) . "\n" . 
    formatDate($row['i_pcv_d2']) . "\n" . 
    formatDate($row['i_pcv_d3']), 
    ($row['i_opv_rem1'] ? $row['i_opv_rem1'] : '   ') . "\n" . 
    ($row['i_opv_rem2'] ? $row['i_opv_rem2'] : '   ') . "\n" . 
    ($row['i_opv_rem3'] ? $row['i_opv_rem3'] : '   ')
);

addRow(
    $pdf, 
    'MEASLES, MUMPS, RUBELLA (MMR)', 
    "2 doses\n9 months & 1 year", 
    formatDate($row['i_mmr_d1']) . "\n" . formatDate($row['i_mmr_d2']), 
    ($row['i_mmr_rem1'] ? $row['i_mmr_rem1'] : '   '). "\n" . ($row['i_mmr_rem2'] ? $row['i_mmr_rem2'] : '   ') 
);
    
addRow(
    $pdf, 
    'OTHER VACCINE', 
    $row['i_other_name1'] . "\n" . $row['i_other_name2'], 
    formatDate($row['i_other_d1']) . "\n" . $row['i_other_d2'], 
    $row['i_other_rem1'] . "\n" . $row['i_other_rem2']
);


$pdf->Output();

$stmt->close();
$connection->close();
?>
