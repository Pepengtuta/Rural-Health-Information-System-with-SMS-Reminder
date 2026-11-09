<?php
session_start();
if (empty($_SESSION['name']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 3)) {
    header('Location: index.php');
    exit;
}

include('header.php');
include('includes/connection.php');

if (isset($_GET['e_id'])) {
    $patient_id = $_GET['e_id'];
    $result = mysqli_query($connection, "SELECT * FROM tbl_experiences WHERE e_id='$patient_id' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        extract($row);  
    } else {
        echo "No record found!";
        exit();
    }
}

if (isset($_POST['edit-experience'])) {
    $e_name = mysqli_real_escape_string($connection, $_POST['e_name']);
    $e_number = mysqli_real_escape_string($connection, $_POST['e_number']);

    $fields = [];
    for ($i = 1; $i <= 6; $i++) {
        $fields["pregnancy_{$i}_dod"] = mysqli_real_escape_string($connection, $_POST["pregnancy_{$i}_dod"]);
        $fields["pregnancy_{$i}_tod_normal"] = isset($_POST["pregnancy_{$i}_tod_normal"]) ? 1 : 0;
        $fields["pregnancy_{$i}_tod_cs"] = isset($_POST["pregnancy_{$i}_tod_cs"]) ? 1 : 0;
        $fields["pregnancy_{$i}_birth_outcome_alive"] = isset($_POST["pregnancy_{$i}_birth_outcome_alive"]) ? 1 : 0;
        $fields["pregnancy_{$i}_birth_outcome_miscarriage"] = isset($_POST["pregnancy_{$i}_birth_outcome_miscarriage"]) ? 1 : 0;
        $fields["pregnancy_{$i}_birth_outcome_stillbirth"] = isset($_POST["pregnancy_{$i}_birth_outcome_stillbirth"]) ? 1 : 0;
        $fields["pregnancy_{$i}_children_single"] = isset($_POST["pregnancy_{$i}_children_single"]) ? 1 : 0;
        $fields["pregnancy_{$i}_children_twin"] = isset($_POST["pregnancy_{$i}_children_twin"]) ? 1 : 0;
        $fields["pregnancy_{$i}_children_multiple"] = isset($_POST["pregnancy_{$i}_children_multiple"]) ? 1 : 0;
        $fields["pregnancy_{$i}_conditions_pih"] = mysqli_real_escape_string($connection, $_POST["pregnancy_{$i}_conditions_pih"]);
        $fields["pregnancy_{$i}_conditions_pe"] = mysqli_real_escape_string($connection, $_POST["pregnancy_{$i}_conditions_pe"]);
        $fields["pregnancy_{$i}_conditions_bleeding"] = mysqli_real_escape_string($connection, $_POST["pregnancy_{$i}_conditions_bleeding"]);
    }

    $update_sql = "UPDATE tbl_experiences SET 
                    e_name = '$e_name',
                    e_number = '$e_number', ";

    foreach ($fields as $field => $value) {
        $update_sql .= "$field = '$value', ";
    }

    $update_sql = rtrim($update_sql, ', ') . " WHERE e_id='$patient_id'";

    if (mysqli_query($connection, $update_sql)) {
        $msg = "Record updated successfully!";
    } else {
        $msg = "Error updating record: " . mysqli_error($connection);
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="page-title">View Experience with Previous Pregnancies and Births</h4>
            </div>
            <div class="col-sm-4 text-right">
                <a href="experience-patient.php" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-10 offset-lg-1"> 
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="e_name" value="<?php echo ($e_name); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="table-responsive">
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
                                            <td><input type="date" class="form-control custom-date" name="pregnancy_<?= $i ?>_dod" value="<?php echo ${"pregnancy_{$i}_dod"}; ?>" onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>

                                    <tr>
                                        <th rowspan="2">Type of Delivery:</th>
                                        <td>Normal (N)</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_tod_normal" <?php echo ${"pregnancy_{$i}_tod_normal"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                            <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Caesarean Delivery (C/S)</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_tod_cs" <?php echo ${"pregnancy_{$i}_tod_cs"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>

                                    <tr>
                                        <th rowspan="3">Birth Outcome:</th>
                                        <td>Alive</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_alive" <?php echo ${"pregnancy_{$i}_birth_outcome_alive"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Miscarriage</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_miscarriage" <?php echo ${"pregnancy_{$i}_birth_outcome_miscarriage"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Stillbirth</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_stillbirth" <?php echo ${"pregnancy_{$i}_birth_outcome_stillbirth"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>

                                    <tr>
                                        <th rowspan="3">Number of Children:</th>
                                        <td>Single</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_single" <?php echo ${"pregnancy_{$i}_children_single"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Twin</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_twin" <?php echo ${"pregnancy_{$i}_children_twin"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Multiple</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_multiple" <?php echo ${"pregnancy_{$i}_children_multiple"} ? 'checked' : ''; ?> onclick="return false;"></td>
                                        <?php endfor; ?>
                                    </tr>

                                    <tr>
                                        <th rowspan="3">Pregnancy-related Conditions:</th>
                                        <td>PIH</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="text" name="pregnancy_<?= $i ?>_conditions_pih" size="1" value="<?php echo ${"pregnancy_{$i}_conditions_pih"}; ?>" readonly></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Preeclampsia</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="text" name="pregnancy_<?= $i ?>_conditions_pe" size="1" value="<?php echo ${"pregnancy_{$i}_conditions_pe"}; ?>" readonly></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <td>Bleeding</td>
                                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                                            <td><input type="text" name="pregnancy_<?= $i ?>_conditions_bleeding" size="1" value="<?php echo ${"pregnancy_{$i}_conditions_bleeding"}; ?>" readonly></td>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                                <th colspan="6">&nbsp &nbsp &nbsp *Y = Yes &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp  &nbsp &nbsp N = No</th>
                                    </tr>
                                </tbody>
                            </table>
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
        echo 'swal("' . ($msg) . '");';
    } ?>
</script>

<script>
document.getElementById("name-select").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    document.getElementById("m_number").value = selectedOption.value;
});
</script>

<style>
    .table {
    width: 100%; /* This will make the table take up the full width of its container */
    max-width: 100%; /* Prevents the table from overflowing the page */
    table-layout: fixed; /* Ensure consistent column width distribution */
}

.table th, .table td {
    width: auto; /* Allow the columns to take as much space as needed */
    padding: 12px 8px; /* Increase the padding for better readability */
    text-align: center; /* Center-align the text in table cells */
}

.custom-date {
    width: 84px; /* Increase the width for date inputs */
    font-size: 7px; /* Adjust the font size as needed */
    text-align: center;
}

input[type="text"] {
    width: 80px; /* Adjust the width for text inputs */
    text-align: center;
}

@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px; /* Smaller text on smaller screens */
    }
}
</style>
