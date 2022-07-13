<?php
include_once '../Config/db.php';

class MoneyTransferMOdel
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

        $stmt = "SELECT * FROM account WHERE account_no='$id';";
        $result = mysqli_query($this->conn, $stmt);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo 'found!';
                return true;
            } else {
                echo 'not found';
                return false;
            }
        } else {
            echo 'Error: ' . mysqli_error($this->conn);
            return false;
        }
    }

    public function selectRowById($id)
    {
        $sql = "SELECT * FROM account INNER JOIN account_type WHERE account_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    public function updateAmount($id, $transferredAmount, $senderId)
    {
        $row_sender = $this->selectRowById($senderId);
        $amount_sender = $row_sender["balance"];
        $sender_updatedBalance = $amount_sender - $transferredAmount;

        $row_receiver = $this->selectRowById($id);
        $amount_receiver = $row_receiver["balance"];
        $receiver_updatedBalance = $amount_receiver + $transferredAmount;

        $state = true;
        $sql1 = "UPDATE account SET balance='$receiver_updatedBalance' WHERE account_no=?;";
        $sql2 = "UPDATE account SET balance='$sender_updatedBalance' WHERE account_no=?;";

        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $res = $stmt1->execute();

        if (!$res) {
            $state = false;
            echo "Error: " . mysqli_error($this->conn) . ".";
        }

        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("i", $senderId);
        $res = $stmt2->execute();

        if (!$res) {
            $state = false;
            echo "Error: " . mysqli_error($this->conn) . ".";
        }

        if ($state) {
            mysqli_commit($this->conn);
            echo "All queries have been executed successfully";
        } else {
            mysqli_rollback($this->conn);
            echo "All queries have been canceled";
        }
    }

    public function checkWithdrawalCount($id)
    {
        $sql = "SELECT withdrawal_count FROM savings_account WHERE savings_acc_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc();
        $wihdrawal_count = $count['withdrawal_count'];
        if ($wihdrawal_count < 5) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWithdrawalCount($id)
    {
        $sql = "SELECT withdrawal_count FROM savings_account WHERE savings_acc_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc();
        $wihdrawal_count = $count['withdrawal_count'];
        $updatedWithdrawalCount = $wihdrawal_count + 1;

        $sql1 = "UPDATE savings_account SET withdrawal_count='$updatedWithdrawalCount' WHERE savings_acc_no=?;";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $res = $stmt1->execute();
        if (!$res) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }
}
