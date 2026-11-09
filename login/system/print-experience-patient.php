<?php
require('./fpdf/fpdf.php');

include('includes/connection.php');
session_start();

if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

if (isset($_GET['e_id'])) {
    $patient_id = $_GET['e_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_experiences WHERE e_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 15, 'Experience with Previous Pregnancies and Births', 0, 1, 'C');
        $this->Ln(5);
    }

    function TableHeader()
    {
        $this->SetFillColor(255, 255, 255); 
        $this->SetTextColor(50, 50, 50); 
        $this->SetFont('Arial', 'B', 12);
        
        $margin_left = ($this->w - (40 + 50 + 6 * 25)) / 2;
        $this->SetX($margin_left);

        $this->Cell(40, 12, '', 1, 0, 'C', true);
        $this->Cell(50, 12, '', 1, 0, 'C', true);
        for ($i = 1; $i <= 6; $i++) {
            $this->Cell(25, 12, " $i", 1, 0, 'C', true);
        }
        $this->Ln();
        $this->SetTextColor(0, 0, 0); 
    }

    function TableRow($title, $column2, $data, $options = [], $fill = false)
    {
        $this->SetFont('Arial', '', 11);
        $this->SetFillColor(240, 240, 240); 
        
        $margin_left = ($this->w - (40 + 50 + 6 * 25)) / 2;
        $this->SetX($margin_left);

        $this->Cell(40, 12, $title, 1, 0, 'C', $fill);
        $this->Cell(50, 12, $column2, 1, 0, 'C', $fill); 

        foreach ($data as $cell) {
            $cellData = isset($options['checkbox']) ? ($cell ? '/' : '') : $cell;
            $this->Cell(25, 12, $cellData, 1, 0, 'C', $fill);
        }

        $this->Ln();
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->TableHeader();

for ($i = 1; $i <= 6; $i++) {
    ${"pregnancy_{$i}_dod"} = $row["pregnancy_{$i}_dod"];
    ${"pregnancy_{$i}_tod_normal"} = $row["pregnancy_{$i}_tod_normal"];
    ${"pregnancy_{$i}_tod_cs"} = $row["pregnancy_{$i}_tod_cs"];
    ${"pregnancy_{$i}_birth_outcome_alive"} = $row["pregnancy_{$i}_birth_outcome_alive"];
    ${"pregnancy_{$i}_birth_outcome_miscarriage"} = $row["pregnancy_{$i}_birth_outcome_miscarriage"];
    ${"pregnancy_{$i}_birth_outcome_stillbirth"} = $row["pregnancy_{$i}_birth_outcome_stillbirth"];
    ${"pregnancy_{$i}_children_single"} = $row["pregnancy_{$i}_children_single"];
    ${"pregnancy_{$i}_children_twin"} = $row["pregnancy_{$i}_children_twin"];
    ${"pregnancy_{$i}_children_multiple"} = $row["pregnancy_{$i}_children_multiple"];
    ${"pregnancy_{$i}_conditions_pih"} = $row["pregnancy_{$i}_conditions_pih"];
    ${"pregnancy_{$i}_conditions_pe"} = $row["pregnancy_{$i}_conditions_pe"];
    ${"pregnancy_{$i}_conditions_bleeding"} = $row["pregnancy_{$i}_conditions_bleeding"];
}

$pdf->TableRow('Date of Delivery', 'Actual Date', [
    $pregnancy_1_dod, $pregnancy_2_dod, $pregnancy_3_dod, $pregnancy_4_dod, $pregnancy_5_dod, $pregnancy_6_dod
], [], true);

$pdf->TableRow('Type of Delivery', 'Normal (N) or', [
    $pregnancy_1_tod_normal, $pregnancy_2_tod_normal, $pregnancy_3_tod_normal, $pregnancy_4_tod_normal, $pregnancy_5_tod_normal, $pregnancy_6_tod_normal
], ['checkbox' => true], false);

$pdf->TableRow('', 'Caesarean Delivery (C/S)', [
    $pregnancy_1_tod_cs, $pregnancy_2_tod_cs, $pregnancy_3_tod_cs, $pregnancy_4_tod_cs, $pregnancy_5_tod_cs, $pregnancy_6_tod_cs
], ['checkbox' => true], true);

$pdf->TableRow('Birth Outcome', 'Alive', [
    $pregnancy_1_birth_outcome_alive, $pregnancy_2_birth_outcome_alive, $pregnancy_3_birth_outcome_alive, $pregnancy_4_birth_outcome_alive, $pregnancy_5_birth_outcome_alive, $pregnancy_6_birth_outcome_alive
], ['checkbox' => true], false);

$pdf->TableRow('', 'Miscarriage', [
    $pregnancy_1_birth_outcome_miscarriage, $pregnancy_2_birth_outcome_miscarriage, $pregnancy_3_birth_outcome_miscarriage, $pregnancy_4_birth_outcome_miscarriage, $pregnancy_5_birth_outcome_miscarriage, $pregnancy_6_birth_outcome_miscarriage
], ['checkbox' => true], true);

$pdf->TableRow('', 'Stillbirth', [
    $pregnancy_1_birth_outcome_stillbirth, $pregnancy_2_birth_outcome_stillbirth, $pregnancy_3_birth_outcome_stillbirth, $pregnancy_4_birth_outcome_stillbirth, $pregnancy_5_birth_outcome_stillbirth, $pregnancy_6_birth_outcome_stillbirth
], ['checkbox' => true], false);

$pdf->TableRow('Number of Children', 'Single', [
    $pregnancy_1_children_single, $pregnancy_2_children_single, $pregnancy_3_children_single,
    $pregnancy_4_children_single, $pregnancy_5_children_single, $pregnancy_6_children_single
], ['checkbox' => true], false);

$pdf->TableRow('', 'Twin', [
    $pregnancy_1_children_twin, $pregnancy_2_children_twin, $pregnancy_3_children_twin,
    $pregnancy_4_children_twin, $pregnancy_5_children_twin, $pregnancy_6_children_twin
], ['checkbox' => true], true);

$pdf->TableRow('', 'Multiple', [
    $pregnancy_1_children_multiple, $pregnancy_2_children_multiple, $pregnancy_3_children_multiple,
    $pregnancy_4_children_multiple, $pregnancy_5_children_multiple, $pregnancy_6_children_multiple
], ['checkbox' => true], false);

$pdf->TableRow('Pregnancy Conditions', 'PIH', [
    $pregnancy_1_conditions_pih, $pregnancy_2_conditions_pih, $pregnancy_3_conditions_pih,
    $pregnancy_4_conditions_pih, $pregnancy_5_conditions_pih, $pregnancy_6_conditions_pih
], [], true);

$pdf->TableRow('', 'Preeclampsia', [
    $pregnancy_1_conditions_pe, $pregnancy_2_conditions_pe, $pregnancy_3_conditions_pe,
    $pregnancy_4_conditions_pe, $pregnancy_5_conditions_pe, $pregnancy_6_conditions_pe
], [], false);

$pdf->TableRow('', 'Bleeding', [
    $pregnancy_1_conditions_bleeding, $pregnancy_2_conditions_bleeding, $pregnancy_3_conditions_bleeding,
    $pregnancy_4_conditions_bleeding, $pregnancy_5_conditions_bleeding, $pregnancy_6_conditions_bleeding
], [], true);

$pdf->Output();
