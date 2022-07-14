<?php

include "../Models/loginModel.php";

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
            $account = $this->loginModel->isCustomer($acc_no, $passwrd);


            if (!empty($account)) {
                $acc_type = $account['customer_type_name'];
                if ($acc_type == 'organization') {
                    $stackholder = $this->loginModel->getStackholder($account['customer_NIC'], $nic);
                    if (!empty($stackholder)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if ($account['customer_NIC'] == $nic) {
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
            $passwrd = $_POST['passwordS'];
            $account = $this->loginModel->isStaff($user_name, $passwrd);

            if (!empty($account)) {
                $acc_type = $account['staff_type_name'];

                return true;
            } else {
                return false;
            }
        }
    }
}
