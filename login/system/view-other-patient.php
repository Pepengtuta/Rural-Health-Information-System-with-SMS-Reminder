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
if (isset($_GET['o_id'])) {
    $patient_id = $_GET['o_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_other WHERE o_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
    } else {
        echo "No record found!";
        exit();
    }
}


if (isset($_POST['edit-other'])) {
    extract($_POST);

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
                <h4 class="page-title">View Other Records</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="other-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-10 offset-lg-1"> <!-- Widened the container -->
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
                                <tr>
                                    <td>I will be attended at the delivery by (Name of Doctor/Midwife/Nurse)</td>
                                    <td><input type="text" class="form-control" placeholder="Enter name" name="aap" value="<?php echo $aap; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>I plan to deliver at (Name of Hospital/Health Center or Clinic)	</td>
                                    <td><input type="text" class="form-control" placeholder="Enter facility" name="aam" value="<?php echo $aam; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>This is a PhilHealth accredited facility	</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paf" value="Oo" <?php if($row['paf'] == 1) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="paf">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paf" value="Hindi" <?php if($row['paf'] == 0) echo 'checked'; ?> onclick="return false;">
                                        <label class="form-check-label" for="paf">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>I am a PhilHealth member</td>
                                    <td>
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" value="1" <?php if($row['pm']==1) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="pm">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" value="0" <?php if($row['pm']==0) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="pm">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>The estimated cost of the mother/newborn package is</td>
                                    <td><input type="text" class="form-control" placeholder="Enter amount" name="nbp" value="<?php echo $nbp; ?>" readonly> pesos</td>
                                </tr>
                                <tr>
                                    <td>My mode of payment is</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" value="1" <?php if($row['pay']==1) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="pay">Cash</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" value="2" <?php if($row['pay']==2) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="pay">PhilHealth</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" value="3" <?php if($row['pay']==3) echo 'checked'; ?> onclick="return false;">
                                            <label class="form-check-label" for="pay">Insurance</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>The available transport to the facility is</td>
                                    <td><input type="text" class="form-control" name="veh" value="<?php echo $veh; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>I have communicated with to bring me to the above facility</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="dname" value="<?php echo $dname; ?>" readonly>
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="dnum" value="<?php echo $dnum; ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>I will be accompanied by</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter BHW name" name="bhwname" value="<?php echo $bhwname; ?>" readonly>
                                        <input type="text" class="form-control" placeholder="Enter BHW contact number" name="bhwnum" value="<?php echo $bhwnum; ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>My children/home will be taken care by while I am at the health facility</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="tname" value="<?php echo $tname; ?>" readonly>
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="tnum" value="<?php echo $tnum; ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>In case of emergency, please call</td>
                                    <td>
                                    <input type="text" class="form-control" placeholder="Enter name" name="ename" value="<?php echo $ename; ?>" readonly>
                                    <input type="text" class="form-control" placeholder="Enter phone number" name="enum" value="<?php echo $enum; ?>" readonly>
                                    <input type="text" class="form-control" placeholder="Enter address" name="edd" value="<?php echo $edd; ?>" readonly>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="page-title text-muted mb-2 font-9">In case I need a blood transfusion, my possible donors are:</h4>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <td>Name</td>
                                    <td>Telephone / Cellphone</td>
                                    <td>Address</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername1" value="<?php echo $emername1; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum1" value="<?php echo $emernum1; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd1" value="<?php echo $emeradd1; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername2" value="<?php echo $emername2; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum2" value="<?php echo $emernum2; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd2" value="<?php echo $emeradd2; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername3" value="<?php echo $emername3; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum3" value="<?php echo $emernum3; ?>" readonly></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd3" value="<?php echo $emeradd3; ?>" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script type="text/javascript">
    <?php if (!empty($msg)) {
        echo 'swal("' . htmlspecialchars($msg) . '");';
    } ?>
</script>
