<?php 

session_start();
include 'base.php';
include "../Controllers/bmDashboradController.php";

$bmDashboardCtrl = new bmDashboardController();

$branch_manager_NIC = "802365415V";    // hardcoded for demonstration

$bm_first_name = $bmDashboardCtrl->getFirstName($branch_manager_NIC);
$bm_last_name = $bmDashboardCtrl->getLastName($branch_manager_NIC);
$branch_name = $bmDashboardCtrl->getBranchName($branch_manager_NIC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Manager Dashboard</title>
    
    <link rel="stylesheet" href="../CSS/branchManangerDashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="../CSS/counter.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="counter.js"></script>
</head>

<body style="background-image:linear-gradient(to right,#00007d,#0042db,#0076ff);">
    <main-header></main-header>
    <div class="float-sm main-cont mt-5">
        <div class="main-container" style="display:flex;">
            
            <div class="sidebar" style="display:flex; flex-direction:column;">
                <div class="ms-3" style="position:fixed; text-align:center;">
                    <h3> Branch Manager </h3>
                    <h5 style="color:black;"> <?php echo $branch_name?> Branch </h5>
                    <img src="../Resources/Images/avatar2.png" class="rounded-circle" alt="../Resources/Images/avatar2.png">
                    <h1><?php echo $bm_first_name ?> </h1>
                    <h1 style="margin-top: 10px;"> <?php echo $bm_last_name ?> </h1>
                </div>
            </div>

            <div class="container1 mt-2 d-flex" style="display:flex;">
                
                <div class="bankName">
                    <img src="../Resources/Images/logoBlack.png" alt="no title">
                </div>
                
                <div class="dash1" style="display:flex; flex-direction:row; align-self:center; justify-content:space-evenly;">

                    <a href="transactionReport.php" style="text-decoration:none;">
                        <div class="card" style="width:16rem; height:12rem;">
                            <div class="card-body" style="align-self:center; display:flex; flex-direction:column;">
                                <i class="bi bi-clipboard-data" style="font-size:80px; align-self:center; margin-top:-10%;"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-20%; text-align:center;"> Branch Wise Total Transaction Report </p>
                            </div>
                        </div>
                    </a>

                    <a href="" style="text-decoration:none;">
                        <div class="card" style="width:16rem; height:12rem;">
                            <div class="card-body" style="align-self:center; display:flex; flex-direction:column;">
                                <i class="bi bi-clipboard-data" style="font-size:80px; align-self:center; margin-top:-10%;"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-20%; text-align:center;"> Branch Wise Late Loan Installment Report </p>
                            </div>
                        </div>
                    </a>

                    <a href="approveRegularLoans.php" style="text-decoration:none;">
                        <div class="card" style="width:16rem; height:12rem;">
                            <div class="card-body" style="align-self:center; display:flex; flex-direction:column;">
                                <i class="bi bi-cash-coin" style="font-size:80px; align-self:center; margin-top:-10%;"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-15%; text-align:center;">Approve/Reject Loan Applications </p>
                            </div>
                        </div>
                    </a>

                </div>  <br><br><br><br><br><br>

                <!--
                <div class="dash2" style="display: flex;flex-direction: row;align-self: center;justify-content:space-evenly;">
                    <a href="viewReports.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-clipboard-data" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top:-40%; margin-bottom:-20%">View Reports</p>
                            </div>
                        </div>

                    </a>
                    <a href="loans.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self:center;display:flex;flex-direction:column">
                                <i class="bi bi-cash-coin" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -27%; margin-bottom:-15%">Loan Section</p>
                            </div>
                        </div>

                    </a>
                </div>
                -->

            </div>
        </div>
    </div>

</body>

</html>