<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}

include('header.php');
include('includes/connection.php');

if (isset($_GET['second_ids'])) {
    $id = intval($_GET['second_ids']);
    $delete_query = mysqli_prepare($connection, "DELETE FROM tbl_second_trimester WHERE second_id=?");
    mysqli_stmt_bind_param($delete_query, "i", $id);
    if (mysqli_stmt_execute($delete_query)) {
        echo "<p class='text-success'>Record deleted successfully.</p>";
    } else {
        echo "<p class='text-danger'>Error deleting record: " . mysqli_error($connection) . "</p>";
    }
    mysqli_stmt_close($delete_query);
}

$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_second_trimester");
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Manage Monthly Check-up (Second Trimester)</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Control Number</th>
                        <th>Weight</th>
                        <th>Height</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['second_m_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['second_m_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['sec_weight']); ?></td>
                        <td><?php echo htmlspecialchars($row['sec_height']); ?></td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="manage-patient-second-trimester.php?second_id=<?php echo urlencode($row['second_id']); ?>"><i class="fa fa-pencil m-r-5"></i>
                                        Edit
                                    </a>
                                    <a class="dropdown-item" href="?second_ids=<?php echo urlencode($row['second_id']); ?>" onclick="return confirmDelete();">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    mysqli_free_result($fetch_query); 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<script language="JavaScript" type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this Second Trimester Record?');
}
</script>
