<?php 
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);

if(isset($_POST['save-emp'])) {
    $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $new_pwd = $_POST['new_pwd'];

    // Update the password only if a new password is provided
    if (!empty($new_pwd)) {
        $update_query = mysqli_query($connection, "UPDATE tbl_employee SET username='$username', emailid='$emailid', password='$new_pwd' WHERE id='$id'");
    } else {
        $update_query = mysqli_query($connection, "UPDATE tbl_employee SET username='$username', emailid='$emailid' WHERE id='$id'");
    }

    if($update_query) {
        $msg = "Password changed successfully";
        $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
        $row = mysqli_fetch_array($fetch_query);   
    } else {
        $msg = "Error!";
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Change Password</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="change-password.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" onsubmit="return validatePassword();">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name" value="<?php echo $row['first_name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="<?php echo $row['last_name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="emailid" value="<?php echo $row['emailid']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input id="current-password" class="form-control" type="password" value="<?php echo $row['password']; ?>" readonly>
                                <input type="checkbox" onclick="togglePassword('current-password')"> Show Password
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>New Password</label>
                                <input id="new-password" class="form-control" type="password" name="new_pwd" value="">
                                <small id="message" class="text-danger"></small><br>
                                <input type="checkbox" onclick="togglePassword('new-password')"> Show Password
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="save-emp">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
function togglePassword(fieldId) {
    var passwordField = document.getElementById(fieldId);
    passwordField.type = (passwordField.type === "password") ? "text" : "password";
}

function validatePassword() {
    const newPassword = document.getElementById('new-password').value;
    const message = document.getElementById('message');
    message.textContent = '';

    if (newPassword === '') {
        message.textContent = 'Please enter a new password.';
        return false;
    }

    const hasUppercase = /[A-Z]/.test(newPassword);
    const hasLowercase = /[a-z]/.test(newPassword);

    if (!hasUppercase) {
        message.textContent += 'Password must contain at least one uppercase letter. ';
    }
    if (!hasLowercase) {
        message.textContent += 'Password must contain at least one lowercase letter. ';
    }

    return hasUppercase && hasLowercase;
}
</script>

<script type="text/javascript">
<?php
if(isset($msg)) {
    echo 'swal("' . $msg . '");';
}
?>
</script>
