<?php 

session_start();
include "base.php";
include "../Controllers/transactionReportController.php";

$transRepCtrl = new TransactionReportController();

$branchManager_NIC = '802365415V'; // hardcoded for demonstration

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <title>Branch Wise Total Transaction Report</title>

    <style>
        .cont{
            margin-left: 25px;
            margin-right: 25px;
        }
    </style>
</head>

<body>
    <main-header></main-header> <br> <br> <br>
    <div class="cont">
        <h2 style="text-align: center;"> <?php echo $transRepCtrl->getBranchName($branchManager_NIC);?> Branch - Total Transaction Report </h2> <br>
        <div class="container border border-2 m-5 p-5 mx-auto ">
            <?php 
                $branch_id = $transRepCtrl->getBranchID($branchManager_NIC); 
            ?>
            <h5> No of Total Transactions : <?php echo $transRepCtrl->getTotalTransactionsCount($branch_id); ?> </h5> <br>
            <h5> No of Transfers : <?php echo $transRepCtrl->getTransfersCount($branch_id); ?> </h5> <br>
            <h5> No of Deposits : <?php echo $transRepCtrl->getDepositsCount($branch_id); ?> </h5> <br>
            <h5> No of Withdrawls : </h5>
        </div>
        
            <h3> Deposits </h3>
            <table class="table table-sm table-bordered table-responsive table-hover">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Account Number </th>
                        <th> Account Owner </th>
                        <th> Account Type </th>
                        <th> Amount </th>
                        <th> Date </th>
                        <th> Time </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 100 </td>
                        <td> 1295634785 </td>
                        <td> Ross Gellerrrrrrrrrrrrrrrrrrrrrrr </td>
                        <td> Savings </td>
                        <td> 1000.00</td>
                        <td> 2022-07-08 </td>
                        <td> 12:25:12 </td>
                    </tr>
                </tbody>
            </table>
        
        
    </div>
    




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>
</html>