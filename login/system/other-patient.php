<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}

include('header.php');
include('includes/connection.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Other Records</h4>
            </div>
            <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3): ?>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="add-other-patient.php" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i> Add Information
                    </a>
                </div>
            <?php endif; ?>
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
            <table id="patientTable" class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name of Mother</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['o_ids'])) {
                        $o_id = mysqli_real_escape_string($connection, $_GET['o_ids']);
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_other WHERE o_id = '$o_id'");
                        echo "<script>alert('" . ($delete_query ? "Record deleted successfully" : "Failed to delete record") . "');</script>";
                    }

                    $fetch_query = mysqli_query($connection, "
                        SELECT 
                            o.o_id, 
                            p.m_first_name, 
                            p.m_last_name,
                            p.m_age,          
                            p.addr,          
                            p.m_phone,
                            p.patient_type         
                        FROM tbl_other o
                        JOIN tbl_patients p ON o.o_name = p.m_number
                    ");

                    while ($row = mysqli_fetch_assoc($fetch_query)):
                        $full_name = htmlspecialchars($row['m_first_name'] . ' ' . $row['m_last_name']);
                    ?>
                        <tr class="patient-row" data-status="<?php echo $row['patient_type']; ?>">
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo htmlspecialchars($row['m_age']); ?></td>
                            <td><?php echo htmlspecialchars($row['addr']); ?></td>
                            <td><?php echo htmlspecialchars($row['m_phone']); ?></td>
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
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="view-other-patient.php?o_id=<?php echo $row['o_id']; ?>">
                                            <i class="fa fa-eye m-r-5"></i> View
                                        </a>
                                        <a class="dropdown-item" href="print-other-experience.php?o_id=<?php echo $row['o_id']; ?>">
                                            <i class="fa fa-print m-r-5"></i> Print
                                        </a>
                                        <a class="dropdown-item" href="edit-other-patient.php?o_id=<?php echo $row['o_id']; ?>">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="?o_ids=<?php echo $row['o_id']; ?>" onclick="return confirmDelete();">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
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

    for (var i = 1; i < rows.length; i++) {
        var columns = rows[i].getElementsByTagName('td');
        var match = false;

        for (var j = 0; j < columns.length - 1; j++) { 
            if (columns[j].innerText.toLowerCase().indexOf(input) > -1) {
                match = true;
                break;
            }
        }

        rows[i].style.display = match ? '' : 'none';
    }
});

document.getElementById('statusFilter').addEventListener('change', function() {
    var selectedStatus = this.value.toLowerCase();
    var rows = document.querySelectorAll('.patient-row');

    rows.forEach(function(row) {
        var patientStatus = row.getAttribute('data-status').toLowerCase();

        if (selectedStatus === 'all' || patientStatus === selectedStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

window.onload = function() {
    document.getElementById('statusFilter').value = 'Active';
    var rows = document.querySelectorAll('.patient-row');
    rows.forEach(function(row) {
        if (row.getAttribute('data-status') !== 'Active') {
            row.style.display = 'none';
        }
    });
};
</script>
