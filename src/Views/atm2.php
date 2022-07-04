<?php
session_start();
include "base.php";
include "../Controllers/atmController.php";
$atm_contr = new AtmController();

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
        <form class="" action="">
            <div id="form3" class="container-md d-flex flex-column col-md-8 form3 form " action="">
                <div class="form-group col-md-7 AccType d-flex flex-column">
                    <label style="margin-bottom:30px">Chose your Account Type</label><br>
                    <button type="submit" class="btn btn-primary" name="Checking" id="Next3_1" style="margin-bottom:30px">Checking</button>
                    <button type="submit" class="btn btn-primary" name="Savings" id="Next3_2" style="margin-bottom:100px">Savings</button>
                </div>
            </div>
        </form>
    </div>
</body>

<!-- <script>
    var Form1 = document.getElementById("form1");
    var Form2 = document.getElementById("form2");
    var Form3 = document.getElementById("form3");
    var Form4 = document.getElementById("form4");
    var Form5 = document.getElementById("form5");

    var Next3_1 = document.getElementById("Next3_1");
    var Next3_2 = document.getElementById("Next3_2");

    Next3_1.addEventListener("click", function() {
        Form3.classList.add("shift_left");
        Form4.classList.remove("shift_right");
    });
    Next3_2.addEventListener("click", function() {
        Form3.classList.add("shift_left");
        Form4.classList.remove("shift_right");
    });
</script> -->
<script src="./atm.js"></script>

</html>