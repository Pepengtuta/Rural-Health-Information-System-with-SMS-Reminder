<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th, td {
                padding: 5px;
                text-align: left;
            }
            th {
                text-align: center;
            }
            td {
                text-align: center;
            }
            .table-wrapper {
                margin: 0 auto;
                max-width: 1000px; 
            }
        </style>
    </head>
        
        <body>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3">
                            <h4 class="page-title">Vaccination Schedule</h4>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table>
                            <tr>
                                <th>VACCINE</th>
                                <th>DOSES</th>
                                <th>DATE OF VACCINATION</th>
                                <th>REMARKS</th>
                            </tr>
                            <tr>
                                <td>BCG</td>
                                <td>1<br>pagkapanganak</td>
                                <td>02-05-20</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>HEPATITIS B</td>
                                <td>1<br>pagkapanganak</td>
                                <td>02-05-20<br>1<br>2<br>3</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PENTAVALENT VACCINE<br>(DPT-Hep B-HiB)</td>
                                <td>3<br>(1 ½, 2 ½ & 3 ½ buwan)</td>
                                <td>3-22-20 4-22-20 5-27-20</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>ORAL POLIO VACCINE<br>(OPV)</td>
                                <td>3<br>(1 ½, 2 ½ & 3 ½ buwan)</td>
                                <td>3-22-20 4-22-20 5-27-20</td>
                                <td>OPV-SIA<br>03-20-24</td>
                            </tr>
                            <tr>
                                <td>INACTIVATED POLIO VACCINE (IPV)</td>
                                <td>1<br>(3 ½ buwan)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PNEUMOCOCCAL CONJUGATE VACCINE (PCV)</td>
                                <td>3<br>(1 ½, 2 ½ & 3 ½ buwan)</td>
                                <td>3-22-20 4-22-20 5-27-20</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEASLES, MUMPS, RUBELLA (MMR)</td>
                                <td>2<br>(9 buwan & 1 taon)</td>
                                <td>9 mvs<br>11-11-20 3-24-21</td>
                                <td>VitA- 8-12-20</td>
                            </tr>
                            <tr>
                                <td>IBA PANG MGA BAKUNA</td>
                                <td>Vit K- 2, 3- 20<br>IPV 5-22-20</td>
                                <td>MR-SIA<br>05/11/23</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

<?php include('footer.php'); ?>
<script language="JavaScript" type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this child record?');
    }
</script>
</body>
</html>
