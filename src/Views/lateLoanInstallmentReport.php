<?php
include_once 'base.php';
include_once '../Config/db.php';
include_once '../Controllers/lateInstallmentReportController.php';
include_once '../Models/lateInstallmentReportModel.php';

$branchId = 1;
$controller = new lateInstallmentReportController();

if (isset($_POST["submit"])) {
    $controller->getMonthAndYear();
    $details_online = $controller->getOnlineLateLoanInstallments($branchId);
    //$rows = count($details_online);
    $details_regular = $controller->getRegularLateLoanInstallments($branchId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Late Installment Report</title>
    <link rel="stylesheet" href="../CSS/lateLoanInstallmentReport.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body style="background-color: rgb(16, 131, 246);">

    <main-header></main-header>
    <div style="margin-top: 5rem;">
        <div class="container border border-2 m-5 p-5 mx-auto bg-light " style="margin-top: 50px;">
            <h2 style="color:black ;">Late Loan Installment Report </h2>
            <form id="myForm" action="lateLoanInstallmentReport.php" method="post">
                <div class="form-row mt-5">
                    <div class="form-group col-md-5">
                        <label for="year">Year</label>
                        <select id="year" name="year" class="form-select form-select-sm" style="height:2.5rem ;font-size:medium" required>
                            <option value=0>choose</option>
                            <option value=2021>2021</option>
                            <option value=2022>2022</option>
                        </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="month">Month</label>
                        <select id="month" name="month" class="form-select form-select-sm" style="height:2.5rem ;font-size:medium" required>
                            <option value=0>choose</option>
                            <option value="January">January</option>
                            <option value=February>February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary" name="submit" id="submit">Generate Report</button>
            </form>
            <!-- <button id="switch" name="submit2" onclick="showApplication()">Click to hide visible DIVs and show hidden ones</button> -->
        </div>

        <div class="container border border-2 m-5 p-5 mx-auto bg-light " id="div3" hidden>

            <h2>Online Late Loan Installment report for <?php echo $controller->getYear() . " " . $controller->getMonth() ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">number</th>
                        <th scope="col">Loan ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Monthly Installment</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    foreach ($details_online as $detail) :
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $detail[0]; ?></td>
                            <td><?php echo $detail[1]; ?></td>
                            <td><?php echo $detail[2]; ?></td>
                            <td><?php echo $detail[3]; ?></td>
                            <td><?php echo $detail[4]; ?></td>
                            <td><?php echo $detail[5]; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container border border-2 m-5 p-5 mx-auto bg-light " id="div4" hidden>

        <h2>Regular Late Loan Installment report for <?php echo $controller->getYear() . " " . $controller->getMonth() ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">number</th>
                    <th scope="col">Loan ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Date Time</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Monthly Installment</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                foreach ($details_regular as $detail) :
                    $count++;
                ?>
                    <tr>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><?php echo $detail[0]; ?></td>
                        <td><?php echo $detail[1]; ?></td>
                        <td><?php echo $detail[2]; ?></td>
                        <td><?php echo $detail[3]; ?></td>
                        <td><?php echo $detail[4]; ?></td>
                        <td><?php echo $detail[5]; ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>



    <script type="text/javascript">
        const application1 = document.getElementById("div3");
        const application2 = document.getElementById("div4");

        function showApplication() {
            application1.hidden = !application1.hidden;
            application2.hidden = !application2.hidden;

        };
    </script>

    <?php
    if (isset($_POST["submit"])) {


        // echo $details[0][4];
        // echo $details[1][0];
        echo '<script type="text/javascript">showApplication();</script>';
    }

    ?>
</body>

</html>