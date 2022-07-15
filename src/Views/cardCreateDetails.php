<?php
session_start();
include 'base.php';
include '../Controllers/cardController.php';
$cardContr = new CardController();
$result = $cardContr->getCardDetails($_SESSION["account_no"]);
$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
$myUrl = strval($account_type) . "Dashboard.php";
if (isset($_POST["exit"])) {
    if (isset($_SESSION["account_no"])) {
        // unset($_SESSION["account_no"]);
    }
    header("Location: ./employeeDashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/insufficientBalance.css">
</head>

<body>

    <main-header></main-header>
    <main>
        <div class="card mx-auto" style="width: 50rem; height:27rem; margin: 0; position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
            <div class="card-body" style="display: flex; flex-direction:column;">
                <h2 style="color:green !important; margin-bottom:-20px" class="card-title mx-auto">Card Details Account Number-<?php echo $_SESSION["account_no"] ?></h2>
                <p class="card-text mx-auto" style="margin-bottom:-100px !important">Card number: </p>
                <p class="card-text mx-auto" style=" color:green; margin-bottom:-80px !important"> <?php echo $result["card_no"] ?></p>
                <p class="card-text mx-auto" style="margin-bottom:-100px !important">Pin number: </p>
                <p class="card-text mx-auto" style="color:red; margin-bottom:-30px !important"> <?php echo $result["pin_no"] ?></p>
                <div class="mx-auto">
                    <form method="post" action="./cardCreateDetails.php">
                        <button type=submit name="exit" class="btn btn-primary mx-auto" style="width:10vw">Exit</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        function gotoDashboard() {
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        }
    </script>
</body>

</html>