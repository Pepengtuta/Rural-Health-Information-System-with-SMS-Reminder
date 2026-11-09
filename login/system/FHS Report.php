<?php
// Include FPDF library
require('./fpdf/fpdf.php');

// Include your connection and session
include('includes/connection.php');
session_start();

// Ensure the user is logged in
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

// Check if date filters are set
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : null;
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : null;

// Prepare the base query to fetch data
$query = "SELECT * FROM tbl_immunization WHERE 1=1";

if ($from_date && $to_date) {
    $query .= " AND (i_bcg_d1 BETWEEN '$from_date' AND '$to_date' 
                 OR i_hep_d1 BETWEEN '$from_date' AND '$to_date' 
                 OR i_dpt_d1 BETWEEN '$from_date' AND '$to_date'
                 OR i_dpt_d2 BETWEEN '$from_date' AND '$to_date'
                 OR i_dpt_d3 BETWEEN '$from_date' AND '$to_date'
                 OR i_opv_d1 BETWEEN '$from_date' AND '$to_date'
                 OR i_opv_d2 BETWEEN '$from_date' AND '$to_date'
                 OR i_opv_d3 BETWEEN '$from_date' AND '$to_date'
                 OR i_ipv_d1 BETWEEN '$from_date' AND '$to_date'
                 OR i_pcv_d1 BETWEEN '$from_date' AND '$to_date'
                 OR i_pcv_d2 BETWEEN '$from_date' AND '$to_date'
                 OR i_pcv_d3 BETWEEN '$from_date' AND '$to_date'
                 OR i_mmr_d1 BETWEEN '$from_date' AND '$to_date'
                 OR i_mmr_d2 BETWEEN '$from_date' AND '$to_date')";
}

$result = mysqli_query($connection, $query);

// Initialize counters for each vaccine
$male_bcg_count = $female_bcg_count = 0;
$male_opv3_count = $female_opv3_count = 0;

$male_hep_count = $female_hep_count = 0;
$male_ipv_count = $female_ipv_count = 0;

$male_dpt1_count = $female_dpt1_count = 0;
$male_pcv1_count = $female_pcv1_count = 0;

$male_dpt2_count = $female_dpt2_count = 0;
$male_pcv2_count = $female_pcv2_count = 0;

$male_dpt3_count = $female_dpt3_count = 0;
$male_pcv3_count = $female_pcv3_count = 0;

$male_opv1_count = $female_opv1_count = 0;
$male_mmr1_count = $female_mmr1_count = 0;

$male_opv2_count = $female_opv2_count = 0;
$male_mmr2_count = $female_mmr2_count = 0;



// Loop through the results and count the totals
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['i_gender'] == 'Male') {
        $male_bcg_count += !empty($row['i_bcg_d1']) ? 1 : 0;
        $male_opv3_count += !empty($row['i_opv_d3']) ? 1 : 0;
        $male_hep_count += !empty($row['i_hep_d1']) ? 1 : 0;
        $male_ipv_count += !empty($row['i_ipv_d1']) ? 1 : 0;
        $male_dpt1_count += !empty($row['i_dpt_d1']) ? 1 : 0;
        $male_pcv1_count += !empty($row['i_pcv_d1']) ? 1 : 0;
        $male_dpt2_count += !empty($row['i_dpt_d2']) ? 1 : 0;
        $male_pcv2_count += !empty($row['i_pcv_d2']) ? 1 : 0;
        $male_dpt3_count += !empty($row['i_dpt_d3']) ? 1 : 0;
        $male_pcv3_count += !empty($row['i_pcv_d3']) ? 1 : 0;
        $male_opv1_count += !empty($row['i_opv_d1']) ? 1 : 0;

        $male_mmr1_count += !empty($row['i_mmr_d1']) ? 1 : 0;
        $male_opv2_count += !empty($row['i_opv_d2']) ? 1 : 0;
        $male_mmr2_count += !empty($row['i_mmr_d2']) ? 1 : 0;

    } else if ($row['i_gender'] == 'Female') {
        $female_bcg_count += !empty($row['i_bcg_d1']) ? 1 : 0;
        $female_opv3_count += !empty($row['i_opv_d3']) ? 1 : 0;
        $female_hep_count += !empty($row['i_hep_d1']) ? 1 : 0;
        $female_ipv_count += !empty($row['i_ipv_d1']) ? 1 : 0;
        $female_dpt1_count += !empty($row['i_dpt_d1']) ? 1 : 0;
        $female_pcv1_count += !empty($row['i_pcv_d1']) ? 1 : 0;
        $female_dpt2_count += !empty($row['i_dpt_d2']) ? 1 : 0;
        $female_pcv2_count += !empty($row['i_pcv_d2']) ? 1 : 0;
        $female_dpt3_count += !empty($row['i_dpt_d3']) ? 1 : 0;
        $female_pcv3_count += !empty($row['i_pcv_d3']) ? 1 : 0;
        $female_opv1_count += !empty($row['i_opv_d1']) ? 1 : 0;

        $female_mmr1_count += !empty($row['i_mmr_d1']) ? 1 : 0;
        $female_opv2_count += !empty($row['i_opv_d2']) ? 1 : 0;
        $female_mmr2_count += !empty($row['i_mmr_d2']) ? 1 : 0;
    }
}

//mother
$nutrition_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE first_nutrition IS NOT NULL AND first_nutrition != ''
";

$syphilis_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE third_STIs IS NOT NULL AND third_STIs != ''
";

$prenatal_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM (
        SELECT first_m_name, first_m_age FROM tbl_first_trimester
        UNION ALL
        SELECT second_m_name, second_m_age FROM tbl_second_trimester
        UNION ALL
        SELECT third_m_name, third_m_age FROM tbl_third_trimester
    ) AS combined
    GROUP BY first_m_name
    HAVING COUNT(first_m_name) >= 2;

";

// For Nutrition Data
$nutrition_result = mysqli_query($connection, $nutrition_query);
$nutrition_data = mysqli_fetch_assoc($nutrition_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

// For Syphilis Data
$syphilis_result = mysqli_query($connection, $syphilis_query);
$syphilis_data = mysqli_fetch_assoc($syphilis_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

// For Prenatal Data
$prenatal_result = mysqli_query($connection, $prenatal_query);
$prenatal_data = mysqli_fetch_assoc($prenatal_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

// Create associative arrays for totals
$total_nutrition_assessed_age_group = [
    '10-14' => $nutrition_data['age_10_14'],
    '15-19' => $nutrition_data['age_15_19'],
    '20-49' => $nutrition_data['age_20_49'],
];

$total_syphilis_assessed_age_group = [
    '10-14' => $syphilis_data['age_10_14'],
    '15-19' => $syphilis_data['age_15_19'],
    '20-49' => $syphilis_data['age_20_49'],
];

$total_prenatal_checkups = [
    '10-14' => $prenatal_data['age_10_14'],
    '15-19' => $prenatal_data['age_15_19'],
    '20-49' => $prenatal_data['age_20_49'],
];

// Create PDF with Legal paper size (Landscape)
$pdf = new FPDF('L', 'mm', 'Legal');
$pdf->AddPage();

// Title Section
$pdf->SetFont('Helvetica', 'B', 11);

// First row: Logo, Title, etc.
// Insert the logo image
$pdf->Image('doh.jpeg', 25, 15, 30, 30);  // Adjust the file path and dimensions accordingly
$pdf->Cell(60, 40, '', 1, 0, 'C');  // Placeholder cell for logo's border

// Set position for the title and description
$pdf->SetXY(70, 10); // Set position next to the logo
$pdf->SetFont('Helvetica', 'B', 13); // Reset back to original font size

// Combine title and additional information into one text block
$combinedText = "Field Health Services Information System (FHSIS) Report\n" . 
                "Name of Barangay: Laguinbanua East               Name of BHS: Bubog\n" . 
                "Name of Municipality: Numancia                      Name of Province: Aklan\n" . 
                "Projected Population of the Year:";

// Use MultiCell for multi-line text and better alignment
$pdf->MultiCell(180, 10, $combinedText, 1, 'C');  // MultiCell allows text to wrap properly

// Draw a line below the title text
$pdf->Line(70, 20, 250, 20);  // Adjust the y-coordinate to position the line correctly

// Set a larger font size for the M1 cell
$pdf->SetFont('Helvetica', 'B', 36); // Change font size for M1
$pdf->SetXY(250, 10);  // Set X and Y position for M1 and Date cells
$pdf->Cell(50, 40, 'M1', 1, 0, 'C');  // M1 Cell

// Retrieve and format the date range
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : null;

// Convert the dates to a more readable format, e.g., "October 1, 2024"
$fromDateFormatted = $from_date ? date('F Y', strtotime($from_date)) : 'N/A';

// Display the formatted date range in the PDF
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(50, 40, "$fromDateFormatted", 1, 1, 'C');


// Section Title for Maternal Care and Services
$pdf->SetFont('Arial', 'B', 12); // Set bold font for section header
$pdf->Cell(340, 8, 'Section: Maternal Care and Services', 1, 1, 'C');  // Full-width section header

// Reset font for the table
$pdf->SetFont('Arial', 'B', 9);  // Bold for table headers

// Adjusted column widths for a total width of 340mm
$columnWidths = [
    75,  // Indicators
    15,  // Eligible Pop.
    30,  // Age
    10,  // Total
    10,  // %
    30,  // Remarks
];

// Table Header (First Half)
$pdf->Cell($columnWidths[0], 8, 'Indicators', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, 'Pop.', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, 'Age', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, 'Total', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, '%', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, 'Remarks', 1, 0, 'C');
$pdf->Cell($columnWidths[0], 8, 'Indicators', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, 'Pop.', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, 'Age', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, 'Total', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, '%', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, 'Remarks', 1, 1, 'C');  // Ends the row (use 1, 1 to move to next line)

$columnWidths = [
    75,  // Indicators
    15,  // Eligible Pop.
    10,  // Age
    10,  // Total
    10,  // %
    30,  // Remarks
];
$pdf->Cell($columnWidths[0], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '10-14', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '15-19', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '20-49', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[0], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '10-14', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '15-19', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, '20-49', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, '', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, '', 1, 1, 'C');  

$pdf->SetFont('Arial', 'B', 8);  
$pdf->Cell(340, 5, 'B1. Prenatal Care', 1, 1, 'L');  

// Prenatal Care Data Row
$pdf->Cell($columnWidths[0], 15, '1. No. of pregnant with at least 4 prenatal check-ups', 1, 0, 'L');
$pdf->Cell($columnWidths[1], 15, '', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_prenatal_checkups['10-14'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_prenatal_checkups['15-19'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_prenatal_checkups['20-49'], 1, 0, 'C');
$pdf->Cell($columnWidths[3], 15, array_sum($total_prenatal_checkups), 1, 0, 'C'); // Total
$pdf->Cell($columnWidths[4], 15, '', 1, 0, 'C'); // Placeholder for %
$pdf->Cell($columnWidths[5], 15, '', 1, 0, 'C'); // Remarks

// Table Header (First Half)
$pdf->Cell($columnWidths[0], 15, '3. No. of pregnant given one dose of deworming tablet', 1, 0, 'L');
$pdf->Cell($columnWidths[1], 15, '0', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, '0', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, '0', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, '0', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 15, '0', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 15, '', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 15, '', 1, 1, 'C');
// Nutrition Data Row
$pdf->Cell($columnWidths[0], 15, '2. No. of pregnant assessed of their nutritional status', 1, 0, 'L');
$pdf->Cell($columnWidths[1], 15, '', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_nutrition_assessed_age_group['10-14'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_nutrition_assessed_age_group['15-19'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_nutrition_assessed_age_group['20-49'], 1, 0, 'C');
$pdf->Cell($columnWidths[3], 15, array_sum($total_nutrition_assessed_age_group), 1, 0, 'C'); // Total
$pdf->Cell($columnWidths[4], 15, '', 1, 0, 'C'); // Placeholder for %
$pdf->Cell($columnWidths[5], 15, '', 1, 0, 'C'); // Remarks
// Syphilis Data Row
$pdf->Cell($columnWidths[0], 15, '4. No. of pregnant screened for syphilis', 1, 0, 'L');
$pdf->Cell($columnWidths[1], 15, '', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_syphilis_assessed_age_group['10-14'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_syphilis_assessed_age_group['15-19'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 15, $total_syphilis_assessed_age_group['20-49'], 1, 0, 'C');
$pdf->Cell($columnWidths[3], 15, array_sum($total_syphilis_assessed_age_group), 1, 0, 'C'); // Total
$pdf->Cell($columnWidths[4], 15, '', 1, 0, 'C'); // Placeholder for %
$pdf->Cell($columnWidths[5], 15, '', 1, 1, 'C'); // Remarks



$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(340, 8, 'Section: Child Care and Services', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$columnWidths = [55, 20, 15, 15, 15, 10, 40];

$pdf->SetX(10); // Position for left column
$pdf->Cell($columnWidths[0], 8, 'Indicators', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, 'Eligible Pop.', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, 'Male', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, 'Female', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, 'Total', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, '%', 1, 0, 'C');
$pdf->Cell($columnWidths[6], 8, 'Remarks', 1, 0, 'C');

$pdf->SetX(180); // Position for right column
$pdf->Cell($columnWidths[0], 8, 'Indicators', 1, 0, 'C');
$pdf->Cell($columnWidths[1], 8, 'Eligible Pop.', 1, 0, 'C');
$pdf->Cell($columnWidths[2], 8, 'Male', 1, 0, 'C');
$pdf->Cell($columnWidths[3], 8, 'Female', 1, 0, 'C');
$pdf->Cell($columnWidths[4], 8, 'Total', 1, 0, 'C');
$pdf->Cell($columnWidths[5], 8, '%', 1, 0, 'C');
$pdf->Cell($columnWidths[6], 8, 'Remarks', 1, 1, 'C');

function addVaccineRow($pdf, $columnWidths, $vaccineName, $maleCount, $femaleCount, $position) {
    $totalCount = $maleCount + $femaleCount;

    if ($position % 2 == 0) {
        $pdf->SetX(10); // Left column position
    } else {
        $pdf->SetX(180); // Right column position
    }

    $pdf->Cell($columnWidths[0], 8, $vaccineName, 1, 0, 'L');
    $pdf->Cell($columnWidths[1], 8, '', 1, 0, 'C');
    $pdf->Cell($columnWidths[2], 8, $maleCount, 1, 0, 'C');
    $pdf->Cell($columnWidths[3], 8, $femaleCount, 1, 0, 'C');
    $pdf->Cell($columnWidths[4], 8, $totalCount, 1, 0, 'C');
    $pdf->Cell($columnWidths[5], 8, '', 1, 0, 'C');
    $pdf->Cell($columnWidths[6], 8, '', 1, 0, 'C');

    if ($position % 2 == 1) {
        $pdf->Ln();
    }
}

$vaccines = [
    ['1. BCG', $male_bcg_count, $female_bcg_count],
    ['3. OPV 3', $male_opv3_count, $female_opv3_count],
    ['2. Hepatitis B', $male_hep_count, $female_hep_count],
    ['5. IPV', $male_ipv_count, $female_ipv_count],
    ['3. DPT 1', $male_dpt1_count, $female_dpt1_count],
    ['7. PCV 1', $male_pcv1_count, $female_pcv1_count],
    ['4. DPT 2', $male_dpt2_count, $female_dpt2_count],
    ['9. PCV 2', $male_pcv2_count, $female_pcv2_count],
    ['5. DPT 3', $male_dpt3_count, $female_dpt3_count],
    ['11. PCV 3', $male_pcv3_count, $female_pcv3_count],
    ['6. OPV 1', $male_opv1_count, $female_opv1_count],

    ['13. MMR 1', $male_mmr1_count, $female_mmr1_count],
    ['7. OPV 2', $male_opv2_count, $female_opv2_count],
    ['14. MMR2', $male_mmr2_count, $female_mmr2_count],



];

$position = 0;
foreach ($vaccines as $vaccine) {
    addVaccineRow($pdf, $columnWidths, $vaccine[0], $vaccine[1], $vaccine[2], $position);
    $position++;
}

$pdf->Output();
