<?php

require_once('../Core/Controller.php');
include "../Models/transactionReportModel.php";

class TransactionReportController{

    private $transactionReportModel;

    public function __construct(){
        $this->transactionReportModel = new TransactionReportModel();
    }


    public function getBranch($branchManager_NIC){
        
        $result = $this->transactionReportModel->getBranch($branchManager_NIC);
        $branch_name = $result["branch_name"];
        return $branch_name;
    }


}

?>