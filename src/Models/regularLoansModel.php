<?php

include_once '../Config/db.php';

class RegularLoansModel {
    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function getBranch($branch_manager_NIC){
        
        $sql = "SELECT b.branch_id AS branch_id,
                        b.branch_name AS branch_name
                FROM branch b
                JOIN staff s ON s.branch_id = b.branch_id AND s.user_NIC = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $branch_manager_NIC);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result;
    }

    public function getRequestedLoans($branch_id){
        $loan_status = "requested";

        $sql = "SELECT rl.loan_id AS loan_id, 
                       c.f_name AS first_name, 
                       c.l_name AS last_name,
                       l.datetime AS date_time,
                       l.amount AS amount,
                       l.duration AS duration,
                       l.liability AS liability,
                       rl.guarantor_name AS guarantor_name
                FROM regular_loan rl
                JOIN staff s ON s.user_NIC = rl.requested_staff_id AND s.branch_id = ?
                JOIN loan l ON l.loan_id = rl.loan_id
                JOIN customer c ON l.customer_NIC = c.user_NIC
                WHERE rl.loan_status = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $branch_id, $loan_status);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }



    public function approveLoan($loan_id, $branch_manager_NIC){
        $loan_status = "accepted";

        $sql = "UPDATE regular_loan
                SET loan_status = ?,
                    accep_rej_staff_id=?
                WHERE loan_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $loan_status, $branch_manager_NIC, $loan_id);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }


    public function rejectLoan($loan_id, $branch_manager_NIC){
        $loan_status = "rejected";

        $sql = "UPDATE regular_loan
                SET loan_status = ?,
                    accep_rej_staff_id=?
                WHERE loan_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $loan_status, $branch_manager_NIC, $loan_id);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }
}

?>