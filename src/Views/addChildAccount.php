<?php

include 'base.php';
include_once("../Controllers/individualCustomerController.php");
include_once("../Controllers/branchController.php");
include_once("../Controllers/savingsPlanController.php");
include_once("../Controllers/accountController.php");
include_once("../Controllers/childController.php");

$individualCtrl = new individualCustomerController();
$branchCtrl = new BranchController();
$savingsPlanCtrl = new SavingsPlanController();
$accountCtrl = new AccountController();
$childCtrl = new ChildController();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <script>
        function gotoDashboard() {
        var url = <?php echo (json_encode($myUrl)); ?>;
        window.location.href = url;
    }
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Child Savings Account</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2> Add Child Savings Account </h2> <br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="inputNIC">Enter Guardian NIC to select a child</label>
                <select class="chosen" name="inputNIC" id="inputNIC">
                    <!-- <option value="************">************</option> -->
                    <?php
                    $childList = $childCtrl->getChildList();
                    if ($childList->num_rows > 0) {
                        while ($row = $childList->fetch_assoc()) {
                    ?><option value="<?= $row["guardian_NIC"] . "|" . $row["child_id"]; ?>"><?= $row["guardian_NIC"] . " - " . $row["f_name"] . " " . $row["m_name"] . " " . $row["l_name"]; ?></option><?php
                                                                                                                                                                                                    }
                                                                                                                                                                                                }
                                                                                                                                                                                                        ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputBranch">Branch</label>
                <select class="chosen" name="branch" id="branch">
                    <?php
                    $branchList = $branchCtrl->getBranches();
                    foreach ($branchList as $branch) {
                    ?><option value="<?= $branch[0]; ?>"><?= $branch[1]; ?></option><?php
                                                                                }
                                                                                    ?>
                </select>
            </div>
        </div>
        <div>
            <label for="plan">Select a savings plan:</label>
            <!-- <select name="plan" id="plan">
                    <option value="Plan 1">Plan 1</option>
                    <option value="Plan 2">Plan 2</option>
                    <option value="Plan 3">Plan 3</option>
                    <option value="Plan 4">Plan 4</option>
                </select> -->
            <select name="plan" id="plan">
                <?php
                $age = 18;
                $planList = $savingsPlanCtrl->getsavingsPlans($age);
                foreach ($planList as $plan) {
                ?><option value="<?= $plan[0]; ?>"><?= $plan[1] . "s of age " . $plan[3] . " or above | Interest: " . $plan[2] . "% |Minimum Balance: " . $plan[4] . "Rs/="; ?></option><?php
                                                                                                                                                                                    }
                                                                                                                                                                                        ?>
            </select>
        </div>
        <br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAmount">Initial Deposit</label>
                <input type="number" class="form-control" id="inputAmount" name="inputAmount" placeholder="Amount">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="addAccount" name="addAccount">Register</button>

    </form>
</div>
<script type="text/javascript">
    $(".chosen").chosen();

    //validate to make sure the age matches the savings plan
    //initial deposit should be greater than minimum amount
    //cant hv another savings account
</script>

<?php
$accountCtrl->addChildAccountT();
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>