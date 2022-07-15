<?php
session_start();
if (!isset($_SESSION["atm1direct"])) {
    header("Location: ./atm1.php");
}
include "base.php";
include "../Controllers/atmController.php";
$atm_contr = new AtmController();
if (isset($_POST["exit"])) {
    if (isset($_SESSION["accountType"])) {
        unset($_SESSION["accountType"]);
    }
    header("Location: ./customerDashboard.php");
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/atm.css">
    <title>atm</title>
</head>

<body>
    <main-header></main-header><br><br>
    <div class="container mx-auto col-md-5 d-flex flex-column">
        <div class="bankName">
            <img src="../Resources/Images/logoBlack.png" alt="no title">
        </div>
        <form method="post" action="">
            <div id="form3" class="container-md d-flex flex-column col-md-8 form3 form " action="">
                <div class="form-group col-md-7 AccType d-flex flex-column">
                    <label style="margin-bottom:30px">Chose your Account Type</label><br>
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<p style="color:red; font-size:1.2rem; align-self:center; padding:0px">' . $_SESSION['error_message'] . '</p>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <div class="d-grid gap-4 ">
                        <button type="submit" class="btn btn-primary shadow" name="checking" id="Next3_1">Checking</button>
                        <button type="submit" class="btn btn-primary shadow" name="savings" id="Next3_2">Savings</button>
                        <button type="submit" class="btn btn-danger shadow col-3 mx-auto" id="exit" name="exit">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
        <?php
        $atm_contr->checkAccount();
        ?>
    </div>
</body>


<script src="./atm.js"></script>

</html>