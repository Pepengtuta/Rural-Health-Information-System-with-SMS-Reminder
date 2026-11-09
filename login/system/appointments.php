<?php
session_start();

// Check if the user is logged in
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit(); // Prevent further execution after redirect
}

// Include header and database connection
include('header.php');
include('includes/connection.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Appointments</h4>
            </div>
            
            <?php 
            // Check if the user has the appropriate role (role=1 indicates admin)
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="send.php" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i> Add Appointment
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="table-responsive">
            <?php
            // Handle deletion of an appointment
            if (isset($_GET['ids'])) {
                $id = mysqli_real_escape_string($connection, $_GET['ids']);
                $delete_query = mysqli_query($connection, "DELETE FROM tbl_appointment WHERE id = '$id'");
                if ($delete_query) {
                    echo "<script>alert('Appointment deleted successfully');</script>";
                } else {
                    echo "<script>alert('Failed to delete appointment');</script>";
                }
            }

            // Fetch appointments grouped by mother's name from the database
            $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_appointment ORDER BY patient_name");

            $appointments_by_mother = [];
            while ($row = mysqli_fetch_assoc($fetch_query)) {
                // Group appointments by mother, then by appointment type
                $appointments_by_mother[$row['patient_name']][$row['appointment_type']][] = $row;
            }

            // Loop through each mother's appointments and display them
            foreach ($appointments_by_mother as $index => $appointment_types) {
                $mother_name = $index;
                $collapse_id = 'collapse' . $index; // Unique ID for each collapsible section
            
                echo "<div class='card mb-4 border shadow-sm'>";
                echo "<div class='card-header bg-pink text-dark d-flex justify-content-between align-items-center'>"; // Changed text color to dark
                echo "<h5 class='mb-0'>$mother_name's Appointments</h5>";
                echo '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#' . $collapse_id . '" onclick="toggleAppointments(\'' . $collapse_id . '\')">Show Appointments</button>';
                echo '</div>';
                
                // Collapsible content with unique ID
                echo '<div id="' . $collapse_id . '" class="collapse">';
                echo "<div class='card-body bg-light-pink'>"; // Added bg-light-pink class

                // Loop through each appointment type for the current mother
                foreach ($appointment_types as $appointment_type => $appointments) {
                    echo "<h5 class='font-weight-bold'>Appointment Type: $appointment_type</h6>"; // Display the appointment type as a header

                    echo "<table class='table table-bordered table-hover'>";
                    echo "<thead><tr>
                            <th>Appointment ID</th>
                            <th>Contact Number</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr></thead>";
                    echo "<tbody>";

                    foreach ($appointments as $appointment) {
                        // Get appointment date and current date in comparable format (timestamp)
                        $appointment_date = strtotime($appointment['date']);
                        $appointment_time = strtotime($appointment['time']); 
                    
                        $start_time = date('h:i A', $appointment_time);
                        $end_time = date('h:i A', $appointment_time + 60 * 60); // Add 1 hour
                        
                        echo "<tr>";
                        echo "<td>{$appointment['appointment_id']}</td>";
                        echo "<td>{$appointment['m_phone']}</td>";
                        echo "<td>{$appointment['date']}</td>";
                        echo "<td>$start_time - $end_time</td>";
                        
                        echo "<td>";
                        
                        // Check if the appointment date has passed
                        if ($appointment_date < time()) { // If current date is past the appointment date
                            echo "<span class='custom-badge status-blue'>Done</span>";
                        } else {
                            // Keep the original status logic for upcoming or pending appointments
                            if ($appointment['status'] == 1) {
                                echo "<span class='custom-badge status-green'>Approved</span>";
                            } elseif ($appointment['status'] == 2) {
                                echo "<span class='custom-badge status-orange'>Pending</span>";
                            } else {
                                echo "<span class='custom-badge status-red'>Declined</span>";
                            }
                        }
                        
                        echo "</td>";

                        // Show Actions column only for role 1 and 3
                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) {
                            echo "<td>
                                    <div class='dropdown dropdown-action'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Actions
                                        </button>
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuButton'>
                                            <a class='dropdown-item' href='view-appointment.php?id={$appointment['id']}'>
                                                <i class='fa fa-eye m-r-5'></i> View
                                            </a>
                                            <a class='dropdown-item' href='edit-appointment.php?id={$appointment['id']}'>
                                                <i class='fa fa-pencil m-r-5'></i> Edit
                                            </a>
                                            <a class='dropdown-item' href='appointments.php?ids={$appointment['id']}' onclick='return confirmDelete();'>
                                                <i class='fa fa-trash-o m-r-5'></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                  </td>";
                        } else {
                            echo "<td>-</td>"; // If not role 1 or 3, leave blank or show a placeholder
                        }

                        echo "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo "</table>";
                }
                
                echo "</div>"; // Close card body
                echo "</div>"; // Close collapsible div
                echo "</div>"; // Close card
            }
            ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script language="JavaScript" type="text/javascript">
// Confirmation dialog for delete action
function confirmDelete() {
    return confirm('Are you sure you want to delete this appointment?');
}

// Function to toggle appointments with feedback
function toggleAppointments(collapseId) {
    var collapseElement = document.getElementById(collapseId);
    if (collapseElement) {
        // Toggle the collapse class
        collapseElement.classList.toggle('show');
        
        // Provide feedback based on the current state
        var button = document.querySelector(`[data-target="#${collapseId}"]`);
        if (collapseElement.classList.contains('show')) {
            button.innerText = 'Hide Appointments';
        } else {
            button.innerText = 'Show Appointments';
        }
    }
}
</script>
