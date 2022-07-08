<?php

require_once('../Core/Controller.php');
include "../Models/transactionReportModel.php";

class TransactionReportController{

    private $transactionReportModel;

    public function __construct(){
        $this->transactionReportModel = new TransactionReportModel();
    }


    public function getBranchName($branchManager_NIC){
        
        $result = $this->transactionReportModel->getBranch($branchManager_NIC);
        $branch_name = $result["branch_name"];
        return $branch_name;
    }


    public function getBranchID($branchManager_NIC){
        $result = $this->transactionReportModel->getBranch($branchManager_NIC);
        $branch_id = $result["branch_id"];
        return $branch_id;
    }

    public function getTotalTransactionsCount($branch_id){
        $result = $this->transactionReportModel->getTransactionDetails($branch_id);
        $transaction_count = $result["transaction_count"];
        return $transaction_count;
    }


    public function getTransfersCount($branch_id){
        $result = $this->transactionReportModel->getTransfersCount($branch_id);
        $transfers_count = $result["transfers_count"];
        return $transfers_count;
    }


    public function getDepositsCount($branch_id){
        $result = $this->transactionReportModel->getDepositsCount($branch_id);
        $deposits_count = $result["deposits_count"];
        return $deposits_count;
    }


}

?>