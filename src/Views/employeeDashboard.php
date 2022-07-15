<?php
// if (!isset($_SESSION['login'])) {
//     header("Location:login.php");
// }
include_once 'base.php';
include_once '../Config/db.php';
include_once '../Models/employeeDashboardMOdel.php';
include_once '../Controllers/employeeDashboardController.php';
session_start();


// $employee_id = 199974401842;
// $account_type = $_SESSION['account_type'];
$employee_id = $_SESSION['login'];



$controller = new employeeDashboardController();
$employee_details = $controller->getEmployeeDetails($employee_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../CSS/employeeDashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../CSS/counter.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="counter.js"></script>

</head>

<body>
    <main-header></main-header>

    <div class=" float-sm main-cont mt-5">
        <div class="main-container" style="display:flex;">
            <div class="sidebar" style="display:flex;flex-direction:column;">
                <div class="ms-3" style="position: fixed; text-align: center;">
                    <img src="../Resources/Images/avatar2.png" class="rounded-circle" alt="../Resources/Images/avatar2.png">
                    <h1><?php echo $employee_details['f_name']; ?></h1>
                    <h1 style="margin-top: 10px;"><?php echo $employee_details['l_name']; ?></h1>
                </div>
            </div>
            <div class="container1 d-flex mt-2" style="display:flex;">
                <div class=" bankName">
                    <img src="../Resources/Images/logoBlack.png" alt="no title">
                </div>
                <!-- <div class="container my-3">
                    <div class="row">
                        <div class="four col-md-3">
                            <div class="counter-box colored"> <span class="counter" id="counter" data-val="225">4</span>
                                <p>Registered Students</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"><span class="counter" id="counter" data-val="225">5</span>
                                <p>Registered Teachers</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box colored"> <span class="counter" id="counter" data-val="225">6</span>
                                <p>Available Classes</p>
                            </div>
                        </div>

                        <div class="four col-md-3">
                            <div class="counter-box"> <span class="counter" id="counter" data-val="225">7</span>
                                <p>Advertiesments</p>
                            </div>
                        </div>

                    </div>
                </div> -->
                <div class="dash1" style="display: flex;flex-direction: row ;align-self: center;justify-content:space-evenly;">

                    <a href="addAccountForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-person-plus-fill" style="font-size:100px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -70%; margin-bottom:-20%">Add Account</p>
                            </div>
                        </div>
                    </a>
                    <a href="depositMoney.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-piggy-bank-fill" style="font-size:100px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -60%; margin-bottom:-20%">Deposit Money</p>
                            </div>
                        </div>

                    </a>
                    <a href="withdrawMoneyForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-cash-coin" style="font-size:100px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -50%; margin-bottom:-20%">Withdraw Money</p>
                            </div>
                        </div>

                    </a>

                </div>
                <div class="dash2" style="display: flex;flex-direction: row;align-self: center;justify-content:space-evenly;">
                    <a href="loanApplicationForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-person-plus-fill" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-20%">Add Adult Customer</p>
                            </div>
                        </div>

                    </a>
                    <a href="loanInstallmentForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self:center;display:flex;flex-direction:column">
                                <i class="bi bi-person-plus" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -30%; margin-bottom:-15%">Add Child Customer</p>
                            </div>
                        </div>

                    </a>

                    <a href="fdForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self:center;display:flex;flex-direction:column">
                                <i class="bi bi-building" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -35%; margin-bottom:-15%">Add Organization</p>
                            </div>
                        </div>

                    </a>
                </div>

                <div class="dash2" style="display: flex;flex-direction: row;align-self: center;justify-content:space-evenly;">
                    <a href="loanApplyRegular.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-file-text" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top:-40%; margin-bottom:-20%">Loan Application</p>
                            </div>
                        </div>

                    </a>
                    <a href="loanInstallmentForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self:center;display:flex;flex-direction:column">
                                <i class="bi bi-card-text" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -27%; margin-bottom:-15%">Loan installment Form</p>
                            </div>
                        </div>

                    </a>

                    <a href="fdForm.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self:center;display:flex;flex-direction:column">
                                <i class="bi bi-file-text" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -70%; margin-bottom:-15%">Create FD</p>
                            </div>
                        </div>

                    </a>
                </div>
                <div class="dash2" style="display: flex;flex-direction: row;align-self: center;justify-content:space-evenly;">
                    <a href="createCard.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-file-text" style="font-size:80px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top:-40%; margin-bottom:-20%">Create Card</p>
                            </div>
                        </div>

                    </a>

                </div>

            </div>


        </div>

</body>

</html>