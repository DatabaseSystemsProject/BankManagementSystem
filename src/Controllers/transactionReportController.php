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


    public function getWithdrewAmount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getWithdrewAmount($branch_id, $start_date, $end_date);
        $withdrew_amount = $result["SUM(withdrew_amount)"];
        return $withdrew_amount;
    }


    public function getDepositedAmount($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getDepositedAmount($branch_id, $start_date, $end_date);
        $deposited_amount = $result["SUM(deposited_amount)"];
        return $deposited_amount;
    }


    public function getTransferredAmountfrom($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getTransferredAmountfrom($branch_id, $start_date, $end_date);
        $transferred_amount_from = $result["SUM(transferred_amount_from)"];
        return $transferred_amount_from;
    }


    public function getTransferredAmountTo($branch_id, $start_date, $end_date){
        $result = $this->transactionReportModel->getTransferredAmountTo($branch_id, $start_date, $end_date);
        $transferred_amount_to = $result["SUM(transferred_amount_to)"];
        return $transferred_amount_to;
    }

    
    public function generateReport($branch_id, $branch_name){
        if (isset($_POST["generate"])) {
            if(!empty($_POST["start_date"]) && !empty($_POST["end_date"])){
                $start_date = $_POST["start_date"]. " 00:00:00";
                $end_date = $_POST["end_date"]. " 00:00:00";

                $total_transaction_count = $this->getToalTransactionCount($branch_id, $start_date, $end_date);
                $tranfers_count = $this->getTransfersCount($branch_id, $start_date, $end_date);
                $deposits_count = $this->getDepositsCount($branch_id, $start_date, $end_date);
                $withdrawals_count = $this->getWithdrawlsCount($branch_id, $start_date, $end_date);

                $withdrew_amount = $this->getWithdrewAmount($branch_id, $start_date, $end_date);
                $deposited_amount = $this->getDepositedAmount($branch_id, $start_date, $end_date);
                $transferred_amount_from = $this->getTransferredAmountfrom($branch_id, $start_date, $end_date);
                $transferred_amount_to = $this->getTransferredAmountTo($branch_id, $start_date, $end_date);

                $total_transacted_amount = $deposited_amount + $transferred_amount_to - $withdrew_amount - $transferred_amount_from;

                ?>

                <div class="container report border m-5 py-5 px-5 mx-auto" style="background-color: white;">
                    <h4 style="text-align: center;"> <?php echo $branch_name ?> Branch - Total Transaction Report </h4> <br> <br>

                    <h6> No of Withdrawals : &nbsp; <?php echo $withdrawals_count ?> </h6> <br>
                    <h6> No of Deposits : &nbsp; <?php echo $deposits_count ?> </h6> <br>
                    <h6> No of Transfers : &nbsp; <?php echo $tranfers_count ?> </h5> <br>
                    <h6> No of Total Transactions : &nbsp; <?php echo $total_transaction_count ?> </h6> <br>
                    <h6> Toatal Withdrew Amount : &nbsp; Rs. <?php echo $withdrew_amount ?></h6> <br>
                    <h6> Total Deposited Amount : &nbsp; Rs. <?php echo $deposited_amount ?> </h6> <br>
                    <h6> Total Transferred Amount From This Branch : &nbsp; Rs. <?php echo $transferred_amount_from ?> </h6> <br>
                    <h6> Total Transferred Amount To This Branch : &nbsp; Rs. <?php echo $transferred_amount_to ?> </h6> <br>
                    <h6> Total Transacted Amount : &nbsp; Rs. <?php echo $total_transacted_amount ?> </h6> <br>

                </div>

                <?php
            }
        }
    }


}

?>