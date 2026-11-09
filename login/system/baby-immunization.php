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
                <h4 class="page-title">Child's Immunization Record</h4>
            </div>
            <?php 
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="register-immunization.php" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i> Register Child's Immunization
                    </a>
                </div>
            <?php } ?>
        </div>

        <!-- Filter Dropdown and Search Bar -->
        <div class="row m-b-20">
            <div class="col-sm-9">
                <input type="text" id="searchBar" class="form-control" placeholder="Search by name, immunization name..." onkeyup="filterTable()">
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
            <table class="datatable table table-striped table-condensed" id="immunizationTable">
                <thead>
                    <tr>
                        <th>Name of Child</th>
                        <th>Status</th>
                        <th>BCG</th>
                        <th>HEPATITIS B</th>
                        <th>DPT</th>
                        <th>OPV</th>
                        <th>IPV</th>
                        <th>PCV</th>
                        <th>MMR</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Handle deletion of tbl_immunization
                    if (isset($_GET['i_ids'])) {
                        $i_id = mysqli_real_escape_string($connection, $_GET['i_ids']);
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_immunization WHERE i_id = '$i_id'");
                        if ($delete_query) {
                            echo "<script>alert('Record deleted successfully');</script>";
                        } else {
                            echo "<script>alert('Failed to delete record');</script>";
                        }
                    }

                    // Fetch records from the database
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_immunization");
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $name_parts = explode(",", $row['i_name']);
                        $i_name = $name_parts[0];

                        // Format the date fields
                        $bcg_date = !empty($row['i_bcg_d1']) ? date('M. d, Y', strtotime($row['i_bcg_d1'])) : '';
                        $hep_date = !empty($row['i_hep_d1']) ? date('M. d, Y', strtotime($row['i_hep_d1'])) : '';
                        $dpt_date = !empty($row['i_dpt_d1']) ? date('M. d, Y', strtotime($row['i_dpt_d1'])) : '';
                        $opv_date = !empty($row['i_opv_d1']) ? date('M. d, Y', strtotime($row['i_opv_d1'])) : '';
                        $ipv_date = !empty($row['i_ipv_d1']) ? date('M. d, Y', strtotime($row['i_ipv_d1'])) : '';
                        $pcv_date = !empty($row['i_pcv_d1']) ? date('M. d, Y', strtotime($row['i_pcv_d1'])) : '';
                        $mmr_date = !empty($row['i_mmr_d1']) ? date('M. d, Y', strtotime($row['i_mmr_d1'])) : '';
                    ?>
                        <tr class="immunization-row" data-status="<?php echo htmlspecialchars($row['stat']); ?>">
                            <td><?php echo htmlspecialchars($i_name); ?></td>
                            <td>
                                <span class="custom-badge <?php echo $row['stat'] == 'Active' ? 'status-green' : 'status-red'; ?>">
                                    <?php echo $row['stat']; ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($bcg_date); ?></td>
                            <td><?php echo htmlspecialchars($hep_date); ?></td>
                            <td><?php echo htmlspecialchars($dpt_date); ?></td>
                            <td><?php echo htmlspecialchars($opv_date); ?></td>
                            <td><?php echo htmlspecialchars($ipv_date); ?></td>
                            <td><?php echo htmlspecialchars($pcv_date); ?></td>
                            <td><?php echo htmlspecialchars($mmr_date); ?></td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="view-immunization.php?i_id=<?php echo $row['i_id']; ?>">
                                            <i class="fa fa-eye m-r-5"></i> View
                                        </a>
                                        <a class="dropdown-item" href="print_immunization.php?i_id=<?php echo $row['i_id']; ?>">
                                            <i class="fa fa-print m-r-5"></i> Print
                                        </a>
                                        <a class="dropdown-item" href="edit-immunization.php?i_id=<?php echo $row['i_id']; ?>">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="?i_ids=<?php echo $row['i_id']; ?>" onclick="return confirmDelete();">
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
    var table = document.getElementById('immunizationTable');
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

        var recordStatus = rows[i].getAttribute('data-status').toLowerCase();

        if (match && (selectedStatus === 'all' || recordStatus === selectedStatus)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

window.onload = filterTable;
</script>
