<?php 
session_start();
if (empty($_SESSION['name']) || !($_SESSION['role'] == 1 || $_SESSION['role'] == 3)) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');

$msg = '';

if (isset($_POST['add-other'])) {
    $o_name = $_REQUEST['o_name'];
    $o_m_number = $_REQUEST['o_m_number'];
    $o_number = $_REQUEST['o_number'];
    $aap = $_REQUEST['aap'];
    $aam = $_REQUEST['aam'];
    $paf = $_REQUEST['paf'] ?? '';
    $pm = $_REQUEST['pm'] ?? '';
    $nbp = $_REQUEST['nbp'];
    $pay = $_REQUEST['pay'] ?? '';
    $veh = $_REQUEST['veh'];
    $dname = $_REQUEST['dname'];
    $dnum = $_REQUEST['dnum'];
    $bhwname = $_REQUEST['bhwname'];
    $bhwnum = $_REQUEST['bhwnum'];
    $tname = $_REQUEST['tname'];
    $tnum = $_REQUEST['tnum'];
    $ename = $_REQUEST['ename'];
    $enum = $_REQUEST['enum'];
    $edd = $_REQUEST['edd'];
    $emername1 = $_REQUEST['emername1'];
    $emernum1 = $_REQUEST['emernum1'];
    $emeradd1 = $_REQUEST['emeradd1'];
    $emername2 = $_REQUEST['emername2'];
    $emernum2 = $_REQUEST['emernum2'];
    $emeradd2 = $_REQUEST['emeradd2'];
    $emername3 = $_REQUEST['emername3'];
    $emernum3 = $_REQUEST['emernum3'];
    $emeradd3 = $_REQUEST['emeradd3'];

    $check_query = mysqli_query($connection, "SELECT * FROM tbl_other WHERE o_name='$o_name'");
    if (mysqli_num_rows($check_query) > 0) {
        $msg = "Record already exists.";
    } else {
        $insert_query = mysqli_query($connection, "INSERT INTO tbl_other SET
            o_name = '$o_name',
            o_m_number = '$o_m_number',
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
            emeradd3 = '$emeradd3'");

        if ($insert_query) {
            $msg = "Record created successfully.";
        } else {
            $msg = "Error!";
        }
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="page-title">Other Records</h4>
            </div>
            <div class="col-sm-4 text-right m-b-20">
                <a href="other-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <select class="select form-control" name="o_name" id="name-select" required>
                                    <option value="">Select</option>
                                    <?php
                                    $fetch_query = mysqli_query($connection, "SELECT m_number, CONCAT(m_first_name, ' ', m_last_name) AS name FROM tbl_patients");
                                    while ($row = mysqli_fetch_array($fetch_query)) {
                                        ?>
                                        <option value="<?php echo htmlspecialchars($row['m_number']); ?>">
                                            <?php echo htmlspecialchars($row['name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="o_m_number" id="m_number">
                            </div>
                            <div class="form-group" style="display:none">
                                <?php
                                $length = 4;
                                $o_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                ?>
                                <label for="inputZip" class="col-form-label">Experience Number</label>
                                <input type="text" name="o_number" value="<?php echo htmlspecialchars($o_number); ?>" class="form-control" id="inputZip">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <label>I know that complications can happen unexpectedly either to me or my newborn baby during the delivery, I know that
                                            I should deliver my baby in a facility that is staffed and equipped to help us.
                                    </label>                                        <tr>
                                            <td class="w-50">I will be attended at the delivery by (Name of Doctor/Midwife/Nurse)</td>
                                            <td><input type="text" class="form-control" placeholder="Enter name" name="aap"></td>
                                        </tr>
                                        <tr>
                                            <td>I plan to deliver at (Name of Hospital/Health Center or Clinic)</td>
                                            <td><input type="text" class="form-control" placeholder="Enter facility name" name="aam"></td>
                                        </tr>
                                <tr>
                                    <td>This is a PhilHealth accredited facility</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="paf" id="paf">
                                            <label class="form-check-label" for="paf">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="paf" id="paf">
                                            <label class="form-check-label" for="paf">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>I am a PhilHealth member</td>
                                    <td>
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" id="pm">
                                            <label class="form-check-label" for="pm">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pm" id="pm">
                                            <label class="form-check-label" for="pm">No</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>The estimated cost of the mother/newborn package is</td>
                                    <td><input type="text" class="form-control" placeholder="Enter amount" name="nbp"> pesos</td>
                                </tr>
                                <tr>
                                    <td>My mode of payment is</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay">
                                            <label class="form-check-label" for="pay">Cash</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay">
                                            <label class="form-check-label" for="pay">PhilHealth</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay" id="pay">
                                            <label class="form-check-label" for="pay">Insurance</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>The available transport to the facility is</td>
                                    <td><input type="text" class="form-control" name="veh"></td>
                                </tr>
                                <tr>
                                    <td>I have communicated with to bring me to the above facility</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="dname">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="dnum">
                                    </td>
                                </tr>
                                <tr>
                                    <td>I will be accompanied by</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="bhwname">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="bhwnum">
                                    </td>
                                </tr>
                                <tr>
                                    <td>My children/home will be taken care by while I am at the health facility</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="tname">
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="tnum">
                                    </td>
                                </tr>
                                <tr>
                                    <td>In case of emergency, please call</td>
                                    <td>
                                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="ename">
                                        <input type="text" class="form-control mb-2" placeholder="Enter phone number" name="enum">
                                        <input type="text" class="form-control" placeholder="Enter address" name="edd">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="page-title text-muted mb-2 font-9">In case I need a blood transfusion, my possible donors are:</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" placeholder="Enter Name" name="emername1"></td>
                                            <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum1"></td>
                                            <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd1"></td>
                                        </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername2"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum2"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd2"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Enter Name" name="emername3"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Number" name="emernum3"></td>
                                    <td><input type="text" class="form-control" placeholder="Enter Address" name="emeradd3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 text-center">
                            <button name="add-other" class="btn btn-primary submit-btn">Save Record</button>
                        </div>
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

<script>
    document.getElementById('name-select').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('m_number').value = selectedOption.value;
    });
</script>