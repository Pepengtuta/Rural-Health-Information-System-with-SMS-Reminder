<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-patient-first-trimester']))
    {
        $first_m_name = $_REQUEST['first_m_name'];
        $first_m_number	 = $_REQUEST['first_m_number'];
        $first_number = $_REQUEST['first_number'];
        
        $first_date = $_REQUEST['first_date'];
        $first_weight = $_REQUEST['first_weight'];
        $first_height = $_REQUEST['first_height'];
        $first_aog = $_REQUEST['first_aog'];
        $first_bp = $_REQUEST['first_bp'];
        $first_nutrition = $_REQUEST['first_nutrition'];
        $first_examine = $_REQUEST['first_examine'];
        $first_p = $_REQUEST['first_p'];
        $first_cotbp = $_REQUEST['first_cotbp'];
        $first_dental = $_REQUEST['first_dental'];
        $first_ltd = $_REQUEST['first_ltd'];
        $first_hc = $_REQUEST['first_hc'];
        $first_u = $_REQUEST['first_u'];
        $first_cbc = $_REQUEST['first_cbc'];
        $first_stis = $_REQUEST['first_stis'];
        $first_stool = $_REQUEST['first_stool'];
        $first_aaw = $_REQUEST['first_aaw'];
        $first_tcvdg = $_REQUEST['first_tcvdg'];
        $first_treatments = $_REQUEST['first_treatments'];
        $first_dsp = $_REQUEST['first_dsp'];
        $first_donc = $_REQUEST['first_donc'];
        $first_noh = $_REQUEST['first_noh'];
        $first_hr = $_REQUEST['first_hr'];
        
        $second_date = $_REQUEST['second_date'];
        $second_w = $_REQUEST['second_w'];
        $second_h = $_REQUEST['second_h'];
        $second_age = $_REQUEST['second_age'];
        $second_bp = $_REQUEST['second_bp'];
        $second_ns = $_REQUEST['second_ns'];
        $second_examine = $_REQUEST['second_examine'];
        $second_pres = $_REQUEST['second_pres'];
        $second_changes = $_REQUEST['second_changes'];
        $second_dental = $_REQUEST['second_dental'];
        $second_ltd = $_REQUEST['second_ltd'];
        $second_hc = $_REQUEST['second_hc'];
        $second_u = $_REQUEST['second_u'];
        $second_cbc = $_REQUEST['second_cbc'];
        $second_stis = $_REQUEST['second_stis'];
        $second_stool = $_REQUEST['second_stool'];
        $second_aaw = $_REQUEST['second_aaw'];
        $second_tcvdg = $_REQUEST['second_tcvdg'];
        $second_treatments = $_REQUEST['second_treatments'];
        $second_dsp = $_REQUEST['second_dsp'];
        $second_donc = $_REQUEST['second_donc'];
        $second_noh = $_REQUEST['second_noh'];
        $second_hr = $_REQUEST['second_hr'];
        
        $third_date = $_REQUEST['third_date'];
        $third_w = $_REQUEST['third_w'];
        $third_h = $_REQUEST['third_h'];
        $third_aog = $_REQUEST['third_aog'];
        $third_bp = $_REQUEST['third_bp'];
        $third_ns = $_REQUEST['third_ns'];
        $third_examine = $_REQUEST['third_examine'];
        $third_pres = $_REQUEST['third_pres'];
        $third_changes = $_REQUEST['third_changes'];
        $third_dental = $_REQUEST['third_dental'];
        $third_ltd = $_REQUEST['third_ltd'];
        $third_hc = $_REQUEST['third_hc'];
        $third_u = $_REQUEST['third_u'];
        $third_cbc = $_REQUEST['third_cbc'];
        $third_STIs = $_REQUEST['third_STIs'];
        $third_stool = $_REQUEST['third_stool'];
        $third_aaw = $_REQUEST['third_aaw'];
        $third_tcvdg = $_REQUEST['third_tcvdg'];
        $third_treatments = $_REQUEST['third_treatments'];
        $third_dsp = $_REQUEST['third_dsp'];
        $third_donc = $_REQUEST['third_donc'];
        $third_noh = $_REQUEST['third_noh'];
        $third_hr = $_REQUEST['third_hr'];

                        // Check for duplicate name
                        $check_query = mysqli_query($connection, "SELECT * FROM tbl_first_trimester WHERE first_m_name='$first_m_name'");
                        if(mysqli_num_rows($check_query) > 0) {
                            $msg = "Record already exists.";
                        } else {

      
$insert_query = mysqli_query($connection, "INSERT INTO tbl_first_trimester SET 
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
");

      if($insert_query>0)
      {
          $msg = "Record created successfully";
      }
      else
      {
          $msg = "Error!";
      }
    }
}
?>
        <div class="page-wrapper">

        <?php
                $m_number = $_GET['m_number'];
                $ret="SELECT  * FROM tbl_patients WHERE m_number=?";
                $stmt= $connection->prepare($ret) ;
                $stmt->bind_param('s',$m_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Patient First Trimester Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="add-monthly-checkup.php" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
						<h4 class="page-title">1st Check-Up</h4>

                            <div class="row">
                            
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_m_name" value="<?php echo $row->m_first_name;?> <?php echo $row->m_last_name;?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_m_age" value="<?php echo $row->m_age;?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group" style="display:none">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_m_number" value="<?php echo $row->m_number;?>">
                                        </div>
                                    </div>

                                    <?php }?>
                                    <div class="form-group" style="display:none">
    <?php 
        $length = 4;    
        $first_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    ?>
    <label for="inputZip" class="col-form-label">Control Number</label>
    <input type="text" name="first_number" value="<?php echo $first_number; ?>" class="form-control" id="inputZip">
</div>

                            
<div class="row">
  
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="first_date" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_weight">
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_height" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_aog" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_bp" >
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="first_nutrition">
                                            <option value="">Select</option>
                                            <option >Normal</option>
											<option >Underweight</option>
											<option >Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_examine" >
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_p" >
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_cotbp" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_dental" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_ltd" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_hc" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_u" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_cbc" >
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="first_stis">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >HIV</option>
											<option >Hepatitis B (HbsAg)</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_stool" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_aaw" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_tcvdg" >
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="first_treatments">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="first_dsp">
                                            <option value="">Select</option>
                                            <option >Avoiding alcohol, tobacco, and illegal drugs</option>
											<option >Counseling about proper diet</option>
											<option >Counseling about safe sex</option>
											<option >Use of insecticide-treated mosquito nets</option>
											<option >Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="first_donc" >
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_noh" >
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_hr" >
                                    </div>
                                </div>
								
								<br><br><br>
								
								<h4 class="page-title">2nd Check-Up</h4>

                            <div class="row">
                                

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="second_date" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_w" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_h" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_age" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_bp" >
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="second_ns">
                                            <option value="">Select</option>
                                            <option >Normal</option>
											<option >Underweight</option>
											<option >Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_examine" >
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_pres" >
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_changes" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_dental" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_ltd" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_hc" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_u" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_cbc" >
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="second_stis">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >HIV</option>
											<option >Hepatitis B (HbsAg)</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_stool" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_aaw" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_tcvdg" >
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="second_treatments">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="second_dsp">
                                            <option value="">Select</option>
                                            <option >Avoiding alcohol, tobacco, and illegal drugs</option>
											<option >Counseling about proper diet</option>
											<option >Counseling about safe sex</option>
											<option >Use of insecticide-treated mosquito nets</option>
											<option >Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="second_donc" >
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_noh" >
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="second_hr" >
                                    </div>
                                </div>
								
								<br><br><br>
								
						
								
								
								
								
								
								<h4 class="page-title">3rd Check-Up</h4>

                            <div class="row">
                                

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="third_date" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_w" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_h" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_aog" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_bp" >
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="third_ns">
                                            <option value="">Select</option>
                                            <option >Normal</option>
											<option >Underweight</option>
											<option >Overweight</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Examine the condition of the Mother: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_examine" >
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_pres" >
                                    </div>
                                </div>
                            
							<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_changes" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_dental" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_ltd" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_hc" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_u" >
                                    </div>
                                </div>
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_cbc" >
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>STIs using syndromic approach</label>
                                        <select class="select" name="third_STIs">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >HIV</option>
											<option >Hepatitis B (HbsAg)</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stool Examination:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_stool" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Acetic Acid Wash:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_aaw" >
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tetanus-containing Vaccine Date given:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_tcvdg" >
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="third_treatments">
                                            <option value="">Select</option>
                                            <option >Syphilis</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="third_dsp">
                                            <option value="">Select</option>
                                            <option >Avoiding alcohol, tobacco, and illegal drugs</option>
											<option >Counseling about proper diet</option>
											<option >Counseling about safe sex</option>
											<option >Use of insecticide-treated mosquito nets</option>
											<option >Birth Plan</option>
                                        </select>
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Next Check-up</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="third_donc" >
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_noh" >
                                    </div>
                                </div>
								
								
								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="third_hr" >
                                    </div>
                                </div>
                                


                            <div class="col-sm-12">
                            <div class="m-t-20 text-center">
                                <button name="add-patient-first-trimester" class="btn btn-primary submit-btn">Save Record</button>
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