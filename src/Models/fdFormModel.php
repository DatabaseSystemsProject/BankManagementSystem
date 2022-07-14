<?php

include_once '../Config/db.php';

class FDMOdel
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

    public function checkID($id)
    {

        $stmt = "SELECT * FROM savings_account WHERE savings_acc_no='$id';";
        $result = mysqli_query($this->conn, $stmt);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // echo 'found!';
                return true;
            } else {
                // echo 'not found';
                return false;
            }
        } else {
            echo 'Error: ' . mysqli_error($this->conn);
            return false;
        }
    }

    public function selectRowById($id)
    {
        $sql = "SELECT * FROM savings_account WHERE savings_acc_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }


    public function getCustomerIdBySavingAccountNo($accountNo)
    {
        $sql = "SELECT account.customer_NIC FROM savings_account INNER JOIN account ON savings_account.savings_acc_no=account.account_no WHERE savings_account.savings_acc_no=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
        $customerNIC = $customer['customer_NIC'];
        return $customerNIC;
    }

    public function getCustomerDetailsBySavingAccountNo($accountNo)
    {
        $customerNIC = $this->getCustomerIdBySavingAccountNo($accountNo);
        $sql = "SELECT * FROM customer WHERE user_NIC=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customerNIC);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    public function getFdAccountTypes()
    {
        $sql = "SELECT * FROM fd_type";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                //echo 'found!';
                return $result;
            } else {
                //echo 'not found';
                return null;
            }
        } else {
            echo 'Error: ' . mysqli_error($this->conn);
            return null;
        }
    }

    public function selectFdrateById($typeId)
    {
        $sql = "SELECT interest_rate FROM fd_type WHERE fd_type_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $typeId);
        $stmt->execute();
        $result = $stmt->get_result();
        $type_rate = $result->fetch_assoc();
        return $type_rate;
    }

    public function insertFdAccountDetails($savingAccountNo, $fd_type_id, $amount, $monthly_interest)
    {
        $stmt = $this->conn->prepare("INSERT INTO fd_account (saving_account_id,fd_type_id,amount,monthly_interest) VALUES (?,?,?,?)");
        $stmt->bind_param("iidd", $savingAccountNo, $fd_type_id, $amount, $monthly_interest);
        $stmt->execute();

        //echo "<h1>successfull</h1>";
    }
}
