<?php 
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Midwife Details</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="doctors.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div><br>

        <div class="row">
            <div class="col-lg-12"> 
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                            <div style="width: 230px; height: 230px; border-radius: 50%; overflow: hidden; border: 1px solid #ddd; margin: 50px auto 0;">
                            <img src="<?php echo !empty($row['pic']) ? 'assets/img/logo/employee/' . $row['pic'] : 'assets/img/logo/employee/user.jpg'; ?>" 
                                         alt="Profile Picture" 
                                         class="img-fluid" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-user"></i>
                                        <label class="text-muted" style="font-size: 14px;">First Name:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['first_name']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-user"></i>
                                        <label class="text-muted" style="font-size: 14px;">Last Name:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['last_name']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-user-circle"></i>
                                        <label class="text-muted" style="font-size: 14px;">Username:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['username']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-envelope"></i>
                                        <label class="text-muted" style="font-size: 14px;">Email:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['emailid']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-id-badge"></i>
                                        <label class="text-muted" style="font-size: 14px;">Employee ID:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['employee_id']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-calendar-alt"></i>
                                        <label class="text-muted" style="font-size: 14px;">Joining Date:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['joining_date']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-calendar"></i>
                                        <label class="text-muted" style="font-size: 14px;">Date of Birth:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['dob']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-phone"></i>
                                        <label class="text-muted" style="font-size: 14px;">Phone:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['phone']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-venus-mars"></i>
                                        <label class="text-muted" style="font-size: 14px;">Gender:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['gender']; ?></p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <label class="text-muted" style="font-size: 14px;">Address:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['address']; ?></p>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <i class="fa fa-user-tag"></i>
                                        <label class="text-muted" style="font-size: 14px;">Role:</label>
                                        <p style="font-size: 14px; font-weight: 500;">
                                            <?php 
                                                $role_query = mysqli_query($connection, "SELECT title FROM tbl_role WHERE role='".$row['role']."'");
                                                if ($role_query && mysqli_num_rows($role_query) > 0) {
                                                    $role_row = mysqli_fetch_array($role_query);
                                                    echo $role_row['title'];
                                                } else {
                                                    echo "Admin";
                                                }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <i class="fa fa-toggle-on"></i>
                                        <label class="text-muted" style="font-size: 14px;">Status:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></p>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <i class="fa fa-info-circle"></i>
                                        <label class="text-muted" style="font-size: 14px;">Short Biography:</label>
                                        <p style="font-size: 14px; font-weight: 500;"><?php echo $row['bio']; ?></p>
                                    </div>
                                </div> <!-- end of row inside col-md-8 -->
                            </div> <!-- end of col-md-8 -->
                        </div> <!-- end of row -->
                    </div>
                </div> <!-- end of card -->
            </div>
        </div> <!-- end of row -->
    </div>
</div>

<?php 
include('footer.php');
?>
