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
            $passwrd = $_POST['passwordC'];
            $nic = $_POST['nic'];

            //check whether there is an account with the given password
            $account = $this->loginModel->isCustomer($acc_no, $passwrd);


            if (!empty($account)) {
                $acc_type = $account['owner_type_name'];
                if ($acc_type == 'organization') {
                    $reg_no = $this->loginModel->getOrganization($account['account_no']);

                    $stackholder = $this->loginModel->getStackholder($reg_no['reg_no'], $nic);
                    if (!empty($stackholder)) {

                        $_SESSION['account_type']=$acc_type;
                        $_SESSION['account_no']=$acc_no;
                        $_SESSION['login']=$nic;
                        header('location:customerDashboard.php');

                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if ($account['customer_NIC'] == $nic) {

                        $_SESSION['account_type']=$acc_type;
                        $_SESSION['account_no']=$acc_no;
                        $_SESSION['login']=$nic;
                        header('location:customerDashboard.php');

                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
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

                $_SESSION['account_type']=$acc_type;
                $_SESSION['login']=$account['user_NIC'];
                $url=strval($acc_type)."Dashboard.php";
                header('location:'.$url );

                



                return true;
            } else {
                return false;
            }
        }
    }
    
}
