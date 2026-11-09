<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Experience with Previous Pregnancies and Births</h4>
            </div>
            <?php 
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="add-experience-patient.php" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i> Add Information
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
                    // Handle deletion of tbl_experiences
                    if (isset($_GET['e_ids'])) {
                        $e_id = mysqli_real_escape_string($connection, $_GET['e_ids']);
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_experiences WHERE e_id = '$e_id'");
                        if ($delete_query) {
                            echo "<script>alert('Record deleted successfully');</script>";
                        } else {
                            echo "<script>alert('Failed to delete record');</script>";
                        }
                    }

                    // Fetch records from the database
                    $fetch_query = mysqli_query($connection, "
                        SELECT 
                            e.e_id, 
                            p.m_first_name, 
                            p.m_last_name, 
                            p.m_age,           -- For calculating age
                            p.addr,          -- Address field
                            p.m_phone,        -- Phone field
                            p.patient_type 

                        FROM 
                            tbl_experiences e
                        JOIN 
                            tbl_patients p 
                        ON 
                            e.e_name = p.m_number
                    ");

                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $full_name = htmlspecialchars($row['m_first_name'] . ' ' . $row['m_last_name']);
                    ?>
                        <tr class="patient-row" data-status="<?php echo $row['patient_type']; ?>" style="display: <?php echo ($row['patient_type'] == 'Active' ? 'table-row' : 'none'); ?>">
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
                                    <a class="dropdown-item" href="view-experience-patient.php?e_id=<?php echo $row['e_id']; ?>">
                                        <i class="fa fa-eye m-r-5"></i> View
                                    </a>
                                    <a class="dropdown-item" href="print-experience-patient.php?e_id=<?php echo $row['e_id']; ?>">
                                        <i class="fa fa-print m-r-5"></i> Print
                                    </a>
                                    <a class="dropdown-item" href="edit-experience-patient.php?e_id=<?php echo $row['e_id']; ?>">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="?e_ids=<?php echo $row['e_id']; ?>" onclick="return confirmDelete();">
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
    return confirm('Are you sure you want to delete this record?');
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