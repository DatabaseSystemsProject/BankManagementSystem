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
        $stmt->bind_param("ii", $newWithdrawalAmount, $accountNo);
        $stmt->execute();
        return;
    }

    public function  updateAccountBalance($accountNo, $remainingbalance)
    {
        $sql = "UPDATE account SET balance = ? WHERE account_no =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $remainingbalance, $accountNo);
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
}
