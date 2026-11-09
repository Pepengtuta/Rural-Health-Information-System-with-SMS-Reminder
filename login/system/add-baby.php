<?php
session_start();

if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

// Include necessary files
include('header.php');
include('includes/connection.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Add Newborn Information</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
            </div>
        </div>

        <!-- Filter and Search Bar -->
        <div class="row">
            <div class="col-sm-9">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Mother Name, Age, Address, or Phone" onkeyup="filterTable()">
            </div>
            <div class="col-sm-3">
                <select id="statusFilter" class="form-control" onchange="filterTable()">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="all">Show All</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name of Mother</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    if (isset($_GET['ids'])) {
                        $id = mysqli_real_escape_string($connection, $_GET['ids']);
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_patients WHERE id='$id'");
                        if ($delete_query) {
                            echo "<script>alert('Record deleted successfully');</script>";
                        } else {
                            echo "<script>alert('Error deleting record');</script>";
                        }
                    }

                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_patients");
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $dob = $row['m_dob'];
                        $date = str_replace('/', '-', $dob);
                        $dob = date('Y-m-d', strtotime($date));
                        $year = (date('Y') - date('Y', strtotime($dob)));
                    ?>
                        <tr class="patient-row" data-status="<?php echo htmlspecialchars($row['patient_type']); ?>">
                            <td><?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?></td>
                            <td><?php echo $year; ?></td>
                            <td><?php echo $row['addr']; ?></td>
                            <td><?php echo $row['m_phone']; ?></td>
                            <td>
                                <span class="custom-badge <?php echo $row['patient_type'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                                    <?php echo $row['patient_type']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a href="register-baby.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&first_m_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                            <i class="fa fa-plus m-r-5"></i>Add Information
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script language="JavaScript" type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this patient?');
}

function filterTable() {
    var searchValue = document.getElementById('searchInput').value.toLowerCase();
    var statusValue = document.getElementById('statusFilter').value.toLowerCase();
    var rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(function(row) {
        var rowText = row.textContent.toLowerCase();
        var rowStatus = row.getAttribute('data-status').toLowerCase();

        var matchesSearch = rowText.includes(searchValue);
        var matchesStatus = (statusValue === 'all' || rowStatus === statusValue);

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

window.onload = function() {
    filterTable();
};
</script>
