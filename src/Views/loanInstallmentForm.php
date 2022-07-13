<?php include 'base.php';
session_start();
$_SESSION["loan_payments"] = "Months to settle : January";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Loan Installment </title>
</head>

<body style="background-color: rgb(0,0,205);">
    <main-header></main-header>
    <div style="margin-top:57px !important; border-radius:6px;" class="container border border-2 mt-1 p-4 mx-auto bg-light">
        <form class="form mx-auto" action="">
            <div class="form-group">
                <div class="row col-md-6 align-items-center mx-auto">
                    <Label for="loanID" class="col-sm-2 control-label" style="color:black">Loan ID</Label>
                    <div class="col-sm-6"><input type="text" class="form-control " id="loanID" placeholder="Enter loan id"></div>
                    <div class="col-sm-2"><button class="btn btn-primary" type="submit" name="check">check</button></div>
                </div>
            </div>
        </form>
    </div>
    <div style="margin-top:1px; border-radius:5px;" class="container border border-2 m p-5 mx-auto bg-light" id="hidDiv">
        <?php
        if (isset($_SESSION["loan_payments"])) {
            echo '<p style="color:red; font-size:1.2rem; padding:0px">' . $_SESSION["loan_payments"] . '</p>';
        }
        ?>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label style="color:black" for="inputNIC">NIC </label>
                    <input type="text" class="form-control" id="inputNIC" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label style="color:black" for="loanType">Loan type</label>
                    <input type="text" class="form-control" id="loanType" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label style="color:black" for="amount">Amount </label>
                    <input type="text" class="form-control" id="amount" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label style="color:black" for="duration">Duration</label>
                    <input type="text" class="form-control" id="duration" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label style="color:black" for="remaining">Total Remaining( with interest )</label>
                    <input type="text" class="form-control" id="remaining" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label style="color:black" for="installment">Monthly Installment</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rs</span>
                        <input type="text" name="amount" id="amount" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group ">
                    <label for="month">Month</label>
                    <select id="month" class="custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                </div>
            </div>
            <div class="d-grid col-6 mx-auto" style="margin-top:40px ;">
                <button class=" btn btn-primary">Pay Installment</button>
            </div>
        </form>
    </div>
</body>

</html>