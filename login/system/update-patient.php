<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_patients WHERE id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No patient found!";
        exit();
    }
}

if (isset($_POST['update-patient'])) {
    extract($_POST);

    $update_query = mysqli_query($connection, 
        "UPDATE tbl_patients SET 
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
            m_pic='$m_pic',
            stat='$stat' 
        WHERE id='$patient_id'"
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
            <div class="col-sm-4">
                <h4 class="page-title">Update Mother Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
            <a href="edit-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">

                                    <!-- Profile Picture Display -->
                                    <div class="text-center mb-4">
                        <div style="width: 200px; height: 200px; border: 1px solid #ddd; display: inline-block;">
                            <img src="<?php echo !empty($row['m_pic']) ? 'assets/img/logo/mother/' . $row['m_pic'] : 'assets/img/logo/mother/user.jpg'; ?>" 
                                alt="Profile Picture" 
                                class="img-fluid" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <h4 class="page-title">Mother</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="m_first_name" value="<?php echo $m_first_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="m_middle_name" value="<?php echo $m_middle_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="m_last_name" value="<?php echo $m_last_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cell Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="m_phone" value="<?php echo $m_phone; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Landline</label>
                                <input class="form-control" type="text" name="m_landline" value="<?php echo $m_landline; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="m_dob" value="<?php echo $m_dob; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="m_type_blood">
                                    <option value="">Select</option>
                                    <option <?php if ($m_type_blood == "A+") echo "selected"; ?>>A+</option>
                                    <option <?php if ($m_type_blood == "A-") echo "selected"; ?>>A-</option>
                                    <option <?php if ($m_type_blood == "B+") echo "selected"; ?>>B+</option>
                                    <option <?php if ($m_type_blood == "B-") echo "selected"; ?>>B-</option>
                                    <option <?php if ($m_type_blood == "AB+") echo "selected"; ?>>AB+</option>
                                    <option <?php if ($m_type_blood == "AB-") echo "selected"; ?>>AB-</option>
                                    <option <?php if ($m_type_blood == "O+") echo "selected"; ?>>O+</option>
                                    <option <?php if ($m_type_blood == "O-") echo "selected"; ?>>O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input class="form-control" type="text" name="m_occupation" value="<?php echo $m_occupation; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of First Check-up</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="dofcu" value="<?php echo $dofcu; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Age <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="m_age" value="<?php echo $m_age; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Weight (kg)</label>
                                <input class="form-control" type="text" name="m_weight" value="<?php echo $m_weight; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Height (cm)</label>
                                <input class="form-control" type="text" name="m_height" value="<?php echo $m_height; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nutritional status based on Body Mass Index (cm)</label>
                                <input class="form-control" type="text" name="m_bmi" value="<?php echo $m_bmi; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Last Period</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="m_dolp" value="<?php echo $m_dolp; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Date of Delivery</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="m_edod" value="<?php echo $m_edod; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="page-title">Father</h4>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="f_first_name" value="<?php echo $f_first_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="f_middle_name" value="<?php echo $f_middle_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="f_last_name" value="<?php echo $f_last_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="f_phone" value="<?php echo $f_phone; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Landline</label>
                                <input class="form-control" type="text" name="f_landline" value="<?php echo $f_landline; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="f_dob" value="<?php echo $f_dob; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="f_type_blood">
                                    <option value="">Select</option>
                                    <option <?php if ($f_type_blood == "A+") echo "selected"; ?>>A+</option>
                                    <option <?php if ($f_type_blood == "A-") echo "selected"; ?>>A-</option>
                                    <option <?php if ($f_type_blood == "B+") echo "selected"; ?>>B+</option>
                                    <option <?php if ($f_type_blood == "B-") echo "selected"; ?>>B-</option>
                                    <option <?php if ($f_type_blood == "AB+") echo "selected"; ?>>AB+</option>
                                    <option <?php if ($f_type_blood == "AB-") echo "selected"; ?>>AB-</option>
                                    <option <?php if ($f_type_blood == "O+") echo "selected"; ?>>O+</option>
                                    <option <?php if ($f_type_blood == "O-") echo "selected"; ?>>O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input class="form-control" type="text" name="f_occupation" value="<?php echo $f_occupation; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Children</label>
                                <input class="form-control child-input" type="text" name="children1" value="<?php echo $children1; ?>">
                                <input class="form-control child-input" type="text" name="children2" value="<?php echo $children2; ?>">
                                <input class="form-control child-input" type="text" name="children3" value="<?php echo $children3; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" name="dob1" value="<?php echo $dob1; ?>">
                                </div>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" name="dob2" value="<?php echo $dob2; ?>">
                                </div>
                                <div class="cal-icon">
                                    <input type="text" class="form-control child-input datetimepicker" name="dob3" value="<?php echo $dob3; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="addr" value="<?php echo $addr; ?>">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Guardian's Name</label>
                                <input type="text" class="form-control" name="g_name" value="<?php echo $g_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Relationship</label>
                                <input type="text" class="form-control" name="g_rel" value="<?php echo $g_rel; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Guardian's Phone Number</label>
                                <input type="text" class="form-control" name="g_phone" value="<?php echo $g_phone; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Guardian's Date of Birth</label>
                                <input type="text" class="form-control datetimepicker" name="g_dob" value="<?php echo $g_dob; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <select class="select" name="patient_type">
                                    <option value="">Select</option>
                                    <option <?php if($row['patient_type']=='Active') echo 'selected="selected"'; ?>>Active</option>
                                    <option <?php if($row['patient_type']=='Inactive') echo 'selected="selected"'; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                            <label class="display-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stat" id="patient_active" value="1" <?php if($row['stat']==1) echo 'checked'; ?>>
                                <label class="form-check-label" for="patient_active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stat" id="patient_inactive" value="0" <?php if($row['stat']==0) echo 'checked'; ?>>
                                <label class="form-check-label" for="patient_inactive">Inactive</label>
                            </div>
                        </div>
</div>
<div class="col-sm-4">
                            <div class="form-group">
                                <label>Upload Mother's Photo</label>
                                <input type="file" class="form-control" name="m_pic" value="<?php echo $m_pic; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="update-patient">Update Patient</button>
                    </div>
                </form>
                <?php
                include('footer.php');
                ?>
                <script type="text/javascript">
                    <?php
                    if (isset($msg)) {
                        echo 'swal("' . $msg . '");';
                    }
                    ?>
                </script>
            </div>
        </div>
    </div>
</div>
