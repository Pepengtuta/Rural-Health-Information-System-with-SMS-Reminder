<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Child Record</h4>
            </div>
        </div>

        <div class="row">
    <div class="col-sm-9">
        <input type="text" id="searchBar" class="form-control" placeholder="Search for mother by name, address, or phone..." onkeyup="filterTable()">
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
            <table class="datatable table table-stripped" id="babyTable">
                <thead>
                    <tr>
                        <th>Name of Child</th>
                        <th>Name of Mother</th>
                        <th>Name of Father</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    if (isset($_GET['b_id'])) {
        $b_id = $_GET['b_id'];
        $delete_query = mysqli_query($connection, "DELETE FROM tbl_baby WHERE b_id='$b_id'");
        if ($delete_query) {
            echo "<script>alert('Child record deleted successfully');</script>";
        } else {
            echo "<script>alert('Failed to delete child record');</script>";
        }
    }

    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_baby");
    while ($row = mysqli_fetch_array($fetch_query)) {
        // Check if the date of birth exists
        $dob = !empty($row['b_dob']) ? date('M. d, Y', strtotime($row['b_dob'])) : '';
    ?>
    <tr class="baby-row" data-status="<?php echo $row['baby_type']; ?>">
        <td><?php echo ($row['b_fname'] . " " . $row['b_lname']); ?></td>
        <td><?php echo ($row['b_mother']); ?></td>
        <td><?php echo ($row['b_father']); ?></td>
        <td><?php echo ($row['b_dob']); ?></td>
        <td>
            <span class="custom-badge <?php echo $row['baby_type'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                <?php echo $row['baby_type']; ?>
            </span>
        </td>
        <td>
            <div class="dropdown dropdown-action">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="view-single-baby.php?b_id=<?php echo $row['b_id']; ?>&b_number=<?php echo $row['b_number']; ?>&patient_name=<?php echo $row['b_fname'] . '_' . $row['b_lname']; ?>">
                        <i class="fa fa-eye m-r-5"></i> View Information
                    </a>
                    <a class="dropdown-item" href="update-baby.php?b_id=<?php echo $row['b_id']; ?>">
                        <i class="fa fa-pencil m-r-5"></i> Edit
                    </a>
                    <a class="dropdown-item" href="?b_id=<?php echo $row['b_id']; ?>" onclick="return confirmDelete()">
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
    return confirm('Are you sure you want to delete this child record?');
}

function filterTable() {
    var input = document.getElementById('searchBar').value.toLowerCase();
    var selectedStatus = document.getElementById('statusFilter').value.toLowerCase();
    var table = document.getElementById('babyTable');
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

        var patientStatus = rows[i].getAttribute('data-status').toLowerCase();

        if (match && (selectedStatus === 'all' || patientStatus === selectedStatus)) {
            rows[i].style.display = ''; 
        } else {
            rows[i].style.display = 'none'; 
        }
    }
}

window.onload = function() {
    filterTable();
};

</script>
