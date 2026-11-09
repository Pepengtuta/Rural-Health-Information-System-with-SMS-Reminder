<?php
session_start();
if (empty($_SESSION['name']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 3)) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$fetch_query = mysqli_query($connection, "SELECT MAX(i_id) as i_id FROM tbl_immunization");
$row = mysqli_fetch_row($fetch_query);

if (isset($_REQUEST['register-immunization'])) {
    $i_name = $_REQUEST['i_name'];
    $i_gender = $_REQUEST['i_gender'];
    $i_number = $_REQUEST['i_number'];

    $i_bcg_d1 = !empty($_REQUEST['i_bcg_d1']) ? "'".$_REQUEST['i_bcg_d1']."'" : "NULL";
    $i_bcg_rem = $_REQUEST['i_bcg_rem'];
    $i_hep_d1 = !empty($_REQUEST['i_hep_d1']) ? "'".$_REQUEST['i_hep_d1']."'" : "NULL";
    $i_hep_rem = $_REQUEST['i_hep_rem'];
    $i_dpt_d1 = !empty($_REQUEST['i_dpt_d1']) ? "'".$_REQUEST['i_dpt_d1']."'" : "NULL";
    $i_dpt_rem1 = $_REQUEST['i_dpt_rem1'];
    $i_dpt_d2 = !empty($_REQUEST['i_dpt_d2']) ? "'".$_REQUEST['i_dpt_d2']."'" : "NULL";
    $i_dpt_rem2 = $_REQUEST['i_dpt_rem2'];
    $i_dpt_d3 = !empty($_REQUEST['i_dpt_d3']) ? "'".$_REQUEST['i_dpt_d3']."'" : "NULL";
    $i_dpt_rem3 = $_REQUEST['i_dpt_rem3'];
    $i_opv_d1 = !empty($_REQUEST['i_opv_d1']) ? "'".$_REQUEST['i_opv_d1']."'" : "NULL";
    $i_opv_rem1 = $_REQUEST['i_opv_rem1'];
    $i_opv_d2 = !empty($_REQUEST['i_opv_d2']) ? "'".$_REQUEST['i_opv_d2']."'" : "NULL";
    $i_opv_rem2 = $_REQUEST['i_opv_rem2'];
    $i_opv_d3 = !empty($_REQUEST['i_opv_d3']) ? "'".$_REQUEST['i_opv_d3']."'" : "NULL";
    $i_opv_rem3 = $_REQUEST['i_opv_rem3'];
    $i_ipv_d1 = !empty($_REQUEST['i_ipv_d1']) ? "'".$_REQUEST['i_ipv_d1']."'" : "NULL";
    $i_ipv_rem = $_REQUEST['i_ipv_rem'];
    $i_pcv_d1 = !empty($_REQUEST['i_pcv_d1']) ? "'".$_REQUEST['i_pcv_d1']."'" : "NULL";
    $i_pcv_rem1 = $_REQUEST['i_pcv_rem1'];
    $i_pcv_d2 = !empty($_REQUEST['i_pcv_d2']) ? "'".$_REQUEST['i_pcv_d2']."'" : "NULL";
    $i_pcv_rem2 = $_REQUEST['i_pcv_rem2'];
    $i_pcv_d3 = !empty($_REQUEST['i_pcv_d3']) ? "'".$_REQUEST['i_pcv_d3']."'" : "NULL";
    $i_pcv_rem3 = $_REQUEST['i_pcv_rem3'];
    $i_mmr_d1 = !empty($_REQUEST['i_mmr_d1']) ? "'".$_REQUEST['i_mmr_d1']."'" : "NULL";
    $i_mmr_rem1 = $_REQUEST['i_mmr_rem1'];
    $i_mmr_d2 = !empty($_REQUEST['i_mmr_d2']) ? "'".$_REQUEST['i_mmr_d2']."'" : "NULL";
    $i_mmr_rem2 = $_REQUEST['i_mmr_rem2'];
    $i_other_name1 = $_REQUEST['i_other_name1'];
    $i_other_d1 = !empty($_REQUEST['i_other_d1']) ? "'".$_REQUEST['i_other_d1']."'" : "NULL";
    $i_other_rem1 = $_REQUEST['i_other_rem1'];
    $i_other_name2 = $_REQUEST['i_other_name2'];
    $i_other_d2 = !empty($_REQUEST['i_other_d2']) ? "'".$_REQUEST['i_other_d2']."'" : "NULL";
    $i_other_rem2 = $_REQUEST['i_other_rem2'];

    // Check for duplicate name
    $check_query = mysqli_query($connection, "SELECT * FROM tbl_immunization WHERE i_name='$i_name'");
    if (mysqli_num_rows($check_query) > 0) {
        $msg = "Child name already exists.";
    } else {
        $insert_query = mysqli_query($connection, "INSERT INTO tbl_immunization SET 
            i_name = '$i_name',
            i_gender = '$i_gender',
            i_number = '$i_number',
            i_bcg_d1 = $i_bcg_d1,
            i_bcg_rem = '$i_bcg_rem',
            i_hep_d1 = $i_hep_d1,
            i_hep_rem = '$i_hep_rem',
            i_dpt_d1 = $i_dpt_d1,
            i_dpt_rem1 = '$i_dpt_rem1',
            i_dpt_d2 = $i_dpt_d2,
            i_dpt_rem2 = '$i_dpt_rem2',
            i_dpt_d3 = $i_dpt_d3,
            i_dpt_rem3 = '$i_dpt_rem3',
            i_opv_d1 = $i_opv_d1,
            i_opv_rem1 = '$i_opv_rem1',
            i_opv_d2 = $i_opv_d2,
            i_opv_rem2 = '$i_opv_rem2',
            i_opv_d3 = $i_opv_d3,
            i_opv_rem3 = '$i_opv_rem3',
            i_ipv_d1 = $i_ipv_d1,
            i_ipv_rem = '$i_ipv_rem',
            i_pcv_d1 = $i_pcv_d1,
            i_pcv_rem1 = '$i_pcv_rem1',
            i_pcv_d2 = $i_pcv_d2,
            i_pcv_rem2 = '$i_pcv_rem2',
            i_pcv_d3 = $i_pcv_d3,
            i_pcv_rem3 = '$i_pcv_rem3',
            i_mmr_d1 = $i_mmr_d1,
            i_mmr_rem1 = '$i_mmr_rem1',
            i_mmr_d2 = $i_mmr_d2,
            i_mmr_rem2 = '$i_mmr_rem2',
            i_other_name1 = '$i_other_name1',
            i_other_d1 = $i_other_d1,
            i_other_rem1 = '$i_other_rem1',
            i_other_name2 = '$i_other_name2',
            i_other_d2 = $i_other_d2,
            i_other_rem2 = '$i_other_rem2',
            stat = '$stat'

        ");

        if ($insert_query) {
            $msg = "Record created successfully";
        } else {
            $msg = "Error!";
        }
    }
}
?>


<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Add Child Immunization Record</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="baby-immunization.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Full Name</label>
                                <select class="select" name="i_name" required>
                                            <option value="">Select</option>
                                        <?php
                                        $fetch_query = mysqli_query($connection, "select concat(b_fname,' ',b_lname) as name from tbl_baby");
                                        while($row = mysqli_fetch_array($fetch_query)){
                                        ?>
                                            
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="select" name="i_gender" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <?php
                        $length = 4;
                        $i_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                        ?>
                        <label for="inputZip" class="col-form-label">Baby Number</label>
                        <input type="text" name="i_number" value="<?php echo $i_number; ?>" class="form-control" id="inputZip">
                    </div>

                    <h4>BCG</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" value="1 dose">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_bcg_d1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_bcg_rem">
                            </div>
                        </div>
                    </div>

                    <h4>HEPATITIS B</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="1 dose">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_hep_d1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_hep_rem">
                            </div>
                        </div>
                    </div>

                    <h4>PENTAVALENT VACCINE (DPT-Hep B-HiB)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_dpt_d1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_dpt_rem1" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_dpt_d2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_dpt_rem2" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_dpt_d3">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_dpt_rem3">
                            </div>
                        </div>
                    </div>

                    <h4>ORAL POLIO VACCINE (OPV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_opv_d1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_opv_rem1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_opv_d2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_opv_rem2" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_opv_d3" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_opv_rem3" >
                            </div>
                        </div>
                    </div>

                    <h4>INACTIVATED POLIO VACCINE (IPV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="1 dose">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_ipv_d1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_ipv_rem" >
                            </div>
                        </div>
                    </div>

                    <h4>PNEUMOCOCCAL CONJUGATE VACCINE (PCV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_pcv_d1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_pcv_rem1" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_pcv_d2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_pcv_rem2" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_pcv_d3" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_pcv_rem3" >
                            </div>
                        </div>
                    </div>

                    <h4>MEASLES, MUMPS, RUBELLA (MMR)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="2 doses">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_mmr_d1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_mmr_rem1" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_mmr_d2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_mmr_rem2" >
                            </div>
                        </div>
                    </div>


                    <h4>OTHER VACCINE</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="i_other_name1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_other_d1" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_other_rem1" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_other_name2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_other_d2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_other_rem2" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select" name="stat" required>
                                    <option value="">Select</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group text-center">
                        <button name="register-immunization" class="btn btn-primary submit-btn">Save Vaccination Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php'); ?>

<script type="text/javascript">
    <?php if (isset($msg)) {
        echo 'swal("' . htmlspecialchars($msg) . '");';
    } ?>
</script>