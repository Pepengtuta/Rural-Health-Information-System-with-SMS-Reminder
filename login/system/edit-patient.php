<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Mother Details</h4>
            </div>

            <?php 
            // Check if the user has the appropriate role (role=1 indicates admin)
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="register-patient.php" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i> Add Mother
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="row m-b-20">

            <div class="col-sm-9">
                <input type="text" id="searchBar" class="form-control" placeholder="Search by name, age, address, or phone...">
            </div>
            <div class="col-sm-3">
                <select id="statusFilter" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="all">Show All</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-stripped" id="patientTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th> Date of Delivery </th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Handle deletion of a patient
                    if (isset($_GET['delete_id'])) { // Use 'delete_id' to avoid conflict with other query params
                        $id = $_GET['delete_id'];
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_patients WHERE id='$id'");
                        if ($delete_query) {
                            echo "<script>alert('Patient deleted successfully'); window.location.href = 'edit-patient.php';</script>";
                        } else {
                            echo "<script>alert('Failed to delete patient');</script>";
                        }
                    }

                    // Fetch patient data
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_patients");
                    while ($row = mysqli_fetch_array($fetch_query)) {
                        // Calculate age if m_dob is available
                        $dob = $row['m_dob'];
                        if (!empty($dob)) {
                            $dob = date('Y-m-d', strtotime(str_replace('/', '-', $dob)));
                            $age = date('Y') - date('Y', strtotime($dob));
                        } else {
                            $age = 'N/A'; // Default value if DOB is not available
                        }
                    ?>
                            <tr class="patient-row" data-status="<?php echo $row['patient_type']; ?>" style="display: <?php echo ($row['patient_type'] == 'Active' ? 'table-row' : 'none'); ?>">
                            <td><?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $row['addr']; ?></td>
                            <td><?php echo $row['m_phone']; ?></td>
                            <td>
    <?php 
    // Convert the date format
    $date = DateTime::createFromFormat('d/m/Y', $row['m_edod']);
    echo $date ? $date->format('m/d/Y') : $row['m_edod']; 
    ?>
</td>
                            <td>
                                <span class="custom-badge <?php echo $row['patient_type'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                                    <?php echo $row['patient_type']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="view-single-patient.php?id=<?php echo urlencode($row['id']); ?>&m_number=<?php echo urlencode($row['m_number']); ?>&patient_name=<?php echo urlencode($row['m_first_name'] . '_' . $row['m_last_name']); ?>">
                                            <i class="fa fa-eye m-r-5"></i> View Details
                                        </a>
                                        <a class="dropdown-item" href="mothers_book.php?id=<?php echo $row['id']; ?>">
                                            <i class="fa fa-print m-r-5"></i> Print
                                        </a>
                                        <a class="dropdown-item" href="update-patient.php?id=<?php echo $row['id']; ?>">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirmDelete();">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
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

document.getElementById('searchBar').addEventListener('keyup', function() {
    var input = document.getElementById('searchBar').value.toLowerCase();
    var table = document.getElementById('patientTable');
    var rows = table.getElementsByTagName('tr');
    var selectedStatus = document.getElementById('statusFilter').value.toLowerCase();

    for (var i = 1; i < rows.length; i++) {
        var columns = rows[i].getElementsByTagName('td');
        var match = false;
        
        for (var j = 0; j < columns.length - 1; j++) { 
            if (columns[j].innerText.toLowerCase().indexOf(input) > -1) {
                match = true;
                break;
            }
        }

        var patientStatus = rows[i].getAttribute('data-status').toLowerCase();

        if (match && (selectedStatus === 'all' || patientStatus === selectedStatus)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});

document.getElementById('statusFilter').addEventListener('change', function() {
    var selectedStatus = this.value.toLowerCase();
    var table = document.getElementById('patientTable');
    var rows = table.getElementsByTagName('tr');
    var searchInput = document.getElementById('searchBar').value.toLowerCase();

    for (var i = 1; i < rows.length; i++) {
        var columns = rows[i].getElementsByTagName('td');
        var match = false;

        for (var j = 0; j < columns.length - 1; j++) {
            if (columns[j].innerText.toLowerCase().indexOf(searchInput) > -1) {
                match = true;
                break;
            }
        }

        var patientStatus = rows[i].getAttribute('data-status').toLowerCase();

        if (match && (selectedStatus === 'all' || patientStatus === selectedStatus)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
