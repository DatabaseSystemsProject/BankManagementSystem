<?php include 'base.php' ?>
<?php include '../Models/moneyTransfermodel.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Transfer Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body style="background-color: rgb(0,100,180);display:flex;flex-direction:column; ">
    <main-header></main-header>
    <div class="mt-5">
        <div class="container border border-2 mt-5 p-5 mx-auto bg-light " id="div3">
            <h2>Money Transfer Form</h2>
            <form onsubmit="return false;">
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="accountNumber">Account Number</label>
                        <input type="text" class="form-control" id="accountNumber" placeholder="Account Number">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="fullName">Full Name </label>
                        <input type="text" class="form-control" id="fullName" placeholder="FullName">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Recipient Email Address(optional)</label>
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Amount</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" id="amount" placeholder="Amount">
                            <span class="input-group-text">.00</span>
                        </div>

                    </div>

                </div>

                <div class="confirmDetails" id="confirmDetails" style="display:none;">
                    <p class="my-1 py-1">Press confirm button if details are correct</p>
                    <button type="submit" class="btn btn-primary my-1 mx-5" id="confirm" style="width:100px">Confirm</button>
                    <button type="submit" class="btn btn-primary my-1 mx-5" id="cancel" style="width:100px" onclick="cancelTransfer()">Cancel</button>
                </div>
            </form>
            <button type="submit" class="btn btn-primary" id="apply" onclick=" showConfirmaion()" style="display:block">Apply</button>



        </div>
    </div>


    <script type="text/javascript">
        // const confirmation = document.getElementById("confirmDetails");

        function showConfirmaion() {

            var x = document.getElementById("confirmDetails");
            x.style.display = "block";

            var y = document.getElementById("apply");
            y.style.display = "none";

            var accountNumber = document.getElementById("accountNumber");
            var fullName = document.getElementById("fullName");
            var inputEmail = document.getElementById("inputEmail");
            var amount = document.getElementById("amount");

            accountNumber.disabled = true;
            fullName.disabled = true;
            inputEmail.disabled = true;
            amount.disabled = true;

        };

        function cancelTransfer() {
            sessionStorage.cancelTransfer = 'true';

            var x = document.getElementById("confirmDetails");
            x.style.display = "none";

            var y = document.getElementById("apply");
            y.style.display = "block";

            var accountNumber = document.getElementById("accountNumber");
            var fullName = document.getElementById("fullName");
            var inputEmail = document.getElementById("inputEmail");
            var amount = document.getElementById("amount");

            accountNumber.disabled = false;
            fullName.disabled = false;
            inputEmail.disabled = false;
            amount.disabled = false;
        }
    </script>
</body>

</html>