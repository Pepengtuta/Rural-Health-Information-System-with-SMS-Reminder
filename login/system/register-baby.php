<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if(isset($_REQUEST['add-baby']))
{
    $b_fname = $_REQUEST['b_fname'];
    $b_mname = $_REQUEST['b_mname'];
    $b_lname = $_REQUEST['b_lname'];
    $b_number = $_REQUEST['b_number'];
    $b_mother = $_REQUEST['b_mother'];
    $b_father = $_REQUEST['b_father'];
    $b_m_number = $_REQUEST['b_m_number'];
    $b_dob = $_REQUEST['b_dob'];
    $b_sex = $_REQUEST['b_sex'];
    $b_bloodtype = $_REQUEST['b_bloodtype'];
    $b_tod = $_REQUEST['b_tod'];
    $b_accurate = $_REQUEST['b_accurate'];
    $b_sotb = $_REQUEST['b_sotb'];
    $b_nom = $_REQUEST['b_nom'];
    $b_bweight = $_REQUEST['b_bweight'];
    $b_blength = $_REQUEST['b_blength'];
    $b_cheadsize = $_REQUEST['b_cheadsize'];
    $b_cc = $_REQUEST['b_cc'];
    $b_hmcdyh = $_REQUEST['b_hmcdyh'];
    $b_dobr = $_REQUEST['b_dobr'];
    $b_address = $_REQUEST['b_address'];
    $b_list = $_REQUEST['b_list'];
    $baby_type = $_REQUEST['baby_type'];

    $b_pic = '';

    if (isset($_FILES['b_pic']) && $_FILES['b_pic']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "assets/img/logo/baby/";
        $file_name = basename($_FILES["b_pic"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;

        if ($_FILES["b_pic"]["size"] > 2000000) {
            $msg = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if(!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $msg = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["b_pic"]["tmp_name"], $target_file)) {
                $b_pic = $file_name;
            } else {
                $msg = "Sorry, there was an error uploading your file.";
            }
        }
    }

    $check_query = mysqli_query($connection, "SELECT * FROM tbl_baby WHERE b_mother='$b_mother'");
    if(mysqli_num_rows($check_query) > 0) {
        $msg = "Child record already exists.";
    } else {
        $insert_query = mysqli_query($connection, "INSERT INTO tbl_baby SET 
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
        ");

        if($insert_query > 0) {
            $msg = "Child record created successfully";
        } else {
            $msg = "Error! Unable to create record.";
        }
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
                <a href="add-baby.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_fname">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Middle Name </label>
                                <input class="form-control" type="text" name="b_mname">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_lname">
                            </div>
                        </div>
                    </div>

                    <h4>Name of Parents</h4>
                    <?php
                    $m_number = $_GET['m_number'];
                    $ret = "SELECT * FROM tbl_patients WHERE m_number=?";
                    $stmt = $connection->prepare($ret);
                    $stmt->bind_param('s', $m_number);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    while ($row = $res->fetch_object()) {
                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mother</label>
                                <input class="form-control" type="text" name="b_mother" value="<?php echo $row->m_first_name; ?> <?php echo $row->m_last_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Father</label>
                                <input class="form-control" type="text" name="b_father" value="<?php echo $row->f_first_name; ?> <?php echo $row->f_last_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group" style="display:none">                                <label>Mothers Number</label>
                                <input class="form-control" type="text" name="b_m_number" value="<?php echo $row->m_number; ?>">
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="b_dob">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sex</label>
                                <select class="select" name="b_sex">
                                    <option value="">Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select class="select" name="b_bloodtype">
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
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Type of Delivery <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="b_tod">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="display-block">Is it accurate Month of giving birth?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="b_accurate" id="b_yes" value="1" checked>
                                    <label class="form-check-label" for="b_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="b_accurate" id="b_no" value="0">
                                    <label class="form-check-label" for="b_no">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Single or Twins births</label>
                                <input class="form-control" type="text" name="b_sotb">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name of Midwife</label>
                                <input type="text" class="form-control" name="b_nom">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Birth Weight</label>
                                <input class="form-control" type="text" name="b_bweight">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Body Length</label>
                                <input class="form-control" type="text" name="b_blength">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Circular Head size</label>
                                <input class="form-control" type="text" name="b_cheadsize">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Chest Circumference</label>
                                <input class="form-control" type="text" name="b_cc">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>How many child/children do you have?</label>
                                <input class="form-control" type="text" name="b_hmcdyh">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth Registration</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="b_dobr">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="b_address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>List of Unfortunate Events (Serious illness or death of parents or siblings under the age of five)</label>
                                <input class="form-control" type="text" name="b_list">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Upload Child Photo</label><br><br>
                                <input class="form-control" type="file" name="b_pic">
                            </div>
                        </div>
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select" name="baby_type" required>
                                    <option value="">Select</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group" style="display:none">
    <?php 
        $length = 4;    
        $b_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    ?>
    <label for="inputZip" class="col-form-label">Baby Number</label>
    <input type="text" name="b_number" value="<?php echo $b_number; ?>" class="form-control" id="inputZip">
</div>

                    <div class="form-group text-center">
                    <button name="add-baby" class="btn btn-primary submit-btn">Save Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script type="text/javascript">
    <?php if (isset($msg)) {
        echo 'swal("' . $msg . '");';
    } ?>
</script>
