<?php
include 'base.php';
include "../Controllers/onlineLoanController.php";

$loanController = new OnlineLoanController();
$check = $loanController->checkEligibility();
$user_type = "organization";
$user_id = 123;
$login=111111112;
// $user_type = "personal";
// $user_id = 111111111;
// $login=111111111;



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

    <title>Online Loan</title>
</head>

<body style="background-color: rgb(0,0,205);">

    <!-- <main-header></main-header> -->

    <div class="mt-5">
        <div class="container border border-2 m-5 p-5 mx-auto bg-light ">
            <h2>First, check your eligibility for applying a loan </h2>

            <form method="post">

                <div class="form-row ">
                    <div class="form-group ">
                        <label for="inpuFD1">Select FD Account</label>
                        <select name="inputFD" id="inputFD1" class="custom-select mr-sm-2" required>
                            <?php
                            $fdAccounts = $loanController->getFdAccount($user_id,$user_type);
                            foreach ($fdAccounts as $acc) :
                            ?>
                                <option value="<?php echo $acc['fd_account_id']  ?>"><?php echo $acc['fd_account_id']; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

              

                <div class="form-row ">
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
                                ?>
                                ">
                                <?php
                                // echo $type['loan_plan_name'] 
                                ?>
                            </option>
                            <?php
                            // endforeach;
                            ?>

                        </select>
                    </div>  -->

                    <div class="input-group mb-3">
                        <div class="col-md-2">
                            <label for="inputLoanAmount">Loan Amount</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rs.</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="inputLoanAmount" id="inputLoanAmount1" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-md-2">
                            <label for="inputLoanAmount">Loan Duration</label>
                        </div>
                        <input type="text" class="form-control" aria-label="Loan Duration (Minimum one month duration)" id="inputLoanDuration1" name="inputLoanDuration" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Months</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="check">Check</button>

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
                        <input type="text" class="form-control" id="inputNIC" placeholder="NIC" name="inputNIC" disabled>
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

                    <div class="form-check col-sm-2">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxYes" value="yes" onclick="EnableDisableTextBox()" checked>
                        <label class="form-check-label" for="TaxYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check col-sm-2">
                        <input class="form-check-input" type="radio" name="TaxYes" id="TaxNo" value="no" onclick="EnableDisableTextBox()">
                        <label class="form-check-label" for="TaxNo">
                            No
                        </label>
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="inputTaxNo.">Tax Number</label>
                        <input type="email" class="form-control" id="inputTaxNo" placeholder="Tax No" name="inputTaxNo">
                    </div>
                </div>
            </div>
            <div id="orgData" style="display: none;">
                <div class="my-3" id="abc">
                    <h5>Organization Details</h5>
                    <div class="form-group mt-3 ">
                        <label for="inputFullName">Organization Name</label>
                        <input type="text" class="form-control" id="inputOrgName" placeholder="inputOrgName" name="inputOrgName" disabled>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNIC">Registration number </label>
                            <input type="text" class="form-control" id="inputRegNo" placeholder="Reg No" name="inputRegNo" value="<?php echo $user_id ?>" disabled>
                        </div>
                        <!-- <div class="form-group col-md-6">
                    <label for="inputPassNo">Passport Number</label>
                    <input type="text" class="form-control" id="inputPassNo" placeholder="Passport Number (Optional)" name="inputPassNo">
                </div> -->
                    </div>

                </div>
            </div>



            <div class="my-3" id="loan_data">
                <h5>Loan Details</h5>
                <div class="form-row mt-3">
                    <div class="form-group " id="loanType">
                        <label for="inputLoanType">Loan Type</label>
                        <select id="inputLoanType" class="custom-select mr-sm-2" name="inputLoanType" required>
                            <!-- <option>Choose...</option> -->
                            <?php
                            $loanTypes = $loanController->getLoanTypes();
                            foreach ($loanTypes as $type) : ?>
                                <option value="<?php echo $type['loan_plan_id'] ?>"><?php echo $type['loan_plan_name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

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
                            <label for="inputLoanAmount">Loan Duration</label>
                        </div>
                        <input type="text" class="form-control" aria-label="Loan Duration (Minimum one month duration)" id="inputLoanDuration" name="inputLoanDuration" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Months</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3" id="gurantor_data" hidden>
                <h5>Guarantor's Details</h5>
                <div class="form-group mt-3 ">
                    <label for="inputFullName">Full Name</label>
                    <input type="text" class="form-control" id="inputFullName" placeholder="Full Name" name="inputFullName" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNIC">NIC </label>
                        <input type="text" class="form-control" id="inputNIC" placeholder="NIC" name="inputNIC" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassNo">Passport Number</label>
                        <input type="text" class="form-control" id="inputPassNo" placeholder="Passport Number (Optional)" name="inputPassNo">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="inputEmail" >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMobile">Mobile Number</label>
                        <input type="text" class="form-control" id="inputMobile" placeholder="07********" name="inputMobile" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAccNo">Savings Account Number </label>
                    <input type="text" class="form-control" id="inputAccNo" placeholder="Savings Account Number" name="inputAccNo" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFDNo">Fixed Deposite Number</label>
                    <input type="text" class="form-control" id="inputFDNo" placeholder="Fixed Deposite Number" name="inputFDNo" disabled>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="apply" value="apply">Apply</button>
            <button type="cancel" class="btn btn-primary" name="cancel" value="cancel" onclick="window.history.back();">Cancel</button>
        </form>
    </div>


    <?php

    if ($check && isset($_POST)) {
        $array = $loanController->autoFill($user_id,$login);
    }
    ?>

    <!-- <script type="text/javascript">
        const application = document.getElementById("div3");

        var passedArray = <?php
                            // echo json_encode($array); ?>;

        function EnableDisableTextBox() {
            var chkYes = document.getElementById("TaxYes");
            var inputTaxNo = document.getElementById("inputTaxNo");
            inputTaxNo.disabled = chkYes.checked ? false : true;
            if (!inputTaxNo.disabled) {
                inputTaxNo.focus();
            }
        };


        function showApplication() {
            application.hidden = !application.hidden;

        };

        function showjhv() {

            document.getElementById("a").style.display = "block";
        };

        function fill() {
            var full_name = document.getElementById("inputFullName");
            var nic = document.getElementById("inputNIC");
            var email = document.getElementById("inputEmail");
            var mobile = document.getElementById("inputMobile");
            var amount = document.getElementById("inputLoanAmount");
            var sav_acc_no = document.getElementById("inputAccNo");
            var fd_no = document.getElementById("inputFDNo");
            var duration = document.getElementById("inputLoanDuration");

            full_name.value = passedArray["full_name"];
            nic.value = passedArray["nic"];
            email.value = passedArray["email"];
            mobile.value = passedArray["mobile"];
            amount.value = passedArray["amount"];
            sav_acc_no.value = passedArray["sav_acc_no"];
            fd_no.value = passedArray["fd_no"];

            console.log(duration);
            duration.value = passedArray["duration"];


        };

        // function autoFill() {
        //     var full_name = document.getElementById("inputFullName");
        //     var nic = document.getElementById("inputNIC");
        //     var email = document.getElementById("inputEmail");
        //     var mobile = document.getElementById("inputMobile");
        //     var amount = document.getElementById("inputLoanAmount");
        //     var sav_acc_no = document.getElementById("inputAccNo");
        //     var fd_no = document.getElementById("inputFDNo");

        //     full_name.value = passedArray["full_name"];
        //     nic.value = passedArray["nic"];
        //     email.value = passedArray["email"];
        //     mobile.value = passedArray["mobile"];
        //     amount.value = passedArray["amount"];
        //     sav_acc_no.value = passedArray["sav_acc_no"];
        //     fd_no.value = passedArray["fd_no"];

        // };
    </script> -->

    <script type="text/javascript">
        const application = document.getElementById("div3");
        var passedArray = 
        <?php echo json_encode($array); 
        ?>;

        function EnableDisableTextBox() {
            var chkYes = document.getElementById("TaxYes");
            var inputTaxNo = document.getElementById("inputTaxNo");
            inputTaxNo.disabled = chkYes.checked ? false : true;
            if (!inputTaxNo.disabled) {
                inputTaxNo.focus();
            }
        };

        function showOrg() {

            document.getElementById("orgData").style.display="block";
            document.getElementById("loanType").style.display="none";
        };
        function showApplication() {
            application.hidden = !application.hidden;

        };
        function fill() {
            var full_name = document.getElementById("inputFullName");
            var nic = document.getElementById("inputNIC");
            var email = document.getElementById("inputEmail");
            var mobile = document.getElementById("inputMobile");
            var amount = document.getElementById("inputLoanAmount");
            var duration = document.getElementById("inputLoanDuration");
            var sav_acc_no = document.getElementById("inputAccNo");
            var fd_no = document.getElementById("inputFDNo");
            var org_name = document.getElementById("inputFDNo");

            full_name.value = passedArray["full_name"];
            nic.value = passedArray["nic"];
            email.value = passedArray["email"];
            mobile.value = passedArray["mobile"];
            amount.value = passedArray["amount"];
            duration.value = passedArray["duration"];
            sav_acc_no.value = passedArray["sav_acc_no"];
            fd_no.value = passedArray["fd_no"];
            org_name.value=passedArray["org_name"];




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
    if ($user_type == "organization") {

        echo "<script type='text/javascript'>showOrg();</script>";
        
    }

    ?>


</body>

</html>