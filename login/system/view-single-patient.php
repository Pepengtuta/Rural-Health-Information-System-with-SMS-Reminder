<?php
session_start();
include('header.php');
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<body>
<style>
    .table-bordered {
        border: 1px solid #dee2e6;
    }
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 ">
            <?php
            if (isset($_GET['m_number']) && isset($_GET['id'])) {
                $m_number = $_GET['m_number'];
                $id = $_GET['id'];
            
                $ret = "SELECT * FROM tbl_patients WHERE id = ?";
                $stmt = $connection->prepare($ret);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $res = $stmt->get_result();

                while ($row = $res->fetch_assoc()) {
            ?>
            <h4 class="page-title"><?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?>'s Profile</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="edit-patient.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="content">
            <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                                    <div class="text-center mb-4">
                        <div style="width: 200px; height: 200px; border: 1px solid #ddd; display: inline-block;">
                            <img src="<?php echo !empty($row['m_pic']) ? 'assets/img/logo/mother/' . $row['m_pic'] : 'assets/img/logo/mother/user.jpg'; ?>" 
                                alt="Profile Picture" 
                                class="img-fluid" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="text-left mt-3">
                        <h4 class="page-title text-muted mb-2 font-13">ABOUT MOTHER</h4>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong><span class="ml-2"> <?php echo $row['m_first_name'] . " " . $row['m_last_name']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Birthday :</strong> <span class="ml-2"> <?php echo $row['m_dob']; ?> </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Cell Phone :</strong> <span class="ml-2"> <?php echo $row['m_phone']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Landline :</strong> <span class="ml-2"> <?php echo $row['m_landline']; ?> </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Blood Type :</strong> <span class="ml-2"> <?php echo $row['m_type_blood']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Occupation :</strong> <span class="ml-2"> <?php echo $row['m_occupation']; ?></span></p>
                        <hr>
                        <h4 class="page-title text-muted mb-2 font-13">ABOUT FATHER</h4>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <?php echo $row['f_first_name'] . " " . $row['f_last_name']; ?></p>
                        <p class="text-muted mb-2 font-13"><strong>Birthday :</strong> <?php echo $row['f_dob']; ?></p>
                        <p class="text-muted mb-2 font-13"><strong>Cell Phone :</strong> <span class="ml-2"> <?php echo $row['f_phone']; ?> </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Blood Type :</strong> <span class="ml-2"> <?php echo $row['f_type_blood']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Landline :</strong> <span class="ml-2"> <?php echo $row['f_landline']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Occupation :</strong> <span class="ml-2"> <?php echo $row['f_occupation']; ?></span></p>
                        <hr>
                        <h4 class="page-title text-muted mb-2 font-13">Children</h4>
                        <p class="text-muted mb-2 font-13"><strong>Name :</strong> <?php echo $row['children1'] . " - " . $row['dob1']; ?></p>
                        <p class="text-muted mb-2 font-13"><strong>Name :</strong> <?php echo $row['children2'] . " - " . $row['dob2']; ?></p>
                        <p class="text-muted mb-2 font-13"><strong>Name :</strong> <?php echo $row['children3'] . " - " . $row['dob3']; ?></p>
                        <hr>
                        <p class="text-muted mb-2 font-13"><strong>Address :</strong> <br> <?php echo $row['addr']; ?></p>
                        <hr>
                        <h4 class="page-title text-muted mb-2 font-13">IN CASE OF EMERGENCY</h4>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <?php echo $row['g_name']; ?></p>
                        <p class="text-muted mb-2 font-13"><strong>Relationship :</strong> <span class="ml-2"> <?php echo $row['g_rel']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Birthday :</strong> <span class="ml-2"> <?php echo $row['g_dob']; ?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Cell Phone :</strong> <span class="ml-2"> <?php echo $row['g_phone']; ?></span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#about" data-toggle="tab" aria-expanded="false" class="nav-link custom-link">Other Details About Mother</a>
                        </li>
                        <li class="nav-item">
                            <a href="#experience" data-toggle="tab" aria-expanded="false" class="nav-link custom-link">Experience with Previous Pregnancies and Births</a>
                        </li>
                        <li class="nav-item">
                            <a href="#record" data-toggle="tab" aria-expanded="false" class="nav-link custom-link">Other Records</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="about">
                        <div class="table-responsive">
                        <?php
                                $experience_query = $connection->prepare("SELECT * FROM tbl_patients WHERE m_number = ?");
                                $experience_query->bind_param('s', $m_number);
                                $experience_query->execute();
                                $experience_result = $experience_query->get_result();
                                
                                if ($patients = $experience_result->fetch_assoc()) {
                                ?>
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="2"><center>Other Details About Mother</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Date of First Check-up</strong></td>
                                        <td><?php echo ($patients['dofcu']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Age</strong></td>
                                        <td><?php echo ($patients['m_age']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Weight (kg)</strong></td>
                                        <td><?php echo ($patients['m_weight']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Height (cm)</strong></td>
                                        <td><?php echo ($patients['m_height']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nutritional status based on Body Mass Index</strong></td>
                                        <td><?php echo ($patients['m_bmi']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of Last Menstrual Period</strong></td>
                                        <td><?php echo ($patients['m_dolp']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Expected Date of Delivery</strong></td>
                                        <td><?php echo ($patients['m_edod']); ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="experience">
                        <div class="form-section">
                        <div class="table-responsive">
                        <?php
                            $experience_query = $connection->prepare("SELECT * FROM tbl_experiences WHERE e_name = ?");
                            $experience_query->bind_param('s', $m_number);
                            $experience_query->execute();
                            $experience_result = $experience_query->get_result();

                            if ($experience_row = $experience_result->fetch_assoc()) {
                        ?>
                            <table class="table table-bordered table-striped text-center">
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th colspan="6">Pregnancy Number</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <th>Date of Delivery:</th>
                                        <td></td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="date" class="form-control custom-date" name="pregnancy_<?= $i ?>_dod" 
                                            value="<?php echo ($experience_row['pregnancy_' . $i . '_dod']); ?>" readonly>
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Type of Delivery:</th>
                                        <td>Normal (N)</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td>
                                                <input type="checkbox" name="pregnancy_<?= $i ?>_tod_normal"
                                                <?php echo ($experience_row['pregnancy_' . $i . '_tod_normal'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Caesarean Delivery (C/S)</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td>
                                                <input type="checkbox" name="pregnancy_<?= $i ?>_tod_cs"
                                                <?php echo ($experience_row['pregnancy_' . $i . '_tod_cs'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <th rowspan="3">Birth Outcome:</th>
                                        <td>Alive</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td>
                                                <input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_alive"
                                                <?php echo ($experience_row['pregnancy_' . $i . '_birth_outcome_alive'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Miscarriage</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_miscarriage"
                                            <?php echo ($experience_row['pregnancy_' . $i . '_birth_outcome_miscarriage'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Stillbirth</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_stillbirth"
                                            <?php echo ($experience_row['pregnancy_' . $i . '_birth_outcome_stillbirth'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <th rowspan="3">Number of Children:</th>
                                        <td>Single</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_single"
                                            <?php echo ($experience_row['pregnancy_' . $i . '_children_single'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Twin</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_twin"
                                            <?php echo ($experience_row['pregnancy_' . $i . '_children_twin'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Multiple</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_multiple"
                                            <?php echo ($experience_row['pregnancy_' . $i . '_children_multiple'] == 1) ? 'checked' : ''; ?> onclick="return false;">
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <th rowspan="3">Pregnancy-related Conditions:</th>
                                        <td>PIH</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td>
                                                <input type="text" name="pregnancy_<?= $i ?>_conditions_pih" size="1" 
                                                value="<?php echo ($experience_row['pregnancy_' . $i . '_conditions_pih']); ?>" readonly>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>

                                    <tr>
                                        <td>Preeclampsia</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="text" name="pregnancy_<?= $i ?>_conditions_pe" size="1"
                                            value="<?php echo ($experience_row['pregnancy_' . $i . '_conditions_pe']); ?>" readonly>
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Bleeding</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="text" name="pregnancy_<?= $i ?>_conditions_bleeding" size="1"
                                            value="<?php echo ($experience_row['pregnancy_' . $i . '_conditions_bleeding']); ?>" readonly>
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                                <th colspan="6">&nbsp &nbsp &nbsp *Y = Yes &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp  &nbsp &nbsp N = No</th>
                                    </tr>
                      
                                </tbody>
                                <?php } else { ?>
                <tr>
                    <td colspan="2"><center>No data available</center></td>
                </tr>
                <?php } ?>
                            </table>
                        </div>
                    </div>
                    </div>

                    <div class="tab-pane fade" id="record">
                    <div class="table-responsive">
                        <form>
            <?php
                $experience_query = $connection->prepare("SELECT * FROM tbl_other WHERE o_name = ?");
                $experience_query->bind_param('s', $m_number);
                $experience_query->execute();
                $experience_result = $experience_query->get_result();

                if ($record_row = $experience_result->fetch_assoc()) {
                ?>
            <h4 class="page-title text-muted mb-2 font-13">Delivery Information</h4>
            <table class="table table-bordered">
                <tbody>
                <label>I know that complications can happen unexpectedly either to me or my newborn baby during the delivery, I know that
                                            I should deliver my baby in a facility that is staffed and equipped to help us.
                                    </label> 
                <tr>
                <td class="w-50">I will be attended at the delivery by (Name of Doctor/Midwife/Nurse)</td>
                <td><?php echo htmlspecialchars($record_row['aap']); ?></td>
                </tr>
                <tr>
                <td>I plan to deliver at (Name of Hospital/Health Center or Clinic)</td>
                <td><?php echo htmlspecialchars($record_row['aam']); ?></td>
                </tr>
                <tr>
                <td>This is a PhilHealth accredited facility</td>
                <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paf" value="1" 
                            <?php echo ($record_row['paf'] == 1) ? 'checked' : ''; ?> onclick="return false;"> Yes
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paf" value="0" 
                            <?php echo ($record_row['paf'] == 0) ? 'checked' : ''; ?> onclick="return false;"> No
                        </div>
                    </td>
                </tr>
                <tr>
                <td>I am a PhilHealth member</td>
                <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pm" value="1" 
                            <?php echo ($record_row['pm'] == 1) ? 'checked' : ''; ?> onclick="return false;"> Yes
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pm" value="0" 
                            <?php echo ($record_row['pm'] == 0) ? 'checked' : ''; ?> onclick="return false;"> No
                        </div>
                    </td>
                </tr>
                <tr>
                <td>The estimated cost of the mother/newborn package is</td>
                <td><?php echo htmlspecialchars($record_row['nbp']); ?></td>
                </tr>
                <tr>
                <td>My mode of payment is</td>
                <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pay" value="1" 
                            <?php echo ($record_row['pay'] == 1) ? 'checked' : ''; ?> onclick="return false;"> Cash
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pay" value="2" 
                            <?php echo ($record_row['pay'] == 2) ? 'checked' : ''; ?> onclick="return false;"> PhilHealth
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pay" value="3" 
                            <?php echo ($record_row['pay'] == 3) ? 'checked' : ''; ?> onclick="return false;"> Insurance
                        </div>
                    </td>
                </tr>
                <tr>
                <td>My mode of payment is</td>
                <td><?php echo htmlspecialchars($record_row['veh']); ?></td>
                </tr>
                <tr>
                <td>I have communicated with to bring me to the above facility</td>
                <td>
                        <?php echo htmlspecialchars($record_row['dname']); ?><br>
                        <?php echo htmlspecialchars($record_row['dnum']); ?>
                    </td>
                </tr>
                <tr>
                <td>I will be accompanied by</td>
                <td>
                        <?php echo htmlspecialchars($record_row['bhwname']); ?><br>
                        <?php echo htmlspecialchars($record_row['bhwnum']); ?>
                    </td>
                </tr>
                <tr>
                <td>My children/home will be taken care by while I am at the health facility</td>
                <td>
                        <?php echo htmlspecialchars($record_row['tname']); ?><br>
                        <?php echo htmlspecialchars($record_row['tnum']); ?>
                    </td>
                </tr>
                <tr>
                <td>In case of emergency, please call</td>
                <td><?php echo htmlspecialchars($record_row['ename']); ?><br>
                    <?php echo htmlspecialchars($record_row['enum']); ?><br>
                    <?php echo htmlspecialchars($record_row['edd']); ?>
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
                        <td><?php echo htmlspecialchars($record_row['emername1']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emernum1']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emeradd1']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($record_row['emername2']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emernum2']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emeradd2']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($record_row['emername3']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emernum3']); ?></td>
                        <td><?php echo htmlspecialchars($record_row['emeradd3']); ?></td>
                    </tr>
                </tbody>
                <?php } else { ?>
                <tr>
                    <td colspan="2"><center>No data available</center></td>
                </tr>
                <?php } ?>
            </table>
        </form>
    </div>
</div>
            </div>
            <?php
                }

            ?>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<style>
    .table {
    width: 100%;
    max-width: 100%;
    table-layout: fixed;

.table th, .table td {
    width: auto;
    padding: 12px 8px;
}

.custom-date {
    width: 75px;
    font-size: 6px;
    text-align: center;
}

@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px;
    }
}
</style>

</body>
</html>

</div>
            <?php
                }

            ?>
