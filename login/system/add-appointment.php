<?php
session_start();
if(empty($_SESSION['name']) || $_SESSION['role']!=1 && $_SESSION['role'] != 3) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
$fetch_query = mysqli_query($connection, "select max(id) as id from tbl_appointment");
$row = mysqli_fetch_row($fetch_query);
$apt_id = ($row[0] == 0) ? 1 : $row[0] + 1;

if(isset($_REQUEST['add-appointment'])) {
    $appointment_id = 'APT-'.$apt_id;
    $patient_name = $_REQUEST['patient_name'];
    $doctor = $_REQUEST['doctor'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];
    $message = $_REQUEST['message'];
    $status = $_REQUEST['status'];

    $insert_query = mysqli_query($connection, "insert into tbl_appointment set appointment_id='$appointment_id', patient_name='$patient_name', doctor='$doctor', date='$date', time='$time', message='$message', status='$status'");

    if($insert_query > 0) {
        $msg = "Appointment created successfully";
    } else {
        $msg = "Error!";
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Add Appointment</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="appointments.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Appointment ID <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="appointment_id" value="<?php echo 'APT-'.$apt_id; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Name</label>
                                <select class="select" name="patient_name" id="patient_name" required>
                                    <option value="">Select</option>
                                    <?php
                                    $fetch_query = mysqli_query($connection, "select concat(m_first_name,' ',m_last_name) as name, m_dob from tbl_patients");
                                    while($row = mysqli_fetch_array($fetch_query)){
                                    ?>
                                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Midwife</label>
                                <select class="select" name="doctor" id="doctor" required>
                                    <option value="">Select</option>
                                    <?php
                                    $fetch_query = mysqli_query($connection, "select concat(first_name,' ',last_name) as name from tbl_employee where role=2 and status=1");
                                    while($row = mysqli_fetch_array($fetch_query)){
                                    ?>
                                        <option><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" name="date" id="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="time-icon">
                                    <input type="text" class="form-control" id="time" name="time" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" class="form-control" name="message" id="message" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Appointment Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_active" value="1" checked>
                            <label class="form-check-label" for="product_active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0">
                            <label class="form-check-label" for="product_inactive">Inactive</label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="add-appointment" class="btn btn-primary submit-btn">Create Appointment</button>
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
document.getElementById('patient_name').addEventListener('change', function() {
    updateMessage();
});

document.getElementById('doctor').addEventListener('change', function() {
    updateMessage();
});

document.getElementById('date').addEventListener('change', function() {
    updateMessage();
});

document.getElementById('time').addEventListener('change', function() {
    updateMessage();
});

function updateMessage() {
    var patientName = document.getElementById('patient_name').value;
    var doctorName = document.getElementById('doctor').value;
    var date = document.getElementById('date').value;
    var time = document.getElementById('time').value;

    var messageTemplate = `Good day ${patientName}!\n\nYour prenatal checkup has been scheduled for ${date} at ${time}. The attending midwife will be ${doctorName}. Please make sure to arrive 15 minutes early.\n\nThank you,\nLaguinbanua East Health Center`;

    document.getElementById('message').value = messageTemplate;
}

<?php
if(isset($msg)) {
    echo 'swal("' . $msg . '");';
}
?>
</script>
