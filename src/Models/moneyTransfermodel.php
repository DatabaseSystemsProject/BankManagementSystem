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
        $sql = "SELECT * FROM account_abstract INNER JOIN account_type WHERE account_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    public function updateAmount($id, $transferredAmount, $senderId)
    {

        mysqli_begin_transaction($this->conn);

        try {

            mysqli_autocommit($this->conn, FALSE);
            $state = true;

            $row_sender = $this->selectRowById($senderId);
            $amount_sender = $row_sender["balance"];
            $sender_updatedBalance = $amount_sender - $transferredAmount;

            $row_receiver = $this->selectRowById($id);
            $amount_receiver = $row_receiver["balance"];
            $receiver_updatedBalance = $amount_receiver + $transferredAmount;

            $sql1 = "UPDATE account SET balance='$receiver_updatedBalance' WHERE account_no=?;";
            $sql2 = "UPDATE account SET balance='$sender_updatedBalance' WHERE account_no=?;";

            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bind_param("i", $id);
            $res1 = $stmt1->execute();
            if (!$res1) {
                $state = false;
            }

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("i", $senderId);
            $res2 = $stmt2->execute();
            if (!$res2) {
                $state = false;
            }


            $sql3 = "SELECT withdrawal_count FROM savings_account WHERE savings_acc_no=?";
            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->bind_param("i", $senderId);
            $stmt3->execute();
            $res3 = $stmt3->get_result();
            if (!$res3) {
                $state = false;
            }

            $count = $res3->fetch_assoc();
            $wihdrawal_count = $count['withdrawal_count'];
            $updatedWithdrawalCount = $wihdrawal_count + 1;

            $sql4 = "UPDATE savings_account SET withdrawal_count='$updatedWithdrawalCount' WHERE savings_acc_no=?;";
            $stmt4 = $this->conn->prepare($sql4);
            $stmt4->bind_param("i", $senderId);
            $res4 = $stmt4->execute();
            if (!$res4) {
                $state = false;
            }


            $transaction_type = 5;
            $stmt5 = $this->conn->prepare("INSERT INTO transaction(transaction_type,source ,destination,amount) VALUES (?,?,?,?)");
            $stmt5->bind_param("iiid", $transaction_type, $senderId, $id, $transferredAmount);
            $res5 = $stmt5->execute();
            if (!$res5) {
                $state = false;
            }

            if ($state == true) {
                mysqli_commit($this->conn);
                header("Location: transferSuccess.php");
            } else {
                $_SESSION['error_message'] = "Error occured during transaction";
                echo '<p style="color:red; font-size:3rem; align-self:center; margin-bottom:-4%;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->conn);
            throw $exception;
        }
    }

    public function getCustomerEmail($id)
    {
        $sql = "SELECT email FROM customer INNER JOIN account_abstract ON customer.user_NIC=account_abstract.customer_NIC WHERE account_abstract.account_no=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $email = $user['email'];
        return $email;
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

    public function updateTransactionTable($senderId, $receiverId, $amount)
    {
        $transaction_type = 3;
        $stmt = $this->conn->prepare("INSERT INTO transaction(transaction_type,source ,destination,amount) VALUES (?,?,?,?)");
        $stmt->bind_param("iiid", $transaction_type, $senderId, $receiverId, $amount);
        $stmt->execute();
    }
}
