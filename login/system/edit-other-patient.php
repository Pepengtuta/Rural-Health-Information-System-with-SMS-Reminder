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
if (isset($_GET['o_id'])) {
    $patient_id = $_GET['o_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_other WHERE o_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Populate variables with existing data
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}


if (isset($_POST['edit-other'])) {
    // Get updated data from form
    extract($_POST);

    // Update query
    $update_query = mysqli_query($connection, 
        "UPDATE tbl_other SET
                    o_name = '$o_name',
            o_number = '$o_number',
            aap = '$aap',
            aam = '$aam',
            paf = '$paf',
            pm = '$pm',
            nbp = '$nbp',
            pay = '$pay',
            veh = '$veh',
            dname = '$dname',
            dnum = '$dnum',
            bhwname = '$bhwname',
            bhwnum = '$bhwnum',
            tname = '$tname',
            tnum = '$tnum',
            ename = '$ename',
            enum = '$enum',
            edd = '$edd',
            emername1 = '$emername1',
            emernum1 = '$emernum1',
            emeradd1 = '$emeradd1',
            emername2 = '$emername2',
            emernum2 = '$emernum2',
            emeradd2 = '$emeradd2',
            emername3 = '$emername3',
            emernum3 = '$emernum3',
            emeradd3 = '$emeradd3'
              WHERE o_id='$patient_id'"
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
                <h4 class="page-title">Edit Other Records</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="other-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-10 offset-lg-1"> 
        <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="o_name" value="<?php echo $o_name; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Child Record Content -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <label>I know that complications can happen unexpectedly either to me or my newborn baby during the delivery, I know that
                                            I should deliver my baby in a facility that is staffed and equipped to help us.
                                    </label>                                        
                                <tr>
                                <td class="w-50">I will be attended at the delivery by (Name of Doctor/Midwife/Nurse)</td>
                                <td><input type="text" class="form-control" placeholder="Enter name" name="aap" value="<?php echo $aap; ?>"></td>
                                </tr>
                                <tr>
                                <td>I plan to deliver at (Name of Hospital/Health Center or Clinic)</td>
                                <td><input type="text" class="form-control" placeholder="Enter facility" name="aam" value="<?php echo $aam; ?>"></td>
                                </tr>
                                <tr>
                                <td>This is a PhilHealth accredited facility</td>
                                <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="paf" id="paf" value="1" <?php if($row['paf']==1) echo 'checked'; ?>>
                                            <label class="form-check-label" for="paf">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="paf" id="paf" value="0" <?php if($row['paf']==0) echo 'checked'; ?>>
                                            <label class="form-check-label" for="paf">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>I am a PhilHealth member</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" id="pm" value="1" <?php if($row['pm']==1) echo 'checked'; ?>>
                                            <label class="form-check-label" for="pm">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" id="pm" value="0" <?php if($row['pm']==0) echo 'checked'; ?>>
                                            <label class="form-check-label" for="pm">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>The estimated cost of the mother/newborn package is</td>
                                <td><input type="text" class="form-control" placeholder="Enter amount" name="nbp" value="<?php echo $nbp; ?>"> pesos</td>
                                </tr>
                                <tr>
                                <td>My mode of payment is</td>
                                <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay" value="1" <?php if($row['pay']==1) echo 'checked'; ?>>
                                            <label class="form-check-label" for="pay">Cash</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay" value="2" <?php if($row['pay']==2) echo 'checked'; ?>>
                                            <label class="form-check-label" for="pay">PhilHealth</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay" value="3" <?php if($row['pay']==3) echo 'checked'; ?>>
                                            <label class="form-check-label" for="pay">Insurance</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>The available transport to the facility is</td>
                                <td><input type="text" class="form-control" name="veh" value="<?php echo $veh; ?>"></td>
                                </tr>
                                <tr>
                                <td>I have communicated with to bring me to the above facility</td>
                                <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="dname" value="<?php echo $dname; ?>">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="dnum" value="<?php echo $dnum; ?>">
                                    </td>
                                </tr>
                                <tr>
                                <td>I will be accompanied by</td>
                                <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="bhwname" value="<?php echo $bhwname; ?>">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="bhwnum" value="<?php echo $bhwnum; ?>">
                                    </td>
                                </tr>
                                <tr>
                                <td>My children/home will be taken care by while I am at the health facility</td>
                                <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="tname" value="<?php echo $tname; ?>">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="tnum" value="<?php echo $tnum; ?>">
                                    </td>
                                </tr>
                                <tr>
                                <td>In case of emergency, please call</td>
                                <td><input type="text" class="form-control mb-2" placeholder="Enter name" name="ename" value="<?php echo $ename; ?>">
                                        <input type="text" class="form-control mb-2" placeholder="Enter phone number" name="enum" value="<?php echo $enum; ?>">
                                        <input type="text" class="form-control" placeholder="Enter address" name="edd" value="<?php echo $edd; ?>">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="page-title text-muted mb-2 font-9">In case I need a blood transfusion, my possible donors are:</h4>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <td>Name</td>
                                    <th>Contact Number</th>
                                    <td>Address</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername1" value="<?php echo $emername1; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum1" value="<?php echo $emernum1; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd1" value="<?php echo $emeradd1; ?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername2" value="<?php echo $emername2; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum2" value="<?php echo $emernum2; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd2" value="<?php echo $emeradd2; ?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername3" value="<?php echo $emername3; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum3" value="<?php echo $emernum3; ?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd3" value="<?php echo $emeradd3; ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="form-group">
                                <button name="edit-other" class="btn btn-primary submit-btn">Save Record</button>
                            </div>
                        </div>
                    </div>
                </form> <!-- End of the form -->
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script type="text/javascript">
    <?php if (!empty($msg)) {
        echo 'swal("' . ($msg) . '");';
    } ?>
</script>
