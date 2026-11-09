<?php 
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

    $id = $_GET['id'];

        $fetch_query = mysqli_query($connection, "
            SELECT 
                s.*, 
                e.first_name, 
                e.last_name, 
                e.emailid, 
                e.phone, 
                e.address, 
                e.bio, 
                e.employee_id, 
                e.joining_date, 
                e.pic
            FROM tbl_schedule AS s
            JOIN tbl_employee AS e ON s.doctor_name = CONCAT(e.first_name, ' ', e.last_name)
            WHERE s.id='$id'
        ");

    $row = mysqli_fetch_array($fetch_query);

        if (!$row) {
            echo "<script>alert('Schedule not found'); window.location.href='schedule.php';</script>";
            exit();
        }
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="page-title">View Schedule Details</h4>
            </div>
            <div class="col-sm-6 text-right m-b-20">
                <a href="schedule.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; border: 1px solid #ddd; margin: 50px auto;">
                                    <img src="<?php echo !empty($row['pic']) ? 'assets/img/logo/employee/' . $row['pic'] : 'assets/img/logo/employee/user.jpg'; ?>" 
                                         alt="Profile Picture" 
                                         class="img-fluid" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-8"><br>
                                <h5 class="card-title">Midwife Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> <?php echo ($row['first_name'] . ' ' . $row['last_name']); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Employee ID:</strong> <?php echo ($row['employee_id']); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> <?php echo ($row['emailid']); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Phone:</strong> <?php echo ($row['phone']); ?></p>
                                    </div>
                                </div>
                        <h4 class="card-title mt-4">Schedule Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Available Days:</strong> <?php echo ($row['available_days']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong> <?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Start Time:</strong> <?php echo ($row['start_time']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>End Time:</strong> <?php echo ($row['end_time']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Message:</strong> <?php echo ($row['message']); ?></p>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('footer.php');
?>
