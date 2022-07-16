<?php include 'base.php';
include "../Controllers/staffDashboardControler.php";
session_start();


if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}


$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
$myUrl = strval($account_type) . "Dashboard.php";
$staff_controller = new StaffDashboardController();
$staff_member = $staff_controller->staffDetails($login);
$name = $staff_member['f_name'];

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
    <link rel="stylesheet" href="../CSS/counter.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="counter.js"></script>
</head>

<body style="background-image: linear-gradient(to right,#00007d,#0042db,#0076ff);">
    <main-header></main-header>
    <div class=" float-sm main-cont mt-5">
        <div class="main-container" style="display:flex;">
            <div class="sidebar" style="display:flex;flex-direction:column;">
                <div class="ms-3" style="position: fixed; text-align: center;">
                    <img src="../Resources/Images/avatar2.png" class="rounded-circle" alt="../Resources/Images/avatar2.png">
                    <h1><?php echo $staff_member['f_name']; ?></h1>
                    <h1 style="margin-top: 10px;"><?php echo $staff_member['l_name']; ?></h1>
                </div>
            </div>

            <div class="container1 mt-2 d-flex" style="display:flex;">
                <div class=" bankName">
                    <img src="../Resources/Images/logoBlack.png" alt="no title">
                </div>
                <div class="container my-3" hidden>
                    <div class="row">
                        <div class="four col-md-3">
                            <div class="counter-box colored"> <span class="counter" id="counter">4</span>
                                <p>Registered Students</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"><span class="counter" id="counter">5</span>
                                <p>Registered Teachers</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box colored"> <span class="counter" id="counter">6</span>
                                <p>Available Classes</p>
                            </div>
                        </div>

                        <div class="four col-md-3">
                            <div class="counter-box"><span class="counter" id="counter">7</span>
                                <p>Advertiesments</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="dash1" style="display: flex;flex-direction: row ;align-self: center;justify-content:space-evenly;">

                    <a href="staffRegister.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-person-plus-fill" style="font-size:100px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -70%; margin-bottom:-20%">Add Account</p>
                            </div>
                        </div>
                    </a>
                    <a href="viewStaff.php">
                        <div class="card" style="width: 16rem;height:12rem;">
                            <div class="card-body" style="align-self: center;display:flex;flex-direction:column">
                                <i class="bi bi-person-lines-fill" style="font-size:100px;align-self:center;margin-top:-10%"></i>
                                <p class="action" style="margin-top: -60%; margin-bottom:-20%">View Staff</p>
                            </div>
                        </div>

                    </a>
                    <a href="lateLoanSuper.php" style="text-decoration:none;">
                        <div class="card" style="width:16rem; height:12rem;">
                            <div class="card-body" style="align-self:center; display:flex; flex-direction:column;">
                                <i class="bi bi-clipboard-data" style="font-size:80px; align-self:center; margin-top:-10%;"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-20%; text-align:center;"> Branch Wise Late Loan Installment Report </p>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="dash2" style="display: flex;flex-direction: row;align-self: center;justify-content:space-evenly;">
                    
                <a href="transactionSuper.php" style="text-decoration:none;">
                        <div class="card" style="width:16rem; height:12rem;">
                            <div class="card-body" style="align-self:center; display:flex; flex-direction:column;">
                                <i class="bi bi-clipboard-data" style="font-size:80px; align-self:center; margin-top:-10%;"></i>
                                <p class="action" style="margin-top:-30%; margin-bottom:-20%; text-align:center;"> Branch Wise Total Transaction Report </p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>


        </div>
    </div>
    <script>
        function gotoDashboard() {
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        }
    </script>

    <!-- <script>
        let counts=setInterval(updated);
        let upto=0;
        function updated(){
            var count= document.getElementById("counter");
            count.innerHTML=++upto;
            if(upto===10)
            {
                clearInterval(counts);
            }
        }
    </script> -->

</body>

</html>