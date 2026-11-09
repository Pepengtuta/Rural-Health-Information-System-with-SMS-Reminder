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

    // Fetch the first trimester data from tbl_second_trimester
    $second_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_second_trimester WHERE second_m_number = '$m_number'");
    if (!$second_trimester_query) {
        die("Database query failed: " . mysqli_error($connection));
    }
    $second_trimester_data = mysqli_fetch_assoc($second_trimester_query);

    // Handle missing data cases
    if (!$second_trimester_data) {
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
        'second_m_name', 'second_m_age', 'second_number', 'seco_date', 'seco_weight', 'seco_height', 
        'seco_aog', 'seco_bp', 'seco_nutrition', 'seco_examine', 'seco_p', 
        'seco_cotbp', 'seco_dental', 'seco_ltd', 'seco_u', 'seco_cbc', 'seco_sti', 
        'seco_gd', 'seco_bac', 'seco_tret', 'seco_dsp', 'seco_don', 'seco_noh', 'seco_hr'
    ];
    $data = [];
    
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($connection, $_POST[$field] ?? '');
    }
    
    // Update query
    $update_second_trimester_query = "UPDATE tbl_second_trimester SET 
        second_m_name='{$data['second_m_name']}',
                        second_m_age='{$data['second_m_ge']}',

        second_number='{$data['second_number']}',
        seco_date='{$data['seco_date']}',
        seco_weight='{$data['seco_weight']}',
        seco_height='{$data['seco_height']}',
        seco_aog='{$data['seco_aog']}',
        seco_bp='{$data['seco_bp']}',
        seco_nutrition='{$data['seco_nutrition']}',
        seco_examine='{$data['seco_examine']}',
        seco_p='{$data['seco_p']}',
        seco_cotbp='{$data['seco_cotbp']}',
        seco_dental='{$data['seco_dental']}',
        seco_ltd='{$data['seco_ltd']}',
        seco_u='{$data['seco_u']}',
        seco_cbc='{$data['seco_cbc']}',
        seco_sti='{$data['seco_sti']}',
        seco_gd='{$data['seco_gd']}',
        seco_bac='{$data['seco_bac']}',
        seco_tret='{$data['seco_tret']}',
        seco_dsp='{$data['seco_dsp']}',
        seco_don='{$data['seco_don']}',
        seco_noh='{$data['seco_noh']}',
        seco_hr='{$data['seco_hr']}'
        WHERE second_m_number='$m_number'";

    // Execute the update query
    $trimester_updated = mysqli_query($connection, $update_second_trimester_query);

    if ($trimester_updated) {
        // Fetch updated data
        $second_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_second_trimester WHERE second_m_number = '$m_number'");
        if (!$second_trimester_query) {
            die("Database query failed: " . mysqli_error($connection));
        }
        $second_trimester_data = mysqli_fetch_assoc($second_trimester_query);
        
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
                <h4 class="page-title">Mother Second Trimester Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="head-second-trimester.php" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>

        <div class="row">
        <div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="post">
            <h4 class="page-title">Third Check-Up</h4>

            <div class="row">
            <div class="col-sm-6">
                    <div class="form-group">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="second_m_name" value="<?php echo ($second_trimester_data['second_m_name']); ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>Age<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="second_m_age" value="<?php echo ($second_trimester_data['second_m_age']); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" name="seco_date" value="<?php echo ($second_trimester_data['seco_date']); ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Weight <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_weight" value="<?php echo ($second_trimester_data['seco_weight']); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Height <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_height" value="<?php echo ($second_trimester_data['seco_height']); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Age of Gestation <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_aog" value="<?php echo ($second_trimester_data['seco_aog']); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Blood Pressure <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_bp" value="<?php echo ($second_trimester_data['seco_bp']); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nutritional Status</label>
                        <select class="select" name="seco_nutrition">
                            <option value="">Select</option>
                            <option value="Normal" <?php echo ($second_trimester_data['seco_nutrition'] == "Normal") ? "selected" : ""; ?>>Normal</option>
                            <option value="Underweight" <?php echo ($second_trimester_data['seco_nutrition'] == "Underweight") ? "selected" : ""; ?>>Underweight</option>
                            <option value="Overweight" <?php echo ($second_trimester_data['seco_nutrition'] == "Overweight") ? "selected" : ""; ?>>Overweight</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_examine" value="<?php echo ($second_trimester_data['seco_examine']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prescription<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_p" value="<?php echo ($second_trimester_data['seco_p']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_cotbp" value="<?php echo ($second_trimester_data['seco_cotbp']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_dental" value="<?php echo ($second_trimester_data['seco_dental']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_ltd" value="<?php echo ($second_trimester_data['seco_ltd']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Urinalysis:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_u" value="<?php echo ($second_trimester_data['seco_u']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_cbc" value="<?php echo ($second_trimester_data['seco_cbc']); ?>">
                    </div>
                </div>

                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_sti" value="<?php echo ($second_trimester_data['seco_sti']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_gd" value="<?php echo ($second_trimester_data['seco_gd']); ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_bac" value="<?php echo ($second_trimester_data['seco_bac']); ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="seco_tret">
                                            <option value="">Select</option>
                                            <option value="Deworming" <?php echo ($second_trimester_data['seco_tret'] == "Deworming") ? "selected" : ""; ?>>Deworming</option>
                                            <option value="Antiretroviral (ARV)" <?php echo ($second_trimester_data['seco_tret'] == "Antiretroviral (ARV)") ? "selected" : ""; ?>>Antiretroviral</option>
                                            <option value="Bacteriuria" <?php echo ($second_trimester_data['seco_tret'] == "Bacteriuria") ? "selected" : ""; ?>>Bacteriuria</option>
                                            <option value="Anemia" <?php echo ($second_trimester_data['seco_tret'] == "Anemia") ? "selected" : ""; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="seco_dsp">
                                            <option value="">Select</option>
                                            <option value="Avoiding alcohol, tobacco, and illegal drugs" <?php echo ($second_trimester_data['seco_dsp'] == "Avoiding alcohol, tobacco, and illegal drugs") ? "selected" : ""; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option value="Counseling about proper diet" <?php echo ($second_trimester_data['seco_dsp'] == "Counseling about proper diet") ? "selected" : ""; ?>>Counseling about proper diet</option>
                                            <option value="Counseling about safe sex" <?php echo ($second_trimester_data['seco_dsp'] == "Counseling about safe sex") ? "selected" : ""; ?>>Counseling about safe sex</option>
                                            <option value="Use of insecticide-treated mosquito nets" <?php echo ($second_trimester_data['seco_dsp'] == "Use of insecticide-treated mosquito nets") ? "selected" : ""; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option value="Birth Plan" <?php echo ($second_trimester_data['seco_dsp'] == "Birth Plan") ? "selected" : ""; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="seco_don" value="<?php echo ($second_trimester_data['seco_don']); ?>">
                                        </div>
                                    </div>
                                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_noh" value="<?php echo ($second_trimester_data['seco_noh']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hospital referral<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="seco_hr" value="<?php echo ($second_trimester_data['seco_hr']); ?>">
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
