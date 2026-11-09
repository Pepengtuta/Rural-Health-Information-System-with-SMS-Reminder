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
            <div class="col-sm-4 col-3">
                <h4 class="page-title">View Child Details</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20"></div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name of Mother</th>
                        <th>Name of Father</th>
                        <th>Name of Child</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['b_ids'])) {
                        $b_id = $_GET['b_ids'];
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_baby WHERE b_id='$b_id'");
                    }
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_baby");
                    while ($row = mysqli_fetch_array($fetch_query)) {
                    ?>
                        <tr>
                            <td><?php echo $row['b_mother']; ?></td>
                            <td><?php echo $row['b_father']; ?></td>
                            <td><?php echo $row['b_fname'] . " " . $row['b_lname']; ?></td>
                            <td><?php echo $row['b_dob']; ?></td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="view-single-baby.php?b_id=<?php echo $row['b_id']; ?>&b_number=<?php echo $row['b_number']; ?>&patient_name=<?php echo $row['b_fname'] . '_' . $row['b_lname']; ?>"><i class="fa fa-eye m-r-5"></i>
                                            View Information
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
</script>
