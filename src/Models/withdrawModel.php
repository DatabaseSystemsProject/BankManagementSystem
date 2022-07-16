<?php
include "../Config/db.php";

class WithdrawModel
{

    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function checkDetails($accountNo)
    {

        $sql = "SELECT * FROM account JOIN account_type ON account.account_type_id = account_type.acc_type_id WHERE account_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function getSavingsAcc($accountNo)
    {
        $sql = "SELECT * FROM account JOIN savings_account ON account.account_no = savings_account.savings_acc_no WHERE account_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function updateWithdrawalCount($accountNo, $newWithdrawalAmount)
    {
        $sql = "UPDATE savings_account SET withdrawal_count = ? WHERE savings_acc_no =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $newWithdrawalAmount, $accountNo);
        $stmt->execute();
        return;
    }

    public function  updateAccountBalance($accountNo, $remainingbalance)
    {
        $sql = "UPDATE account SET balance = ? WHERE account_no =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $remainingbalance, $accountNo);
        $stmt->execute();
        return;
    }


    public function getCheckingAcc($accountNo)
    {
        $sql = "SELECT * FROM account JOIN checking_account ON account.account_no = checking_account.checking_acc_no WHERE account_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function updateTransactionTable($senderId, $amount, $employeeID)
    {
        $transaction_type = 1;
        $stmt = $this->conn->prepare("INSERT INTO transaction(transaction_type,source,amount,teller) VALUES (?,?,?,?)");
        $stmt->bind_param("iidi", $transaction_type, $senderId, $amount, $employeeID);
        $stmt->execute();
        return;
    }

    public function withdrawAndUpdateTransaction($account_no, $newWithdrawalCount, $remainingbalance, $amount, $employee_id)
    {
        $transaction_type = 1;

        mysqli_begin_transaction($this->conn);
        try {
            mysqli_autocommit($this->conn, FALSE);
            $sql1 = "UPDATE savings_account SET withdrawal_count = ? WHERE savings_acc_no =?";
            $sql2 = "UPDATE account SET balance = ? WHERE account_no =?";
            $sql3 = "INSERT INTO transaction(transaction_type,source,amount,teller) VALUES (?,?,?,?)";

            $state = true;

            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bind_param("ii", $newWithdrawalCount, $account_no);
            $res1 = $stmt1->execute();
            if (!$res1) {
                $state = false;
            }

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("di", $remainingbalance, $account_no);
            $res2 = $stmt2->execute();
            if (!$res2) {
                $state = false;
            }

            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->bind_param("iidi", $transaction_type, $account_no, $amount, $employee_id);
            $res3 = $stmt3->execute();
            if (!$res3) {
                $state = false;
            }
            if ($state) {
                mysqli_commit($this->conn);
                return true;
            } else {
                mysqli_rollback($this->conn);
                return false;
            }
        } catch (mysqli_sql_exception $exception) {
            throw $exception;
            return false;
        }
    }

    public function updateBalanceAndUpdateTransaction($account_no, $remainingbalance, $amount, $employee_id)
    {
        $transaction_type = 1;

        mysqli_begin_transaction($this->conn);
        try {
            mysqli_autocommit($this->conn, FALSE);
            $sql2 = "UPDATE account SET balance = ? WHERE account_no =?";
            $sql3 = "INSERT INTO transaction(transaction_type,source,amount,teller) VALUES (?,?,?,?)";

            $state = true;

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("di", $remainingbalance, $account_no);
            $res2 = $stmt2->execute();
            if (!$res2) {
                $state = false;
            }

            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->bind_param("iidi", $transaction_type, $account_no, $amount, $employee_id);
            $res3 = $stmt3->execute();
            if (!$res3) {
                $state = false;
            }
            if ($state) {
                mysqli_commit($this->conn);
                return true;
            } else {
                mysqli_rollback($this->conn);
                return false;
            }
        } catch (mysqli_sql_exception $exception) {
            throw $exception;
            return false;
        }
    }
}
