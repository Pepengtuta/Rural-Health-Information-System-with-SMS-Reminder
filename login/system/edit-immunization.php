<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
?>

<?php
// Check if ID is passed and fetch data
if (isset($_GET['i_id'])) {
    $patient_id = $_GET['i_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_immunization WHERE i_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Populate variables with existing data
        extract($row);
    } else {
        echo "No patient found!";
        exit();
    }
}

if (isset($_POST['edit-immunization'])) {
    // Get updated data from form
    extract($_POST);

    // Handle null values for date fields
    $i_bcg_d1 = !empty($i_bcg_d1) ? "'$i_bcg_d1'" : "NULL";
    $i_hep_d1 = !empty($i_hep_d1) ? "'$i_hep_d1'" : "NULL";
    $i_dpt_d1 = !empty($i_dpt_d1) ? "'$i_dpt_d1'" : "NULL";
    $i_dpt_d2 = !empty($i_dpt_d2) ? "'$i_dpt_d2'" : "NULL";
    $i_dpt_d3 = !empty($i_dpt_d3) ? "'$i_dpt_d3'" : "NULL";
    $i_opv_d1 = !empty($i_opv_d1) ? "'$i_opv_d1'" : "NULL";
    $i_opv_d2 = !empty($i_opv_d2) ? "'$i_opv_d2'" : "NULL";
    $i_opv_d3 = !empty($i_opv_d3) ? "'$i_opv_d3'" : "NULL";
    $i_ipv_d1 = !empty($i_ipv_d1) ? "'$i_ipv_d1'" : "NULL";
    $i_pcv_d1 = !empty($i_pcv_d1) ? "'$i_pcv_d1'" : "NULL";
    $i_pcv_d2 = !empty($i_pcv_d2) ? "'$i_pcv_d2'" : "NULL";
    $i_pcv_d3 = !empty($i_pcv_d3) ? "'$i_pcv_d3'" : "NULL";
    $i_mmr_d1 = !empty($i_mmr_d1) ? "'$i_mmr_d1'" : "NULL";
    $i_mmr_d2 = !empty($i_mmr_d2) ? "'$i_mmr_d2'" : "NULL";
    $i_other_d1 = !empty($i_other_d1) ? "'$i_other_d1'" : "NULL";
    $i_other_d2 = !empty($i_other_d2) ? "'$i_other_d2'" : "NULL";

    // Update query with NULL handling for date fields
    $update_query = mysqli_query($connection, 
        "UPDATE tbl_immunization SET
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
        WHERE i_id='$patient_id'"
    );

    // Check query success
    if (mysqli_affected_rows($connection) > 0) {
        $msg = "Record updated successfully";
    } else {
        $msg = "Error updating record!";
    }
}
?>


<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Manage Child Immunization Record</h4>
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
                                <input class="form-control" type="text" name="i_name" value="<?php echo $i_name; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="select" name="i_gender">
                                    <option value="">Select</option>
                                    <option <?php if ($i_gender == "Male") echo "selected"; ?>>Male</option>
                                    <option <?php if ($i_gender == "Female") echo "selected"; ?>>Female</option>
                                </select>                           
                             </div>
                        </div>
                    </div>

                    <h4 class="mt-4">BCG</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="1 dose" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_bcg_d1" value="<?php echo $i_bcg_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_bcg_rem" value="<?php echo $i_bcg_rem; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">HEPATITIS B</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="1 dose" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_hep_d1" value="<?php echo $i_hep_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_hep_rem" value="<?php echo $i_hep_rem; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">PENTAVALENT VACCINE (DPT-Hep B-HiB)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_dpt_d1" value="<?php echo $i_dpt_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_dpt_rem1" value="<?php echo $i_dpt_rem1; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_dpt_d2" value="<?php echo $i_dpt_d2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_dpt_rem2" value="<?php echo $i_dpt_rem2; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_dpt_d3" value="<?php echo $i_dpt_d3; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_dpt_rem3" value="<?php echo $i_dpt_rem3; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">ORAL POLIO VACCINE (OPV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_opv_d1" value="<?php echo $i_opv_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_opv_rem1" value="<?php echo $i_opv_rem1; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_opv_d2" value="<?php echo $i_opv_d2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_opv_rem2" value="<?php echo $i_opv_rem2; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_opv_d3" value="<?php echo $i_opv_d3; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_opv_rem3" value="<?php echo $i_opv_rem3; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">INACTIVATED POLIO VACCINE (IPV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="1 dose" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_ipv_d1" value="<?php echo $i_ipv_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_ipv_rem" value="<?php echo $i_ipv_rem; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">PNEUMOCOCCAL CONJUGATE VACCINE (PCV)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="3 doses" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_pcv_d1" value="<?php echo $i_pcv_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_pcv_rem1" value="<?php echo $i_pcv_rem1; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_pcv_d2" value="<?php echo $i_pcv_d2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_pcv_rem2" value="<?php echo $i_pcv_rem2; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_pcv_d3" value="<?php echo $i_pcv_d3; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_pcv_rem3" value="<?php echo $i_pcv_rem3; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">MEASLES, MUMPS, RUBELLA (MMR)</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="" value="2 doses" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_mmr_d1" value="<?php echo $i_mmr_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_mmr_rem1" value="<?php echo $i_mmr_rem1; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_mmr_d2" value="<?php echo $i_mmr_d2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_mmr_rem2" value="<?php echo $i_mmr_rem2; ?>">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">OTHER VACCINE</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Doses</label>
                                <input class="form-control" type="text" name="i_other_name1" value="<?php echo $i_other_name1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Vaccination</label>
                                    <input type="date" class="form-control" name="i_other_d1" value="<?php echo $i_other_d1; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input class="form-control" type="text" name="i_other_rem1" value="<?php echo $i_other_rem1; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_other_name2" value="<?php echo $i_other_name2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="date" class="form-control" name="i_other_d2" value="<?php echo $i_other_d2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="i_other_rem2" value="<?php echo $i_other_rem2; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <select class="select" name="stat">
                                    <option value="">Select</option>
                                    <option <?php if($row['stat']=='Active') echo 'selected="selected"'; ?>>Active</option>
                                    <option <?php if($row['stat']=='Inactive') echo 'selected="selected"'; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    

                    <div class="form-group text-center">
                    <button name="edit-immunization" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
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