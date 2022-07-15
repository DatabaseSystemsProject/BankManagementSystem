<?php

use LDAP\Result;

include "../Models/onlineLoanModel.php";

class OnlineLoanController
{
    private $loanModel;
    private $year;
    private $month;
    private $duration;
    private $fd_id;
    private $amount;
    private $account_no;
    private $login;

    function __construct()
    {
        $this->loanModel = new OnlineLoanModle();
    }

    function getFdAccount($acc_no)
    {


        $fdAcc = $this->loanModel->getFixedDepositeID($acc_no);
        var_dump($fdAcc);
        if (!is_null($fdAcc)) {
            return $fdAcc;
        } else {
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

            $this->year=$_POST["inputYear"];
            $this->month=$_POST["inputMonth"];
            $this->duration = $this->year*12+$this->month;
            $this->amount = $_POST["inputLoanAmount"];
            $this->fd_id = $_POST["inputFD"];
            return $this->loanEligible($this->duration,$this->amount,$this->fd_id);
            
        }
    }

    function autoFill($account_no, $login)
    {
        $this->account_no = $account_no;
        $this->login = $login;
        $array = array();
        $resultAcc = $this->loanModel->getAccount($account_no);


        $result = $this->loanModel->getCustomerContact($login);

        $array["full_name"] = $result["f_name"] . " " . $result["m_name"] . " " . $result["l_name"];
        $array["nic"] = $result["user_NIC"];

        $array["email"] = $result["email"];
        $array["mobile"] = $result["contact_number"];
        $array["amount"] = $this->amount;
        $array["duration"] = $this->duration;
        $array["sav_acc_no"] = $account_no;
        $array["fd_no"] = $this->fd_id;
        $array["year"]=$this->year;
        $array["month"]=$this->month;


        if($resultAcc["owner_type_name"]=="organization")
        {
            $reg_no=$this->loanModel->getRegNo($account_no)['org_regNo'];
            $resultOrg = $this->loanModel->getOgranization($reg_no);
            $array["org_name"] = $resultOrg["org_name"];
            $array["reg_no"]=$reg_no;
        }else
        {
            $array["org_name"] = null;
            $array["reg_no"]=null;
        }

        return $array;
    }
    function submitAppication($login)
    {
        if (isset($_POST["apply"])) {
            if (!empty($_POST['inputLoanAmount'])) {
                $loan_type = $_POST['inputLoanType'];
                $customer_NIC = $login;
                $amount = $_POST["inputLoanAmount"];
                $year =$_POST["inputYear"];
                $month=$_POST["inputMonth"];
                $duration=$year*12+$month;
                // $duration =$_POST["inputLoanDuration"] ;
                $tax_no = $_POST['inputTaxNo'];
                $reg_no = $_POST['inputRegNo'];
                $fd_id = $_POST["inputFDNo"];
                $mode = "online";
                $liability=$amount;

                if($this->loanEligible($duration,$amount,$fd_id))
                {
                    $result= $this->loanModel->submitApplication($loan_type,$customer_NIC,$amount,$duration,$liability,$mode,$tax_no,$reg_no,$fd_id);
                }


               

            }
        }
    }

    function loanEligible($duration,$amount,$fd_id)
    {
        $result = $this->loanModel->getFixedDepositeData(intval($fd_id));
        $fd_duration = $result["remaining_months"];
        $fd_amount = $result["amount"];
        if ($duration <= $fd_duration && $amount < 500000 && $amount <= $fd_amount * 0.6) {
            return true;
        } else {
            $_SESSION['error_message'] = "You not eligibale for this loan.Try again!!";
            return false;
        }
    }
}
