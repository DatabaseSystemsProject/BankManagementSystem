<?php

include_once '../Config/db.php';

class TransactionReportModel{

    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }


    public function getBranch($branchmanager_NIC){
        
        $sql = "SELECT br.branch_name, br.branch_id FROM staff st JOIN branch br ON st.branch_id = br.branch_id AND st.user_NIC = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $branchmanager_NIC);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result;
    }


    public function getTransactionDetails($branch_id){

        $sql = "SELECT COUNT(t.transaction_id) AS transaction_count
                FROM transaction t 
                JOIN account a ON a.account_no = t.source OR a.account_no = t.destination AND a.branch_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $branch_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getTransfersCount($branch_id){

        $transaction_type = 3;

        $sql = "SELECT COUNT(t.transaction_id) AS transfers_count
                FROM transaction t
                JOIN account a ON a.account_no = t.source OR a.account_no = t.destination AND a.branch_id = ?
                WHERE t.transaction_type = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $branch_id, $transaction_type);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getDepositsCount($branch_id){
        
        $transaction_type = 2;

        $sql = "SELECT COUNT(t.transaction_id) AS deposits_count
                FROM transaction t
                JOIN account a ON a.account_no = t.destination AND a.branch_id = ?
                WHERE t.transaction_type = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $branch_id, $transaction_type);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }
    
    
}

?>