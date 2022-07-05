<?php
include "../Models/onlineLoanModel.php";

class OnlineLoanController
{
    private $loanModel;
    private $sav_acc_no;
    private $fd_id;
    private $amount;

    function __construct()
    {
        $this->loanModel = new OnlineLoanModle();
    }

    function getLoanTypes()
    {
        $loanTypes = $this->loanModel->getLoanTypes();
        // echo ($loanTypes);
        return $loanTypes;
    }

    function checkEligibility()
    {
        if (isset($_POST["check"])) {

            $this->sav_acc_no = $_POST["inputAccNo"];
            $this->amount = $_POST["inputLoanAmount"];
            $fd_id = $this->loanModel->getFixedDepositeID($this->sav_acc_no);

            if ($fd_id != null && $this->amount <= 50000) {
                $this->fd_id=$fd_id["fd_id"];
                // return true;
                return true;
                // header("Location: ../Views/loanApplyOnine.php");
            } else {
                return false;
                // $_SESSION['error_message'] = "Invalid";
            }
        }
    }

    function autoFill()
    {
        $array = array();

        $result = $this->loanModel->getCustomerContact($this->sav_acc_no);
        if ($result["customer_type"] == "individual") {
            $name_nic = $this->loanModel->getCustomerDetails($result["customer_id"]);
            $array["full_name"] = $name_nic["f_name"] ." ". $name_nic["m_name"] ." ". $name_nic["l_name"];
            $array["nic"] = $name_nic["NIC"];
        } else {
            $array["full_name"] = "";
            $array["nic"] = "";
        }

        $array["email"] = $result["email_address"];
        $array["mobile"] = $result["contact_no"];
        $array["amount"] = $this->amount;
        $array["sav_acc_no"] = $this->sav_acc_no;
        $array["fd_no"] = $this->fd_id;

        return $array;
    }
}
