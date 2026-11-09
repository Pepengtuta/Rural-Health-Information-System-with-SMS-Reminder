<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');

// Fetching data for each vaccine
$immunization_data = [
    'BCG' => 0,
    'Hepatitis B' => 0,
    'DPT 1' => 0,
    'DPT 2' => 0,
    'DPT 3' => 0, 
    'OPV 1' => 0,
    'OPV 2' => 0,
    'OPV 3' => 0,
    'IPV' => 0,
    'PCV 1' => 0, 
    'PCV 2' => 0, 
    'PCV 3' => 0, 
    'MMR 1' => 0, 
    'MMR 2' => 0, 
];

$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_immunization WHERE stat='Active'");

while ($row = mysqli_fetch_assoc($fetch_query)) {
    if (!empty($row['i_bcg_d1'])) $immunization_data['BCG']++;
    if (!empty($row['i_hep_d1'])) $immunization_data['Hepatitis B']++;
    if (!empty($row['i_dpt_d1'])) $immunization_data['DPT 1']++;
    if (!empty($row['i_dpt_d2'])) $immunization_data['DPT 2']++;
    if (!empty($row['i_dpt_d3'])) $immunization_data['DPT 3']++;
    if (!empty($row['i_opv_d1'])) $immunization_data['OPV 1']++;
    if (!empty($row['i_opv_d2'])) $immunization_data['OPV 2']++;
    if (!empty($row['i_opv_d3'])) $immunization_data['OPV 3']++;
    if (!empty($row['i_ipv_d1'])) $immunization_data['IPV']++;
    if (!empty($row['i_pcv_d1'])) $immunization_data['PCV 1']++;
    if (!empty($row['i_pcv_d2'])) $immunization_data['PCV 2']++;
    if (!empty($row['i_pcv_d3'])) $immunization_data['PCV 3']++;
    if (!empty($row['i_mmr_d1'])) $immunization_data['MMR 1']++;
    if (!empty($row['i_mmr_d2'])) $immunization_data['MMR 2']++;

}

// Prepare data for Chart.js
$labels = array_keys($immunization_data);
$data = array_values($immunization_data);
?>

<div class="page-wrapper">
    <div class="content">
            <div class="row">
                <!-- Welcome Message -->
                <div class="col-12">
                    <?php
                    if ($_SESSION['role'] == 2) {
                        echo "<h3>Welcome, Midwife " . $_SESSION['name'] . "!</h3>";
                    } elseif ($_SESSION['role'] == 3) {
                        echo "<h3>Welcome, Staff " . $_SESSION['name'] . "!</h3>";
                    } else {
                        echo "<h3>Welcome, Admin " . $_SESSION['name'] . "!</h3>";
                    }
                    ?>
                </div>
    </div>
        <div class="row">
            <!-- Statistics Widgets -->
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg1"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM tbl_employee WHERE status=1 AND role=2");
                    $doc = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-left">
                        <h3><?php echo $doc[0]; ?></h3>
                        <span class="widget-title1">Midwife <i aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg5"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM tbl_employee WHERE status=1 AND role=3");
                    $staff = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-left">
                        <h3><?php echo $staff[0]; ?></h3>
                        <span class="widget-title5">Staff <i aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-female"></i></span>
                    <?php
                        $fetch_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM tbl_patients WHERE patient_type='Active'");
                        $patient = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-left">
                        <h3><?php echo $patient[0]; ?></h3>
                        <span class="widget-title2">Mother <i aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-child"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM tbl_baby WHERE baby_type='Active'");
                    $baby = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-left">
                        <h3><?php echo $baby[0]; ?></h3>
                        <span class="widget-title3">Baby <i aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <br />

        <div class="row">
            <!-- Immunization Report -->
            <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <a href="baby-immunization.php" class="btn btn-link text-muted" style="font-size: 18px;">Immunization Report</a>
                    </div>
                    <div class="card-body">
                        <canvas id="immunizationChart"></canvas>
                    </div>
                </div>
            </div>

<!-- Appointment Schedule -->
<div class="col-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card member-panel shadow-sm">
        <div class="card-header text-white">
            <h4 class="card-title mb-0">Appointment Schedule</h4>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush contact-list">
                <?php
                // Fetch only future appointments from the database, comparing both date and time with the current date and time
                $fetch_query = mysqli_query($connection, "
                    SELECT * 
                    FROM tbl_appointment 
                    WHERE CONCAT(date, ' ', time) >= NOW() 
                    ORDER BY date ASC, time ASC 
                    LIMIT 5
                ");

                // Check if any results were returned
                if (mysqli_num_rows($fetch_query) > 0) {
                    // Loop through the results and display them
                    while ($row = mysqli_fetch_array($fetch_query)) { ?>
                        <li class="list-group-item">
                            <div class="contact-cont d-flex align-items-center">
                                <div class="contact-info">
                                <h5 class="contact-name mb-1 font-weight-bold">
                                            <?php echo ($row['patient_name']); ?>
                                            <span class="text-muted small"> - <?php echo ($row['appointment_type']); ?></span>
                                        </h5>
                                        <p class="contact-date text-muted small mb-0">
                                            <?php echo ($row['date']); ?> - <?php echo ($row['time']); ?>
                                        </p>
                                </div>
                            </div>
                        </li>
                    <?php }
                } else { ?>
                    <li class="list-group-item text-center">
                        No upcoming appointments
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="card-footer text-center bg-light">
            <a href="appointments.php" class="btn btn-link text-muted">View all Appointments</a>
        </div>
    </div>
</div>

        </div>

        <div class="row">
    <!-- Recent Mothers -->
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Mother</h4>
                <a href="edit-patient.php" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 new-patient-table">
                        <tbody>
                            <?php 
                            $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_patients WHERE patient_type='Active' LIMIT 5");
                            while($row = mysqli_fetch_array($fetch_query)) { ?>
                                <tr>
                                    <td>
                                        <!--<img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">-->
                                        <h2><?php echo ($row['m_first_name']." ".$row['m_last_name']); ?></h2>
                                    </td>
                                    <td>
                                        <span class="custom-badge <?php echo $row['patient_type'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                                            <?php echo ($row['patient_type']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Children -->
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Child</h4>
                <a href="edit-baby.php" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 new-patient-table">
                        <tbody>
                            <?php 
                            $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_baby WHERE baby_type='Active' LIMIT 5");
                            while($row = mysqli_fetch_array($fetch_query)) { ?>
                                <tr>
                                    <td>
                                        <!--<img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">-->
                                        <h2><?php echo ($row['b_fname']." ".$row['b_lname']); ?></h2>
                                    </td>
                                    <td>
                                        <span class="custom-badge <?php echo $row['baby_type'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                                            <?php echo ($row['baby_type']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

            <!-- Recent Midwives -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card member-panel shadow-sm">
        <div class="card-header bg-white">
            <h4 class="card-title mb-0">Midwife</h4>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush contact-list">
                <?php 
                $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE status=1 AND role=2 LIMIT 5");
                while($row = mysqli_fetch_array($fetch_query)) { ?>
                    <li class="list-group-item">
                        <div class="contact-cont d-flex align-items-center">
                            <div class="user-img m-r-10">
                                <a title="<?php echo ($row['first_name']); ?>">
                                <img src="<?php echo !empty($row['pic']) ? 'assets/img/logo/employee/' . $row['pic'] : 'assets/img/logo/employee/user.jpg'; ?>" 
                                alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="contact-info ml-3">
                                <h5 class="contact-name mb-0">
                                    <?php echo ($row['first_name'] . " " . $row['last_name']); ?>
                                </h5>
                                <p class="contact-date text-muted small">
                                    <?php echo ($row['bio']); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="card-footer text-center bg-white">
                        <a href="doctors.php" class="btn btn-link text-muted">View all Midwife</a>
                    </div>
    </div>
</div>


<?php include('footer.php'); ?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data fetched from PHP
    var ctx = document.getElementById('immunizationChart').getContext('2d');
var immunizationChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Number of Children Immunized',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: [
                'rgba(255, 204, 220, 1)',  // Light pink
                'rgba(255, 184, 202, 1)',  // Light-medium pink
                'rgba(255, 164, 182, 1)',  // Medium pink
                'rgba(255, 144, 162, 1)',  // Medium-dark pink
                'rgba(255, 124, 142, 1)',  // Darker pink
                'rgba(255, 104, 122, 1)',  // Dark pink
                'rgba(255, 84, 102, 1)',   // Darker pink
                'rgba(255, 64, 82, 1)',    // Deep pink
                'rgba(235, 54, 72, 1)',    // Deep medium pink
                'rgba(215, 44, 62, 1)',    // Darker deep pink
                'rgba(195, 34, 52, 1)',    // Intense pink
                'rgba(175, 24, 42, 1)',    // Deeper pink
                'rgba(155, 14, 32, 1)',    // Very deep pink
                'rgba(135, 4, 22, 1)'      // Deepest pink
            ],
            borderColor: 'rgb(255, 102, 150)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>
