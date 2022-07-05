<?php
include_once '../Models/moneyTransfermodel.php';
include_once '../Config/db.php';

class moneyTransferController
{
    private $model;

    function __construct()
    {
        $this->model = new MoneyTransferMOdel();
    }

    public function submitForm()
    {
        if (!empty($_POST["accountNumber"]) && !empty($_POST["fullName"]) && !empty($_POST["amount"])) {
            $accountNumber = $_POST["accountNumber"];
            $fullName = $_POST["fullName"];
            $email = $_POST["inputEmail"];
            $amount = $_POST["amount"];
            $this->model->checkID($accountNumber);
            return array($accountNumber, $amount);
        } else {
            echo "invalid data";
        }
    }

    public function updateBalance($id, $transferredAmount, $senderId)
    {
        if ($this->checkBalanceAvailability($senderId, $transferredAmount) == true) {
            $this->model->updateAmount($id, $transferredAmount, $senderId);
            header("Location: transferSuccess.php");
        } else {
            header("Location: insufficientBalance.php");
        }
    }

    public function checkBalanceAvailability($id, $transferredAmount)
    {
        $minimumBalance = 100;
        $data = $this->model->selectRowById($id);
        $availableBalance = $data['amount'];
        if (($availableBalance - $transferredAmount) >= $minimumBalance) {
            return true;
        } else {
            return false;
        }
    }
}
