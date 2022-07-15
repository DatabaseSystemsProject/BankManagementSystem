<?php

session_start();
include "base.php";
include "../Controllers/approveRegularLoansController.php";

$arl_ctrl = new ApproveRegularLoansController();

$branch_manager_NIC = $_SESSION['branch_manager_NIC'];
//$branch_manager_NIC = '802365415V'; // hardcoded for demonstration

$branch_id = $arl_ctrl->getBranchID($branch_manager_NIC);
$branch_name = $arl_ctrl->getBranchName($branch_manager_NIC);

if (isset($_GET['approve_loan_id']) && isset($_GET['approve_bmID'])) {
    $loan_id = $_GET['approve_loan_id'];
    $branch_manager_NIC = $_GET['approve_bmID'];

    $arl_ctrl->approveLoan($loan_id, $branch_manager_NIC);
}

if (isset($_GET['reject_loan_id']) && isset($_GET['reject_bmID'])) {
    $loan_id = $_GET['reject_loan_id'];
    $branch_manager_NIC = $_GET['reject_bmID'];

    $arl_ctrl->rejectLoan($loan_id, $branch_manager_NIC);
}

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
    <title>Approve/Reject Regular Loans</title>

</head>

<body>
    <main-header></main-header> <br> <br> <br>
    <div class="cont">
        <h2 style="text-align: center;"> Approve/Reject Regular Loans - <?php echo $branch_name ?> Branch </h2> <br> <br>
        
        <div class="container mx-auto table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"> # </th>
                        <th scope="col"> Loan ID </th>
                        <th scope="col"> Applier's Name </th>
                        <th scope="col"> Applied Date </th>
                        <th scope="col"> Loan Amount</th>
                        <th scope="col"> Duration </th>
                        <th scope="col"> Liability </th>
                        <th scope="col"> Guarantor's Name </th>
                        <th scope="col"> Approve / Reject </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = $arl_ctrl->getRequestedLoans($branch_id, $branch_manager_NIC); 
                    $i = 0;

                    while($row = $result->fetch_assoc()):
                        $i = $i + 1 ;
                        $loan_id = $row["loan_id"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $date_time = $row["date_time"];
                        $amount = $row["amount"];
                        $duration = $row["duration"];
                        $liability = $row["liability"];
                        $guarantor_name = $row["guarantor_name"];

                        $applier_name = $first_name." ".$last_name;
                        $date = substr($date_time, 0, 10);
                        ?>

                        <tr>
                            <th scope="row"> <?php echo $i ?> </th>
                            <td> <?php echo $loan_id ?> </td>
                            <td> <?php echo $applier_name ?> </td>
                            <td> <?php echo $date ?> </td>
                            <td> Rs. <?php echo $amount ?> </td>
                            <td> <?php echo $duration ?> months </td>
                            <td> <?php echo $liability ?> </td>
                            <td> <?php echo $guarantor_name ?> </td>
                            <td>
                                <a href="approveRegularLoans.php?approve_loan_id=<?php echo $loan_id?>&approve_bmID=<?php echo $branch_manager_NIC?>" class="btn btn-primary"> Approve </a>
                                <a href="approveRegularLoans.php?reject_loan_id=<?php echo $loan_id?>&reject_bmID=<?php echo $branch_manager_NIC?>" class="btn btn-danger"> Reject </a>  
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        
    </div> <br> <br> <br>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>
</html>