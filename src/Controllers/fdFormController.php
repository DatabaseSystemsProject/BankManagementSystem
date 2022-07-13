<?php
include_once '../Models/fdFormModel.php';
include_once '../Config/db.php';

class moneyTransferController
{
    private $model;
    private $accountNumber;
    private $fd_types;
    private $fd_type_id;
    private $fd_amount;

    function __construct()
    {
        $this->model = new MoneyTransferMOdel();
    }

    public function checkId()
    {

        if (isset($_POST["submit1"])) {
            if (!empty($_POST["inputAccNo"])) {
                $this->accountNumber = $_POST["inputAccNo"];
                $validity = $this->model->checkID($this->accountNumber);
                return $validity;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function submitSavingAccount()
    {
        if ($this->checkId($this->accountNumber) == true) {

            $data = $this->model->selectRowById($this->accountNumber);
            return $data;
        } else {
            return null;
        }
    }

    public function getUserDetails()
    {
        if ($this->submitSavingAccount() != null) {
            $details = $this->model->getCustomerDetailsBySavingAccountNo($this->accountNumber);
            return $details;
        }
    }

    public function autofill()
    {
        $array = array();
        $details = $this->getUserDetails($this->accountNumber);
        $array['full_name'] = $details['f_name'] . " " . $details['m_name'] . " " . $details['l_name'];
        $array['nic'] = $details['user_NIC'];
        $array['birthday'] = $details['dob'];
        $array['email'] = $details['email'];
        $array['contact_number'] = $details['contact_number'];
        $array['address'] = $details['residence'] . ", " . $details['street_name'] . ", " . $details['city'];
        return $array;
    }


    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function getFdTypes()
    {
        $this->fd_types = $this->model->getFdAccountTypes();
        return $this->fd_types;
    }

    public function submitFdAccountDetails()
    {

        if (isset($_POST["apply"])) {


            $this->fd_type_id = $_POST["inputFdType"];
            $this->fd_amount = $_POST["inputFdAmount"];
            $this->accountNumber = $_POST["hidden"];
            //echo $this->fd_type_id;
            //echo $this->fd_amount;

            $fd_type_rate_array = $this->model->selectFdrateById($this->fd_type_id);
            $fd_type_rate = $fd_type_rate_array['interest_rate'];
            //echo $fd_type_rate;
            $monthly_interest = $this->fd_amount * ($fd_type_rate / 100) / 12;
            //echo $monthly_interest;
            //echo $this->accountNumber;
            $this->model->insertFdAccountDetails($this->accountNumber, $this->fd_type_id, $this->fd_amount, $monthly_interest);
            return true;
        } else {
            return false;
        }
    }
}
