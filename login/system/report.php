<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
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
    if (!empty($row['i_dpt_d1'])) {
        $immunization_data['DPT 1']['total']++;
        $immunization_data['DPT 1'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_dpt_d2'])) {
        $immunization_data['DPT 2']['total']++;
        $immunization_data['DPT 2'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_dpt_d3'])) {
        $immunization_data['DPT 3']['total']++;
        $immunization_data['DPT 3'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_opv_d1'])) {
        $immunization_data['OPV 1']['total']++;
        $immunization_data['OPV 1'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_opv_d2'])) {
        $immunization_data['OPV 2']['total']++;
        $immunization_data['OPV 2'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_opv_d3'])) {
        $immunization_data['OPV 3']['total']++;
        $immunization_data['OPV 3'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_ipv_d1'])) {
        $immunization_data['IPV']['total']++;
        $immunization_data['IPV'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_pcv_d1'])) {
        $immunization_data['PCV 1']['total']++;
        $immunization_data['PCV 1'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_pcv_d2'])) {
        $immunization_data['PCV 2']['total']++;
        $immunization_data['PCV 2'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_pcv_d3'])) {
        $immunization_data['PCV 3']['total']++;
        $immunization_data['PCV 3'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_mmr_d1'])) {
        $immunization_data['MMR 1']['total']++;
        $immunization_data['MMR 1'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
    if (!empty($row['i_mmr_d2'])) {
        $immunization_data['MMR 2']['total']++;
        $immunization_data['MMR 2'][$row['i_gender'] == 'Male' ? 'male' : 'female']++;
    }
}

$labels = array_keys($immunization_data);
$data = array_map(function($vaccine) {
    return $vaccine['total'];
}, $immunization_data);

$nutrition_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE first_nutrition IS NOT NULL AND first_nutrition != ''
";
$nutrition_result = mysqli_query($connection, $nutrition_query);
$nutrition_data = mysqli_fetch_assoc($nutrition_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

$total_nutrition_assessed_age_group = [
    '10-14' => $nutrition_data['age_10_14'] ?? 0,
    '15-19' => $nutrition_data['age_15_19'] ?? 0,
    '20-49' => $nutrition_data['age_20_49'] ?? 0,
];

$syphilis_query = "
    SELECT 
        SUM(CASE WHEN first_m_age BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS age_10_14,
        SUM(CASE WHEN first_m_age BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS age_15_19,
        SUM(CASE WHEN first_m_age BETWEEN 20 AND 49 THEN 1 ELSE 0 END) AS age_20_49
    FROM tbl_first_trimester
    WHERE third_STIs IS NOT NULL AND third_STIs != ''
";
$syphilis_result = mysqli_query($connection, $syphilis_query);
$syphilis_data = mysqli_fetch_assoc($syphilis_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

$total_syphilis_assessed_age_group = [
    '10-14' => $syphilis_data['age_10_14'] ?? 0,
    '15-19' => $syphilis_data['age_15_19'] ?? 0,
    '20-49' => $syphilis_data['age_20_49'] ?? 0,
];

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

$prenatal_result = mysqli_query($connection, $prenatal_query);
$prenatal_data = mysqli_fetch_assoc($prenatal_result) ?: ['age_10_14' => 0, 'age_15_19' => 0, 'age_20_49' => 0];

$total_prenatal_checkups = [
    '10-14' => $prenatal_data['age_10_14'] ?? 0,
    '15-19' => $prenatal_data['age_15_19'] ?? 0,
    '20-49' => $prenatal_data['age_20_49'] ?? 0,
];

?>

<div class="page-wrapper">
<div class="content">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Field Health Services Information System Report</h4>
        </div>
    </div>

<form method="GET" action="">
    <div class="row mb-3">
        <div class="col-md-3 mb-2">
            <label for="department">Services:</label>
            <select id="department" class="form-control">
                <option value="all">All Services</option>
                <option value="department1">Maternal Care and Services</option>
                <option value="department2">Child Care and Services</option>
            </select>
        </div>

        <div class="col-md-3 mb-2">
            <label for="from-date">From Date:</label>
            <input type="date" id="from-date" name="from_date" class="form-control" value="<?php echo $from_date; ?>">
        </div>

        <div class="col-md-3 mb-2">
            <label for="to-date">To Date:</label>
            <input type="date" id="to-date" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
        </div>

        <div class="col-md-3 mb-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="FHS Report.php?from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>" class="btn btn-secondary ml-2">Print</a>
            </div>
    </div>
</form>


    <div id="maternal-table" class="service-table">
    <label style="font-size: 16px;">Maternal Care and Services</label>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Indicators</th>
                            <th class="text-center">Eligible<br> Population</th>
                            <th class="text-center" colspan="3">Age Groups</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">%</th>
                            <th class="text-center">Remarks</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-center">10-14</th>
                            <th class="text-center">15-19</th>
                            <th class="text-center">20-49</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No. of pregnant women with at least 4 prenatal<br> check-ups</td>
                            <td></td>
                            <td><?php echo $total_prenatal_checkups['10-14']; ?></td>
                            <td><?php echo $total_prenatal_checkups['15-19']; ?></td>
                            <td><?php echo $total_prenatal_checkups['20-49']; ?></td>
                            <td><?php echo $total_prenatal_checkups['10-14'] + $total_prenatal_checkups['15-19'] + $total_prenatal_checkups['20-49']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>    
                        <tr>
                            <td>No. of pregnant women assessed of their<br> nutritional status during the 1st trimester</td>
                            <td></td>
                            <td><?php echo $total_nutrition_assessed_age_group['10-14']; ?></td>
                            <td><?php echo $total_nutrition_assessed_age_group['15-19']; ?></td>
                            <td><?php echo $total_nutrition_assessed_age_group['20-49']; ?></td>
                            <td><?php echo $total_nutrition_assessed_age_group['10-14'] + $total_nutrition_assessed_age_group['15-19'] + $total_nutrition_assessed_age_group['20-49']; ?></td> 
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>No. of pregnant women given one dose<br> of deworming tablet</td>
                            <td></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td></td>
                            <td></td>
                        </tr>    
                        <tr>
                            <td>No. of pregnant women screened for<br> syphilis</td>
                            <td></td>
                            <td><?php echo $total_syphilis_assessed_age_group['10-14']; ?></td>
                            <td><?php echo $total_syphilis_assessed_age_group['15-19']; ?></td>
                            <td><?php echo $total_syphilis_assessed_age_group['20-49']; ?></td>
                            <td><?php echo $total_syphilis_assessed_age_group['10-14'] + $total_syphilis_assessed_age_group['15-19'] + $total_syphilis_assessed_age_group['20-49']; ?></td> 
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


        <div id="child-table" class="service-table">
    <label style="font-size: 16px;">Child Care and Services</label>
    <label style="font-size: 14px;">(Immunization Services)</label>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th class="text-center">Indicators</th>
                            <th class="text-center">Eligible<br> Population</th>
                            <th class="text-center">Male</th>
                            <th class="text-center">Female</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">%</th>
                            <th class="text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($immunization_data as $vaccine => $counts): ?>
                    <tr>
                        <td><?php echo $vaccine; ?></td>
                        <td></td>
                        <td><?php echo $counts['male']; ?></td>
                        <td><?php echo $counts['female']; ?></td>
                        <td><?php echo $counts['total']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php include('footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function showTables() {
        var selectedService = $("#department").val();

        if (selectedService === "all") {
            $("#maternal-table").show();
            $("#child-table").show();
        } else if (selectedService === "department1") {
            $("#maternal-table").show();
            $("#child-table").hide();
        } else if (selectedService === "department2") {
            $("#child-table").show();
            $("#maternal-table").hide();
        }
    }

    showTables();

    $("#department").on("change", function() {
        showTables();
    });
});
</script>