<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}

include('header.php');
include('includes/connection.php');

$i_number = isset($_GET['i_number']) ? mysqli_real_escape_string($connection, $_GET['i_number']) : '';
$i_id = isset($_GET['i_id']) ? mysqli_real_escape_string($connection, $_GET['i_id']) : '';

$ret = "SELECT * FROM tbl_immunization WHERE i_id=?";
$stmt = $connection->prepare($ret);
if ($stmt === false) {
    die("Prepare failed: " . $connection->error);
}

$stmt->bind_param('i', $i_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "No record found.";
    exit();
}

while ($row = $res->fetch_assoc()) {
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">View Child Immunization Record</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="baby-immunization.php" class="btn btn-primary btn-sm float-right">Back</a>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
                <div class="text-left mt-3">
                    <p><strong>Name of Child:</strong>&nbsp;&nbsp;<span style="font-size: 16px;"><?php echo htmlspecialchars($row['i_name']); ?></span></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Vaccine</th>
                                <th class="text-center">Doses</th>
                                <th class="text-center">Date of Vaccination</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">BCG</td>
                                <td class="text-center">1 dose</td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_bcg_d1']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_bcg_rem']); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">Hepatitis B</td>
                                <td class="text-center">1 dose</td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_hep_d1']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_hep_rem']); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">Pentavalent Vaccine (DPT-Hep B-HiB)</td>
                                <td class="text-center">3 doses<br>1 ½, 2 ½ & 3 ½ months</td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_dpt_d1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_dpt_d2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_dpt_d3']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_dpt_rem1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_dpt_rem2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_dpt_rem3']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Oral Polio Vaccine (OPV)</td>
                                <td class="text-center">3 doses<br>1 ½, 2 ½ & 3 ½ months</td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_opv_d1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_opv_d2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_opv_d3']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_opv_rem1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_opv_rem2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_opv_rem3']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Inactivated Polio Vaccine (IPV)</td>
                                <td class="text-center">1 dose<br>3 ½ months</td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_ipv_d1']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_ipv_rem']); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">Pneumococcal Conjugate Vaccine (PCV)</td>
                                <td class="text-center">3 doses<br>1 ½, 2 ½ & 3 ½ months</td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_pcv_d1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_pcv_d2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_pcv_d3']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_pcv_rem1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_pcv_rem2']); ?><br>
                                    <?php echo htmlspecialchars($row['i_pcv_rem3']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Measles, Mumps, Rubella (MMR)</td>
                                <td class="text-center">2 doses<br>9 months & 1 year</td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_mmr_d1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_mmr_d2']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo htmlspecialchars($row['i_mmr_rem1']); ?><br>
                                    <?php echo htmlspecialchars($row['i_mmr_rem2']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Other Vaccine</td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_other_name1']); ?><br><?php echo htmlspecialchars($row['i_other_name2']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_other_d1']); ?><br><?php echo htmlspecialchars($row['i_other_d2']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['i_other_rem1']); ?><br><?php echo htmlspecialchars($row['i_other_rem2']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} 
$stmt->close();
$connection->close();
?>

<?php include('footer.php'); ?>
