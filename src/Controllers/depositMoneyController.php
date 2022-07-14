<?php
require_once('../Core/Controller.php');
include_once("../Models/depositMoneyModel.php");

class DepositMoneyController
{
    private $depositMoneyModel;

    public function __construct()
    {
        $this->depositMoneyModel = new DepositMoneyModel();
    }
    public function depositMoney($empID)
    {
        if(isset($_POST["deposit"])){
            //if(!empty($_POST["inputOrgName"])) check this
            $accountNo=$_POST['inputAccNo'];
            $amount=$_POST['inputAmount'];
            $remarks=$_POST['inputRemarks'];

            $result = $this->depositMoneyModel->depositMoney($accountNo,$amount,$remarks,$empID);
            return $result;
        }
    }
}
?>