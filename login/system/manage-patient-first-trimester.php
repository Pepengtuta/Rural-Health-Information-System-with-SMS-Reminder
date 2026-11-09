<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
?>
<?php
if (isset($_GET['first_id'])) {
    $patient_id = $_GET['first_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_first_trimester WHERE first_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}


if (isset($_POST['update-first-trimester'])) {
    extract($_POST);

    $update_query = mysqli_query($connection, 
        "UPDATE tbl_first_trimester SET
        first_m_name = '$first_m_name',
first_m_number = '$first_m_number',
first_number = '$first_number',
first_date = '$first_date',
first_weight = '$first_weight',
first_height = '$first_height',
first_aog = '$first_aog',
first_bp = '$first_bp',
first_nutrition = '$first_nutrition',
first_examine = '$first_examine',
first_p = '$first_p',
first_cotbp = '$first_cotbp',
first_dental = '$first_dental',
first_ltd = '$first_ltd',
first_hc = '$first_hc',
first_u = '$first_u',
first_cbc = '$first_cbc',
first_stis = '$first_stis',
first_stool = '$first_stool',
first_aaw = '$first_aaw',
first_tcvdg = '$first_tcvdg',
first_treatments = '$first_treatments',
first_dsp = '$first_dsp',
first_donc = '$first_donc',
first_noh = '$first_noh',
first_hr = '$first_hr',

second_date = '$second_date',
second_w = '$second_w',
second_h = '$second_h',
second_age = '$second_age',
second_bp = '$second_bp',
second_ns = '$second_ns',
second_examine = '$second_examine',
second_pres = '$second_pres',
second_changes = '$second_changes',
second_dental = '$second_dental',
second_ltd = '$second_ltd',
second_hc = '$second_hc',
second_u = '$second_u',
second_cbc = '$second_cbc',
second_stis = '$second_stis',
second_stool = '$second_stool',
second_aaw = '$second_aaw',
second_tcvdg = '$second_tcvdg',
second_treatments = '$second_treatments',
second_dsp = '$second_dsp',
second_donc = '$second_donc',
second_noh = '$second_noh',
second_hr = '$second_hr',

third_date = '$third_date',
third_w = '$third_w',
third_h = '$third_h',
third_aog = '$third_aog',
third_bp = '$third_bp',
third_ns = '$third_ns',
third_examine = '$third_examine',
third_pres = '$third_pres',
third_changes = '$third_changes',
third_dental = '$third_dental',
third_ltd = '$third_ltd',
third_hc = '$third_hc',
third_u = '$third_u',
third_cbc = '$third_cbc',
third_STIs = '$third_STIs',
third_stool = '$third_stool',
third_aaw = '$third_aaw',
third_tcvdg = '$third_tcvdg',
third_treatments = '$third_treatments',
third_dsp = '$third_dsp',
third_donc = '$third_donc',
third_noh = '$third_noh',
third_hr = '$third_hr'
  WHERE first_id='$patient_id'"
    );
    if (mysqli_affected_rows($connection) > 0) {
        $msg = "Record updated successfully";
    } else {
        $msg = "Error updating record!";
    }
}
?>




        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Mother First Trimester Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="manage-patient-trimester.php" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
						<h4 class="page-title">1st Check-Up</h4>

                            <div class="row">

                            <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_m_name" value="<?php echo $first_m_name; ?>">
                                            </div>

                                
                            <div class="row">

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="first_date" value="<?php echo $first_date;?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_weight" value="<?php echo $first_weight;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_height" value="<?php echo $first_height;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_aog" value="<?php echo $first_aog;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_bp" value="<?php echo $first_bp;?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="first_nutrition" value="<?php echo $first_nutrition;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($first_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($first_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($first_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_examine" value="<?php echo $first_examine ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_p" value="<?php echo $first_p ;?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_cotbp" value="<?php echo $first_cotbp ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_dental" value="<?php echo $first_dental ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_ltd" value="<?php echo $first_ltd ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_hc" value="<?php echo $first_hc ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_u" value="<?php echo $first_u ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_cbc" value="<?php echo $first_cbc ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="first_stis" value="<?php echo $first_stis ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($first_stis == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($first_stis == "HIV") echo "selected"; ?>>HIV</option>
                                            <option <?php if ($first_stis == "Hepatitis B (HbsAg)") echo "selected"; ?>>Hepatitis B (HbsAg)</option>
											
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_stool" value="<?php echo $first_stool ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_aaw" value="<?php echo $first_aaw ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_tcvdg" value="<?php echo $first_tcvdg ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="first_treatments" value="<?php echo $first_treatments ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($first_treatments == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($first_treatments == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($first_treatments == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($first_treatments == "Anemia") echo "selected"; ?>>Anemia</option>

                                            
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="first_dsp" value="<?php echo $first_dsp ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($first_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($first_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($first_dsp == "SyphiCounseling about safe sexlis") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($first_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($first_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                            
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="first_donc" value="<?php echo $first_donc ;?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_noh" value="<?php echo $first_noh ;?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_hr" value="<?php echo $first_hr ;?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
								<h4 class="page-title">2nd Check-Up</h4>

                            <div class="row">
                                

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="second_date" value="<?php echo $second_date ;?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_w" value="<?php echo $second_w ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_h" value="<?php echo $second_h ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_age" value="<?php echo $second_age ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_bp" value="<?php echo $second_bp ;?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="second_ns" value="<?php echo $second_ns ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($second_ns == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($second_ns == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($second_ns == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_examine" value="<?php echo $second_examine ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_pres" value="<?php echo $second_pres ;?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_changes" value="<?php echo $second_changes ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_dental" value="<?php echo $second_dental ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_ltd" value="<?php echo $second_ltd ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_hc" value="<?php echo $second_hc ;?>">                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_u" value="<?php echo $second_u ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_cbc" value="<?php echo $second_cbc ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="second_stis" value="<?php echo $second_stis ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($second_stis == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($second_stis == "HIV") echo "selected"; ?>>HIV</option>
                                            <option <?php if ($second_stis == "Hepatitis B (HbsAg)") echo "selected"; ?>>Hepatitis B (HbsAg)</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_stool" value="<?php echo $second_stool ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_aaw" value="<?php echo $second_aaw ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_tcvdg" value="<?php echo $second_tcvdg ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="second_treatments" value="<?php echo $second_treatments ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($second_treatments == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($second_treatments == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($second_treatments == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($second_treatments == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="second_dsp" value="<?php echo $second_dsp ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($second_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($second_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($second_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($second_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($second_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="second_donc" value="<?php echo $second_donc ;?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_noh" value="<?php echo $second_noh ;?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_hr" value="<?php echo $second_hr ;?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
						
								
								
								
								
								
								<h4 class="page-title">3rd Check-Up</h4>

                            <div class="row">
                                

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="third_date" value="<?php echo $third_date ;?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_w" value="<?php echo $third_w ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_h" value="<?php echo $third_h ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_aog" value="<?php echo $third_aog ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_bp" value="<?php echo $third_bp ;?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="third_ns" value="<?php echo $third_ns ;?>">
                                            <option value="<?php echo $third_ns ;?>">Select</option>
                                            <option <?php if ($third_ns == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($third_ns == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($third_ns == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_examine" value="<?php echo $third_examine ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_pres" value="<?php echo $third_pres ;?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_changes" value="<?php echo $third_changes ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_dental" value="<?php echo $third_dental ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_ltd" value="<?php echo $third_ltd ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_hc" value="<?php echo $third_hc ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_u" value="<?php echo $third_u ;?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_cbc" value="<?php echo $third_cbc ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="third_STIs" value="<?php echo $third_STIs ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($third_STIs == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($third_STIs == "HIV") echo "selected"; ?>>HIV</option>
                                            <option <?php if ($third_STIs == "Hepatitis B (HbsAg)") echo "selected"; ?>>Hepatitis B (HbsAg)</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_stool" value="<?php echo $third_stool ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_aaw" value="<?php echo $third_aaw ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_tcvdg" value="<?php echo $third_tcvdg ;?>">
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="third_treatments" value="<?php echo $third_treatments ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($third_treatments == "Syphilis") echo "selected"; ?>>Syphilis</option>
                                            <option <?php if ($third_treatments == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($third_treatments == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                             <option <?php if ($third_treatments == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="third_dsp" value="<?php echo $third_dsp ;?>">
                                            <option value="">Select</option>
                                            <option <?php if ($third_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($third_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($third_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($third_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($third_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="third_donc" value="<?php echo $third_donc ;?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_noh" value="<?php echo $third_noh ;?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_hr" value="<?php echo $third_hr ;?>">
                                    </div>
                                </div>
							
                            <div class="col-sm-12">
                            <div class="m-t-20 text-center">
                                <button name="update-first-trimester" class="btn btn-primary submit-btn">Update Record</button>
                            </div>

                        </form>
                        </div>

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