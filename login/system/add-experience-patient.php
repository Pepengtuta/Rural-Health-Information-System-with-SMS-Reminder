<?php
session_start();
if (empty($_SESSION['name']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 3)) {
    header('Location: index.php');
    exit;
}

include('header.php');
include('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_name = mysqli_real_escape_string($connection, $_POST['e_name']);
    $e_m_number = mysqli_real_escape_string($connection, $_POST['e_m_number']);
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

        $check_query = mysqli_query($connection, "SELECT * FROM tbl_experiences WHERE e_name='$e_name'");
        if (mysqli_num_rows($check_query) > 0) {
            $msg = "Record already exists.";
        } else {

    $sql = "INSERT INTO tbl_experiences (e_name, e_m_number, e_number, ";
    $sql .= implode(", ", array_keys($fields));
    $sql .= ") VALUES ('$e_name', '$e_m_number', '$e_number', '" . implode("', '", array_values($fields)) . "')";

    if (mysqli_query($connection, $sql)) {
        $msg = "Experience record added successfully!";
    } else {
        $msg = "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="page-title">Add Experience with Previous Pregnancies and Births</h4>
            </div>
            <div class="col-sm-4 text-right">
                <a href="experience-patient.php" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-10 offset-lg-1"> <!-- Widened the container -->
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <select class="select" name="e_name" id="name-select" required>
                                    <option value="">Select</option>
                                    <?php
                                    $fetch_query = mysqli_query($connection, "SELECT m_number, CONCAT(m_first_name, ' ', m_last_name) AS name FROM tbl_patients");
                                    while ($row = mysqli_fetch_array($fetch_query)) {
                                        echo '<option value="' . htmlspecialchars($row['m_number']) . '">' . htmlspecialchars($row['name']) . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="e_m_number" id="m_number">
                            </div>

                            <div class="form-group" style="display:none">
                                <?php
                                $length = 4;
                                $e_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                ?>
                                <label for="inputZip" class="col-form-label">Experience Number</label>
                                <input type="text" name="e_number" value="<?php echo htmlspecialchars($e_number); ?>" class="form-control" id="inputZip">
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
                                                    <td><input type="date" class="form-control custom-date" name="pregnancy_<?= $i ?>_dod"></td>
                                                <?php endfor; ?>
                                            </tr>

                                            <tr>
                                                <th rowspan="2">Type of Delivery:</th>
                                                <td>Normal (N)</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_tod_normal"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr>
                                                <td>Caesarean Delivery (C/S)</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_tod_cs"></td>
                                                <?php endfor; ?>
                                            </tr>

                                            <tr>
                                                <th rowspan="3">Birth Outcome:</th>
                                                <td>Alive</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_alive"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr>
                                                <td>Miscarriage</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_miscarriage"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr>
                                                <td>Stillbirth</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_birth_outcome_stillbirth"></td>
                                                <?php endfor; ?>
                                            </tr>

                                            <tr>
                                                <th rowspan="3">Number of Children:</th>
                                                <td>Single</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_single"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr>
                                                <td>Twin</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_twin"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr>
                                                <td>Multiple</td>
                                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                    <td><input type="checkbox" name="pregnancy_<?= $i ?>_children_multiple"></td>
                                                <?php endfor; ?>
                                            </tr>

                                            <tr>
                                            <th rowspan="3">Pregnancy-related Conditions:</th>
                                            <td>PIH</td>
                                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                <td><input type="text" name="pregnancy_<?= $i ?>_conditions_pih" size="1"></td>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr>
                                            <td>Preeclampsia</td>
                                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                <td><input type="text" name="pregnancy_<?= $i ?>_conditions_pe" size="1"></td>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr>
                                            <td>Bleeding</td>
                                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                                <td><input type="text" name="pregnancy_<?= $i ?>_conditions_bleeding" size="1"></td>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr>
                                                <th colspan="6">&nbsp &nbsp &nbsp *Y = Yes &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp  &nbsp &nbsp N = No</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create Experience</button>
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
document.getElementById("name-select").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    document.getElementById("m_number").value = selectedOption.value;
});
</script>

<style>
    .table {
    width: 100%;
    max-width: 100%;
    table-layout: fixed;
}

.table th, .table td {
    width: auto;
    padding: 12px 8px;
    text-align: center;
}

.custom-date {
    width: 84px;
    font-size: 7px;
    text-align: center;
}

input[type="text"] {
    width: 80px;
    text-align: center;
}

@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px;
    }
}
</style>