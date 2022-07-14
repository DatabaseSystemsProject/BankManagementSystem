<div style="margin-top:1px !important; border-radius:5px;" class="container border border-2 m p-5 mx-auto bg-light" id="hidDiv">
    <?php

    if (isset($_SESSION["uptodate"])) {
        echo '<p style="color:green; font-size:1.2rem; padding:0px">' . $_SESSION["uptodate"] . '</p>';

        unset($_SESSION["uptodate"]);
    }
    if (isset($_SESSION["unpaidMonthsYear"])) {
        echo
        '<p style="color:red; font-size:1.2rem; padding:0px">Months to pay installments : ' . implode(", ", $_SESSION["unpaidMonthsYear"]) . '</p>';
        unset($_SESSION["unpaidMonthsYear"]);
    }
    ?>

    <form method="post" action="loanInstallmentForm.php">
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
                    <input type="text" name="installment" id="installment" class="form-control" disabled>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group ">
                <label for="month">Month</label>
                <select name="insNo" id="month" class="custom-select mr-sm-2" required>
                    <option value="" disabled selected>choose..</option>
                    <?php
                    if (isset($_SESSION["installments"])) {
                        foreach ($_SESSION["installments"] as $row) {
                            echo '<option value="' . $row["installment_no"] . '" >' . $row["month"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="d-grid col-6 mx-auto" style="margin-top:40px ;">
            <button class="btn btn-primary" type="button" name="confirm" id="confirm" data-bs-toggle="modal" data-bs-target="#myModal">Pay Installment</button>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content" style="border-radius:10px; border-style:groove;border-color:darksalmon">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:#0648AB">Confirm Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Please confirm to Pay
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button value="submit" type="submit" name="pay" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<?php
if (isset($_POST["pay"])) {
    $_SESSION["loanInsController"]->payInstallment();
}
?>

<script>
    var passedArray = <?php echo json_encode($_SESSION["loan_details"]); ?>;

    function autoFill() {

        var inputNIC = document.getElementById("inputNIC");
        var loanType = document.getElementById("loanType");
        var amount = document.getElementById("amount");
        var duration = document.getElementById("duration");
        var remaining = document.getElementById("remaining");
        var installment = document.getElementById("installment");

        inputNIC.value = passedArray["customer_NIC"];
        loanType.value = passedArray["loan_type"];
        amount.value = passedArray["amount"];
        duration.value = passedArray["duration"];
        remaining.value = passedArray["liability"];
        installment.value = passedArray["monthly_installment"];

    };
</script>

<?php
echo '<script> autoFill();</script>';



?>