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

    public function getToalTransactionCount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getToalTransactionCount($branch_id, $start_date, $end_date);
        $transaction_count = $result["transaction_count"];
        return $transaction_count;
    }


    public function getTransfersCount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getTransfersCount($branch_id, $start_date, $end_date);
        $transfers_count = $result["transfers_count"];
        return $transfers_count;
    }


    public function getDepositsCount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getDepositsCount($branch_id, $start_date, $end_date);
        $deposits_count = $result["deposits_count"];
        return $deposits_count;
    }


    public function getWithdrawlsCount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getWithdrawalsCount($branch_id, $start_date, $end_date);
        $withdrawals_count = $result["withdrawals_count"];
        return $withdrawals_count;
    }

    
    public function generateReport($branch_id, $branch_name){
        if (isset($_POST["generate"])) {
            if(!empty($_POST["start_date"]) && !empty($_POST["end_date"])){
                $start_date = $_POST["start_date"] . " 00:00:00";
                $end_date = $_POST["end_date"] . " 00:00:00";
                
                ?>

                <div class="container border border-2 m-5 p-5 mx-auto ">
                    <h3 style="text-align: center;"> <?php echo $branch_name ?> Branch - Total Transaction Report </h3> <br> <br>

                    <h5> No of Total Transactions : <?php echo $this->getToalTransactionCount($branch_id, $start_date, $end_date); ?> </h5> <br>
                    <h5> No of Transfers : <?php echo $this->getTransfersCount($branch_id, $start_date, $end_date); ?> </h5> <br>
                    <h5> No of Deposits : <?php echo $this->getDepositsCount($branch_id, $start_date, $end_date); ?> </h5> <br>
                    <h5> No of Withdrawals : <?php echo $this->getWithdrawlsCount($branch_id, $start_date, $end_date); ?> </h5>
                </div>

                <?php
            }
        }
    }


}

?>