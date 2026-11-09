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
        'first_m_name', 'first_m_age', 'first_number', 'first_date', 'first_weight', 'first_height', 
        'first_aog', 'first_bp', 'first_nutrition', 'first_examine', 'first_p', 
        'first_cotbp', 'first_dental', 'first_ltd', 'first_hc', 'first_u', 
        'first_cbc', 'first_stis', 'first_stool', 'first_aaw', 'first_tcvdg', 
        'first_treatments', 'first_dsp', 'first_donc', 'first_noh', 'first_hr'
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
        first_date='{$data['first_date']}',
        first_weight='{$data['first_weight']}',
        first_height='{$data['first_height']}',
        first_aog='{$data['first_aog']}',
        first_bp='{$data['first_bp']}',
        first_nutrition='{$data['first_nutrition']}',
        first_examine='{$data['first_examine']}',
        first_p='{$data['first_p']}',
        first_cotbp='{$data['first_cotbp']}',
        first_dental='{$data['first_dental']}',
        first_ltd='{$data['first_ltd']}',
        first_hc='{$data['first_hc']}',
        first_u='{$data['first_u']}',
        first_cbc='{$data['first_cbc']}',
        first_stis='{$data['first_stis']}',
        first_stool='{$data['first_stool']}',
        first_aaw='{$data['first_aaw']}',
        first_tcvdg='{$data['first_tcvdg']}',
        first_treatments='{$data['first_treatments']}',
        first_dsp='{$data['first_dsp']}',
        first_donc='{$data['first_donc']}',
        first_noh='{$data['first_noh']}',
        first_hr='{$data['first_hr']}'
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
                    <h4 class="page-title">1st Check-Up</h4>

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
                                    <input type="date" class="form-control" name="first_date" value="<?php echo ($first_trimester_data['first_date']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Weight <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_weight" value="<?php echo ($first_trimester_data['first_weight']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Height <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_height" value="<?php echo ($first_trimester_data['first_height']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Age of Gestation <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_aog" value="<?php echo ($first_trimester_data['first_aog']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Blood Pressure <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_bp" value="<?php echo ($first_trimester_data['first_bp']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nutritional Status</label>
                                <select class="select" name="first_nutrition">
                                    <option value="">Select</option>
                                    <option value="Normal" <?php echo ($first_trimester_data['first_nutrition'] == "Normal") ? "selected" : ""; ?>>Normal</option>
                                    <option value="Underweight" <?php echo ($first_trimester_data['first_nutrition'] == "Underweight") ? "selected" : ""; ?>>Underweight</option>
                                    <option value="Overweight" <?php echo ($first_trimester_data['first_nutrition'] == "Overweight") ? "selected" : ""; ?>>Overweight</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Examine the condition of the Mother <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_examine" value="<?php echo ($first_trimester_data['first_examine']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Prescription <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_p" value="<?php echo ($first_trimester_data['first_p']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Changes on the Birth Plan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_cotbp" value="<?php echo ($first_trimester_data['first_cotbp']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Dental Check-up <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_dental" value="<?php echo ($first_trimester_data['first_dental']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Laboratory Tests Done <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_ltd" value="<?php echo ($first_trimester_data['first_ltd']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Hemoglobin count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_hc" value="<?php echo ($first_trimester_data['first_hc']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Urinalysis <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_u" value="<?php echo ($first_trimester_data['first_u']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Complete Blood Count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_cbc" value="<?php echo ($first_trimester_data['first_cbc']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>STIs</label>
                                <select class="select" name="first_stis">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['first_stis'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="HIV" <?php echo ($first_trimester_data['first_stis'] == "HIV") ? "selected" : ""; ?>>HIV</option>
                                    <option value="Hepatitis B (HbsAg)" <?php echo ($first_trimester_data['first_stis'] == "Hepatitis B (HbsAg)") ? "selected" : ""; ?>>Hepatitis B (HbsAg)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Stool Examination <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_stool" value="<?php echo ($first_trimester_data['first_stool']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Acetic Acid Wash <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_aaw" value="<?php echo ($first_trimester_data['first_aaw']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_tcvdg" value="<?php echo ($first_trimester_data['first_tcvdg']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Treatments</label>
                                <select class="select" name="first_treatments">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['first_treatments'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="Antiretroviral (ARV)" <?php echo ($first_trimester_data['first_treatments'] == "Antiretroviral (ARV)") ? "selected" : ""; ?>>Antiretroviral (ARV)</option>
                                    <option value="Bacteriuria" <?php echo ($first_trimester_data['first_treatments'] == "Bacteriuria") ? "selected" : ""; ?>>Bacteriuria</option>
                                    <option value="Anemia" <?php echo ($first_trimester_data['first_treatments'] == "Anemia") ? "selected" : ""; ?>>Anemia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discussed/Service Provided</label>
                                <select class="select" name="first_dsp">
                                    <option value="">Select</option>
                                    <option value="Avoiding alcohol, tobacco, and illegal drugs" <?php echo ($first_trimester_data['first_dsp'] == "Avoiding alcohol, tobacco, and illegal drugs") ? "selected" : ""; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                    <option value="Counseling about proper diet" <?php echo ($first_trimester_data['first_dsp'] == "Counseling about proper diet") ? "selected" : ""; ?>>Counseling about proper diet</option>
                                    <option value="Counseling about safe sex" <?php echo ($first_trimester_data['first_dsp'] == "Counseling about safe sex") ? "selected" : ""; ?>>Counseling about safe sex</option>
                                    <option value="Use of insecticide-treated mosquito nets" <?php echo ($first_trimester_data['first_dsp'] == "Use of insecticide-treated mosquito nets") ? "selected" : ""; ?>>Use of insecticide-treated mosquito nets</option>
                                    <option value="Birth Plan" <?php echo ($first_trimester_data['first_dsp'] == "Birth Plan") ? "selected" : ""; ?>>Birth Plan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Next Check-up</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="first_donc" value="<?php echo ($first_trimester_data['first_donc']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name of Health Service Provider</label>
                                <input class="form-control" type="text" name="first_noh" value="<?php echo ($first_trimester_data['first_noh']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hospital Referral</label>
                                <input class="form-control" type="text" name="first_hr" value="<?php echo ($first_trimester_data['first_hr']); ?>">
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
