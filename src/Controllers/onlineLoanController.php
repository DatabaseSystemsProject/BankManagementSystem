<?php

use LDAP\Result;

include "../Models/onlineLoanModel.php";

class OnlineLoanController
{
    private $loanModel;
    private $duration;
    private $fd_id;
    private $amount;
    private $user_type;
    private $login;

    function __construct()
    {
        $this->loanModel = new OnlineLoanModle();
    }

    function getFdAccount($user_id)
    {

        $fdAcc = $this->loanModel->getFixedDepositeID($user_id);
        if (!is_null($fdAcc)) {
            return $fdAcc;
        } else {
            $_SESSION['error_message'] = "You don't have a fd account";
            return null;
        }
    }

    function getLoanTypes()
    {
        $loanTypes = $this->loanModel->getLoanTypes();
        return $loanTypes;
    }

    function checkEligibility()
    {
        if (isset($_POST["check"]) ) {

            $this->duration = $_POST["inputLoanDuration"];
            $this->amount = $_POST["inputLoanAmount"];
            $this->fd_id = $_POST["inputFD"];
            $result = $this->loanModel->getFixedDepositeData(intval($this->fd_id));
            $fd_duration = $result["duration"];
            $fd_amount = $result["amount"];
            if ($this->duration <= $fd_duration && $this->amount < 500000 && $this->amount <= $fd_amount * 0.6) {
                return true;
            } else {
                $_SESSION['error_message'] = "You not eligibale for this loan.Try again!!";
                return false;
            }
        }
    }

    function autoFill($user_id, $login)
    {
        $this->user_id = $user_id;
        $this->login = $login;
        $array = array();
        $resultAcc = $this->loanModel->getFixedDepositeData(intval($this->fd_id));
        $sav_acc_no = $resultAcc["saving_account_id"];

        $result = $this->loanModel->getCustomerContact($login);

        $array["full_name"] = $result["f_name"] . " " . $result["m_name"] . " " . $result["l_name"];
        $array["nic"] = $result["user_NIC"];

        $array["email"] = $result["email"];
        $array["mobile"] = $result["contact_number"];
        $array["amount"] = $this->amount;
        $array["duration"] = $this->duration;
        $array["sav_acc_no"] = $sav_acc_no;
        $array["fd_no"] = $this->fd_id;

        $resultOrg = $this->loanModel->getOgranization($user_id);
        if (!is_null($resultOrg)) {
            $array["org_name"] = $resultOrg["org_name"];
            $this->user_type = "organization";
        }else{
            $this->user_type="personal";
        }


        return $array;
    }
    function submitAppication($login)
    {
        if (isset($_POST["apply"])) {
            if (!empty($_POST['inputLoanAmount']) && !empty($_POST['inputLoanDuration']) && !empty($_POST['inputLoanType'])) {
                $loan_type = $_POST['inputLoanType'];
                $customer_NIC = $login;
                $amount = $_POST["inputLoanAmount"];
                $duration =$_POST["inputLoanDuration"] ;
                $tax_no = $_POST['inputTaxNo'];
                $reg_no = $_POST['inputRegNo'];
                $fd_id = $_POST["inputFDNo"];
                $mode = "online";
                $liability=$amount;
                echo $_POST["apply"];

               $result= $this->loanModel->submitApplication($loan_type,$customer_NIC,$amount,$duration,$liability,$mode,$tax_no,$reg_no,$fd_id);
               echo $result;
            }
        }
    }
}
