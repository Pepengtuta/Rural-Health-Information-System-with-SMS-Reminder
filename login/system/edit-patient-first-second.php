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
        'first_m_name', 'first_m_age', 'first_number', 'second_date', 'second_w', 'second_h', 
        'second_age', 'second_bp', 'second_ns', 'second_examine', 'second_pres', 
        'second_changes', 'second_dental', 'second_ltd', 'second_hc', 'second_u', 
        'second_cbc', 'second_stis', 'second_stool', 'second_aaw', 'second_tcvdg', 
        'second_treatments', 'second_dsp', 'second_donc', 'second_noh', 'second_hr'
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
        second_date='{$data['second_date']}',
        second_w='{$data['second_w']}',
        second_h='{$data['second_h']}',
        second_age='{$data['second_age']}',
        second_bp='{$data['second_bp']}',
        second_ns='{$data['second_ns']}',
        second_examine='{$data['second_examine']}',
        second_pres='{$data['second_pres']}',
        second_changes='{$data['second_changes']}',
        second_dental='{$data['second_dental']}',
        second_ltd='{$data['second_ltd']}',
        second_hc='{$data['second_hc']}',
        second_u='{$data['second_u']}',
        second_cbc='{$data['second_cbc']}',
        second_stis='{$data['second_stis']}',
        second_stool='{$data['second_stool']}',
        second_aaw='{$data['second_aaw']}',
        second_tcvdg='{$data['second_tcvdg']}',
        second_treatments='{$data['second_treatments']}',
        second_dsp='{$data['second_dsp']}',
        second_donc='{$data['second_donc']}',
        second_noh='{$data['second_noh']}',
        second_hr='{$data['second_hr']}'
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
                    <h4 class="page-title">2nd Check-Up</h4>

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
                                    <input type="date" class="form-control" name="second_date" value="<?php echo ($first_trimester_data['second_date']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Weight <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_w" value="<?php echo ($first_trimester_data['second_w']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Height <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_h" value="<?php echo ($first_trimester_data['second_h']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Age of Gestation <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_age" value="<?php echo ($first_trimester_data['second_age']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Blood Pressure <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_bp" value="<?php echo ($first_trimester_data['second_bp']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nutritional Status</label>
                                <select class="select" name="second_ns">
                                    <option value="">Select</option>
                                    <option value="Normal" <?php echo ($first_trimester_data['second_ns'] == "Normal") ? "selected" : ""; ?>>Normal</option>
                                    <option value="Underweight" <?php echo ($first_trimester_data['second_ns'] == "Underweight") ? "selected" : ""; ?>>Underweight</option>
                                    <option value="Overweight" <?php echo ($first_trimester_data['second_ns'] == "Overweight") ? "selected" : ""; ?>>Overweight</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Examine the condition of the Mother <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_examine" value="<?php echo ($first_trimester_data['second_examine']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Prescription <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_pres" value="<?php echo ($first_trimester_data['second_pres']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Changes on the Birth Plan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_changes" value="<?php echo ($first_trimester_data['second_changes']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Dental Check-up <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_dental" value="<?php echo ($first_trimester_data['second_dental']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Laboratory Tests Done <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_ltd" value="<?php echo ($first_trimester_data['second_ltd']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Hemoglobin count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_hc" value="<?php echo ($first_trimester_data['second_hc']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Urinalysis <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_u" value="<?php echo ($first_trimester_data['second_u']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Complete Blood Count <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_cbc" value="<?php echo ($first_trimester_data['second_cbc']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>STIs</label>
                                <select class="select" name="second_stis">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['second_stis'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="HIV" <?php echo ($first_trimester_data['second_stis'] == "HIV") ? "selected" : ""; ?>>HIV</option>
                                    <option value="Hepatitis B (HbsAg)" <?php echo ($first_trimester_data['second_stis'] == "Hepatitis B (HbsAg)") ? "selected" : ""; ?>>Hepatitis B (HbsAg)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Stool Examination <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_stool" value="<?php echo ($first_trimester_data['second_stool']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Acetic Acid Wash <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_aaw" value="<?php echo ($first_trimester_data['second_aaw']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="second_tcvdg" value="<?php echo ($first_trimester_data['second_tcvdg']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Treatments</label>
                                <select class="select" name="second_treatments">
                                    <option value="">Select</option>
                                    <option value="Syphilis" <?php echo ($first_trimester_data['second_treatments'] == "Syphilis") ? "selected" : ""; ?>>Syphilis</option>
                                    <option value="Antiretroviral (ARV)" <?php echo ($first_trimester_data['second_treatments'] == "Antiretroviral (ARV)") ? "selected" : ""; ?>>Antiretroviral (ARV)</option>
                                    <option value="Bacteriuria" <?php echo ($first_trimester_data['second_treatments'] == "Bacteriuria") ? "selected" : ""; ?>>Bacteriuria</option>
                                    <option value="Anemia" <?php echo ($first_trimester_data['second_treatments'] == "Anemia") ? "selected" : ""; ?>>Anemia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discussed/Service Provided</label>
                                <select class="select" name="second_dsp">
                                    <option value="">Select</option>
                                    <option value="Avoiding alcohol, tobacco, and illegal drugs" <?php echo ($first_trimester_data['second_dsp'] == "Avoiding alcohol, tobacco, and illegal drugs") ? "selected" : ""; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                    <option value="Counseling about proper diet" <?php echo ($first_trimester_data['second_dsp'] == "Counseling about proper diet") ? "selected" : ""; ?>>Counseling about proper diet</option>
                                    <option value="Counseling about safe sex" <?php echo ($first_trimester_data['second_dsp'] == "Counseling about safe sex") ? "selected" : ""; ?>>Counseling about safe sex</option>
                                    <option value="Use of insecticide-treated mosquito nets" <?php echo ($first_trimester_data['second_dsp'] == "Use of insecticide-treated mosquito nets") ? "selected" : ""; ?>>Use of insecticide-treated mosquito nets</option>
                                    <option value="Birth Plan" <?php echo ($first_trimester_data['second_dsp'] == "Birth Plan") ? "selected" : ""; ?>>Birth Plan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Next Check-up</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="second_donc" value="<?php echo ($first_trimester_data['second_donc']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name of Health Service Provider</label>
                                <input class="form-control" type="text" name="second_noh" value="<?php echo ($first_trimester_data['second_noh']); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hospital Referral</label>
                                <input class="form-control" type="text" name="second_hr" value="<?php echo ($first_trimester_data['second_hr']); ?>">
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
