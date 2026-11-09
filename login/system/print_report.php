<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('includes/connection.php');

$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : null;
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : null;

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
$fetch_query = mysqli_query($connection, $query);

$immunization_data = [
    'BCG' => ['total' => 0, 'male' => 0, 'female' => 0],
    'Hepatitis B' => ['total' => 0, 'male' => 0, 'female' => 0],
    'DPT 1' => ['total' => 0, 'male' => 0, 'female' => 0],
    'DPT 2' => ['total' => 0, 'male' => 0, 'female' => 0],
    'DPT 3' => ['total' => 0, 'male' => 0, 'female' => 0], 
    'OPV 1' => ['total' => 0, 'male' => 0, 'female' => 0],
    'OPV 2' => ['total' => 0, 'male' => 0, 'female' => 0],
    'OPV 3' => ['total' => 0, 'male' => 0, 'female' => 0],
    'IPV' => ['total' => 0, 'male' => 0, 'female' => 0],
    'PCV 1' => ['total' => 0, 'male' => 0, 'female' => 0], 
    'PCV 2' => ['total' => 0, 'male' => 0, 'female' => 0], 
    'PCV 3' => ['total' => 0, 'male' => 0, 'female' => 0], 
    'MMR 1' => ['total' => 0, 'male' => 0, 'female' => 0], 
    'MMR 2' => ['total' => 0, 'male' => 0, 'female' => 0], 
];

while ($row = mysqli_fetch_assoc($fetch_query)) {
    if (!empty($row['i_bcg_d1'])) {
        $immunization_data['BCG']['total']++;
        $immunization_data['BCG'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_hep_d1'])) {
        $immunization_data['Hepatitis B']['total']++;
        $immunization_data['Hepatitis B'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
}

$nutrition_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE first_nutrition IS NOT NULL AND first_nutrition != ''
";
$nutrition_result = mysqli_query($connection, $nutrition_query);
$nutrition_data = mysqli_fetch_assoc($nutrition_result);

$syphilis_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE third_STIs IS NOT NULL AND third_STIs != ''
";
$syphilis_result = mysqli_query($connection, $syphilis_query);
$syphilis_data = mysqli_fetch_assoc($syphilis_result);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Printable Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .section-header {
            font-weight: bold;
            margin-top: 20px;
        }
        .seal {
            width: 50px;
            height: 50px;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Seal_of_the_Department_of_Health_%28Philippines%29.svg/1200px-Seal_of_the_Department_of_Health_%28Philippines%29.svg.png');
            background-size: cover;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
        }
        .report-number {
            font-size: 3em;
            font-weight: bold;
            display: inline-block;
            margin-right: 20px;
        }
        .month-year {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="seal"></div>
    Field Health Services Information System (FHSIS) Report
</div>

<!-- Maternal Care Section -->
<h2 class="section-header">Maternal Care and Services</h2>
<table>
    <thead>
        <tr>
            <th>Indicators</th>
            <th>Age 10-14</th>
            <th>Age 15-19</th>
            <th>Age 20-49</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Pregnant women assessed for nutritional status</td>
            <td><?php echo $nutrition_data['age_10_14']; ?></td>
            <td><?php echo $nutrition_data['age_15_19']; ?></td>
            <td><?php echo $nutrition_data['age_20_49']; ?></td>
            <td><?php echo $nutrition_data['age_10_14'] + $nutrition_data['age_15_19'] + $nutrition_data['age_20_49']; ?></td>
        </tr>
        <tr>
            <td>Pregnant women screened for syphilis</td>
            <td><?php echo $syphilis_data['age_10_14']; ?></td>
            <td><?php echo $syphilis_data['age_15_19']; ?></td>
            <td><?php echo $syphilis_data['age_20_49']; ?></td>
            <td><?php echo $syphilis_data['age_10_14'] + $syphilis_data['age_15_19'] + $syphilis_data['age_20_49']; ?></td>
        </tr>
    </tbody>
</table>

<!-- Child Care Section -->
<h2 class="section-header">Child Care and Services</h2>
<table>
    <thead>
        <tr>
            <th>Immunization</th>
            <th>Male</th>
            <th>Female</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($immunization_data as $vaccine => $data) { ?>
            <tr>
                <td><?php echo $vaccine; ?></td>
                <td><?php echo $data['male']; ?></td>
                <td><?php echo $data['female']; ?></td>
                <td><?php echo $data['total']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
