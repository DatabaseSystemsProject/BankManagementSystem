<?php

include 'base.php';
include_once("../Controllers/transactionHistoryController.php");
session_start();

$transactionHistoryCtrl = new transactionHistoryController();
//$accountNo = 10001;// hardcoded for now
$accountNo = $_SESSION['account_no'];
$myUrl =  "customerDashboard.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>


    <title>Transaction History</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2 style="text-align: center;"> Transaction History </h2> <br>
    <form action="" method="post" enctype="multipart/form-data">

        <!-- <div class="form-row">
        <div class="form-group col-md-6">
            <label for="start_date"> Start Date : </label>
            <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required>
        </div>
        <div class="form-group col-md-6">
            <label for="end_date"> End Date : </label>
            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" required>
        </div>
    </div> -->
        <!-- <button type="submit" name="generate" class="btn btn-primary"> Generate Report </button>  -->
        <table>
            <tr>
                <th>Date</th>
                <th>Transaction Type</th>
                <th>Amount</th>
            </tr>

            <?php
            $transactionHistory = $transactionHistoryCtrl->getTransactionHistory($accountNo);
            if ($transactionHistory->num_rows > 0) {
                while ($row = $transactionHistory->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?= $row["datetime"]; ?></td>
                        <td><?= $row["transaction_type_name"]; ?></td>
                        <td><?= $row["amount"]; ?></td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>

    </form>
</div>
<script type="text/javascript">
    function gotoDashboard() {
        var url = <?php echo (json_encode($myUrl)); ?>;
        window.location.href = url;
    }
    //validate to make sure the age matches the savings plan
    //initial deposit should be greater than minimum amount
    //cant hv another savings account
</script>

<?php

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>