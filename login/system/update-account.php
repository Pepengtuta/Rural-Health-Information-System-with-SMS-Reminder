<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
    exit; 
}
include('header.php');
include('includes/connection.php');

function validate_file_upload($file) {
    $allowed_types = array("image/jpeg", "image/png");
    if (in_array($file["type"], $allowed_types)) {
        return true;
    }
    return false;
}

if (isset($_POST['update_profile'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $id = $_SESSION['id'];
    $emailid = $_POST['emailid'];
    $pic = $_FILES["pic"]["name"];
    
    if (!validate_file_upload($_FILES["pic"])) {
        $err = "Invalid file type";
    } else {
        move_uploaded_file($_FILES["pic"]["tmp_name"], "assets/img/users/" . $_FILES["pic"]["name"]);
        
        $query = "UPDATE tbl_employee SET first_name=?, last_name=?, emailid=?, pic=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        if ($stmt === false) {
            die("Failed to prepare the SQL statement: " . $mysqli->error);
        }
        $stmt->bind_param('ssssi', $first_name, $last_name, $emailid, $pic, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $success = "Profile Updated";
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}

if (isset($_POST['update_pwd'])) {
    $username = $_SESSION['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $query = "UPDATE tbl_employee SET password=? WHERE username=?";
    $stmt = $mysqli->prepare($query);
    if ($stmt === false) {
        die("Failed to prepare the SQL statement: " . $mysqli->error);
    }
    $stmt->bind_param('ss', $password, $username);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $success = "Password Updated";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}
?>
        <div class="page-wrapper">
        <?php
                $id=$_SESSION['id'];
                $ret="SELECT * FROM  tbl_employee where id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>

                <div class="content-page">
                    <div class="content">

                        <!-- Start Content-->
                        <div class="container-fluid">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                                <li class="breadcrumb-item active">Profile</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title"><?php echo $row->first_name;?> <?php echo $row->last_name;?>'s Profile</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="../system/assets/img/users/<?php echo $row->pic;?>" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    
                                    <div class="text-centre mt-3">
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Employee Full Name :</strong> <span class="ml-2"><?php echo $row->first_name;?> <?php echo $row->last_name;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Employee Username :</strong> <span class="ml-2"><?php echo $row->username;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Employee Email :</strong> <span class="ml-2"><?php echo $row->emailid;?></span></p>
                </div>
                </div>

                                </div> 

                            </div> 

                            <div class="col-lg-8 col-xl-8">
    <div class="card-box">
        <ul class="nav nav-pills navtab-bg nav-justified">
            <li class="nav-item">
                <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    Update Profile
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                    Change Password
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="aboutme">
                <form method="post" enctype="multipart/form-data">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aboutme_first_name">First Name</label>
                                <input type="text" name="first_name"  class="form-control" id="aboutme_first_name" placeholder="<?php echo $row->first_name;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aboutme_last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="aboutme_last_name" placeholder="<?php echo $row->last_name;?>">
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aboutme_emailid">Email Address</label>
                                <input type="email" name="emailid" class="form-control" id="aboutme_emailid" placeholder="<?php echo $row->emailid;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aboutme_pic">Profile Picture</label>
                                <input type="file" name="pic" class="form-control btn btn-success" id="aboutme_pic" >
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="text-right">
                        <button type="submit" name="update_profile" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                    </div>
                </form>
            </div> 
         

           

            <div class="tab-pane" id="settings">
                <form method="post">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="password" id="new_password" placeholder="Enter New Password">
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
                    </div>

                    <div class="text-right">
                        <button type="submit" name="update_pwd" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update Password</button>
                    </div>
                </form>
            </div>

        </div> 


</div> 
</div>

</div>
            
</div>

<?php 
include('footer.php');
?>

                </div>
                </div>
        <?php
    }
    ?>
</div>