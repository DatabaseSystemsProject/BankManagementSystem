<?php
session_start();
if (!isset($_SESSION["atm2direct"])) {
    header("Location: ./atm0.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>atm</title>
</head>

<body>
    <main-header></main-header><br><br>
    <div class="container mx-auto col-md-5 d-flex flex-column">
        <div class="bankName">
            <img src="../Resources/Images/logoBlack.png" alt="no title">
        </div>
        <form method="post" class="">
            <div id="form4" class="container-md d-flex flex-column col-md-8 form4 form ">
                <div class="form-group col-md-7 Amount d-flex flex-column">
                    <label for="amount">Enter the amount to withdraw</label><br>
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<p style="color:red; font-size:1.2rem; align-self:center; padding:0px">' . $_SESSION['error_message'] . '</p>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <div class="input-group mb-3" style="margin-bottom:35px !important">
                        <span class="input-group-text">Rs</span>
                        <input type="text" name="amount" id="amount" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                    <div class="d-grid gap-4 ">
                        <button type="submit" name="submit" class="btn btn-primary shadow">Withdraw</button>
                        <button type="submit" class="btn btn-danger col-3 mx-auto shadow" id="exit" name="exit">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
        <?php
        $atm_contr->withdraw();
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

    var Next3_1 = document.getElementById("Next3_1");
    var Next3_2 = document.getElementById("Next3_2");

    setInputFilter(
        document.getElementById("amount"),
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