<?php
include "base.php"
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
        <form method="post" class="" action="">
            <div id="form1" class="container-md d-flex flex-column col-md-8 form1 form mx-auto" action="">
                <div class="header">Welcome to Phoenix Trust Bank</div>

                <div class="form-group col-md-7 Enter d-flex flex-column">
                    <label>Enter your card</label><br>
                    <button type="button" class="btn btn-primary " id="Next1" style="margin-bottom:100px">Enter</button>

                </div>
            </div>
            <div id="form2" class="container-md d-flex flex-column col-md-8 form2 form shift_right" action="">
                <div class="form-group col-md-7 AccNumber d-flex flex-column">
                    <label for="accNo">Enter your Account Number</label><br>
                    <input type="text" class="form-control" id="accNo" style="margin-bottom:30px">
                    <button type="submit" class="btn btn-primary"  style="margin-bottom:100px">Enter</button>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
    var Form1 = document.getElementById("form1");
    var Form2 = document.getElementById("form2");
    var Form3 = document.getElementById("form3");
    var Form4 = document.getElementById("form4");
    var Form5 = document.getElementById("form5");

    const Next1 = document.getElementById("Next1");

    var Next3_1 = document.getElementById("Next3_1");
    var Next3_2 = document.getElementById("Next3_2");
    var Next4 = document.getElementById("Next4");

    Next1.addEventListener("click", function() {
        Form1.classList.add("shift_left");
        Form2.classList.remove("shift_right");
    });
  

</script>
<script src="./atm.js"></script>

</html>