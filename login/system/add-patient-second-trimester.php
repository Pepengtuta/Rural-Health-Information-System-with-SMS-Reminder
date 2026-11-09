<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-patient-second-trimester']))
    {
        $second_m_name = $_REQUEST['second_m_name'];
        $second_m_number = $_REQUEST['second_m_number'];
        $second_number = $_REQUEST['second_number'];
        $Sec_date = $_REQUEST['Sec_date'];
        $sec_weight = $_REQUEST['sec_weight'];
        $sec_height = $_REQUEST['sec_height'];
        $sec_aog = $_REQUEST['sec_aog'];
        $sec_bp = $_REQUEST['sec_bp'];
        $sec_nutrition = $_REQUEST['sec_nutrition'];
        $sec_examine = $_REQUEST['sec_examine'];
        $sec_p = $_REQUEST['sec_p'];
        $sec_cotbp = $_REQUEST['sec_cotbp'];
        $sec_dental = $_REQUEST['sec_dental'];
        $sec_ltd = $_REQUEST['sec_ltd'];
        $sec_u = $_REQUEST['sec_u'];
        $sec_cbc = $_REQUEST['sec_cbc'];
        $sec_sti = $_REQUEST['sec_sti'];
        $sec_g = $_REQUEST['sec_g'];
        $sec_bac = $_REQUEST['sec_bac'];
        $sec_tre = $_REQUEST['sec_tre'];
        $sec_dsp = $_REQUEST['sec_dsp'];
        $sec_donc = $_REQUEST['sec_donc'];
        $sec_noh = $_REQUEST['sec_noh'];
        $sec_hr = $_REQUEST['sec_hr'];
        $sect_date = $_REQUEST['sect_date'];
        $sect_weight = $_REQUEST['sect_weight'];
        $sect_height = $_REQUEST['sect_height'];
        $sect_aog = $_REQUEST['sect_aog'];
        $sect_bp = $_REQUEST['sect_bp'];
        $sect_nutrition = $_REQUEST['sect_nutrition'];
        $sect_examine = $_REQUEST['sect_examine'];
        $sect_p = $_REQUEST['sect_p'];
        $sect_cotbp = $_REQUEST['sect_cotbp'];
        $sect_dental = $_REQUEST['sect_dental'];
        $sect_ltd = $_REQUEST['sect_ltd'];
        $sect_u = $_REQUEST['sect_u'];
        $sect_cbc = $_REQUEST['sect_cbc'];
        $sect_et = $_REQUEST['sect_et'];
        $sect_ges = $_REQUEST['sect_ges'];
        $sect_bac = $_REQUEST['sect_bac'];
        $sect_treat = $_REQUEST['sect_treat'];
        $sect_d = $_REQUEST['sect_d'];
        $sect_donc = $_REQUEST['sect_donc'];
        $sect_noh = $_REQUEST['sect_noh'];
        $sect_hr = $_REQUEST['sect_hr'];
        $seco_date = $_REQUEST['seco_date'];
        $seco_weight = $_REQUEST['seco_weight'];
        $seco_height = $_REQUEST['seco_height'];
        $seco_aog = $_REQUEST['seco_aog'];
        $seco_bp = $_REQUEST['seco_bp'];
        $seco_nutrition = $_REQUEST['seco_nutrition'];
        $seco_examine = $_REQUEST['seco_examine'];
        $seco_p = $_REQUEST['seco_p'];
        $seco_cotbp = $_REQUEST['seco_cotbp'];
        $seco_dental = $_REQUEST['seco_dental'];
        $seco_ltd = $_REQUEST['seco_ltd'];
        $seco_u = $_REQUEST['seco_u'];
        $seco_cbc = $_REQUEST['seco_cbc'];
        $seco_sti = $_REQUEST['seco_sti'];
        $seco_gd = $_REQUEST['seco_gd'];
        $seco_bac = $_REQUEST['seco_bac'];
        $seco_tret = $_REQUEST['seco_tret'];
        $seco_dsp = $_REQUEST['seco_dsp'];
        $seco_don = $_REQUEST['seco_don'];
        $seco_noh = $_REQUEST['seco_noh'];
        $seco_hr = $_REQUEST['seco_hr'];

                $check_query = mysqli_query($connection, "SELECT * FROM tbl_second_trimester WHERE second_m_name='$second_m_name'");
                if(mysqli_num_rows($check_query) > 0) {
                    $msg = "Record already exists.";
                } else {

        $insert_query = mysqli_query($connection, "INSERT INTO tbl_second_trimester SET 
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
                        <h4 class="page-title">Patient Second Trimester Details</h4>
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
                            <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="second_m_name" value="<?php echo $row->m_first_name;?> <?php echo $row->m_last_name;?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" style="display:none">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="second_m_number" value="<?php echo $row->m_number;?>">
                                        </div>
                                    </div>

                                   <?php }?>

                                    <div class="form-group" style="display:none">
                                        <?php 
                                            $length = 4;    
                                            $second_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                        ?>
                                        <label for="inputZip" class="col-form-label">Control Number</label>
                                        <input type="text" name="second_number" value="<?php echo $second_number; ?>" class="form-control" id="inputZip">
                                    </div>

                            <div class="row">
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="Sec_date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_weight" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_height" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_aog" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_bp" >
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="sec_nutrition">
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
                                        <input class="form-control" type="text" name="sec_examine" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_p" >
                                    </div>
                                </div>                           
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_cotbp" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_dental" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_ltd" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_u" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_cbc" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_sti" >
                                    </div>
                                </div>							
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_g" >
                                    </div>
                                </div>													
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_bac" >
                                    </div>
                                </div>								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="sec_tre">
                                            <option value="">Select</option>
                                            <option >Deworming</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="sec_dsp">
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
                                            <input type="text" class="form-control datetimepicker" name="sec_donc" >
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_noh" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sec_hr" >
                                    </div>
                                </div>
								<br><br><br>

							<h4 class="page-title">2nd Check-Up</h4>

                            <div class="row">     
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="sect_date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_weight" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_height" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_aog" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_bp" >
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="sect_nutrition">
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
                                        <input class="form-control" type="text" name="sect_examine" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_p" >
                                    </div>
                                </div>                           
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_cotbp" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_dental" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_ltd" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_u" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_cbc" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_et" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_ges" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_bac" >
                                    </div>
                                </div>								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="sect_treat">
                                            <option value="">Select</option>
                                            <option >Deworming</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="sect_d">
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
                                            <input type="text" class="form-control datetimepicker" name="sect_donc" >
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_noh" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sect_hr" >
                                    </div>
                                </div>
								
								<br><br><br>

								<h4 class="page-title">3rd Check-Up</h4>

                            <div class="row"> 
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="seco_date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_weight" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_height" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_aog" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_bp" >
                                    </div>
                                </div>								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="seco_nutrition">
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
                                        <input class="form-control" type="text" name="seco_examine" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_p" >
                                    </div>
                                </div>                           
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_cotbp" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_dental" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_ltd" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_u" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_cbc" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Etiologic tests for STIs, 
										if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_sti" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gestational diabetes, if necessary:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_gd" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_bac" >
                                    </div>
                                </div>								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="seco_tret">
                                            <option value="">Select</option>
                                            <option >Deworming</option>
											<option >Antiretroviral (ARV)</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="seco_dsp">
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
                                            <input type="text" class="form-control datetimepicker" name="seco_don" >
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_noh" >
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="seco_hr" >
                                    </div>
                                </div>
								
								<br><br><br>

                            <div class="col-sm-12">
                                <div class="m-t-20 text-center">
                                <button name="add-patient-second-trimester" class="btn btn-primary submit-btn">Save Record</button>
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