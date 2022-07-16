<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
    header("Location: ./login.php");
}
include "base.php";
include "../Controllers/atmController.php";
$atm_contr = new AtmController();
if (isset($_POST["exit"])) {
    header("Location: ./customerDashboard.php");
}

$myUrl =  "customerDashboard.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/atm.css">
    <script>
        function gotoDashboard() {
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        }
    </script>

    <title>atm</title>
</head>

<body>
    <main-header></main-header><br><br>
    <div class="container mx-auto col-md-5 d-flex flex-column">
        <div class="bankName">
            <img src="../Resources/Images/logoBlack.png" alt="no title">
        </div>
        <form method="post" action="./atm0.php">
            <div id="form1" class="container-md d-flex flex-column col-md-8 form1 form mx-auto" action="">
                <div class="header">Welcome to Phoenix Trust Bank</div>

                <div class="form-group col-md-7 Enter d-flex flex-column">
                    <label for="cardNo">Enter card number</label><br>
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<p style="color:red; font-size:1.2rem; align-self:center; padding:0px">' . $_SESSION['error_message'] . '</p>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <input type="text" name="cardNo" class="form-control" id="cardNo" style="margin-bottom:30px">
                    <div class="d-grid gap-3 ">
                        <button type="submit" class="btn btn-primary shadow" id="Next1" name="submit">Enter</button>
                        <button type="submit" class="btn btn-danger shadow col-3 mx-auto" id="exit" name="exit">Exit</button>
                    </div>
                </div>
        </form>

        <?php
        $atm_contr->checkCardNo();

        ?>


    </div>
</body>
<script src="./atm.js"></script>
<script>
    var Form1 = document.getElementById("form1");
    var Form2 = document.getElementById("form2");
    var Form3 = document.getElementById("form3");
    var Form4 = document.getElementById("form4");
    var Form5 = document.getElementById("form5");



    setInputFilter(
        document.getElementById("cardNo"),
        function(value) {
            return /^\d*$/.test(value);
        },
        "Must be a valid number"
    );

    function gotoDashboard() {
        var url = <?php echo (json_encode($myUrl)); ?>;
        window.location.href = url;
    }
</script>


</html>