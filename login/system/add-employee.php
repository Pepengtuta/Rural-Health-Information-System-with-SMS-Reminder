<?php
session_start();
if (empty($_SESSION['name']) || $_SESSION['role'] != 1) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if (isset($_REQUEST['add-employee'])) {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $username = $_REQUEST['username'];
    $emailid = $_REQUEST['emailid'];
    $pwd = $_REQUEST['pwd'];
    $dob = $_REQUEST['dob'];
    $employee_id = $_REQUEST['employee_id'];
    $joining_date = $_REQUEST['joining_date'];
    $gender = $_REQUEST['gender'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $bio = $_REQUEST['bio'];
    $role = $_REQUEST['role'];
    $status = $_REQUEST['status'];
    $pic = '';
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] == 0) {
        $target_dir = "assets/img/logo/employee/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["pic"]["tmp_name"]);
        if ($check === false) {
            $msg = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["pic"]["size"] > 5000000) {
            $msg = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $msg = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
                $pic = basename($_FILES["pic"]["name"]);
            } else {
                $msg = "Sorry, there was an error uploading your file.";
            }
        }
    }

    $insert_query = mysqli_query($connection, "INSERT INTO tbl_employee SET first_name='$first_name', last_name='$last_name', username='$username', emailid='$emailid', password='$pwd', dob='$dob', employee_id='$employee_id', joining_date='$joining_date', gender='$gender', address='$address', phone='$phone', bio='$bio', role=3, status='$status'");

    if ($insert_query > 0) {
        $msg = "Staff created successfully";
    } else {
        $msg = "Error!";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Add Staff</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="employees.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="username" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="emailid" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="pwd" id="password" required>
                                <small id="message" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="showPassword">
                                <label for="showPassword">Show Password</label>
                            </div>
                        </div>

                        <script>
                            const passwordInput = document.getElementById('password');
                            const message = document.getElementById('message');
                            const showPasswordCheckbox = document.getElementById('showPassword');

                            passwordInput.addEventListener('input', function() {
                                const password = passwordInput.value;
                                const hasUppercase = /[A-Z]/.test(password);
                                const hasLowercase = /[a-z]/.test(password);

                                message.textContent = '';

                                if (!hasUppercase) {
                                    message.textContent += 'Password must contain at least one uppercase letter. ';
                                }
                                if (!hasLowercase) {
                                    message.textContent += 'Password must contain at least one lowercase letter. ';
                                }
                            });

                            showPasswordCheckbox.addEventListener('change', function() {
                                passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
                            });
                        </script>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="dob" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee ID </label>
                                <input class="form-control" type="text" name="employee_id" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="joining_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input class="form-control" type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group gender-select">
                                <label class="gen-label">Gender:</label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input" value="Male" checked>Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Short Biography</label>
                        <textarea class="form-control" rows="3" cols="30" name="bio" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="display-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" checked>
                                    <label class="form-check-label" for="doctor_active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="0">
                                    <label class="form-check-label" for="doctor_inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input class="form-control" type="file" name="pic" required>
                            </div>
                        </div>
                    </div>

                    <div class="m-t-20 text-center">
                        <button name="add-employee" class="btn btn-primary submit-btn">Save Record</button>
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
    if (isset($msg)) {
        echo 'swal("' . $msg . '");';
    }
    ?>
</script>

