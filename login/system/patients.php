<?php
session_start();

// Check if the session is valid, otherwise redirect
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit(); // Make sure the script doesn't continue executing after the redirect
}

// Include necessary files
include('header.php');
include('includes/connection.php');

// Function to calculate age from date of birth
function calculate_age($dob) {
    $date = str_replace('/', '-', $dob);
    $dob = date('Y-m-d', strtotime($date));
    return date('Y') - date('Y', strtotime($dob));
}

// Handle deletion
if (isset($_GET['ids'])) {
    $id = mysqli_real_escape_string($connection, $_GET['ids']);
    $delete_query = mysqli_query($connection, "DELETE FROM tbl_patients WHERE id='$id'");
    if ($delete_query) {
        echo "<script>alert('Patient deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting patient');</script>";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Mother Details</h4>
            </div>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all patients
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_patients");
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $age = calculate_age($row['m_dob']);
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['m_first_name'] . " " . $row['m_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($age); ?></td>
                            <td><?php echo htmlspecialchars($row['addr']); ?></td>
                            <td><?php echo htmlspecialchars($row['m_phone']); ?></td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="view-single-patient.php?id=<?php echo urlencode($row['id']); ?>&m_number=<?php echo urlencode($row['m_number']); ?>&patient_name=<?php echo urlencode($row['m_first_name'] . '_' . $row['m_last_name']); ?>">
                                            <i class="fa fa-eye m-r-5"></i> View Details
                                        </a>             
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script language="JavaScript" type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this patient?');
}
</script>
