<?php
include_once '../Models/fdFormModel.php';
include_once '../Config/db.php';

class moneyTransferController
{
    private $model;

    function __construct()
    {
        $this->model = new MoneyTransferMOdel();
    }

    public function checkId($id)
    {
        $validity = $this->model->checkID($id);
        return $validity;
    }

    public function submitSavingAccount()
    {
        if (!empty($_POST["inputAccNo"])) {
            $accountNumber = $_POST["inputAccNo"];

            if ($this->checkId($accountNumber) == true) {

                $data = $this->model->selectRowById($accountNumber);
                return $data;
            } else {
                return null;
            }
        } else {
            echo "invalid data";
            return null;
        }
    }
}
