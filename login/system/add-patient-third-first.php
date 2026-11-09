<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-patient-third-first']))
    {
        $third_m_name = $_REQUEST['third_m_name'];
        $third_m_age = $_REQUEST['third_m_age'];
        $third_m_number	 = $_REQUEST['third_m_number'];
        $third_number = $_REQUEST['third_number'];
        $th_date = $_REQUEST['th_date'];
        $th_weight = $_REQUEST['th_weight'];
        $th_height = $_REQUEST['th_height'];
        $th_aog = $_REQUEST['th_aog'];
        $th_bp = $_REQUEST['th_bp'];
        $th_nutrition = $_REQUEST['th_nutrition'];
        $th_examine = $_REQUEST['th_examine'];
        $th_p = $_REQUEST['th_p'];
        $th_cotbp = $_REQUEST['th_cotbp'];
        $th_dental = $_REQUEST['th_dental'];
        $th_ltd = $_REQUEST['th_ltd'];
        $th_u = $_REQUEST['th_u'];
        $th_cbc = $_REQUEST['th_cbc'];
        $th_bac = $_REQUEST['th_bac'];
        $th_blood = $_REQUEST['th_blood'];
        $th_treat = $_REQUEST['th_treat'];
        $th_dsp = $_REQUEST['th_dsp'];
        $th_donc = $_REQUEST['th_donc'];
        $th_noh = $_REQUEST['th_noh'];
        $th_hr = $_REQUEST['th_hr'];

                        $check_query = mysqli_query($connection, "SELECT * FROM tbl_third_trimester WHERE third_m_name='$third_m_name'");
                        if(mysqli_num_rows($check_query) > 0) {
                            $msg = "Record already exists.";
                        } else {
     
$insert_query = mysqli_query($connection, "INSERT INTO tbl_third_trimester SET 
    third_m_name = '$third_m_name',
    third_m_age = '$third_m_age',
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
    th_hr = '$th_hr'
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
                        <h4 class="page-title">Patient Third Trimester Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="head-third-trimester.php" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
						<h4 class="page-title">First Check-Up</h4>

                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="third_m_name" value="<?php echo $row->m_first_name;?> <?php echo $row->m_last_name;?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Age <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="third_m_age" value="<?php echo $row->m_age;?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6" style="display:none">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="third_m_number" value="<?php echo $row->m_number;?>">
                                </div>
                            </div>
                            <?php }?>

                            <div class="form-group" style="display:none">
                                <?php 
                                    $length = 4;    
                                    $third_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                ?>
                                <label for="inputZip" class="col-form-label">Control Number</label>
                                <input type="text" name="third_number" value="<?php echo $third_number; ?>" class="form-control" id="inputZip">
                            </div>

                            <div class="row">
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="th_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_weight" >
                                    </div>
                                </div>															
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_height" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age of Gestation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_aog" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Blood Pressure <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_bp" >
                                    </div>
                                </div>								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nutritional Status</label>
                                        <select class="select" name="th_nutrition">
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
                                        <input class="form-control" type="text" name="th_examine" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prescription<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_p" >
                                    </div>
                                </div>                           
							    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Changes on the Birth Plan<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_cotbp" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dental Check-up:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_dental" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Laboratory Tests Done:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_ltd" >
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Urinalysis:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_u" >
                                    </div>
                                </div>								
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Complete Blood Count:<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_cbc" >
                                    </div>
                                </div>

								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Bacteriuria, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_bac" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood/RH group, if necessary: <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_blood" >
                                    </div>
                                </div>								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Treatments</label>
                                        <select class="select" name="th_treat">
                                            <option value="">Select</option>
                                            <option >Antiretroviral</option>
											<option >Bacteriuria</option>
											<option >Anemia</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discussed/Service Provided</label>
                                        <select class="select" name="th_dsp">
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
                                            <input type="text" class="form-control datetimepicker" name="th_donc" >
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name of Health Service Provider<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_noh" >
                                    </div>
                                </div>								
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital referral<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="th_hr" >
                                    </div>
                                </div>
								
								<br><br><br>								
                            <div class="col-sm-12">
                                <div class="m-t-20 text-center">
                                    <button name="add-patient-third-first" class="btn btn-primary submit-btn">Save Record</button>
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