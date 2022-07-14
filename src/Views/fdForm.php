<?php
include 'base.php';
include '../Config/db.php';
include '../Models/fdFormModel.php';
include '../Controllers/fdFormController.php';

if (isset($_SESSION['error_message'])) {
    echo '<p style="color:red; font-size:1.2rem; align-self:center">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}

$controller = new FDController();
$validity = $controller->checkId();

?>

<?php

$isSuccess = $controller->submitFdAccountDetails();
if ($isSuccess) {
    header("Location: fdCreatedSuccessfully.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>FD form</title>
</head>

<body style="background-color: rgb(0,0,205);display:flex;flex-direction:column; ">
    <main-header></main-header>
    <div class="mt-5">
        <div class="container border border-2 m-5 p-5 mx-auto bg-light " style="margin-top: 50px;">
            <h2>First, check customers' eligibility for applying a loan </h2>
            <form id="myForm" action="fdForm.php" method="post">
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label for="inputAccNo">Savings Account Number </label>
                        <input type="text" class="form-control" id="inputAccNo" name="inputAccNo" placeholder="">
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary" name="submit1" id="submit1">Check</button>
            </form>
            <!-- <button id="switch" name="submit2" onclick="showApplication()">Click to hide visible DIVs and show hidden ones</button> -->
        </div>


        <div class="container border border-2 m-5 p-5 mx-auto bg-light " id="div3" hidden>
            <h2>FD Form</h2>
            <form id="myForm1" action="fdForm.php" method="post">
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
                        <label for="birthday">Birthday</label>
                        <input type="text" class="form-control" id="birthday" placeholder="dd/mm/yyyy">
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
                    <div class="form-group col-md-10">
                        <label for="address">Address </label>
                        <input type="text" class="form-control" id="address" placeholder="Address">
                    </div>
                </div>


                <!-- <div class="form-row">
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
            </div> -->

                <div class="form-row mt-3">
                    <div class="form-group ">
                        <label for="inputFdType">Fd Type</label>
                        <select id="inputFdType" name="inputFdType" class="custom-select mr-sm-2" required>
                            <option value="" disabled selected>choose</option>
                            <?php
                            $fd_types = $controller->getFdTypes();
                            foreach ($fd_types as $fd_type) : ?>
                                <option value=<?php echo $fd_type['fd_type_id']; ?>><?php echo $fd_type['fd_type_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-md-2">
                            <label for="inputFdAmount">Amount</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rs.</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="inputFdAmount" name="inputFdAmount" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAccNo">Savings Account Number </label>
                        <input type="text" class="form-control" id="inputAccNo" name="inputAccNo" placeholder="<?php echo $controller->getAccountNumber() ?> " disabled>
                        <input type="hidden" name="hidden" value="<?php echo $controller->getAccountNumber(); ?>">
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary" name="apply" id="apply">Apply</button>

            </form>

        </div>
    </div>

    <?php
    if ($validity == true && isset($_POST["submit1"])) {

        $array = $controller->autoFill();
    } else {
        if (isset($_POST["submit1"])) {
            $_SESSION['error_message'] = "Invalid Input";
            echo '<p style="color:#dc3545; font-size:2rem; align-self:center">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
    }

    ?>



    <script type="text/javascript">
        const application = document.getElementById("div3");
        var passedArray = <?php echo json_encode($array); ?>;
        // function EnableDisableTextBox() {
        //     var chkYes = document.getElementById("TaxYes");
        //     var inputTaxNo = document.getElementById("inputTaxNo");
        //     inputTaxNo.disabled = chkYes.checked ? false : true;
        //     if (!inputTaxNo.disabled) {
        //         inputTaxNo.focus();
        //     }
        // };


        function showApplication() {
            application.hidden = !application.hidden;

        };

        function autoFill() {
            var full_name = document.getElementById("inputFullName");
            var nic = document.getElementById("inputNIC");
            var birthday = document.getElementById("birthday");
            var email = document.getElementById("inputEmail");
            var mobile = document.getElementById("inputMobile");
            var address = document.getElementById("address");

            // var amount = document.getElementById("inputLoanAmount");
            // var sav_acc_no = document.getElementById("inputAccNo");
            // var fd_no = document.getElementById("inputFDNo");

            full_name.value = passedArray["full_name"];
            nic.value = passedArray["nic"];
            birthday.value = passedArray["birthday"];
            email.value = passedArray["email"];
            mobile.value = passedArray["contact_number"];
            address.value = passedArray["address"];

            // amount.value = passedArray["amount"];
            // sav_acc_no.value = passedArray["sav_acc_no"];
            // fd_no.value = passedArray["fd_no"];

        };

        // var form = document.getElementById("myForm1");

        // function handleForm(event) {
        //     event.preventDefault();
        // }
        // form.addEventListener('submit', handleForm);
    </script>

    <?php
    if (isset($_POST["submit1"])) {
        echo '<script type="text/javascript">showApplication();</script>';
        echo '<script type="text/javascript"> autoFill();</script>';
    }




    ?>
</body>

</html>