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
                <h4 class="page-title">Third Trimester</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-12">
                <input type="text" id="searchBar" class="form-control" placeholder="Search for mother by name, address, or phone..." onkeyup="searchTable()">
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table id="patientsTable" class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>First Check-Up</th>
                        <th>Second Check-Up</th>
                        <th>Third Check-Up</th>
                    </tr>
                </thead>
                <tbody>
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

                    $fetch_query = mysqli_query($connection, "
                    SELECT p.*, t.third_number 
                    FROM tbl_patients p 
                    LEFT JOIN tbl_third_trimester t ON p.m_number = t.third_m_number
                ");
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $dob = $row['m_dob'];
                        $date = str_replace('/', '-', $dob);
                        $dob = date('Y-m-d', strtotime($date));
                        $year = (date('Y') - date('Y', strtotime($dob)));
                    ?>
                        <tr>
                            <td><?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?></td>
                            <td><?php echo $year; // Calculated age ?></td>
                            <td><?php echo $row['addr']; ?></td>
                            <td><?php echo $row['m_phone']; ?></td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFirstCheckup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownFirstCheckup">
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <a href="add-patient-third-first.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-plus m-r-5"></i> Create Record</a>
                                        <?php } ?>
                                    <a href="view-patient-third-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                        <i class="fa fa-eye m-r-5"></i>View</a>
                                    <a href="edit-patient-third-first.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="" onclick="return confirmDelete();"><i class="fa fa-trash m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFirstCheckup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownFirstCheckup">
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <a href="add-patient-third-first.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-plus m-r-5"></i> Create Record</a>
                                        <?php } ?>
                                    <a href="view-patient-third2-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                        <i class="fa fa-eye m-r-5"></i>View</a>
                                    <a href="edit-patient-third-second.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="" onclick="return confirmDelete();"><i class="fa fa-trash m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFirstCheckup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownThirdCheckup">
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <a href="add-patient-third-first.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-plus m-r-5"></i> Create Record</a>
                                        <?php } ?>
                                    <a href="view-patient-third3-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                        <i class="fa fa-eye m-r-5"></i>View</a>
                                    <a href="edit-patient-third-third.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>" class="dropdown-item">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="" onclick="return confirmDelete();"><i class="fa fa-trash m-r-5"></i> Delete</a>
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

function searchTable() {
    let input = document.getElementById('searchBar');
    let filter = input.value.toLowerCase();
    let table = document.getElementById('patientsTable');
    let trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
        let tds = trs[i].getElementsByTagName('td');
        let rowVisible = false;

        for (let j = 0; j < tds.length; j++) {
            let td = tds[j];
            if (td) {
                if (td.innerText.toLowerCase().indexOf(filter) > -1) {
                    rowVisible = true;
                }
            }
        }

        trs[i].style.display = rowVisible ? "" : "none";
    }
}
</script>
