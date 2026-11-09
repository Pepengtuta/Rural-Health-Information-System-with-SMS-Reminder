<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-patient-first-first']))
    {
        $first_m_name = $_REQUEST['first_m_name'];
        $first_m_age = $_REQUEST['first_m_age'];
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

            $check_query = mysqli_query($connection, "SELECT * FROM tbl_first_trimester WHERE first_m_name='$first_m_name'");
                if(mysqli_num_rows($check_query) > 0) {
                    $msg = "Record already exists.";
                } else {

$insert_query = mysqli_query($connection, "INSERT INTO tbl_first_trimester SET 
first_m_name = '$first_m_name',
first_m_age = '$first_m_age',
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
first_hr = '$first_hr'
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
                        <a href="head-first-trimester.php" class="btn btn-primary btn-sm float-right">Back</a>
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
                                            <input class="form-control" type="text" name="first_m_name" value="<?php echo $row->m_first_name;?> <?php echo $row->m_last_name;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Age <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_m_age" value="<?php echo $row->m_age;?>" readonly>
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
                                            <input type="date" class="form-control" name="first_date" >
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
                                <div class="col-sm-12">
                                    <div class="m-t-20 text-center">
                                    <button name="add-patient-first-first" class="btn btn-primary submit-btn">Save Record</button>
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