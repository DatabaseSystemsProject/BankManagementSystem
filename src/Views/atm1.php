<?php
session_start();

if (!isset($_SESSION["atm0direct"])) {
    header("Location: ./atm0.php");
}
include "base.php";
include "../Controllers/atmController.php";
$atm_contr = new AtmController();
if (isset($_POST["exit"])) {
    header("Location: ./customerDashboard.php");
}
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
        <form method="post">
            <div id="form2" class="container-md d-flex flex-column col-md-8 form2 form" action="">
                <div class="form-group col-md-7 AccNumber d-flex flex-column">
                    <label for="pinNum">Enter your pin </label><br>
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<p style="color:red; font-size:1.2rem; align-self:center; padding:0px">' . $_SESSION['error_message'] . '</p>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <input type="text" name="pinNo" class="form-control" id="pinNum" style="margin-bottom:30px">
                    <div class="d-grid gap-3 ">
                        <button type="submit" name="submit" class="btn btn-primary shadow" id="btn2">Enter</button>
                        <button type="submit" class="btn btn-danger shadow col-3 mx-auto" id="exit" name="exit">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
        <?php
        if (isset($_POST["submit"])) {
            $atm_contr->checkPin();
        }

        ?>
    </div>
</body>
</body>
<script src="./atm.js"></script>
<script>
    var Form1 = document.getElementById("form1");
    var Form2 = document.getElementById("form2");
    var Form3 = document.getElementById("form3");
    var Form4 = document.getElementById("form4");
    var Form5 = document.getElementById("form5");

    const Next1 = document.getElementById("Next1");

    setInputFilter(
        document.getElementById("pinNum"),
        function(value) {
            return /^\d*$/.test(value);
        },
        "Must be a valid number"
    );
</script>


</html>