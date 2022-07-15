<?php
session_start();


include 'base.php';
include '../Controllers/withdrawController.php';
$withdrawContr = new WithdrawController();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Withdraw Money</title>
</head>

<body style="background-color: rgb(0,0,205);">
    <main-header></main-header>
    <div style="margin-top:57px !important; border-radius:6px;" class="container wrapper border border-2 mt-1 p-5 mx-auto bg-light">
        <form method="post">
            <div class="d-grid col-md-5 mx-auto">
                <header style="font-size:2rem; color:#0648AB; margin-bottom:30px; font-weight:500; text-align:center;">Withdrawal Form</header>
            </div>
            <?php if (isset($_SESSION['error_message'])) {
                echo '<p style="color:red; font-size:1.2rem; padding:0px;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>
            <div class="form-group col-md-10 ">
                <label style="color:black" for="amount">Account Number </label>
                <input type="text" class="form-control inputs" name="accountNo" id="accountNo">
            </div>

            <div class="form-group col-md-10">
                <label style="color:black" for="amount">NIC </label>
                <input type="text" class="form-control inputs" id="nic" name="nic">
            </div>

            <div class="form-group col-md-10">
                <label style="color:black" for="amount">Amount </label>
                <input type="text" class="form-control inputs" id="amount" name="amount">
            </div>

            <div class="d-grid col-6 mx-auto" style="margin-top:40px ;">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="confirm">Withdraw</button><br>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content" style="border-radius:10px; border-style:groove;border-color:darksalmon">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:#0648AB">Confirm Withdrawal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Please confirm to withdraw
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="withdraw" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <?php
        if (isset($_POST['withdraw'])) {
            $withdrawContr->validateDetails();
        } ?>
    </div>

    <script>
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
            document.getElementById("accountNo"),
            function(value) {
                return /^\d*$/.test(value);
            },
            "Must be a valid number"
        );

        setInputFilter(
            document.getElementById("amount"),
            function(value) {
                return /^\d*$/.test(value);
            },
            "Must be a valid amount"
        );

        setInputFilter(
            document.getElementById("nic"),
            function(value) {
                return /^\d*$/.test(value);
            },
            "Must be a valid amount"
        );

        const button = document.getElementById("confirm");
        button.disabled = true;

        let wrapper = document.querySelector('.wrapper');
        let inputs = [...wrapper.querySelectorAll('.inputs')];

        function validate() {
            let isIncomplete = inputs.some(input => !input.value);
            button.disabled = isIncomplete;
        }
        wrapper.addEventListener('input', validate);
        validate();
    </script>

</body>

</html>