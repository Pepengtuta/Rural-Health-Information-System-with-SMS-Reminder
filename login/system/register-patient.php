<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if(isset($_REQUEST['add-patient'])) {
    $m_first_name = $_REQUEST['m_first_name'];
    $m_middle_name = $_REQUEST['m_middle_name'];
    $m_last_name = $_REQUEST['m_last_name'];
    $m_phone = $_REQUEST['m_phone'];
    $m_landline = $_REQUEST['m_landline'];
    $m_dob = $_REQUEST['m_dob'];
    $m_type_blood = $_REQUEST['m_type_blood'];
    $m_occupation = $_REQUEST['m_occupation'];
    $m_number = $_REQUEST['m_number'];
    $dofcu = $_REQUEST['dofcu'];
    $m_age = $_REQUEST['m_age'];
    $m_weight = $_REQUEST['m_weight'];
    $m_height = $_REQUEST['m_height'];
    $m_bmi = $_REQUEST['m_bmi'];
    $m_dolp = $_REQUEST['m_dolp'];
    $m_edod = $_REQUEST['m_edod'];
    $f_first_name = $_REQUEST['f_first_name'];
    $f_middle_name = $_REQUEST['f_middle_name'];
    $f_last_name = $_REQUEST['f_last_name'];
    $f_phone = $_REQUEST['f_phone'];
    $f_landline = $_REQUEST['f_landline'];
    $f_dob = $_REQUEST['f_dob'];
    $f_type_blood = $_REQUEST['f_type_blood'];
    $f_occupation = $_REQUEST['f_occupation'];
    $children1 = $_REQUEST['children1'];
    $children2 = $_REQUEST['children2'];
    $children3 = $_REQUEST['children3'];
    $dob1 = $_REQUEST['dob1'];
    $dob2 = $_REQUEST['dob2'];
    $dob3 = $_REQUEST['dob3'];
    $addr = $_REQUEST['addr'];
    $g_name = $_REQUEST['g_name'];
    $g_rel = $_REQUEST['g_rel'];
    $g_phone = $_REQUEST['g_phone'];
    $g_dob = $_REQUEST['g_dob'];
    $patient_type = $_REQUEST['patient_type'];
    $stat = $_REQUEST['stat'];

    $check_query = mysqli_query($connection, "SELECT * FROM tbl_patients WHERE m_first_name='$m_first_name' AND m_last_name='$m_last_name'");
    if(mysqli_num_rows($check_query) > 0) {
        $msg = "Patient with the same name already exists.";
    } else {
        $m_pic = '';
        if(isset($_FILES['m_pic']) && $_FILES['m_pic']['error'] == 0) {
            $upload_dir = 'assets/img/logo/mother/';
            $m_pic = basename($_FILES['m_pic']['name']);
            $target_file = $upload_dir . $m_pic;
            move_uploaded_file($_FILES['m_pic']['tmp_name'], $target_file);
        }

        $insert_query = mysqli_query($connection, "INSERT INTO tbl_patients SET 
            m_first_name='$m_first_name', 
            m_middle_name='$m_middle_name', 
            m_last_name='$m_last_name', 
            m_phone='$m_phone', 
            m_landline='$m_landline', 
            m_dob='$m_dob', 
            m_type_blood='$m_type_blood', 
            m_occupation='$m_occupation', 
            m_number='$m_number', 
            dofcu='$dofcu', 
            m_age='$m_age', 
            m_weight='$m_weight', 
            m_height='$m_height', 
            m_bmi='$m_bmi', 
            m_dolp='$m_dolp', 
            m_edod='$m_edod', 
            f_first_name='$f_first_name', 
            f_middle_name='$f_middle_name', 
            f_last_name='$f_last_name', 
            f_phone='$f_phone', 
            f_landline='$f_landline', 
            f_dob='$f_dob', 
            f_type_blood='$f_type_blood', 
            f_occupation='$f_occupation', 
            children1='$children1', 
            children2='$children2', 
            children3='$children3', 
            dob1='$dob1', 
            dob2='$dob2', 
            dob3='$dob3', 
            addr='$addr', 
            g_name='$g_name', 
            g_rel='$g_rel', 
            g_phone='$g_phone', 
            g_dob='$g_dob', 
            patient_type='$patient_type', 
            stat='$stat',
            m_pic='$m_pic'");

        if($insert_query > 0) {
            $msg = "Mother's record created successfully";
        } else {
            $msg = "Error!";
        }
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Add Mother Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="edit-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form method="post" enctype="multipart/form-data">
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
                                <label>Cell Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="m_phone" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Landline</label>
                                <input class="form-control" type="text" name="m_landline">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="m_dob" placeholder="dd/mm/yyyy" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="m_type_blood">
                                    <option value="">Select</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input class="form-control" type="text" name="m_occupation">
                            </div>
                        </div>

                        
                                    <div class="form-group" style="display:none">
    <?php 
        $length = 4;    
        $m_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    ?>
    <label for="inputZip" class="col-form-label">Control Number</label>
    <input type="text" name="m_number" value="<?php echo $m_number; ?>" class="form-control" id="inputZip">
</div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of First Check-up</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" name="dofcu">
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
                                <label>Weight (kg)</label>
                                <input class="form-control" type="text" name="m_weight" id="m_weight" oninput="calculateBMI()">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Height (cm)</label>
                                <input class="form-control" type="text" name="m_height" id="m_height" oninput="calculateBMI()">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nutritional Status based on Body Mass Index</label>
                                <input class="form-control" type="text" name="m_bmi" id="m_bmi" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Last Menstrual Period</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" name="m_dolp">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Date of Delivery</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" placeholder="dd/mm/yyyy" name="m_edod">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="page-title">Father</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="f_first_name">
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
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="f_last_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="f_phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Landline</label>
                                <input class="form-control" type="text" name="f_landline">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" name="f_dob">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="f_type_blood">
                                    <option value="">Select</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input class="form-control" type="text" name="f_occupation">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Children</label>
                                <input class="form-control child-input" type="text" name="children1">
                                <input class="form-control child-input" type="text" name="children2">
                                <input class="form-control child-input" type="text" name="children3">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" placeholder="dd/mm/yyyy" name="dob1">
                                </div>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" placeholder="dd/mm/yyyy" name="dob2">
                                </div>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" placeholder="dd/mm/yyyy" name="dob3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="addr">
                            </div>
                        </div>
                    </div>

                    <h4 class="page-title">Can be Called in Case of Emergency</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="g_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Relationship</label>
                                <input class="form-control" type="text" name="g_rel">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="g_phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" name="g_dob">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Patient's Type <span class="text-danger">*</span></label>
                                <select class="select" name="patient_type" required>
                                    <option value="">Select</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Upload Mother's Photo</label>
                                <input class="form-control" type="file" name="m_pic">
                                </div>
                        </div>
                    </div>
                    <div class="form-group" style="display:none">
                    <label class="display-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stat" id="patient_active">
                                <label class="form-check-label" for="patient_active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stat" id="patient_inactive" value="0">
                                <label class="form-check-label" for="patient_inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center">
    <div class="form-group">
    <button name="add-patient" class="btn btn-primary submit-btn">Create Record</button>
    </div>
</div>

                </form>
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
<script>
function calculateBMI() {
    const weight = parseFloat(document.getElementById('m_weight').value); 
    const height = parseFloat(document.getElementById('m_height').value) / 100; 

    if (weight > 0 && height > 0) {
        const bmi = (weight / (height * height)).toFixed(2); 
        document.getElementById('m_bmi').value = bmi; 
    } else {
        document.getElementById('m_bmi').value = ""; 
    }
}

</script>
