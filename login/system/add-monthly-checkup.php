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
                <h4 class="page-title">Add Monthly Check-Up</h4>
            </div>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Add Record</th>
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

                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_patients");
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $dob = $row['m_dob'];
                        $date = str_replace('/', '-', $dob);
                        $dob = date('Y-m-d', strtotime($date));
                        $year = (date('Y') - date('Y', strtotime($dob)));
                    ?>
                        <tr>
                            <td><?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?></td>
                            <td><?php echo $year; ?></td>
                            <td><?php echo $row['addr']; ?></td>
                            <td><?php echo $row['m_phone']; ?></td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="add-patient-first-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                     First Trimester
                                </a>
                                <a href="add-patient-second-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item" class="dropdown-item">
                                     Second Trimester
                                </a>
                                <a href="add-patient-third-trimester.php?id=<?php echo $row['id']; ?>&m_number=<?php echo $row['m_number']; ?>&patient_name=<?php echo $row['m_first_name'] . '_' . $row['m_last_name']; ?>" class="dropdown-item">
                                     Third Trimester
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
</script>
