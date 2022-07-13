<?php include 'base.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Onlin Loan</title>
</head>

<body style="background-color: rgb(0,0,205);">
    <main-header></main-header>
    <div  class="container border border-2 m-5 p-5 mx-auto bg-light " id="div3">
        <h2>Loan Application Form</h2>
        <form>
            <div class="form-group mt-3 ">
                <label for="inputFullName">Full Name</label>
                <input type="text" class="form-control" id="inputFullName" placeholder="Full Name">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNIC">NIC </label>
                    <input type="text" class="form-control" id="inputNIC" placeholder="NIC">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassNo">Passport Number</label>
                    <input type="text" class="form-control" id="inputPassNo" placeholder="Passport Number (Optional)">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputMobile">Mobile Number</label>
                    <input type="text" class="form-control" id="inputMobile" placeholder="07********">
                </div>
            </div>
            <div class="form-row">
                <div class="row">
                    <legend class="col-form-label col-sm-3 pt-0">Tax Payer?</legend>

                    <div class="form-check col-sm-2">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxYes" value="option1" onclick="EnableDisableTextBox()" checked>
                        <label class="form-check-label" for="TaxYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check col-sm-2">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxNo" value="option2" onclick="EnableDisableTextBox()">
                        <label class="form-check-label" for="TaxNo">
                            No
                        </label>
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="inputTaxNo.">Tax Number</label>
                        <input type="email" class="form-control" id="inputTaxNo" placeholder="Tax No">
                    </div>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group ">
                    <label for="inputLoanType">Loan Type</label>
                    <select id="inputLoanType" class="custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option>Business</option>
                        <option>Personal</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="col-md-2">
                        <label for="inputLoanAmount">Loan Amount</label>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rs.</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="inputLoanAmount">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="col-md-2">
                        <label for="inputLoanAmount">Loan Duration</label>
                    </div>
                    <input type="text" class="form-control" aria-label="Loan Duration (Minimum one month duration" id="inputLoanDuration">
                    <div class="input-group-append">
                        <span class="input-group-text">Months</span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAccNo">Savings Account Number </label>
                    <input type="text" class="form-control" id="inputAccNo" placeholder="758****" disabled>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Apply</button>
        </form>
    </div>


    <script type="text/javascript">
        const application = document.getElementById("div3");

        function EnableDisableTextBox() {
            var chkYes = document.getElementById("TaxYes");
            var inputTaxNo = document.getElementById("inputTaxNo");
            inputTaxNo.disabled = chkYes.checked ? false : true;
            if (!inputTaxNo.disabled) {
                inputTaxNo.focus();
            }
        };
    </script>
</body>

</html>