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
                <h4 class="page-title">Midwife</h4>
            </div>
            <?php if ($_SESSION['role'] == 1) { ?>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-doctor.php" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Midwife</a>
            </div>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-striped">
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
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE role=2");                    
                    
                    while ($row = mysqli_fetch_array($fetch_query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                        <td><?php echo $row['emailid']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['bio']; ?></td>
                        <td>
                            <?php if ($row['role'] == 2) { ?>
                                <span class="custom-badge status-blue">Midwife</span>
                            <?php } elseif ($row['role'] == 3) { ?>
                                <span class="custom-badge status-green">Other Role</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="view-doctors.php?id=<?php echo $row['id']; ?>"><i class="fa fa-eye m-r-5"></i> View</a>
                                    
                                    <?php 
                                    // Show Edit button if user is an admin or if the logged-in user's username matches the row's username
                                    if ($_SESSION['role'] == 1 || $_SESSION['username'] == $row['username']) { ?>
                                        <a class="dropdown-item" href="edit-doctor.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <?php } ?>
                                    
                                    <?php 
                                    // Show Delete button if user is an admin
                                    if ($_SESSION['role'] == 1) { ?>
                                        <a class="dropdown-item" href="doctors.php?ids=<?php echo $row['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
    return confirm('Are you sure you want to delete this Midwife?');
}
</script>
