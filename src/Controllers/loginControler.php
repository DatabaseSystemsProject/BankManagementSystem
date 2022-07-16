<?php

include "../Models/loginModel.php";

session_start();

class LoginController
{
    private $loginModel;

    function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    function customerLogin()
    {

        if (isset($_POST["customerLog"])) {

            $acc_no = $_POST['account_no'];
            $passwrd = md5($_POST['passwordC']);
            $nic = $_POST['nic'];

            //check whether there is an account with the given password
            $account = $this->loginModel->isCustomer($acc_no, $passwrd);


            if (!empty($account)) {
                $acc_type = $account['owner_type_name'];
                if ($acc_type == 'organization') {
                    $reg_no = $this->loginModel->getOrganization($account['account_no']);

                    $stackholder = $this->loginModel->getStackholder($reg_no['org_regNo'], $nic);
                    if (!empty($stackholder)) {

                        $_SESSION['login_type'] = $acc_type;
                        $_SESSION['account_no'] = $acc_no;
                        $_SESSION['login'] = $nic;
                        $_SESSION["authenticated"] = "logged in";
                        header('location:customerDashboard.php');

                        return true;
                    } else {
                        echo '<script type="text/javascript">alert("You are can not log in to this account.");</script>';
                        return false;
                    }
                } else {
                    if ($account['customer_NIC'] == $nic) {

                        $_SESSION['login_type'] = $acc_type;
                        $_SESSION['account_no'] = $acc_no;
                        $_SESSION['login'] = $nic;
                        $_SESSION["authenticated"] = "logged in";
                        header('location:customerDashboard.php');

                        return true;
                    } else {
                        echo '<script type="text/javascript">alert("NIC miss match.");</script>';
                        return false;
                    }
                }
            } else {
                echo '<script type="text/javascript">alert("Invalid cridentials.");</script>';
                return false;
            }
        }
    }
    function staffLogin()
    {

        if (isset($_POST["staffLog"])) {

            $user_name = $_POST['user_name'];
            $passwrd = md5($_POST['passwordS']);
            $account = $this->loginModel->isStaff($user_name, $passwrd);

            if (!empty($account)) {
                $acc_type = $account['staff_type_name'];

                $_SESSION['login_type'] = $acc_type;
                $_SESSION['login'] = $account['user_NIC'];
                $url = strval($acc_type) . "Dashboard.php";
                header('location:' . $url);





                return true;
            } else {
                return false;
            }
        }
    }
}
