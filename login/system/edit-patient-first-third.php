<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}

include('header.php');
include('includes/connection.php');

// Ensure id and m_number are provided
if (isset($_GET['id']) && isset($_GET['m_number'])) {
    $patient_id = mysqli_real_escape_string($connection, $_GET['id']);
    $m_number = mysqli_real_escape_string($connection, $_GET['m_number']);
    
    // Fetch the patient information from tbl_patients
    $patient_query = mysqli_query($connection, "SELECT * FROM tbl_patients WHERE id = '$patient_id'");
    if (!$patient_query) {
        die("Database query failed: " . mysqli_error($connection));
    }
    $patient_data = mysqli_fetch_assoc($patient_query);

    // Fetch the first trimester data from tbl_first_trimester
    $first_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_first_trimester WHERE first_m_number = '$m_number'");
    if (!$first_trimester_query) {
        die("Database query failed: " . mysqli_error($connection));
    }
    $first_trimester_data = mysqli_fetch_assoc($first_trimester_query);

    // Handle missing data cases
    if (!$first_trimester_data) {
        echo "No first trimester record found for this patient.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve POST data
    $fields = [
        'first_m_name', 'first_m_age', 'first_number', 'third_date', 'third_w', 'third_h', 
        'third_aog', 'third_bp', 'third_ns', 'third_examine', 'third_pres', 
        'third_changes', 'third_dental', 'third_ltd', 'third_hc', 'third_u', 
        'third_cbc', 'third_STIs', 'third_stool', 'third_aaw', 'third_tcvdg', 
        'third_treatments', 'third_dsp', 'third_donc', 'third_noh', 'third_hr'
    ];
    $data = [];
    
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($connection, $_POST[$field] ?? '');
    }
    
    // Update query
    $update_first_trimester_query = "UPDATE tbl_first_trimester SET 
        first_m_name='{$data['first_m_name']}',
                first_m_age='{$data['first_m_age']}',

        first_number='{$data['first_number']}',
        third_date='{$data['third_date']}',
        third_w='{$data['third_w']}',
        third_h='{$data['third_h']}',
        third_aog='{$data['third_aog']}',
        third_bp='{$data['third_bp']}',
        third_ns='{$data['third_ns']}',
        third_examine='{$data['third_examine']}',
        third_pres='{$data['third_pres']}',
        third_changes='{$data['third_changes']}',
        third_dental='{$data['third_dental']}',
        third_ltd='{$data['third_ltd']}',
        third_hc='{$data['third_hc']}',
        third_u='{$data['third_u']}',
        third_cbc='{$data['third_cbc']}',
        third_STIs='{$data['third_STIs']}',
        third_stool='{$data['third_stool']}',
        third_aaw='{$data['third_aaw']}',
        third_tcvdg='{$data['third_tcvdg']}',
        third_treatments='{$data['third_treatments']}',
        third_dsp='{$data['third_dsp']}',
        third_donc='{$data['third_donc']}',
        third_noh='{$data['third_noh']}',
        third_hr='{$data['third_hr']}'
        WHERE first_m_number='$m_number'";

    // Execute the update query
    $trimester_updated = mysqli_query($connection, $update_first_trimester_query);

    if ($trimester_updated) {
        // Fetch updated data
        $first_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_first_trimester WHERE first_m_number = '$m_number'");
        if (!$first_trimester_query) {
            die("Database query failed: " . mysqli_error($connection));
        }
        $first_trimester_data = mysqli_fetch_assoc($first_trimester_query);
        
        echo "<script>
            alert('Record updated successfully');
            window.location.href = window.location.href; // Refresh page
        </script>";
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($connection) . "');</script>";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Mother First Trimester Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="head-first-trimester.php" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <h4 class="page-title">3rd Check-Up</h4>

                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_m_name" value="<?php echo ($first_trimester_data['first_m_name']); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Age<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_m_age" value="<?php echo ($first_trimester_data['first_m_age']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date</label>
                                    <input type="date" class="form-control" name="third_date" value="<?php echo ($first_trimester_data['third_date']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Weight <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_w" value="<?php echo ($first_trimester_data['third_w']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Height <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_h" value="<?php echo ($first_trimester_data['third_h']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Age of Gestation <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_aog" value="<?php echo ($first_trimester_data['third_aog']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Blood Pressure <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_bp" value="<?php echo ($first_trimester_data['third_bp']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nutritional Status</label>
                                <select class="select" name="third_ns">
                                    <option value="">Select</option>
                                    <option value="Normal" <?php echo ($first_trimester_data['third_ns'] == "Normal") ? "selected" : ""; ?>>Normal</option>
                                    <option value="Underweight" <?php echo ($first_trimester_data['third_ns'] == "Underweight") ? "selected" : ""; ?>>Underweight</option>
                                    <option value="Overweight" <?php echo ($first_trimester_data['third_ns'] == "Overweight") ? "selected" : ""; ?>>Overweight</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Examine the condition of the Mother <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_examine" value="<?php echo ($first_trimester_data['third_examine']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Prescription <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_pres" value="<?php echo ($first_trimester_data['third_pres']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Changes on the Birth Plan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_changes" value="<?php echo ($first_trimester_data['third_changes']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Dental Check-up <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_dental" value="<?php echo ($first_trimester_data['third_dental']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Laboratory Tests Done <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_ltd" value="<?php echo ($first_trimester_data['third_ltd']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Hemoglobin count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_hc" value="<?php echo ($first_trimester_data['third_hc']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Urinalysis <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_u" value="<?php echo ($first_trimester_data['third_u']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Complete Blood Count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_cbc" value="<?php echo ($first_trimester_data['third_cbc']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>STIs</label>
                                <select class="select" name="third_STIs">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['third_STIs'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="HIV" <?php echo ($first_trimester_data['third_STIs'] == "HIV") ? "selected" : ""; ?>>HIV</option>
                                    <option value="Hepatitis B (HbsAg)" <?php echo ($first_trimester_data['third_STIs'] == "Hepatitis B (HbsAg)") ? "selected" : ""; ?>>Hepatitis B (HbsAg)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Stool Examination <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_stool" value="<?php echo ($first_trimester_data['third_stool']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Acetic Acid Wash <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_aaw" value="<?php echo ($first_trimester_data['third_aaw']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="third_tcvdg" value="<?php echo ($first_trimester_data['third_tcvdg']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Treatments</label>
                                <select class="select" name="third_treatments">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['third_treatments'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="Antiretroviral (ARV)" <?php echo ($first_trimester_data['third_treatments'] == "Antiretroviral (ARV)") ? "selected" : ""; ?>>Antiretroviral (ARV)</option>
                                    <option value="Bacteriuria" <?php echo ($first_trimester_data['third_treatments'] == "Bacteriuria") ? "selected" : ""; ?>>Bacteriuria</option>
                                    <option value="Anemia" <?php echo ($first_trimester_data['third_treatments'] == "Anemia") ? "selected" : ""; ?>>Anemia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discussed/Service Provided</label>
                                <select class="select" name="third_dsp">
                                    <option value="">Select</option>
                                    <option value="Avoiding alcohol, tobacco, and illegal drugs" <?php echo ($first_trimester_data['third_dsp'] == "Avoiding alcohol, tobacco, and illegal drugs") ? "selected" : ""; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                    <option value="Counseling about proper diet" <?php echo ($first_trimester_data['third_dsp'] == "Counseling about proper diet") ? "selected" : ""; ?>>Counseling about proper diet</option>
                                    <option value="Counseling about safe sex" <?php echo ($first_trimester_data['third_dsp'] == "Counseling about safe sex") ? "selected" : ""; ?>>Counseling about safe sex</option>
                                    <option value="Use of insecticide-treated mosquito nets" <?php echo ($first_trimester_data['third_dsp'] == "Use of insecticide-treated mosquito nets") ? "selected" : ""; ?>>Use of insecticide-treated mosquito nets</option>
                                    <option value="Birth Plan" <?php echo ($first_trimester_data['third_dsp'] == "Birth Plan") ? "selected" : ""; ?>>Birth Plan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Next Check-up</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="third_donc" value="<?php echo ($first_trimester_data['third_donc']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name of Health Service Provider</label>
                                <input class="form-control" type="text" name="third_noh" value="<?php echo ($first_trimester_data['third_noh']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hospital Referral</label>
                                <input class="form-control" type="text" name="third_hr" value="<?php echo ($first_trimester_data['third_hr']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary submit-btn">Save Record</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg . '");';
        }
    ?>
</script>
