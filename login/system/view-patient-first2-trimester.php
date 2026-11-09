<?php
session_start();
include('header.php');
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4">
                <h4 class="page-title">Patient Details <span style="font-size: smaller;">(First Trimester)</span></h4>
                </div>
                <div class="col-sm-8 text-right m-b-20">
                    <a href="head-first-trimester.php" class="btn btn-primary btn-sm float-right">Back</a>
                </div>
            </div>

            <?php
            if (isset($_GET['m_number']) && isset($_GET['id'])) {
                $m_number = $_GET['m_number'];
                $id = $_GET['id'];

                $stmt = $connection->prepare("SELECT * FROM tbl_patients WHERE id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $res = $stmt->get_result();

                while ($row = $res->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card-box text-center">
                        <div class="text-left mt-3">
                            <h4 class="page-title text-muted mb-2 font-13">ABOUT MOTHER</h4>
                            <p class="text-muted mb-2 font-13"><strong>Full Name:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_first_name'] . " " . $row['m_last_name']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Birthday:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_dob']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Cell Phone:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_phone']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Landline:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_landline']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Blood Type:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_type_blood']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Occupation:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_occupation']); ?></span></p>
                            <hr>
                            <p class="text-muted mb-2 font-13"><strong>Date of First Check-up:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['dofcu']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Age:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_age']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Weight (kg):</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_weight']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Height (cm):</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_height']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Nutritional status based on Body Mass Index:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_bmi']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Date of Last Menstrual Period:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_dolp']); ?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Expected Date of Delivery:</strong> <span class="ml-2"><?php echo htmlspecialchars($row['m_edod']); ?></span></p>
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-8">
                    <div class="card-box">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#first" data-toggle="tab" aria-expanded="false" class="nav-link">First Checkup</a>
                            </li>
                            <li class="nav-item">
                                <a href="#second" data-toggle="tab" aria-expanded="false" class="nav-link active">Second Checkup</a>
                            </li>
                            <li class="nav-item">
                                <a href="#third" data-toggle="tab" aria-expanded="false" class="nav-link">Third Checkup</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="first">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2"><center>FIRST CHECKUP</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $first_query = $connection->prepare("SELECT * FROM tbl_first_trimester WHERE first_m_number = ?");
                                        $first_query->bind_param('s', $m_number);
                                        $first_query->execute();
                                        $first_result = $first_query->get_result();
                                        
                                        if ($first_row = $first_result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><strong>Date:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_date']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Weight:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_weight']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Height:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_height']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Age of Gestation:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_aog']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Blood Pressure:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_bp']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nutritional Status:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_nutrition']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Examine the condition of the Mother:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_examine']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Prescription:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_p']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Changes on the Birth Plan:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_cotbp']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dental Check-up:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_dental']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Laboratory Tests Done:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_ltd']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Hemoglobin count:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_hc']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Urinalysis:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_u']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Complete Blood Count:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_cbc']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>STIs using Syndromic Approach:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_stis']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stool Examination:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_stool']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Acetic Acid Wash:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_aaw']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tetanus-containing Vaccine Date Given:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_tcvdg']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Treatments:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_treatments']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discussed/Service Provided:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_dsp']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date of Next Check-up:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_donc']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Name of Health Service Provider:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_noh']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Hospital Referral:</strong></td>
                                            <td><?php echo htmlspecialchars($first_row['first_hr']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                        <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the first checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>        
        <div class="tab-pane fade" id="second">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                    </thead>
                    <tbody>
                    <?php
                                        $first_query = $connection->prepare("SELECT * FROM tbl_first_trimester WHERE first_m_number = ?");
                                        $first_query->bind_param('s', $m_number);
                                        $first_query->execute();
                                        $first_result = $first_query->get_result();
                                        
                                        if ($first_row = $first_result->fetch_assoc()) {
                                        ?>
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><center>SECOND CHECKUP</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_date']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Weight:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_w']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Height:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_h']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Age of Gestation:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_age']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood Pressure:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_bp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nutritional Status:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_ns']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Examine the condition of the Mother:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_examine']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Prescription:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_pres']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Changes on the Birth Plan:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_changes']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dental Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_dental']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Laboratory Tests Done:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_ltd']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hemoglobin count:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_hc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Urinalysis:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_u']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Complete Blood Count:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_cbc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>STIs using Syndromic Approach:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_stis']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Stool Examination:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_stool']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Acetic Acid Wash:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_aaw']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tetanus-containing Vaccine Date Given:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_tcvdg']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Treatments:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_treatments']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Discussed/Service Provided:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_dsp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Next Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_donc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name of Health Service Provider:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_noh']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hospital Referral:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['second_hr']); ?></td>
                        </tr>
                    </tbody>
                </table>
                        <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the second checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="tab-pane fade" id="third">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                    </thead>
                    <tbody>
                    <?php
                                        // Query first trimester table
                                        $first_query = $connection->prepare("SELECT * FROM tbl_first_trimester WHERE first_m_number = ?");
                                        $first_query->bind_param('s', $m_number);
                                        $first_query->execute();
                                        $first_result = $first_query->get_result();
                                        
                                        if ($first_row = $first_result->fetch_assoc()) {
                                        ?>
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><center>THIRD CHECKUP</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_date']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Weight:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_w']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Height:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_h']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Age of Gestation:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_aog']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood Pressure:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_bp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nutritional Status:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_ns']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Examine the condition of the Mother:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_examine']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Prescription:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_pres']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Changes on the Birth Plan:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_changes']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dental Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_dental']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Laboratory Tests Done:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_ltd']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hemoglobin count:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_hc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Urinalysis:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_u']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Complete Blood Count:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_cbc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>STIs using Syndromic Approach:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_STIs']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Stool Examination:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_stool']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Acetic Acid Wash:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_aaw']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tetanus-containing Vaccine Date Given:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_tcvdg']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Treatments:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_treatments']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Discussed/Service Provided:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_dsp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Next Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_donc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name of Health Service Provider:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_noh']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hospital Referral:</strong></td>
                            <td><?php echo htmlspecialchars($first_row['third_hr']); ?></td>
                        </tr>
                        <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the third checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>    </div>
</div>

            
            <?php 
                }
            } else {
                echo "<p>No patient selected</p>";
            } 
            ?>
        </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script language="JavaScript" type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this patient?');
    }
    </script>
</body>
</html>
