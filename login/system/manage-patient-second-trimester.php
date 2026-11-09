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
if (isset($_GET['second_id'])) {
    $patient_id = $_GET['second_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_second_trimester WHERE second_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}

if (isset($_POST['update-second-trimester'])) {
    extract($_POST);

    $update_query = mysqli_query($connection, 
        "UPDATE tbl_second_trimester SET
        second_m_name = '$second_m_name',
        second_m_number = '$second_m_number',
        second_number = '$second_number',
        Sec_date = '$Sec_date',
        sec_weight = '$sec_weight',
        sec_height = '$sec_height',
        sec_aog = '$sec_aog',
        sec_bp = '$sec_bp',
        sec_nutrition = '$sec_nutrition',
        sec_examine = '$sec_examine',
        sec_p = '$sec_p',
        sec_cotbp = '$sec_cotbp',
        sec_dental = '$sec_dental',
        sec_ltd = '$sec_ltd',
        sec_u = '$sec_u',
        sec_cbc = '$sec_cbc',
        sec_sti = '$sec_sti',
        sec_g = '$sec_g',
        sec_bac = '$sec_bac',
        sec_tre = '$sec_tre',
        sec_dsp = '$sec_dsp',
        sec_donc = '$sec_donc',
        sec_noh = '$sec_noh',
        sec_hr = '$sec_hr',

        sect_date = '$sect_date',
        sect_weight = '$sect_weight',
        sect_height = '$sect_height',
        sect_aog = '$sect_aog',
        sect_bp = '$sect_bp',
        sect_nutrition = '$sect_nutrition',
        sect_examine = '$sect_examine',
        sect_p = '$sect_p',
        sect_cotbp = '$sect_cotbp',
        sect_dental = '$sect_dental',
        sect_ltd = '$sect_ltd',
        sect_u = '$sect_u',
        sect_cbc = '$sect_cbc',
        sect_et = '$sect_et',
        sect_ges = '$sect_ges',
        sect_bac = '$sect_bac',
        sect_treat = '$sect_treat',
        sect_d = '$sect_d',
        sect_donc = '$sect_donc',
        sect_noh = '$sect_noh',
        sect_hr = '$sect_hr',

        seco_date = '$seco_date',
        seco_weight = '$seco_weight',
        seco_height = '$seco_height',
        seco_aog = '$seco_aog',
        seco_bp = '$seco_bp',
        seco_nutrition = '$seco_nutrition',
        seco_examine = '$seco_examine',
        seco_p = '$seco_p',
        seco_cotbp = '$seco_cotbp',
        seco_dental = '$seco_dental',
        seco_ltd = '$seco_ltd',
        seco_u = '$seco_u',
        seco_cbc = '$seco_cbc',
        seco_sti = '$seco_sti',
        seco_gd = '$seco_gd',
        seco_bac = '$seco_bac',
        seco_tret = '$seco_tret',
        seco_dsp = '$seco_dsp',
        seco_don = '$seco_don',
        seco_noh = '$seco_noh',
        seco_hr = '$seco_hr'

  WHERE second_id='$patient_id'"
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
                        <h4 class="page-title">Mother Second Trimester Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="manage-patient-trimester2.php" class="btn btn-primary btn-sm float-right">Back</a>
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
                                        <input class="form-control" type="text" name="second_m_name" value="<?php echo $second_m_name; ?>">
                                        </div>
                            
                            
                                <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="Sec_date" value="<?php echo $Sec_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_weight" value="<?php echo $sec_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_height" value="<?php echo $sec_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_aog" value="<?php echo $sec_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_bp" value="<?php echo $sec_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="sec_nutrition" value="<?php echo $sec_nutrition ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sec_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($sec_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($sec_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_examine" value="<?php echo $sec_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_p" value="<?php echo $sec_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_cotbp" value="<?php echo $sec_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_dental" value="<?php echo $sec_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_ltd" value="<?php echo $sec_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_u" value="<?php echo $sec_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_cbc" value="<?php echo $sec_cbc ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_sti" value="<?php echo $sec_sti ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_g" value="<?php echo $sec_g ; ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_bac" value="<?php echo $sec_bac ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="sec_tre" value="<?php echo $sec_tre ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sec_tre == "Deworming") echo "selected"; ?>>Deworming</option>
                                            <option <?php if ($sec_tre == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($sec_tre == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($sec_tre == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="sec_dsp" value="<?php echo $sec_dsp ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sec_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($sec_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($sec_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($sec_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($sec_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="sec_donc" value="<?php echo $sec_donc ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_noh" value="<?php echo $sec_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_hr" value="<?php echo $sec_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
										
								
								
								
								<h4 class="page-title">2nd Check-Up</h4>

                            <div class="row">
                                
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="sect_date" value="<?php echo $sect_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_weight" value="<?php echo $sect_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_height" value="<?php echo $sect_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_aog" value="<?php echo $sect_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_bp" value="<?php echo $sect_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="sect_nutrition" value="<?php echo $sect_nutrition ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sect_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($sect_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($sect_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_examine" value="<?php echo $sect_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_p" value="<?php echo $sect_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_cotbp" value="<?php echo $sect_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_dental" value="<?php echo $sect_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_ltd" value="<?php echo $sect_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_u" value="<?php echo $sect_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_cbc" value="<?php echo $sect_cbc ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_et" value="<?php echo $sect_et ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_ges" value="<?php echo $sect_ges ; ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_bac" value="<?php echo $sect_bac ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="sect_treat" value="<?php echo $sect_treat ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sect_treat == "Deworming") echo "selected"; ?>>Deworming</option>
                                            <option <?php if ($sect_treat == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($sect_treat == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($sect_treat == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="sect_d" value="<?php echo $sect_d ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($sect_d == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($sect_d == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($sect_d == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($sect_d == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($sect_d == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="sect_donc" value="<?php echo $sect_donc ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_noh" value="<?php echo $sect_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_hr" value="<?php echo $sect_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
								
								
								
								<h4 class="page-title">3rd Check-Up</h4>

                            <div class="row">
                                
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="seco_date" value="<?php echo $seco_date ; ?>">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_weight" value="<?php echo $seco_weight ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_height" value="<?php echo $seco_height ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_aog" value="<?php echo $seco_aog ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_bp" value="<?php echo $seco_bp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="seco_nutrition" value="<?php echo $seco_nutrition ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($seco_nutrition == "Normal") echo "selected"; ?>>Normal</option>
                                            <option <?php if ($seco_nutrition == "Underweight") echo "selected"; ?>>Underweight</option>
                                            <option <?php if ($seco_nutrition == "Overweight") echo "selected"; ?>>Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_examine" value="<?php echo $seco_examine ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_p" value="<?php echo $seco_p ; ?>">
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_cotbp" value="<?php echo $seco_cotbp ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_dental" value="<?php echo $seco_dental ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_ltd" value="<?php echo $seco_ltd ; ?>">
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_u" value="<?php echo $seco_u ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_cbc" value="<?php echo $seco_cbc ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_sti" value="<?php echo $seco_sti ; ?>">
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_gd" value="<?php echo $seco_gd ; ?>">
                                    </div>
                                </div>
					
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_bac" value="<?php echo $seco_bac ; ?>">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="seco_tret" value="<?php echo $seco_tret ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($seco_tret == "Deworming") echo "selected"; ?>>Deworming</option>
                                            <option <?php if ($seco_tret == "Antiretroviral (ARV)") echo "selected"; ?>>Antiretroviral (ARV)</option>
                                            <option <?php if ($seco_tret == "Bacteriuria") echo "selected"; ?>>Bacteriuria</option>
                                            <option <?php if ($seco_tret == "Anemia") echo "selected"; ?>>Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
							
			
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="seco_dsp" value="<?php echo $seco_dsp ; ?>">
                                            <option value="">Select</option>
                                            <option <?php if ($seco_dsp == "Avoiding alcohol, tobacco, and illegal drugs") echo "selected"; ?>>Avoiding alcohol, tobacco, and illegal drugs</option>
                                            <option <?php if ($seco_dsp == "Counseling about proper diet") echo "selected"; ?>>Counseling about proper diet</option>
                                            <option <?php if ($seco_dsp == "Counseling about safe sex") echo "selected"; ?>>Counseling about safe sex</option>
                                            <option <?php if ($seco_dsp == "Use of insecticide-treated mosquito nets") echo "selected"; ?>>Use of insecticide-treated mosquito nets</option>
                                            <option <?php if ($seco_dsp == "Birth Plan") echo "selected"; ?>>Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="seco_don" value="<?php echo $seco_don ; ?>">
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_noh" value="<?php echo $seco_noh ; ?>">
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_hr" value="<?php echo $seco_hr ; ?>">
                                    </div>
                                </div>
								
								<br><br><br>
								
								
							
                            <div class="col-sm-12">
                            <div class="m-t-20 text-center">
                                <button name="update-second-trimester" class="btn btn-primary submit-btn">Update Record</button>
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