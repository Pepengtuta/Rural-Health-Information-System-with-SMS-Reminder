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
                        <h4 class="page-title">Schedule</h4>
                    </div>
                    <?php 
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-schedule.php" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Schedule</a>
                    </div>
                    <?php } ?>
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Midwife Name</th>
                                            <th>Available Days</th>
                                            <th>Available Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['ids'])){
                                        $id = $_GET['ids'];
                                        $delete_query = mysqli_query($connection, "delete from tbl_schedule where id='$id'");
                                        }
                                        $fetch_query = mysqli_query($connection, "select * from tbl_schedule");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['doctor_name']; ?></td>
                                            <td><?php echo $row['available_days']; ?></td>
                                            <td><?php echo $row['start_time'].' - '.$row['end_time']; ?></td>
                                            <?php if($row['status']==1) { ?>
                                            <td><span class="custom-badge status-green">Active</span></td>
                                        <?php } else {?>
                                            <td><span class="custom-badge status-red">Inactive</span></td>
                                        <?php } ?>
                                            <td>
                                            <div class="dropdown dropdown-action">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="view-schedule.php?id=<?php echo $row['id'];?>"><i class="fa fa-eye m-r-5"></i> View</a>
                                                    <a class="dropdown-item" href="edit-schedule.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                                        <a class="dropdown-item" href="schedule.php?ids=<?php echo $row['id'];?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
		
   
<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Schedule?');
}
</script>