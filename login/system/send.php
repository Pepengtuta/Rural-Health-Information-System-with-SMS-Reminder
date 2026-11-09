<?php
session_start();
if(empty($_SESSION['name']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 3)) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$fetch_query = mysqli_query($connection, "SELECT MAX(id) AS id FROM tbl_appointment");
$row = mysqli_fetch_row($fetch_query);
$apt_id = ($row[0] == 0) ? 1 : $row[0] + 1;

if(isset($_POST['add-appointment'])) {
    $appointment_id = 'APT-'.$apt_id;
    $patient_name = mysqli_real_escape_string($connection, $_POST['patient_name']);
    $appointment_type = mysqli_real_escape_string($connection, $_POST['appointment_type']);
    $doctor = mysqli_real_escape_string($connection, $_POST['doctor']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $time = mysqli_real_escape_string($connection, $_POST['time']);
    $m_phone = mysqli_real_escape_string($connection, $_POST['m_phone']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $insert_query = mysqli_query($connection, "INSERT INTO tbl_appointment 
        (appointment_id, patient_name, appointment_type, doctor, date, time, m_phone, message, status) 
        VALUES ('$appointment_id', '$patient_name', '$appointment_type', '$doctor', '$date', '$time', '$m_phone', '$message', '$status')");

    if($insert_query) {
        $msg = "Appointment created successfully";
    } else {
        $msg = "Error creating appointment!";
    }
}

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Appointment</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="appointments.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
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
                        <label>Midwife</label>
                        <select class="select" name="doctor" id="doctor" required>
                            <option value="">Select</option>
                            <?php
                            $fetch_query = mysqli_query($connection, "SELECT CONCAT(first_name,' ',last_name) AS name FROM tbl_employee WHERE role=2 AND status=1");
                            while($row = mysqli_fetch_assoc($fetch_query)){
                            ?>
                                <option><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Appointment Type</label>
                <select class="select" name="appointment_type" id="appointment_type" required>
                    <option value="">Select</option>
                    <option value="Prenatal Checkup">Prenatal Checkup</option>
                    <option value="Child Immunization">Child Immunization</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mother's Name</label>
                        <select class="select" name="patient_name" id="patient_name" required>
                            <option value="">Select</option>
                            <?php
                            $fetch_query = mysqli_query($connection, "SELECT CONCAT(m_first_name,' ',m_last_name) AS name, m_phone FROM tbl_patients");
                            while($row = mysqli_fetch_assoc($fetch_query)){
                            ?>
                                <option value="<?php echo $row['name']; ?>" data-phone="<?php echo $row['m_phone']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="09123456789" name="m_phone" id="m_phone" pattern="[0-9]+" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Time</label>
                        <div class="">
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea cols="30" rows="4" class="form-control" name="message" id="message"></textarea>
            </div>

            <div class="form-group">
                <label class="display-block">Appointment Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1">
                    <label class="form-check-label">Approved</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="2" checked>
                    <label class="form-check-label">Pending</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="0">
                    <label class="form-check-label">Declined</label>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <input class="btn btn-primary submit-btn" type="submit" name="add-appointment" value="Save Appointment" />
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
document.getElementById('patient_name').addEventListener('change', updateMessage);
document.getElementById('doctor').addEventListener('change', updateMessage);
document.getElementById('date').addEventListener('change', updateMessage);
document.getElementById('time').addEventListener('change', updateMessage);
document.getElementById('appointment_type').addEventListener('change', updateMessage);

function updateMessage() {
    var patientName = document.getElementById('patient_name').value;
    var doctorName = document.getElementById('doctor').value;
    var date = document.getElementById('date').value;
    var time = document.getElementById('time').value;
    var appointmentType = document.getElementById('appointment_type').value;

    var messageTemplate = "";

    if (appointmentType === "Prenatal Checkup") {
        messageTemplate = `Good day ${patientName}!\n\nYour prenatal checkup has been scheduled for ${date} at ${time}. The attending midwife will be ${doctorName}. Please make sure to arrive 15 minutes early.\n\nThank you,\nLaguinbanua East Health Center`;
    } else if (appointmentType === "Child Immunization") {
        messageTemplate = `Good day ${patientName}!\n\nYour child's immunization appointment has been scheduled for ${date} at ${time}. The attending midwife will be ${doctorName}. Please ensure to bring your child's immunization card and arrive 15 minutes early.\n\nThank you,\nLaguinbanua East Health Center`;
    }

    document.getElementById('message').value = messageTemplate;
}

</script>