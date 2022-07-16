<?php

include_once '../Config/db.php';


class LateInstallmentModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function executeStatement($stmt)
    {

        if (mysqli_query($this->conn, $stmt)) {
            echo ("successfull");
        } else {
            echo ("error" . mysqli_error($this->conn));
        }
    }

    public function getOnlineLateInstallments($month, $year, $branchId)
    {
        $sql = "SELECT loan_id,customer_NIC,datetime,amount,duration,monthly_installment FROM loan WHERE loan_id IN (SELECT loan_id FROM loan_installment WHERE loan_id IN (SELECT loan_id FROM online_loan WHERE fd_id IN (SELECT fd_account_id FROM fd_account WHERE saving_account_id IN (SELECT account_no FROM account WHERE branch_id=?))) AND paid=0 AND month=? AND year=?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $branchId, $month, $year);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $user = array($row['loan_id'], $row['customer_NIC'], $row['datetime'], $row['amount'], $row['duration'], $row['monthly_installment']);
            array_push($users, $user);
        }
        //$user = $result->fetch_assoc();
        return $users;
    }

    public function getRegularLateLoanInstallments($month, $year, $branchId)
    {
        $sql = "SELECT loan_id,customer_NIC,datetime,amount,duration,monthly_installment FROM loan WHERE loan_id IN (SELECT loan_id FROM loan_installment WHERE loan_id IN (SELECT loan_id FROM regular_loan WHERE requested_staff_id IN (SELECT user_NIC FROM staff WHERE branch_id=? AND staff_type=1)) AND paid=0 AND month=? AND year=?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $branchId, $month, $year);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $user = array($row['loan_id'], $row['customer_NIC'], $row['datetime'], $row['amount'], $row['duration'], $row['monthly_installment']);
            array_push($users, $user);
        }
        //$user = $result->fetch_assoc();
        return $users;
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
}
