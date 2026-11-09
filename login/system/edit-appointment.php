<?php 
session_start();
if(empty($_SESSION['name']) || $_SESSION['role']!=1 && $_SESSION['role'] != 3) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);

$msg = ""; // Initialize the message variable

if(isset($_POST['save-appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $patient_name = $_POST['patient_name'];
    $appointment_type = $_POST['appointment_type'];
    $m_phone = $_POST['m_phone'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    // Escape special characters
    $appointment_id = mysqli_real_escape_string($connection, $appointment_id);
    $patient_name = mysqli_real_escape_string($connection, $patient_name);
    $appointment_type = mysqli_real_escape_string($connection, $appointment_type);
    $m_phone = mysqli_real_escape_string($connection, $m_phone);
    $doctor = mysqli_real_escape_string($connection, $doctor);
    $date = mysqli_real_escape_string($connection, $date);
    $time = mysqli_real_escape_string($connection, $time);
    $message = mysqli_real_escape_string($connection, $message);
    $status = mysqli_real_escape_string($connection, $status);

    // Check if an appointment with the same details already exists
    $check_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE id='$id'");
    if (mysqli_num_rows($check_query) == 0) {
        $msg = "Appointment does not exist!";
    } else {
        // Proceed with updating
        $update_query = mysqli_query($connection, "UPDATE tbl_appointment SET appointment_id='$appointment_id', patient_name='$patient_name', appointment_type='$appointment_type', doctor='$doctor', date='$date', time='$time', message='$message', status='$status' WHERE id='$id'");

        // Debugging
        if (!$update_query) {
            echo "<script>alert('Error updating record: " . mysqli_error($connection) . "');</script>";
        } else {
            echo "<script>
                alert('Record updated successfully');
                window.location.href = window.location.href; // Refresh page
            </script>";
        }
    }   
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Edit Appointment</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="appointments.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" onsubmit="handleFormSubmit(event);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Appointment ID <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="appointment_id" value="<?php echo $row['appointment_id']; ?>" readonly> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Midwife</label>
                                <select class="select" name="doctor" id="doctor">
                                    <option value="">Select</option>
                                    <?php
                                    $fetch_query = mysqli_query($connection, "SELECT CONCAT(first_name,' ',last_name) AS name FROM tbl_employee WHERE role=2 AND status=1");
                                    while($doc = mysqli_fetch_array($fetch_query)) {
                                    ?>
                                        <option value="<?php echo $doc['name']; ?>" <?php echo $doc['name'] == $row['doctor'] ? 'selected' : ''; ?>><?php echo $doc['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Type Selection -->
                    <div class="form-group">
                        <label>Appointment Type</label>
                        <select class="select" name="appointment_type" id="appointment_type" required>
                            <option value="">Select</option>
                            <option value="Prenatal Checkup" <?php echo $row['appointment_type'] == 'Prenatal Checkup' ? 'selected' : ''; ?>>Prenatal Checkup</option>
                            <option value="Child Immunization" <?php echo $row['appointment_type'] == 'Child Immunization' ? 'selected' : ''; ?>>Child Immunization</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Name</label>
                                <select class="select" name="patient_name" id="patient_name">
                                    <option value="">Select</option>
                                    <?php
                                    $pat_name = explode(",", $row['patient_name'])[0];
                                    $fetch_query = mysqli_query($connection, "SELECT CONCAT(m_first_name,' ',m_last_name) AS name FROM tbl_patients");
                                    while($rows = mysqli_fetch_array($fetch_query)) {
                                    ?>
                                        <option value="<?php echo $rows['name']; ?>" <?php echo $rows['name'] == $pat_name ? 'selected' : ''; ?>><?php echo $rows['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="m_phone" id="m_phone" value="<?php echo $row['m_phone']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $row['date']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" class="form-control" id="time" name="time" value="<?php echo $row['time']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" class="form-control" name="message" id="message" required><?php echo $row['message']; ?></textarea>
                    </div>
                    <div id='output'></div>

                    <div class="form-group">
                        <label class="display-block">Appointment Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_approved" value="1" <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="product_approved">Approved</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_pending" value="2" <?php echo $row['status'] == 2 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="product_pending">Pending</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_declined" value="0" <?php echo $row['status'] == 0 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="product_declined">Declined</label>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label>Send Message Days Before Appointment</label>
                        <input type="number" class="form-control" name="send_days" id="send_days" value="3" min="0">
                        <small class="form-text text-muted">Enter the number of days before the appointment to send the message.</small>
                    </div>-->

                    <div class="m-t-20 text-center">
                        <input class="btn btn-primary submit-btn" type="submit" name="save-appointment" value="Send" onclick='SendMessage()' />
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

// Initialize the message on page load
document.addEventListener('DOMContentLoaded', function() {
    updateMessage();
});

// Update message when form fields change
document.getElementById('patient_name').addEventListener('change', updateMessage);
document.getElementById('doctor').addEventListener('change', updateMessage);
document.getElementById('date').addEventListener('change', updateMessage);
document.getElementById('time').addEventListener('change', updateMessage);

var wsUri = 'ws://192.168.123.51:8030';

function init() {
    output = document.getElementById('output');
    testWebSocket();
}

function testWebSocket() {
    websocket = new WebSocket(wsUri);
    websocket.onopen = function (evt) { onOpen(evt) };
    websocket.onclose = function (evt) { onClose(evt) };
    websocket.onmessage = function (evt) { onMessage(evt) };
    websocket.onerror = function (evt) { onError(evt) };
}

function onOpen(evt) {
    writeToScreen('CONNECTED');
}

function onClose(evt) {
    writeToScreen('DISCONNECTED');
}

function onMessage(evt) {
    var json = JSON.parse(evt.data);
}

function onError(evt) {
    writeToScreen('<span>ERROR: Webserver APP is not Open</span>');
}

function SendMessage() {
    var statusApproved = document.getElementById('product_approved').checked;
    var m_phone = document.getElementById('m_phone').value;
    var message = document.getElementById('message').value;

    // Check if the status is approved before sending the message
    if (!statusApproved) {
        alert('Message will only be sent if the appointment is approved.');
        return;
    }

    // Ensure the message is not just whitespace
    if (message.trim() !== '') {
        var _data = {
            "receiver": m_phone,
            "message": message // No need to append a watermark unless necessary
        };

        console.log('Data to send:', _data);

        // Show a confirmation message
        alert('Message is being sent...');

        writeToScreen('<div class="message">The message was sent.</div>');
        const phoneArray = m_phone.trim().split(",");

        try {
            var mydata = JSON.stringify(_data);
            console.log(mydata);
            websocket.send(mydata);

            // Show an alert after successfully sending the message
            alert('The message was successfully sent!');
        } catch (error) {
            console.error('Error sending WebSocket message:', error);
            alert('Error: Failed to send the message.');
        }

        document.getElementById('message').focus();
    } else {
        alert('Please ensure the message content is not empty.');
    }
}



function writeToScreen(message) {
    var pre = document.createElement('p');
    pre.style.wordWrap = 'break-word';
    pre.innerHTML = message;
    output.appendChild(pre);
}

window.addEventListener('load', init, false);

var input = document.getElementById('m_phone');
input.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9\,]/, '');
});
</script>
