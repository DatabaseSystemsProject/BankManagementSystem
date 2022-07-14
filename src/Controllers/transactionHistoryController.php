<?php
require_once('../Core/Controller.php');
include_once("../Models/transactionHistoryModel.php");

class TransactionHistoryController
{
    private $transactionHistoryModel;

    public function __construct()
    {
        $this->transactionHistoryModel = new TransactionHistoryModel();
    }
    public function getChildList()
    {
        $childList = $this->childModel->getChildList();
        return $childList;
    }
    public function getTransactionHistory($accountNo)
    {
        $transactionHistory = $this->transactionHistoryModel->getTransactionHistory($accountNo);
        return $transactionHistory;
    }
}
?>