<?php
session_start();
include('system/includes/connection.php');

$msg = "";
if (isset($_POST['login']) || isset($_REQUEST['login'])) {
    $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
    $pwd = mysqli_real_escape_string($conn, $_REQUEST['pwd']);
    
    $fetch_query = mysqli_query($conn, "SELECT * FROM tbl_employee WHERE username ='$username' AND password = '$pwd'");
    if ($fetch_query && mysqli_num_rows($fetch_query) > 0) {
        $data = mysqli_fetch_array($fetch_query);
        $name = $data['first_name'] . ' ' . $data['last_name'];
        $role = $data['role'];
        $_SESSION['name'] = $name; 
        $_SESSION['username'] = $username; 
        $_SESSION['role'] = $role;
        header('location:system/dashboard.php');
        exit();
    } else {
        $msg = "Incorrect login details.";
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
						<div class="img" style="background-image: url(images/logo/logob.png);">
			      </div>
						<div class="login-wrap p-4 p-md-6">
                            <h5 class="text-center mb-3">Mother's Book: <br>Rural Health Information System with SMS Reminder for <br>Laguinbanua East, Numancia, Aklan</h5>
                            <form name="form" action="" method="POST">
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Enter your username" id="username" name="username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="pwd">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your password" id="pwd" name="pwd" required>
                                    <input type="checkbox" onclick="togglePassword('pwd')"> Show Password
                                </div>

                                <span style="color:#e11584;"><?php if(!empty($msg)){ echo htmlspecialchars($msg); } ?></span>
                                
                                <div class="form-group">
                                    <button type="submit" name="login" value="Log In" class="form-control btn btn-dark rounded submit px-3">Log In</button>
                                    <a href="forgot_password.php">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a href="../index.php" class="highlight-link">Back to Home</a>
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
        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
  </body>
</html>
