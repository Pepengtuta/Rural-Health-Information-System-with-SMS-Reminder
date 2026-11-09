<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/lg.png">
    <title>Mother's Book</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="dashboard.php" class="logo">
                    <img src="assets/img/logo/lg.png" width="35" height="35" alt=""> <span>Mother's Book</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                        <img src="<?php echo !empty($row['pic']) ? 'assets/img/logo/employee/' . $row['pic'] : 'assets/img/logo/employee/user.jpg'; ?>" class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <?php if($_SESSION['role'] == 1) { ?>
                            <span>Admin</span>
                        <?php } else { ?>
                            <span><?php echo $_SESSION['name']; ?></span>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <?php if($_SESSION['role'] == 1) { ?>
                            <div class="dropdown-header noti-title">
                                <a href="logout.php" class="dropdown-item notify-item">
                                <i class="fa fa-sign-out"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item notify-item">
                                <i class="fa fa-sign-out"></i>
                                <span>Logout</span>
                            </a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>


<!--DASHBOARD FOR ADMIN-->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php if ($_SESSION['role'] == 1) { ?>
                        <ul>
                            <li class="active">
                                <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="doctors.php"><span class="material-symbols-outlined">stethoscope</span><span>Midwife</span></a>
                            </li>
                            <li><a href="employees.php"><span class="material-symbols-outlined">groups</span><span>Staff</span></a></li>

                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">pregnant_woman</span>
                                    <span>Mothers Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="edit-patient.php">About Mother</a></li>
                                    <li><a href="experience-patient.php">Experience with Previous Pregnancies and Births</a></li>
                                    <li><a href="other-patient.php">Other Records</a></li>
                                    <hr>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">calendar_month</span><span>Monthly Check-Up</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="head-first-trimester.php">First Trimester</a></li>
                                    <li><a href="head-second-trimester.php">Second Trimester</a></li>
                                    <li><a href="head-third-trimester.php">Third Trimester</a></li>
                                </ul>
                    </li>


                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">child_care</span><span>Child Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="add-baby.php">Register Child</a></li>
                                    <li><a href="edit-baby.php">Child Record</a></li>
                                </ul>
                            </li>
                            <li><a href="baby-immunization.php"><span class="material-symbols-outlined">vaccines</span><span>Child's Immunization</span></a></li>
                            <li><a href="appointments.php"><span class="material-symbols-outlined">event_note</span></i> <span>Appointments</span></a></li>
                           <!-- <li><a href="send.php"><i class="fa fa-calendar"></i> <span>Send</span></a></li>-->
                            <li><a href="schedule.php"><span class="material-symbols-outlined">schedule</span> <span>Midwife Schedule</span></a></li>
                            <li><a href="report.php"><span class="material-symbols-outlined">content_paste</span><span>Report</span></a></li>
                            <li><a href="change-password.php"><span class="material-symbols-outlined">lock_reset</span><span>Change Password</span></a></li>
                            <!--<li><a href="backup.php"><span class="material-symbols-outlined">lock_reset</span><span>Backup</span></a></li>-->
                        </ul>

<!--DASHBOARD FOR MIDWIFE-->

                        <?php } elseif ($_SESSION['role'] == 2) { ?>
                        <ul>
                            <li class="active">
                            <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span><span>Dashboard</span></a>
                            </li>
                            <li>
                            <a href="doctors.php"><span class="material-symbols-outlined">stethoscope</span><span>Midwife</span></a>
                            </li>
                            <li><a href="employees.php"><span class="material-symbols-outlined">groups</span><span>Staff</span></a></li>

                            
                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">pregnant_woman</span>
                                    <span>Mothers Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="edit-patient.php">About Mother</a></li>
                                    <li><a href="experience-patient.php">Experience with Previous Pregnancies and Births</a></li>
                                    <li><a href="other-patient.php">Other Records</a></li>
                                    <hr>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">calendar_month</span><span>Monthly Check-Up</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="head-first-trimester.php">First Trimester</a></li>
                                    <li><a href="head-second-trimester.php">Second Trimester</a></li>
                                    <li><a href="head-third-trimester.php">Third Trimester</a></li>
                                </ul>
                    </li>
                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">child_care</span><span>Child Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="edit-baby.php">Child Record</a></li>
                                </ul>
                            </li>
                            <li><a href="baby-immunization.php"><span class="material-symbols-outlined">vaccines</span><span>Child's Immunization</span></a></li>
                            <li><a href="appointments.php"><span class="material-symbols-outlined">event_note</span></i> <span>Appointments</span></a></li>
                            <li><a href="schedule.php"><span class="material-symbols-outlined">schedule</span> <span>Midwife Schedule</span></a></li>


                        </ul>

<!--DASHBOARD FOR STAFF-->
                        <?php } elseif ($_SESSION['role'] == 3) { ?>
                        <ul>
                        <li class="active">
                                <a href="dashboard.php"><span class="material-symbols-outlined">dashboard</span><span>Dashboard</span></a>
                            </li>
                            <li><a href="employees.php"><span class="material-symbols-outlined">groups</span><span>Staff</span></a></li>
                            <li>
                                <a href="doctors.php"><span class="material-symbols-outlined">stethoscope</span><span>Midwife</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">pregnant_woman</span>
                                    <span>Mothers Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="edit-patient.php">About Mother</a></li>
                                    <li><a href="experience-patient.php">Experience with Previous Pregnancies and Births</a></li>
                                    <li><a href="other-patient.php">Other Records</a></li>
                                    <hr>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">calendar_month</span><span>Monthly Check-Up</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="head-first-trimester.php">First Trimester</a></li>
                                    <li><a href="head-second-trimester.php">Second Trimester</a></li>
                                    <li><a href="head-third-trimester.php">Third Trimester</a></li>
                                </ul>
                    </li>


                            <li>
                                <a href="javascript:void(0);">
                                <span class="material-symbols-outlined">child_care</span><span>Child Record</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="add-baby.php">Register Child</a></li>
                                    <li><a href="edit-baby.php">Child Record</a></li>
                                </ul>
                            </li>
                            <li><a href="baby-immunization.php"><span class="material-symbols-outlined">vaccines</span><span>Child's Immunization</span></a></li>
                            <li><a href="appointments.php"><span class="material-symbols-outlined">event_note</span></i> <span>Appointments</span></a></li>
                           <!-- <li><a href="send.php"><i class="fa fa-calendar"></i> <span>Send</span></a></li>-->
                            <li><a href="schedule.php"><span class="material-symbols-outlined">schedule</span> <span>Midwife Schedule</span></a></li>
                            <li><a href="report.php"><span class="material-symbols-outlined">content_paste</span><span>Report</span></a></li>
                            </ul>

            <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Add necessary JavaScript files -->
</body>
</html>
