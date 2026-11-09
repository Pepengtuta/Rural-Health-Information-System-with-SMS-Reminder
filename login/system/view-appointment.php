<?php 
session_start();
if(empty($_SESSION['name']) || $_SESSION['role'] != 1 && $_SESSION['role'] != 3) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE id='$id'");

if (mysqli_num_rows($fetch_query) == 0) {
    echo "<script>alert('Appointment not found. Redirecting to Appointments page.'); window.location.href = 'appointments.php';</script>";
    exit;
}

$row = mysqli_fetch_array($fetch_query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">View Appointment</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="appointments.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Appointment ID</label>
                                <input class="form-control" type="text" value="<?php echo $row['appointment_id']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Midwife</label>
                                <input class="form-control" type="text" value="<?php echo $row['doctor']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Appointment Type</label>
                        <input class="form-control" type="text" value="<?php echo $row['appointment_type']; ?>" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Name</label>
                                <input class="form-control" type="text" value="<?php echo $row['patient_name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" value="<?php echo $row['m_phone']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" value="<?php echo $row['date']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input class="form-control" type="time" value="<?php echo $row['time']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="8" class="form-control" readonly><?php echo $row['message']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Appointment Status</label>
                        <input class="form-control" type="text" value="<?php echo $row['status'] == 1 ? 'Approved' : ($row['status'] == 2 ? 'Pending' : 'Declined'); ?>" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include('footer.php');
?>
