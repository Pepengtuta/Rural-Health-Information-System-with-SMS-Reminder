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
                <h4 class="page-title">Staff</h4>
            </div>
            <?php if ($_SESSION['role'] == 1) { ?>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-employee.php" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Staff</a>
            </div>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Bio</th>
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

                    // Restrict fetch query based on user role
                    $role_condition = ($_SESSION['role'] == 1) ? "role IN (1, 3)" : "role = 3"; 
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE $role_condition");

                    while ($row = mysqli_fetch_array($fetch_query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                        <td><?php echo $row['emailid']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['bio']; ?></td>
                        <td>
                            <?php if ($row['role'] == 3) { ?>
                                <span class="custom-badge status-green">Staff</span>
                            <?php } elseif ($row['role'] == 2) { ?>
                                <span class="custom-badge status-blue">Midwife</span>
                            <?php } elseif ($row['role'] == 1 && $_SESSION['role'] == 1) { ?>
                                <span class="custom-badge status-grey">Admin</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="view-employee.php?id=<?php echo $row['id']; ?>"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['username'] == $row['username']) { ?>
                                        <a class="dropdown-item" href="edit-employee.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <?php } ?>
                                    <?php if ($_SESSION['role'] == 1) { ?>
                                        <a class="dropdown-item" href="employees.php?ids=<?php echo $row['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    <?php } ?>
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
    return confirm('Are you sure you want to delete this Employee?');
}
</script>
