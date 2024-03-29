<?php 
include 'base.php';
include "../Controllers/regularLoanController.php";
session_start();
$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
$myUrl = strval($account_type) . "Dashboard.php";

$loanController = new RegularLoanController();
$check = $loanController->checkEligibility();


if (isset($_SESSION['error_message'])) {
    echo '<p style="color:red; font-size:1.2rem; align-self:center">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script>
        function gotoDashboard() {
            console.log("set");
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        };
    </script>
    <title>Regular Loan</title>
</head>

<body style="background-color: rgb(0,0,205);">
    <main-header></main-header>
    <div class="mt-5">
        <div class="container border border-2 m-5 p-5 mx-auto bg-light ">
            <h2>First, enter a Savings Account </h2>

            <form method="post">
                <div class="form-row mt-3">
                    <div class="form-group col-md-2">
                        <label for="inputAccNo">Savings Account Number </label>
                    </div>
                    <div class="form-group col-md-10">
                        <input type="text" class="form-control" name="inputAccNo" id="inputAccNo1" placeholder="Savings Account Number" required>
                    </div>
                </div>

                <div class="form-row ">
                    <div class="form-group col-md-2">
                        <label for="inputAccNo">NIC Number </label>
                    </div>
                    <div class="form-group col-md-10">
                        <input type="text" class="form-control" name="inputNIC" id="inputNIC1" placeholder="Applicant's NIC" required>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary" name="check">Enter</button>

            </form>

            <!-- <button id="switch" onclick="showApplication()">Click to hide visible DIVs and show hidden ones</button> -->
        </div>
    </div>


    <div class="container border border-2 m-5 p-5 mx-auto bg-light " id="div3" hidden>
        <h2>Loan Application Form</h2>

        <form method="post">

            <div class="my-3" id="applicant_data">
                <h5>Loan Applicant's Details</h5>
                <div class="form-group mt-3 ">
                    <label for="inputFullName">Full Name</label>
                    <input type="text" class="form-control" id="inputFullName" placeholder="Full Name" name="inputFullName" disabled>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNIC">NIC </label>
                        <input type="text" class="form-control" id="inputNIC" placeholder="NIC" name="inputNIC">
                    </div>
                    <!-- <div class="form-group col-md-6">
                    <label for="inputPassNo">Passport Number</label>
                    <input type="text" class="form-control" id="inputPassNo" placeholder="Passport Number (Optional)" name="inputPassNo">
                </div> -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="inputEmail" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMobile">Mobile Number</label>
                        <input type="text" class="form-control" id="inputMobile" placeholder="07********" name="inputMobile" disabled>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="row">
                    <legend class="col-form-label col-sm-3 pt-0">Tax Payer?</legend>

                    <div class="form-check col-sm-3">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxYes" value="yes" onclick="EnableDisableTextBox()" checked>
                        <label class="form-check-label" for="TaxYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check col-sm-3">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxNo" value="no" onclick="EnableDisableTextBox()">
                        <label class="form-check-label" for="TaxNo">
                            No
                        </label>
                    </div>
                    <div class="form-group col-sm-5" id="inputTaxdata">
                        <label for="inputTaxNo">Tax Number</label>
                        <input type="text" class="form-control" id="inputTaxNo" placeholder="Tax No" name="inputTaxNo">
                    </div>
                </div>
            </div>
            <div id="orgData" style="display: none;">
                <div class="my-3" id="abc">
                    <h5>Organization Details</h5>
                    <div class="form-group mt-3 ">
                        <label for="inputFullName">Organization Name</label>
                        <input type="text" class="form-control" id="inputOrgName" placeholder="Full Name" name="inputFullName" disabled>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNIC">Registration number </label>
                            <input type="text" class="form-control" id="inputRegNo" placeholder="Reg No" name="inputRegNo" value="">
                        </div>
                    </div>

                </div>
            </div>

            <div class="my-3" id="loan_data">
                <h5>Loan Details</h5>
                <div class="form-row mt-3">
                    <div class="form-group " id="loanType">
                        <label for="inputLoanType">Loan Type</label>
                        <select id="inputLoanType" class="custom-select mr-sm-2" name="inputLoanType">
                            <!-- <option>Choose...</option> -->
                            <?php
                            if ($_SESSION['customer_account_type'] == "organization") { ?>
                                <option value="business">Business</option>
                            <?php
                            } else { ?>
                                <option value="personal">Personal</option>
                            <?php
                            unset($_SESSION['customer_account_type']);
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="form-group ">
                        <label for="inputLoanType">Loan Type</label>
                        <select id="inputLoanType" class="custom-select mr-sm-2" name="inputLoanType" required>
                            <?php
                            // $loanTypes = $loanController->getLoanTypes();
                            // foreach ($loanTypes as $type) : 
                            ?>
                                <option value="
                                <?php
                                // $type['loan_plan_id'] 
                                ?>"><?php
                                    // echo $type['loan_plan_name'] 
                                    ?></option>
                            <?php
                            // endforeach;
                            ?>
                        </select>
                    </div> -->

                    <div class="input-group mb-3">
                        <div class="col-md-2">
                            <label for="inputLoanAmount">Loan Amount</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rs.</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="inputLoanAmount" name="inputLoanAmount" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-md-2">
                            <label for="inputLoanDuration">Loan Duration</label>
                        </div>
                        <input type="number" id="inputYear" name="inputYear" min="0" max="100" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Years</span>
                        </div>
                        <input type="number" id="inputMonth" name="inputMonth" min="0" max="11" required>
                        <!-- <input type="text" class="form-control" aria-label="Loan Duration (Minimum one month duration" id="inputLoanDuration" name="inputLoanDuration"> -->
                        <div class="input-group-append">
                            <span class="input-group-text">Months</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3" id="gurantor_data">
                <h5>Guarantor's Details</h5>
                <div class="form-group mt-3 ">
                    <label for="inputFullName">Full Name</label>
                    <input type="text" class="form-control" id="inputGuarantorFullName" placeholder="Full Name" name="inputGuarantorFullName" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNIC">NIC </label>
                        <input type="text" class="form-control" id="inputGuarantorNIC" placeholder="NIC" name="inputGuarantorNIC" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassNo">Passport Number</label>
                        <input type="text" class="form-control" id="inputGuarantorPassNo" placeholder="Passport Number (Optional)" name="inputGuarantorPassNo">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputGuarantorEmail" placeholder="Email" name="inputGuarantorEmail">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMobile">Mobile Number</label>
                        <input type="text" class="form-control" id="inputGuarantorMobile" placeholder="07********" name="inputGuarantorMobile" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAccNo">Savings Account Number </label>
                    <input type="text" class="form-control" id="inputAccNo" placeholder="Savings Account Number" name="inputAccNo" required>
                </div>

            </div>
            <button type="submit" class="btn btn-primary" name="apply" value="apply">Apply</button>
        </form>



    </div>
    <?php

    if ($check && isset($_POST)) {
        $array = $loanController->autoFill();
    }
    ?>


    <script type="text/javascript">
        const application = document.getElementById("div3");
        var passedArray =
            <?php echo json_encode($array);
            ?>;


        function EnableDisableTextBox() {
            var chkYes = document.getElementById("TaxYes");
            var inputTaxNo = document.getElementById("inputTaxdata");
            inputTaxNo.hidden = chkYes.checked ? false : true;
            if (inputTaxNo.hidden) {
                inputTaxNo.value = null;
            }
        };

        function showOrg() {

            document.getElementById("orgData").style.display = "block";
       
        };

        function showApplication() {
            application.hidden = !application.hidden;

        };

        function fill() {
            var full_name = document.getElementById("inputFullName");
            var nic = document.getElementById("inputNIC");
            var email = document.getElementById("inputEmail");
            var mobile = document.getElementById("inputMobile");
            var sav_acc_no = document.getElementById("inputAccNo");
            var org_name = document.getElementById("inputOrgName");
            var reg_no = document.getElementById("inputRegNo");

            full_name.value = passedArray["full_name"];
            nic.value = passedArray["nic"];
            email.value = passedArray["email"];
            mobile.value = passedArray["mobile"];
            sav_acc_no.value = passedArray["sav_acc_no"];
            org_name.value = passedArray["org_name"];
            reg_no.value = passedArray["reg_no"];
            console.log(reg_no.value);





        };
    </script>

    <?php

    if ($check && isset($_POST)) {

        // $array=$loanController->autoFill();
        echo '<script type="text/javascript">showApplication();</script>';
        echo '<script type="text/javascript"> 
        fill();</script>';
        // }elseif(!$check && isset($_POST)) {
        //     // echo '<script type="text/javascript">alert("You are not eligable for applying a loan");</script>'; 
    }
    // echo "<h1>dgf</h1>";
    // echo '<script type="text/javascript">showjhv();</script>';
    if ($loanController->isOrg()) {


        echo "<script type='text/javascript'>showOrg();</script>";
    }
    if (isset($_POST["apply"])) {
        // echo "Set";
        $loanController->submitAppication($login);
    }


    ?>
</body>

</html>