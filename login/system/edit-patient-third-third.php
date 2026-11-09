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

    // Fetch the first trimester data from tbl_third_trimester
    $third_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_third_trimester WHERE third_m_number = '$m_number'");
    if (!$third_trimester_query) {
        die("Database query failed: " . mysqli_error($connection));
    }
    $third_trimester_data = mysqli_fetch_assoc($third_trimester_query);

    // Handle missing data cases
    if (!$third_trimester_data) {
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
        'third_m_name', 'third_age', 'third_number', 'thi_date', 'thi_weight', 'thi_height', 
        'thi_aog', 'thi_bp', 'thi_nutrition', 'thi_examine', 'thi_p', 
        'thi_cotbp', 'thi_dental', 'thi_ltd', 'thi_u', 'thi_cbc', 'thi_bac', 
        'thi_blood', 'thi_treat', 'thi_dsp', 'thi_donc', 'thi_noh', 'thi_hr'
    ];
    $data = [];
    
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($connection, $_POST[$field] ?? '');
    }
    
    // Update query
    $update_third_trimester_query = "UPDATE tbl_third_trimester SET 
        third_m_name='{$data['third_m_name']}',
        third_m_age='{$data['third_m_age']}',
        third_number='{$data['third_number']}',
        thi_date='{$data['thi_date']}',
        thi_weight='{$data['thi_weight']}',
        thi_height='{$data['thi_height']}',
        thi_aog='{$data['thi_aog']}',
        thi_bp='{$data['thi_bp']}',
        thi_nutrition='{$data['thi_nutrition']}',
        thi_examine='{$data['thi_examine']}',
        thi_p='{$data['thi_p']}',
        thi_cotbp='{$data['thi_cotbp']}',
        thi_dental='{$data['thi_dental']}',
        thi_ltd='{$data['thi_ltd']}',
        thi_u='{$data['thi_u']}',
        thi_cbc='{$data['thi_cbc']}',
        thi_bac='{$data['thi_bac']}',
        thi_blood='{$data['thi_blood']}',
        thi_treat='{$data['thi_treat']}',
        thi_dsp='{$data['thi_dsp']}',
        thi_donc='{$data['thi_donc']}',
        thi_noh='{$data['thi_noh']}',
        thi_hr='{$data['thi_hr']}'
        WHERE third_m_number='$m_number'";

    // Execute the update query
    $trimester_updated = mysqli_query($connection, $update_third_trimester_query);

    if ($trimester_updated) {
        // Fetch updated data
        $third_trimester_query = mysqli_query($connection, "SELECT * FROM tbl_third_trimester WHERE third_m_number = '$m_number'");
        if (!$third_trimester_query) {
            die("Database query failed: " . mysqli_error($connection));
        }
        $third_trimester_data = mysqli_fetch_assoc($third_trimester_query);
        
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
                <h4 class="page-title">Mother Third Trimester Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="head-third-trimester.php" class="btn btn-primary btn-sm">Back</a>
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
                                        <input class="form-control" type="text" name="third_m_name" value="<?php echo ($third_trimester_data['third_m_name']); ?>"readonly>
                                        </div> 
</div>   
<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Age<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_m_age" value="<?php echo ($third_trimester_data['third_m_age']); ?>"readonly>
                                        </div> 
</div>  
                        
                        <div class="row">
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thi_date" value="<?php echo ($third_trimester_data['thi_date']); ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_weight" value="<?php echo ($third_trimester_data['thi_weight']); ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_height" value="<?php echo ($third_trimester_data['thi_height']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_aog" value="<?php echo ($third_trimester_data['thi_aog']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_bp" value="<?php echo ($third_trimester_data['thi_bp']); ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="thi_nutrition">
                                        <option value="">Select</option>
                                        <option value="Normal" <?php echo ($third_trimester_data['thi_nutrition'] == "Normal") ? "selected" : ""; ?>>Normal</option>
                                        <option value="Underweight" <?php echo ($third_trimester_data['thi_nutrition'] == "Underweight") ? "selected" : ""; ?>>Underweight</option>
                                        <option value="Overweight" <?php echo ($third_trimester_data['thi_nutrition'] == "Overweight") ? "selected" : ""; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_examine" value="<?php echo ($third_trimester_data['thi_examine']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_p" value="<?php echo ($third_trimester_data['thi_p']); ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_cotbp" value="<?php echo ($third_trimester_data['thi_cotbp']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_dental" value="<?php echo ($third_trimester_data['thi_dental']); ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_ltd" value="<?php echo ($third_trimester_data['thi_ltd']); ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_u" value="<?php echo ($third_trimester_data['thi_u']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_cbc" value="<?php echo ($third_trimester_data['thi_cbc']); ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_bac" value="<?php echo ($third_trimester_data['thi_bac']); ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood/RH group, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_blood" value="<?php echo ($third_trimester_data['thi_blood']); ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="thi_treat">
                                            <option value="">Select</option>
                                            <option value="Antiretroviral (ARV)" <?php echo ($third_trimester_data['thi_treat'] == "Antiretroviral (ARV)") ? "selected" : ""; ?>>Antiretroviral (ARV)</option>
                                            <option value="Bacteriuria" <?php echo ($third_trimester_data['thi_treat'] == "Bacteriuria") ? "selected" : ""; ?>>Bacteriuria</option>
                                            <option value="Anemia" <?php echo ($third_trimester_data['thi_treat'] == "Anemia") ? "selected" : ""; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="thi_dsp">
                                            <option value="">Select</option>
                                            <option value="Avoiding alcohol, tobacco, and illegal drugs" <?php echo ($third_trimester_data['thi_dsp'] == "Avoiding alcohol, tobacco, and illegal drugs") ? "selected" : ""; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option value="Counseling about proper diet" <?php echo ($third_trimester_data['thi_dsp'] == "Counseling about proper diet") ? "selected" : ""; ?>>Counseling about proper diet</option>
                                            <option value="Counseling about safe sex" <?php echo ($third_trimester_data['thi_dsp'] == "Counseling about safe sex") ? "selected" : ""; ?>>Counseling about safe sex</option>
                                            <option value="Use of insecticide-treated mosquito nets" <?php echo ($third_trimester_data['thi_dsp'] == "Use of insecticide-treated mosquito nets") ? "selected" : ""; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option value="Birth Plan" <?php echo ($third_trimester_data['thi_dsp'] == "Birth Plan") ? "selected" : ""; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thi_donc" value="<?php echo ($third_trimester_data['thi_donc']); ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_noh" value="<?php echo ($third_trimester_data['thi_noh']); ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_hr" value="<?php echo ($third_trimester_data['thi_hr']); ?>">
                                    </div>
                                </div>

            <div class="col-md-12 text-center">
                            <button class="btn btn-primary submit-btn">Save Record</button>
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
