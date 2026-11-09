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

                    <div class="col-sm-4 ">
                        <h4 class="page-title">Update</h4>
                    </div>

                    <div class="col-sm-8  text-right m-b-20">
                        <a href="dashboard.php" class="btn btn-primary btn-rounded float-right">Back</a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
						<h4 class="page-title"></h4>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name </label>
                                        <input class="form-control" type="text" name="" > 
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Contact Number </label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                </div>

                            </div>
                    
                            <div class="col-sm-12">
                                <div class="m-t-20 text-center">
                                    <button type="submit" name="btn_update" class="btn btn-primary m-b-0">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                                
                               


                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg . '");';
        }
    ?>
</script>