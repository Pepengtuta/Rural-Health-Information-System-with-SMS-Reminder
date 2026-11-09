<?php
session_start();
include('system/includes/connection.php');

$msg = "";
if (isset($_POST['change_password'])) {
    $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if the email exists in the database
    $check_email_query = "SELECT * FROM tbl_employee WHERE emailid='$emailid'";
    $email_result = mysqli_query($conn, $check_email_query);

    if ($email_result && mysqli_num_rows($email_result) > 0) {
        if ($new_password === $confirm_password) {
            // Update password if email is found and passwords match
            $update_query = "UPDATE tbl_employee SET password='$new_password' WHERE emailid='$emailid'";
            
            if (mysqli_query($conn, $update_query)) {
                $msg = "Password successfully changed!";
            } else {
                $msg = "Error updating password. Please try again.";
            }
        } else {
            $msg = "New password and confirm password do not match.";
        }
    } else {
        // Email not found in the database
        echo "<script>alert('Email not found in the records.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Mother's Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/logo/lg.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .highlight-link {
            display: inline-block;
            padding: 5px 10px;
            font-weight: bold;
            color: gray;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9em;
            text-transform: uppercase;
            transition: background-color 0.3s, color 0.3s;
        }
        .highlight-link:hover {
            background-color: gray;
            color: white;
        }
    </style>
</head>
<body style="background-color: #FEA0AE;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="images/logo/logob.png);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <h5 class="text-center mb-4">Change Password</h5>
                            <form name="changePasswordForm" action="" method="POST" onsubmit="return validateForm()">
                                <div class="form-group mb-3">
                                    <label class="label" for="emailid">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter your email" id="emailid" name="emailid" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="label" for="new_password">New Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your new password" id="new_password" name="new_password" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="label" for="confirm_password">Confirm New Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm your new password" id="confirm_password" name="confirm_password" required>
                                    <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password
                                </div>
                                
                                <span style="color:#e11584;"><?php if(!empty($msg)){ echo htmlspecialchars($msg); } ?></span>

                                <div class="form-group">
                                    <button type="submit" name="change_password" class="form-control btn btn-dark rounded submit px-3">Change Password</button>
                                </div>

                                <div class="text-center">
                                    <a href="index.php" class="highlight-link">Back to Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function togglePasswordVisibility() {
            var newPasswordField = document.getElementById("new_password");
            var confirmPasswordField = document.getElementById("confirm_password");
            if (newPasswordField.type === "password" || confirmPasswordField.type === "password") {
                newPasswordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                newPasswordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }

        function validateForm() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (newPassword !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
