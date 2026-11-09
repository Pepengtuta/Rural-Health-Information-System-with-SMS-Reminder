<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-patient']))
    {
      $first_name = $_REQUEST['first_name'];
      $last_name = $_REQUEST['last_name'];
      $emailid = $_REQUEST['emailid'];
      $dob = $_REQUEST['dob'];
      $gender = $_REQUEST['gender'];
      $patient_type = $_REQUEST['patient_type'];
      $phone = $_REQUEST['phone'];
      $address = $_REQUEST['address'];
      $status = $_REQUEST['status'];

      $insert_query = mysqli_query($connection, "insert into tbl_patient set first_name='$first_name', last_name='$last_name', email='$emailid', dob='$dob', gender='$gender', patient_type='$patient_type', address='$address', phone='$phone', status='$status'");

      if($insert_query>0)
      {
          $msg = "Patient created successfully";
      }
      else
      {
          $msg = "Error!";
      }
    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Add Patient Details</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="patients.php" class="btn btn-primary btn-rounded float-right">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
						<h4 class="page-title">Mother</h4>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_first_name" required> 
                                    </div>                               
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input class="form-control" type="text" name="m_middle_name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_last_name" required>
                                    </div>
                                </div>                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="m_emailid">
                                    </div>
                                </div>                              
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_phone" required>
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="m_dob" required>
                                        </div>
                                    </div>
                                </div>                               
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Blood Type</label>
                                        <select class="select" name="m_type_blood" required>
                                            <option value="">Select</option>
                                            <option >A+</option>
											<option >A-</option>
											<option >B+</option>
                                            <option >B-</option>
											<option >AB+</option>
											<option >AB-</option>
											<option >O+</option>
                                            <option >O-</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Occupation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_occupation" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of First Check-up</label>
                                        <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="dofcu" required>
                                        </div>
                                    </div>
                                </div>                              
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Age <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_age" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Weight (cm)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_weight" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Height (cm)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_height" required>
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Nutritional status based on Body Mass Index (cm)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_occupation" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Date of last Menstrual Period<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_weight" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Expected Date of Delivery<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="m_height" required>
                                    </div>
                                </div>
                            
                                <h4 class="page-title">Father</h4>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="f_first_name" required> 
                                    </div>                                
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input class="form-control" type="text" name="f_middle_name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="f_last_name" required>
                                    </div>
                                </div>                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="f_emailid">
                                    </div>
                                </div>                              
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="f_phone" required>
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="f_dob" required>
                                        </div>
                                    </div>
                                </div>                               
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Blood Type</label>
                                        <select class="select" name="f_type_blood" required>
                                            <option value="">Select</option>
                                            <option >A+</option>
											<option >A-</option>
											<option >B+</option>
                                            <option >B-</option>
											<option >AB+</option>
											<option >AB-</option>
											<option >O+</option>
                                            <option >O-</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Occupation <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="f_occupation" required>
                                    </div>
                                </div>                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Children </label>
                                        <input class="form-control" type="text" name="1_childred"> 
                                        <input class="form-control" type="text" name="2_childred">
                                        <input class="form-control" type="text" name="3_childred">
                                    </div>                               
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="1_dob" required>
                                        </div>
                                        <div class="cal-icon"> 
                                            <input type="text" class="form-control datetimepicker" name="2_dob" required>
                                        </div>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="3_dob" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="page-title">Can be called in case of Emergency</h4>
                                <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="g_name" required>
                                            </div>
                                        </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Relationship <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="g_rel" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" type="email" name="g_phone">
                                    </div>
                                </div>
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" name="g_dob" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_active" value="1" checked>
									<label class="form-check-label" for="patient_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="2">
									<label class="form-check-label" for="patient_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="col-sm-12">
                            <div class="m-t-20 text-center">
                                <button name="add-patient" class="btn btn-primary submit-btn">Create Patient</button>
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