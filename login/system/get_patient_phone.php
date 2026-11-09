<?php
include('includes/connection.php');

if(isset($_POST['patient_name'])) {
    $patient_name = mysqli_real_escape_string($connection, $_POST['patient_name']);
    // Query to fetch phone number based on patient name
    $query = mysqli_query($connection, "SELECT m_phone FROM tbl_patients WHERE CONCAT(m_first_name, ' ', m_last_name) = '$patient_name'");
    
    if ($row = mysqli_fetch_assoc($query)) {
        // Return the phone number as JSON
        echo json_encode(['phone' => $row['m_phone']]);
    } else {
        // Return an empty phone number if no match is found
        echo json_encode(['phone' => '']);
    }
}
?>
