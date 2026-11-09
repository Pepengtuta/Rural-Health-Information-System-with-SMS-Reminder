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
if (isset($_GET['b_id'])) {
    $patient_id = $_GET['b_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_baby WHERE b_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No patient found!";
        exit();
    }
}

if (isset($_POST['update-baby'])) {
    extract($_POST);

    $update_query = mysqli_query($connection, 
        "UPDATE tbl_baby SET 
            b_fname = '$b_fname', 
            b_mname = '$b_mname', 
            b_lname = '$b_lname', 
            b_number = '$b_number', 
            b_mother = '$b_mother', 
            b_father = '$b_father', 
            b_m_number = '$b_m_number', 
            b_dob = '$b_dob', 
            b_sex = '$b_sex', 
            b_bloodtype = '$b_bloodtype', 
            b_tod = '$b_tod', 
            b_accurate = '$b_accurate', 
            b_sotb = '$b_sotb', 
            b_nom = '$b_nom', 
            b_bweight = '$b_bweight', 
            b_blength = '$b_blength', 
            b_cheadsize = '$b_cheadsize', 
            b_cc = '$b_cc', 
            b_hmcdyh = '$b_hmcdyh', 
            b_dobr = '$b_dobr', 
            b_address = '$b_address', 
            b_list = '$b_list', 
            b_pic = '$b_pic',
            baby_type = '$baby_type' 
 

        WHERE b_id='$patient_id'"
    );

    if (mysqli_affected_rows($connection) > 0) {
        $msg = "Record updated successfully";
    } else {
        $msg = "Error updating patient!";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Baby's Record</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="edit-baby.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">

                    <div class="text-center mb-4">
                        <div style="width: 200px; height: 200px; border: 1px solid #ddd; display: inline-block;">
                            <img src="<?php echo !empty($row['b_pic']) ? 'assets/img/logo/baby/' . $row['b_pic'] : 'assets/img/logo/baby/user.jpg'; ?>" 
                                alt="Profile Picture" 
                                class="img-fluid" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_fname" value="<?php echo ($b_fname); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="b_mname" value="<?php echo ($b_mname); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_lname" value="<?php echo ($b_lname); ?>">
                            </div>
                        </div>
                    </div>

                    <h4>Name of Parents</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mother</label>
                                <input class="form-control" type="text" name="b_mother" value="<?php echo ($b_mother); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Father</label>
                                <input class="form-control" type="text" name="b_father" value="<?php echo ($b_father); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="b_dob" value="<?php echo ($b_dob); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sex</label>
                                <select class="select" name="b_sex">
                                    <option value="">Select</option>
                                    <option value="Male" <?php echo ($b_sex === 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($b_sex === 'Female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="b_bloodtype">
                                    <option value="">Select</option>
                                    <option value="A+" <?php echo ($b_bloodtype === 'A+') ? 'selected' : ''; ?>>A+</option>
                                    <option value="A-" <?php echo ($b_bloodtype === 'A-') ? 'selected' : ''; ?>>A-</option>
                                    <option value="B+" <?php echo ($b_bloodtype === 'B+') ? 'selected' : ''; ?>>B+</option>
                                    <option value="B-" <?php echo ($b_bloodtype === 'B-') ? 'selected' : ''; ?>>B-</option>
                                    <option value="AB+" <?php echo ($b_bloodtype === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                    <option value="AB-" <?php echo ($b_bloodtype === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                    <option value="O+" <?php echo ($b_bloodtype === 'O+') ? 'selected' : ''; ?>>O+</option>
                                    <option value="O-" <?php echo ($b_bloodtype === 'O-') ? 'selected' : ''; ?>>O-</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Type of Delivery <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_tod" value="<?php echo ($b_tod); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="display-block">Is it accurate Month of giving birth?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="b_accurate" id="b_yes" value="1" <?php echo ($b_accurate == 'Yes') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="b_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="b_accurate" id="b_no" value="0" <?php echo ($b_accurate == 'No') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="b_no">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Single or Twins births</label>
                                <input class="form-control" type="text" name="b_sotb" value="<?php echo ($b_sotb); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name of Midwife</label>
                                <input type="text" class="form-control" name="b_nom" value="<?php echo ($b_nom); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Birth Weight</label>
                                <input class="form-control" type="text" name="b_bweight" value="<?php echo ($b_bweight); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Body Length</label>
                                <input class="form-control" type="text" name="b_blength" value="<?php echo ($b_blength); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Circular Head size</label>
                                <input class="form-control" type="text" name="b_cheadsize" value="<?php echo ($b_cheadsize); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Chest Circumference</label>
                                <input class="form-control" type="text" name="b_cc" value="<?php echo ($b_cc); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>How many child/children do you have?</label>
                                <input class="form-control" type="text" name="b_hmcdyh" value="<?php echo ($b_hmcdyh); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth Registration</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="b_dobr" value="<?php echo ($b_dobr); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="b_address" value="<?php echo ($b_address); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>List of Unfortunate Events (Serious illness or death of parents or siblings under the age of five)</label>
                                <input class="form-control" type="text" name="b_list" value="<?php echo ($b_list); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Upload Child Photo</label><br><br>
                            <input class="form-control" type="file" name="b_pic" value="<?php echo ($b_pic); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="baby_type">
                                    <option value="">Select</option>
                                    <option <?php if($row['baby_type']=='Active') echo 'selected="selected"'; ?>>Active</option>
                                    <option <?php if($row['baby_type']=='Inactive') echo 'selected="selected"'; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button name="update-baby" class="btn btn-primary submit-btn">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script type="text/javascript">
    <?php if (isset($msg)) {
        echo 'swal("' . ($msg) . '");';
    } ?>
</script>
