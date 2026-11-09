
<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if (isset($_GET['b_id'])) {
    $b_id = $_GET['b_id'];
    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_baby WHERE b_id='$b_id'");
    $row = mysqli_fetch_assoc($fetch_query);
    if (!$row) {
        echo "No record found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Child Information</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="edit-baby.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div><br>
        <div class="row">
        <div class="col-lg-12">
        <div class="card-box p-4" style="border: 1px solid #ddd; box-shadow: 0px 3px 10px rgba(0,0,0,0.1);">
                                        <div class="text-center mb-4">
                        <div style="width: 200px; height: 200px; border: 1px solid #ddd; display: inline-block;">
                            <img src="<?php echo !empty($row['b_pic']) ? 'assets/img/logo/baby/' . $row['b_pic'] : 'assets/img/logo/baby/user.jpg'; ?>" 
                                alt="Profile Picture" 
                                class="img-fluid" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="details-grid mt-3">
                        <div>
                            <strong><i class="fas fa-user"></i> Name of Child:</strong>
                            <span><?php echo ($row['b_fname'] . ' ' . $row['b_lname']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-birthday-cake"></i> Date of Birth:</strong>
                            <span><?php echo ($row['b_dob']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-female"></i> Name of Mother:</strong>
                            <span><?php echo ($row['b_mother']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-male"></i> Name of Father:</strong>
                            <span><?php echo ($row['b_father']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-venus-mars"></i> Sex:</strong>
                            <span><?php echo ($row['b_sex']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-tint"></i> Blood Type:</strong>
                            <span><?php echo ($row['b_bloodtype']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-baby"></i> Type of Delivery:</strong>
                            <span><?php echo ($row['b_tod']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-check-circle"></i> Accurate Month of Giving Birth:</strong>
                            <span><?php echo ($row['b_accurate']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-users"></i> Single or Twins Births:</strong>
                            <span><?php echo ($row['b_sotb']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-user-md"></i> Name of Midwife:</strong>
                            <span><?php echo ($row['b_nom']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-weight"></i> Birth Weight:</strong>
                            <span><?php echo ($row['b_bweight']); ?> kg</span>
                        </div>
                        <div>
                            <strong><i class="fas fa-ruler"></i> Body Length:</strong>
                            <span><?php echo ($row['b_blength']); ?> cm</span>
                        </div>
                        <div>
                            <strong><i class="fas fa-head-side"></i> Circular Head Size:</strong>
                            <span><?php echo ($row['b_cheadsize']); ?> cm</span>
                        </div>
                        <div>
                            <strong><i class="fas fa-ruler-horizontal"></i> Chest Circumference:</strong>
                            <span><?php echo ($row['b_cc']); ?> cm</span>
                        </div>
                        <div>
                            <strong><i class="fas fa-child"></i> Number of Children:</strong>
                            <span><?php echo ($row['b_hmcdyh']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-calendar-check"></i> Birth Registration Date:</strong>
                            <span><?php echo ($row['b_dobr']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-home"></i> Address:</strong>
                            <span><?php echo ($row['b_address']); ?></span>
                        </div>
                        <div>
                            <strong><i class="fas fa-exclamation-triangle"></i> Unfortunate Events (illness or death):</strong>
                            <span><?php echo ($row['b_list']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<style>
    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
    }
    @media (max-width: 768px) {
        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
