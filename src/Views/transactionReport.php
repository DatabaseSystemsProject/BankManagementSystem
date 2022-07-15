<?php 

session_start();
include "base.php";
include "../Controllers/transactionReportController.php";

$transRepCtrl = new TransactionReportController();

$branchManager_NIC = $_SESSION['branch_manager_NIC'];

$branch_name = $transRepCtrl->getBranchName($branchManager_NIC);
$branch_id = $transRepCtrl->getBranchID($branchManager_NIC);

$myUrl = "branch managerDashboard.php";

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

        .contForm{
            width: 60%;
        }

        .report.px-5.border{
            width: 60%;
            padding-right: 10rem !important;
            padding-left: 10rem !important;
            border: 5px solid #dee2e6!important;
        }

    </style>

    <script>
        function gotoDashboard() {
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        }
    </script>

</head>

<body>
    <main-header></main-header> <br> <br> <br> <br>
    <div class="cont">
        <h2 style="text-align: center;"> Total Transaction Report </h2> <br>
        
        <div class="container contForm mx-auto">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_date"> Start Date : </label>
                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date"> End Date : </label>
                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" required>
                    </div>
                </div>
                <button type="submit" name="generate" class="btn btn-primary"> Generate Report </button> 
            </form>
        </div>

        <?php $transRepCtrl->generateReport($branch_id, $branch_name); ?>
          
    </div> <br> <br> <br>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>
</html>