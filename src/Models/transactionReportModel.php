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


    public function getToalTransactionCount($branch_id, $start_date, $end_date){

        $sql = "SELECT COUNT(DISTINCT t.transaction_id) AS transaction_count
                FROM transaction t 
                JOIN account a ON (a.account_no = t.source OR a.account_no = t.destination) AND a.branch_id = ?
                WHERE t.datetime BETWEEN ? AND ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $branch_id, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getTransfersCount($branch_id, $start_date, $end_date){

        $transaction_type = 3;

        $sql = "SELECT COUNT(DISTINCT t.transaction_id) AS transfers_count
                FROM transaction t
                JOIN account a ON (a.account_no = t.source OR a.account_no = t.destination) AND a.branch_id = ?
                WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getDepositsCount($branch_id, $start_date, $end_date){
        
        $transaction_type = 2;

        $sql = "SELECT COUNT(DISTINCT t.transaction_id) AS deposits_count
                FROM transaction t
                JOIN account a ON a.account_no = t.destination AND a.branch_id = ?
                WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getWithdrawalsCount($branch_id, $start_date, $end_date){
        $transaction_type = 1;

        $sql = "SELECT COUNT(DISTINCT t.transaction_id) AS withdrawals_count
                FROM transaction t
                JOIN account a ON a.account_no = t.source AND a.branch_id = ?
                WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;

    }


    public function getWithdrewAmount($branch_id, $start_date, $end_date){
        $transaction_type = 1;

        $sql = "SELECT SUM(withdrew_amount)
                FROM (
                    SELECT DISTINCT t.transaction_id AS transaction_id, t.amount AS withdrew_amount
                    FROM transaction t 
                    JOIN account a ON a.account_no = t.source AND a.branch_id = ?
                    WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?
                    )
                AS withdrew_amount";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }

    public function getDepositedAmount($branch_id, $start_date, $end_date){
        $transaction_type = 2;

        $sql = "SELECT SUM(deposited_amount)
                FROM (
                    SELECT DISTINCT t.transaction_id AS transaction_id, t.amount AS deposited_amount
                    FROM transaction t 
                    JOIN account a ON a.account_no = t.destination AND a.branch_id = ?
                    WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?
                    )
                AS deposited_amount";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;

    }


    public function getTransferredAmountfrom($branch_id, $start_date, $end_date){
        $transaction_type = 3;

        $sql = "SELECT SUM(transferred_amount_from)
                FROM (
                    SELECT DISTINCT t.transaction_id AS transaction_id, t.amount AS transferred_amount_from
                    FROM transaction t 
                    JOIN account a ON a.account_no = t.source AND a.branch_id = ?
                    WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?
                    )
                AS transferred_amount_from";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }


    public function getTransferredAmountTo($branch_id, $start_date, $end_date){
        $transaction_type = 3;

        $sql = "SELECT SUM(transferred_amount_to)
                FROM (
                    SELECT DISTINCT t.transaction_id AS transaction_id, t.amount AS transferred_amount_to
                    FROM transaction t 
                    JOIN account a ON a.account_no = t.destination AND a.branch_id = ?
                    WHERE t.transaction_type = ? AND t.datetime BETWEEN ? AND ?
                    )
                AS transferred_amount_to";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $branch_id, $transaction_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }

    //for superuser
    public function getBranchs()
    {
        $sql = "SELECT branch_id,branch_name FROM branch;";

        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }
    public function getBranchByID($branch_id){
        
        $sql = "SELECT branch_name FROM branch where branch_id =?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $branch_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result;
    }
    
}

?>