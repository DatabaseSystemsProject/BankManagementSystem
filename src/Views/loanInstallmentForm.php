<?php
session_start();
include 'base.php';
require_once '../Controllers/loanInsContoller.php';
$loanInsController = new LoanInsController();
// $_SESSION["loanInsController"] = $loanInsController;
$unpaidMonths = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Loan Installment </title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body style="background-color: rgb(0,0,205);">
    <main-header></main-header>
    <div style="margin-top:77px !important; border-radius:6px;" class="container border border-2 mt-1 p-4 mx-auto bg-light">
        <form action="loanInstallmentForm.php" method="post" id="myForm" class="form mx-auto">
            <div class="form-group">
                <div class="row col-md-6 align-items-center mx-auto">
                    <Label for="loanID" class="col-sm-2 control-label" style="color:black">Loan ID</Label>
                    <div class="col-sm-6"><input type="text" class="form-control" name="loanID" id="loanID" placeholder="Enter loan id"></div>
                    <div class="col-sm-2"><button class="btn btn-primary" type="submit" name="check" onclick="">check</button></div>
                </div>
            </div>
            <?php
            if (isset($_SESSION["error_message"])) {
                echo '<p style="color:red; font-size:1.2rem; padding:0px">' . $_SESSION["error_message"] . '</p>';
                unset($_SESSION["error_message"]);
            }

            ?>
        </form>

    </div>
    <?php
    if (isset($_POST["check"])) {
        $loanInsController->checkLoanID();
    }
    if (isset($_POST["pay"])) {
        $loanInsController->payInstallment();
    }

    ?>
</body>

</html>