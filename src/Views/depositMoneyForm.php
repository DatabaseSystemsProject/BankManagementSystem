<?php

include 'base.php';
include_once("../Controllers/depositMoneyController.php");
session_start();
$depositMoneyCtrl = new DepositMoneyController();
$empID = 345666; // remove this when adding session


$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
$myUrl = strval($account_type) . "Dashboard.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script>
    function gotoDashboard() {
        var url = <?php echo (json_encode($myUrl)); ?>;
        window.location.href = url;
    }
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Money</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2>Deposit Money</h2> <br>
    <form action="" method="post" enctype="multipart/form-data">
            <?php if (isset($_SESSION['error_message'])) {
                echo '<p style="color:red; font-size:1.2rem; padding:0px;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAccNo">Account Number</label>
                <input type="number" class="form-control" id="inputAccNo" name="inputAccNo" placeholder="Account Number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAmount">Amount</label>
                <input type="number" class="form-control" id="inputAmount" name="inputAmount" placeholder="Amount" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputRemarks">Remarks</label>
                <input type="text-box" class="form-control" id="inputRemarks" name="inputRemarks" placeholder="Remarks">
            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-primary" id="deposit" name="deposit">Deposit</button>

    </form>
</div>
<script type="text/javascript">
    
    //deposit cannot be negative
    //account should exist
</script>
<?php
$depositMoneyCtrl->depositMoney($empID);
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>