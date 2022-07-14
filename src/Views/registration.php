<?php include 'base.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto ">
    <form>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputTitle">Title</label>
                <select id="inputTitle" class="custom-select mr-sm-2">
                    <option selected>Choose...</option>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss.</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="inputFirstName">First Name</label>
                <input type="email" class="form-control" id="inputFirstName" placeholder="First Name">
            </div>
            <div class="form-group col-md-5">
                <label for="inputLastName">Last Name</label>
                <input type="password" class="form-control" id="inputLastName" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group ">
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
            <div class="form-group col-md-3">
                <label>Date of Birth:</label>
                <input type="text" id="inputDateofBirth" class="form-control" placeholder="Click to show the datepicker">
            </div>
            <div class="form-group  col-md-5">
                <label for="inputCitizeship">Citizeship </label>
                <input type="text" class="form-control" id="inputCitizeship" placeholder="Citizeship">
            </div>
            <div class="form-group col-md-4">
                <label for="inputStatus">Status</label>
                <select id="inputStatus" class="custom-select mr-sm-2">
                    <option selected>Choose...</option>
                    <option>Single</option>
                    <option>Married</option>
                    <option>Divorced</option>
                    <option>Other</option>
                </select>
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-3 pt-0">Gender</legend>

                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Female
                    </label>
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Male
                    </label>
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                    <label class="form-check-label" for="gridRadios3">
                        Other
                    </label>
                </div>
            </div>

        </fieldset>

        <div class="form-group">
            <label for="inputAddress2">Address </label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Address">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputProvince">Province</label>
                <input type="text" class="form-control" id="inputProvince">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip Code</label>
                <input type="text" class="form-control" id="inputZip">
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
                    <!-- <input type="email" class="form-control" id="inputTaxNo" placeholder="Tax No" > -->
                    <select name="inputTaxNo" id="inputTaxNo">
                        <option value="Plan 1">Plan 1</option>
                        <option value="Plan 2">Plan 2</option>
                        <option value="Plan 3">Plan 3</option>
                        <option value="Plan 4">Plan 4</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#inputDateofBirth').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy"
        });
    });

    function EnableDisableTextBox() {
        var chkYes = document.getElementById("TaxYes");
        var inputTaxNo = document.getElementById("inputTaxNo");
        inputTaxNo.disabled = chkYes.checked ? false : true;
        if (!inputTaxNo.disabled) {
            inputTaxNo.focus();
        }
    }
</script>
</body>

</html>