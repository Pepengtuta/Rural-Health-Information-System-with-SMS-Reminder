<?php
require('fpdf/fpdf.php');
session_start();
include('includes/connection.php');

if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

if (isset($_GET['o_id'])) {
    $patient_id = $_GET['o_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_other WHERE o_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("No record found!");
    }
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(0, 10, 'Birth and Emergency Plan', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, "I know that complications can happen unexpectedly either to me or my newborn baby during the delivery. I know that I should deliver my baby in a facility that is staffed and equipped to help us.");
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$data = [
    'I will be attended at the delivery by' => $row['aap'],
    'I plan to deliver at' => $row['aam'],
    'This is a PhilHealth accredited facility' => $row['paf'] ? 'Yes' : 'No',
    'I am a PhilHealth member' => $row['pm'] ? 'Yes' : 'No',
    'Estimated cost of mother/newborn package' => $row['nbp'] . ' pesos',
    'My mode of payment is' => ($row['pay'] == 1 ? 'Cash' : ($row['pay'] == 2 ? 'PhilHealth' : 'Insurance')),
    'The available transport to the facility is' => $row['veh'],
    'I have communicated with to bring me to the above facility' => $row['dname'] . '  ' . $row['dnum'],
    'I will be accompanied by' => $row['bhwname'] . '  ' . $row['bhwnum'],
    'My children/home will be taken care by while I am at the health facility' => $row['tname'] . '  ' . $row['tnum'],
    'In case of emergency, please call' => $row['ename'] . '  ' . $row['enum'] . ' ' . $row['edd'] . ''
];

foreach ($data as $label => $value) {
    $pdf->Cell(130, 10, $label . ':', 1);
    $pdf->Cell(0, 10, $value, 1, 1, 'C');
}

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'In case of blood transfusion, possible donors:', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$donors = [
    ['Name' => $row['emername1'], 'Contact' => $row['emernum1'], 'Address' => $row['emeradd1']],
    ['Name' => $row['emername2'], 'Contact' => $row['emernum2'], 'Address' => $row['emeradd2']],
    ['Name' => $row['emername3'], 'Contact' => $row['emernum3'], 'Address' => $row['emeradd3']]
];

$pdf->Cell(60, 10, 'Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'Contact Number', 1, 0, 'C');
$pdf->Cell(0, 10, 'Address', 1, 1, 'C');

foreach ($donors as $donor) {
    $pdf->Cell(60, 10, $donor['Name'], 1, 0, 'C');
    $pdf->Cell(60, 10, $donor['Contact'], 1, 0, 'C');
    $pdf->Cell(0, 10, $donor['Address'], 1, 1, 'C');
}


$pdf->Output();
?>
