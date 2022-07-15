<?php
session_start();
include 'base.php';
include_once '../Controllers/moneyTransferController.php';
include_once '../Models/moneyTransfermodel.php';
include_once '../Config/db.php';
include_once '../Helpers/mail.php';
//$sender_id = $_SESSION['account_no'];
$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
// $sender_id = $_SESSION['account_no'];
$myUrl = strval($account_type) . "Dashboard.php";
$sender_id = 456;

if (isset($_POST["submit"])) {
    $controller = new moneyTransferController();
    $data = $controller->submitForm();
    if (sizeof($data) != 0) {
        $controller->updateBalance($data[0], $data[1], $sender_id);
    } else {
        $_SESSION['error_message'] = "Invalid account number";
        echo '<p style="color:red; font-size:3rem; align-self:center; margin-bottom:-4%;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Transfer Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body style="background-color: rgb(0,100,180);display:flex;flex-direction:column; ">
    <!-- <main-header></main-header> -->
    <div class="mt-5">
        <div class="container border border-2 mt-5 p-5 mx-auto bg-light " id="div3">
            <h2>Money Transfer Form</h2>
            <form id="myForm" action="onlineMoneyTransferForm.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="accountNumber">Account Number</label>
                        <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Account Number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="fullName">Full Name </label>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="FullName" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Recipient Email Address(optional)</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Amount</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" required>
                            <span class="input-group-text">.00</span>
                        </div>

                    </div>

                </div>

                <div class="confirmDetails" id="confirmDetails">
                    <p class="my-1 py-1">Press confirm button if details are correct</p>
                    <!-- <input type="submit" value="submit" class="btn btn-primary my-1 mx-5" id="confirm" name="submit" style="width:100px" onclick="return confirmSubmit()"> -->
                    <button type="button" class="btn btn-primary my-1 mx-5" id="confirm" name="submit1" style="width:100px" data-bs-toggle="modal" data-bs-target="#myModal" onclick="ValidateEmail(document.myForm.inputEmail)">Confirm</button>
                    <button type="reset" value="reset" class="btn btn-primary my-1 mx-5" id="cancel" style="width:100px">Cancel</button>

                </div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Are you sure to confirm the entered details?</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" value="submit" class="btn btn-primary my-1 mx-5" id="confirm" name="submit" style="width:100px">
                                <button type="button" class="btn btn-primary my-1 mx-5" data-bs-dismiss="modal" style="width:100px">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>




        </div>

    </div>


    <script type="text/javascript">
        function confirmSubmit() {
            var agree = confirm("Are you sure you wish to continue?");
            if (agree)
                return true;
            else
                return false;
        }

        function setInputFilter(textbox, inputFilter, errMsg) {
            [
                "input",
                "keydown",
                "keyup",
                "mousedown",
                "mouseup",
                "select",
                "contextmenu",
                "drop",
                "focusout",
            ].forEach(function(event) {
                textbox.addEventListener(event, function(e) {
                    if (inputFilter(this.value)) {
                        // Accepted value
                        if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                            this.classList.remove("input-error");
                            this.setCustomValidity("");
                        }
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        // Rejected value - restore the previous one
                        this.classList.add("input-error");
                        this.setCustomValidity(errMsg);
                        this.reportValidity();
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        // Rejected value - nothing to restore
                        this.value = "";
                    }
                });
            });
        }
        setInputFilter(
            document.getElementById("accountNumber"),
            function(value) {
                return /^\d*$/.test(value);
            },
            "Must be a valid number"
        );

        function ValidateEmail(inputText) {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (inputText.value.match(mailformat)) {
                alert("Valid email address!");
                document.form1.text1.focus();
                return true;
            } else {
                alert("You have entered an invalid email address!");
                document.form1.text1.focus();
                return false;
            }
        }
    </script>
</body>

</html>