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
                        <h4 class="page-title">Manage Monthly Check-up</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="register-patient.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Information</a>
                    </div>
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['ids'])){
                                        $id = $_GET['ids'];
                                        $delete_query = mysqli_query($connection, "delete from tbl_patients where id='$id'");
                                        }
                                        $fetch_query = mysqli_query($connection, "select * from tbl_patients");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                            $dob = $row['m_dob'];
                                            $date = str_replace('/', '-', $dob); 
                                            $dob = date('Y-m-d', strtotime($date));
                                            $year = (date('Y') - date('Y',strtotime($dob)));
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $row['m_first_name']." ".$row['m_last_name']; ?></td>
                                            <td><?php echo $row['m_age']; ?></td>
                                            <td><?php echo $row['addr']; ?></td>
                                            <td><?php echo $row['m_phone']; ?></td>
                                            <td>
                                                          <a href="manage-patient-first-trimester.php" class="badge badge-success"><i class="mdi mdi-eye"></i> 1st Trimester</a>
														  <a href="manage-patient-second-trimester.php" class="badge badge-success"><i class="mdi mdi-eye"></i> 2nd Trimester</a>
														  <a href="manage-patient-third-trimester.php" class="badge badge-success"><i class="mdi mdi-eye"></i>  3rd Trimester</a>
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
    return confirm('Are you sure want to delete this Patient?');
}
</script>
</script>