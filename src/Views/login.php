<?php
include 'base.php';
include "../Controllers/loginControler.php";

$loginController = new LoginController();
$customerLogged = $loginController->customerLogin();
$staffLogged = $loginController->staffLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../CSS/login.css"> -->
    <title>Login</title>
</head>

<body class="" style="background-image: linear-gradient(to right,#00007d,#0042db,#0076ff);">

    <section class="h-100 gradient-form" style="background-color: linear-gradient(to right,#00007d,#0042db,#0076ff);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-5 pb-2 md-5  mx-md-4">

                                    <div class="text-center">
                                        <img src="../Resources/Images/logo.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Welcome to Pheonix Trust Bank Online System</h4>
                                    </div>

                                    <form id="customerLogin" method="post">
                                        <div class="mb-5">
                                            <h6>Please login to your customer account</h6>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <input type="text" id="account_no" name="account_no" class="form-control" placeholder="Your account number" required />
                                            <label class="form-label" for="account_no">Account Number</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="nic" name="nic" class="form-control" placeholder="Your NIC number" />
                                            <label class="form-label" for="nic">NIC Number</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="passwordC" name="passwordC" class="form-control" placeholder="Password" required />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-primary" type="submit" name="customerLog">Log in</button>

                                        </div>




                                    </form>
                                    <form id="staffLogin" method="post" hidden>
                                        <div class="mb-5">
                                            <h6>Please login to your staff account</h6>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Your user name" />
                                            <label class="form-label" for="user_name">User name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="passwordS" name="passwordS" class="form-control" placeholder="Password" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>


                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="staffLog">Log in</button>

                                        </div>



                                    </form>


                                </div>

                            </div>


                            <div class="col-lg-6 h-100 ">

                                <div class="card-body p-md-5 mx-md-4 my-4" style="background-image: linear-gradient(to right,#00007d,#0042db,#0076ff);">
                                    <h4 style="color: white;">We are...</h4>
                                    <p class="small mb-0" style="color: white;">Pheonix Trust Bank is a small, high secure, private bank in Seychelles. Now we are in the online system. Customer can 
                                        handle there account easily via our online system. Manage transactions, view loan deatail and even apply for online loans under certain conditions
                                         are noe available.
                                    </p>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" id='customerLog' onclick="customerShow()">Log
                                            in as a customer</button>

                                    </div>
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" id="staffLog" onclick="staffShow()">Log
                                            in as a staff member</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>


    <script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function customerShow() {
            var customer = document.getElementById('customerLogin');
            var staff = document.getElementById('staffLogin');

            customer.hidden = false;
            staff.hidden = true;



        };

        function staffShow() {
            var customer = document.getElementById('customerLogin');
            var staff = document.getElementById('staffLogin');

            customer.hidden = true;
            staff.hidden = false;



        };

        function showNICForm() {
            document.getElementById("orgUser").hidden = false;
        }
    </script>

    <?php
    if (isset($_POST["customerLog"]) || isset($_POST["staffLog"])) {
        if ($customerLogged || $staffLogged) {
            // echo '<script type="text/javascript">alert("Success");</script>';
        } else {
            // echo '<script type="text/javascript">alert("Invalid credentials");</script>';
        }
    }
    ?>
    <!-- <main-footer></main-footer> -->
</body>

</html>