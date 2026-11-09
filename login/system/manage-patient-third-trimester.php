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
if (isset($_GET['third_id'])) {
    $patient_id = $_GET['third_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_third_trimester WHERE third_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}

if (isset($_POST['update-third-trimester'])) {
    extract($_POST);
    
    $update_query = mysqli_query($connection, 
        "UPDATE tbl_third_trimester SET
    third_m_name = '$third_m_name',
    third_m_number = '$third_m_number',
    third_number = '$third_number',
    
    th_date = '$th_date',
    th_weight = '$th_weight',
    th_height = '$th_height',
    th_aog = '$th_aog',
    th_bp = '$th_bp',
    th_nutrition = '$th_nutrition',
    th_examine = '$th_examine',
    th_p = '$th_p',
    th_cotbp = '$th_cotbp',
    th_dental = '$th_dental',
    th_ltd = '$th_ltd',
    th_u = '$th_u',
    th_cbc = '$th_cbc',
    th_bac = '$th_bac',
    th_blood = '$th_blood',
    th_treat = '$th_treat',
    th_dsp = '$th_dsp',
    th_donc = '$th_donc',
    th_noh = '$th_noh',
    th_hr = '$th_hr',

    thir_date = '$thir_date',
    thir_weight = '$thir_weight',
    thir_height = '$thir_height',
    thir_aog = '$thir_aog',
    thir_bp = '$thir_bp',
    thir_nutrition = '$thir_nutrition',
    thir_examine = '$thir_examine',
    thir_p = '$thir_p',
    thir_cotbp = '$thir_cotbp',
    thir_dental = '$thir_dental',
    thir_ltd = '$thir_ltd',
    thir_u = '$thir_u',
    thir_cbc = '$thir_cbc',
    thir_sti = '$thir_sti',
    thir_gd = '$thir_gd',
    thir_bac = '$thir_bac',
    thir_blood = '$thir_blood',
    thir_treat = '$thir_treat',
    thir_dsp = '$thir_dsp',
    thir_donc = '$thir_donc',
    thir_noh = '$thir_noh',
    thir_hr = '$thir_hr',

    thi_date = '$thi_date',
    thi_weight = '$thi_weight',
    thi_height = '$thi_height',
    thi_aog = '$thi_aog',
    thi_bp = '$thi_bp',
    thi_nutrition = '$thi_nutrition',
    thi_examine = '$thi_examine',
    thi_p = '$thi_p',
    thi_cotbp = '$thi_cotbp',
    thi_dental = '$thi_dental',
    thi_ltd = '$thi_ltd',
    thi_u = '$thi_u',
    thi_cbc = '$thi_cbc',
    thi_sti = '$thi_sti',
    thi_gd = '$thi_gd',
    thi_bac = '$thi_bac',
    thi_blood = '$thi_blood',
    thi_treat = '$thi_treat',
    thi_dsp = '$thi_dsp',
    thi_donc = '$thi_donc',
    thi_noh = '$thi_noh',
    thi_hr = '$thi_hr'

  WHERE third_id='$patient_id'"
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
                        <h4 class="page-title">Mother Third Trimester Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="manage-patient-trimester3.php" class="btn btn-primary btn-sm float-right">Back</a>
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
                                        <input class="form-control" type="text" name="third_m_name" value="<?php echo $third_m_name; ?>">
                                        </div>    
                        
                        <div class="row">
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="th_date" value="<?php echo $th_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_weight" value="<?php echo $th_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_height" value="<?php echo $th_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_aog" value="<?php echo $th_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_bp" value="<?php echo $th_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="th_nutrition" value="<?php echo $th_nutrition ; ?>">
                                        <option value="">Select</option>
                                            <option <?php if ($th_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($th_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($th_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_examine" value="<?php echo $th_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_p" value="<?php echo $th_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_cotbp" value="<?php echo $th_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_dental" value="<?php echo $th_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_ltd" value="<?php echo $th_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_u" value="<?php echo $th_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_cbc" value="<?php echo $th_cbc ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_bac" value="<?php echo $th_bac ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood/RH group, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_blood" value="<?php echo $th_blood ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="th_treat" value="<?php echo $th_treat ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($th_treat == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral</option>
                                            <option <?php if ($th_treat == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($th_treat == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="th_dsp" value="<?php echo $th_dsp ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($th_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($th_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($th_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($th_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($th_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="th_donc" value="<?php echo $th_donc ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_noh" value="<?php echo $th_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_hr" value="<?php echo $th_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
								<h4 class="page-title">2nd Check-Up</h4>

                            <div class="row">
                                
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thir_date" value="<?php echo $thir_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_weight" value="<?php echo $thir_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_height" value="<?php echo $thir_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_aog" value="<?php echo $thir_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_bp" value="<?php echo $thir_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="thir_nutrition" value="<?php echo $thir_nutrition ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thir_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($thir_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($thir_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_examine" value="<?php echo $thir_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_p" value="<?php echo $thir_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_cotbp" value="<?php echo $thir_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_dental" value="<?php echo $thir_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_ltd" value="<?php echo $thir_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_u" value="<?php echo $thir_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_cbc" value="<?php echo $thir_cbc ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_sti" value="<?php echo $thir_sti ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_gd" value="<?php echo $thir_gd ; ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_bac" value="<?php echo $thir_bac ; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood/RH group, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_blood" value="<?php echo $thir_blood ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="thir_treat" value="<?php echo $thir_treat ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thir_treat == "Deworming") echo "selected"; ?>>Deworming</option>
                                            <option <?php if ($thir_treat == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral</option>
                                            <option <?php if ($thir_treat == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($thir_treat == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="thir_dsp" value="<?php echo $thir_dsp ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thir_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($thir_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($thir_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($thir_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($thir_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thir_donc" value="<?php echo $thir_donc ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_noh" value="<?php echo $thir_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thir_hr" value="<?php echo $thir_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
								
								
								
								<h4 class="page-title">3rd Check-Up</h4>

                            <div class="row">
                                
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thi_date" value="<?php echo $thi_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_weight" value="<?php echo $thi_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_height" value="<?php echo $thi_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_aog" value="<?php echo $thi_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_bp" value="<?php echo $thi_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="thi_nutrition" value="<?php echo $thi_nutrition ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thi_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($thi_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($thi_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_examine" value="<?php echo $thi_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_p" value="<?php echo $thi_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_cotbp" value="<?php echo $thi_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_dental" value="<?php echo $thi_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_ltd" value="<?php echo $thi_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_u" value="<?php echo $thi_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_cbc" value="<?php echo $thi_cbc ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_sti" value="<?php echo $thi_sti ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_gd" value="<?php echo $thi_gd ; ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_bac" value="<?php echo $thi_bac ; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood/RH group, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_blood" value="<?php echo $thi_blood ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="thi_treat" value="<?php echo $thi_treat ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thi_treat == "Deworming") echo "selected"; ?>>Deworming</option>
                                            <option <?php if ($thi_treat == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral</option>
                                            <option <?php if ($thi_treat == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($thi_treat == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="thi_dsp" value="<?php echo $thi_dsp ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($thi_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($thi_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($thi_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($thi_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($thi_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="thi_donc" value="<?php echo $thi_donc ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_noh" value="<?php echo $thi_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="thi_hr" value="<?php echo $thi_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
							
                            <div class="col-sm-12">
                            <div class="m-t-20 text-center">
                                <button name="update-third-trimester" class="btn btn-primary submit-btn">Update Record</button>
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