<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
                <div class="table-responsive">
    <table class="datatable table table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['ids'])) {
                $id = $_GET['ids'];
                $delete_query = mysqli_query($connection, "DELETE FROM tbl_employee WHERE id='$id'");
            }
            $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE role IN (2, 3)"); // Only fetch rows where role is 2 or 3
            while ($row = mysqli_fetch_array($fetch_query)) {
            ?>
                <tr>
                    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['emailid']; ?></td>
                    <td>
                        <?php if ($row['role'] == 3) { ?>
                            <span class="custom-badge status-green">Staff</span>
                        <?php } else if ($row['role'] == 2) { ?>
                            <span class="custom-badge status-blue">Midwife</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="edit-change-password.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                            Change Password
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
<script language="JavaScript" type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure want to delete this Employee?');
    }
</script>
