<?php
include_once 'base.php';
include_once '../Config/db.php';
include_once '../Models/customerFdDisplayModel.php';
include_once '../Controllers/customerFdDisplayController.php';

session_start();

$account_number = 12;
$controller = new CustomerFdDisplayController();
$isFdAccountExist = $controller->getCustomerFdDetails($account_number);
$details = $controller->getDetails();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer FD Details</title>
</head>

<body>
    <main-header></main-header>

    <div style="margin-top:5rem;" id="fdAccounts" hidden>
        <div class="container border border-2 m-5 p-5 mx-auto bg-light">
            <h2 style="color:black;margin-bottom:5% ;">Your FD Accounts</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">FD ID</th>
                        <th scope="col">FD type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Monthly Interest</th>
                        <th scope="col">Remaining Months</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    foreach ($details as $detail) :
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $detail[0]; ?></td>
                            <td><?php echo $detail[1]; ?></td>
                            <td><?php echo $detail[2]; ?></td>
                            <td><?php echo $detail[3]; ?></td>
                            <td><?php echo $detail[4]; ?></td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    <div style="margin-top:5rem;" id="emptymsg" hidden>
        <div class="container border border-2 m-5 p-5 mx-auto bg-light">
            <h1 style="color:black;">You do not have any fixed deposits</h1>
        </div>
    </div>

    <script>
        const application1 = document.getElementById("fdAccounts");
        const application2 = document.getElementById("emptymsg");

        function showApplication1() {
            application1.hidden = !application1.hidden;

        };

        function showApplication2() {
            application2.hidden = !application2.hidden;

        };
    </script>

    <?php
    $isFdAccountExist = $controller->getCustomerFdDetails($account_number);
    if ($isFdAccountExist == true) {

        echo '<script type="text/javascript">showApplication1();</script>';
    } else {
        echo '<script type="text/javascript">showApplication2();</script>';
    }

    ?>
</body>


</html>