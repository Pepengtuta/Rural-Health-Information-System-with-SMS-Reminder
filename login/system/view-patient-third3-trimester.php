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
                <h4 class="page-title">Patient Details <span style="font-size: smaller;">(Third Trimester)</span></h4>
                </div>
                <div class="col-sm-8 text-right m-b-20">
                    <a href="head-third-trimester.php" class="btn btn-primary btn-sm float-right">Back</a>
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
                                <a href="#second" data-toggle="tab" aria-expanded="false" class="nav-link">Second Checkup</a>
                            </li>
                            <li class="nav-item">
                                <a href="#third" data-toggle="tab" aria-expanded="false" class="nav-link active">Third Checkup</a>
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
                                        $third_query = $connection->prepare("SELECT * FROM tbl_third_trimester WHERE third_m_number = ?");
                                        $third_query->bind_param('s', $m_number);
                                        $third_query->execute();
                                        $third_result = $third_query->get_result();
                                        
                                        if ($third_row = $third_result->fetch_assoc()) {
                                        ?>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_date']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Weight:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_weight']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Height:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_height']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Age of Gestation:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_aog']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood Pressure:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_bp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nutritional Status:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_nutrition']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Examine the condition of the Mother:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_examine']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Prescription:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_p']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Changes on the Birth Plan:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_cotbp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dental Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_dental']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Laboratory Tests Done:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_ltd']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Urinalysis:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_u']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Complete Blood Count:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_cbc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bacteriuria, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_bac']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood/RH group, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_blood']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Treatments:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_treat']); ?></td>
                        </tr>
                            <td><strong>Discussed/Service Provided:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_dsp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Next Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_donc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name of Health Service Provider:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_noh']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hospital Referral:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['th_hr']); ?></td>
                        </tr>
                    </tbody>
                </table>
                    </tbody>
                    <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the first checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                </table>

            </div>
        </div>
        
        <div class="tab-pane fade" id="second">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><center>SECOND CHECKUP</center></th>
                        </tr>
                    </thead>
                    <tbody>
                                    <?php
                                        $third_query = $connection->prepare("SELECT * FROM tbl_third_trimester WHERE third_m_number = ?");
                                        $third_query->bind_param('s', $m_number);
                                        $third_query->execute();
                                        $third_result = $third_query->get_result();
                                        
                                        if ($third_row = $third_result->fetch_assoc()) {
                                        ?>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_date']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Weight:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_weight']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Height:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_height']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Age of Gestation:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_aog']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood Pressure:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_bp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nutritional Status:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_nutrition']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Examine the condition of the Mother:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_examine']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Prescription:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_p']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Changes on the Birth Plan:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_cotbp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dental Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_dental']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Laboratory Tests Done:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_ltd']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Urinalysis:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_u']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Complete Blood Count:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_cbc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bacteriuria, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_bac']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood/RH group, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_blood']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Treatments:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_treat']); ?></td>
                        </tr>
                            <td><strong>Discussed/Service Provided:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_dsp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Next Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_donc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name of Health Service Provider:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_noh']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hospital Referral:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thir_hr']); ?></td>
                        </tr>
                    </tbody>
                </table>
                    <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the second checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                </table>


            </div>
             
        </div>

        <div class="tab-pane fade" id="third">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><center>THIRD CHECKUP</center></th>
                        </tr>
                    </thead>
                    <tbody>
                                    <?php
                                        $third_query = $connection->prepare("SELECT * FROM tbl_third_trimester WHERE third_m_number = ?");
                                        $third_query->bind_param('s', $m_number);
                                        $third_query->execute();
                                        $third_result = $third_query->get_result();
                                        
                                        if ($third_row = $third_result->fetch_assoc()) {
                                        ?>
                    <tbody>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_date']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Weight:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_weight']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Height:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_height']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Age of Gestation:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_aog']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood Pressure:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_bp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nutritional Status:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_nutrition']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Examine the condition of the Mother:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_examine']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Prescription:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_p']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Changes on the Birth Plan:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_cotbp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dental Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_dental']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Laboratory Tests Done:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_ltd']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Urinalysis:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_u']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Complete Blood Count:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_cbc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bacteriuria, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_bac']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blood/RH group, if necessary:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_blood']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Treatments:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_treat']); ?></td>
                        </tr>
                            <td><strong>Discussed/Service Provided:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_dsp']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Next Check-up:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_donc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name of Health Service Provider:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_noh']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hospital Referral:</strong></td>
                            <td><?php echo htmlspecialchars($third_row['thi_hr']); ?></td>
                        </tr>
                    </tbody>
                    <?php } else { ?>
                                        <tr>
                                            <td colspan="2"><center>No data available for the third checkup.</center></td>
                                        </tr>
                                        <?php } ?>
                </table>

            </div>
        </div>
    </div>
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
