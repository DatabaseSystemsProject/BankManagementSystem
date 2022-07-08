<?php

use LDAP\Result;

include "../Models/onlineLoanModel.php";

class OnlineLoanController
{
    private $loanModel;
    private $duration;
    private $fd_id;
    private $amount;

    function __construct()
    {
        $this->loanModel = new OnlineLoanModle();
    }

    function getFdAccount($user_id,$user_type)
    {
        if($user_type=="personal")
        {
            $fdAcc = $this->loanModel->getFixedDepositeID($user_id);
            return $fdAcc;
        }
        else
        {
            $fdAcc=$this->loanModel->getFixedDepositeID($user_id);
            return $fdAcc;
        }
        
    }

    function getLoanTypes()
    {
        $loanTypes = $this->loanModel->getLoanTypes();
        return $loanTypes;
    }

    function checkEligibility()
    {
        if (isset($_POST["check"])) {

            $this->duration = $_POST["inputLoanDuration"];
            $this->amount = $_POST["inputLoanAmount"];
            $this->fd_id = $_POST["inputFD"];
            $result = $this->loanModel->getFixedDepositeData(intval($this->fd_id));
            $fd_duration = $result["duration"];
            $fd_amount = $result["amount"];
            if ($this->duration <= $fd_duration && $this->amount < 500000 && $this->amount <= $fd_amount * 0.6) {
                return true;
            } else {
                $_SESSION['error_message'] = "Change fd id";
                return false;
            }
        }
    }

    function autoFill($user_id,$login)
    {
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

        $resultOrg=$this->loanModel->getOgranization($user_id);
        $array["org_name"]=$resultOrg["org_name"];

        return $array;
    }
}
