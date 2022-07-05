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

        $stmt = "SELECT * FROM savings_account WHERE id='$id';";
        $result = mysqli_query($this->conn, $stmt);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo 'found!';
            } else {
                echo 'not found';
            }
        } else {
            echo 'Error: ' . mysqli_error($this->conn);
        }
    }

    public function selectRowById($id)
    {
        $sql = "SELECT * FROM savings_account WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    public function updateAmount($id, $transferredAmount, $senderId)
    {
        $row_receiver = $this->selectRowById($id);
        $amount_receiver = $row_receiver["amount"];
        $receiver_updatedBalance = $amount_receiver + $transferredAmount;

        $row_sender = $this->selectRowById($senderId);
        $amount_sender = $row_sender["amount"];
        $sender_updatedBalance = $amount_sender - $transferredAmount;

        $state = true;
        $sql1 = "UPDATE savings_account SET amount='$receiver_updatedBalance' WHERE id=?;";
        $sql2 = "UPDATE savings_account SET amount='$sender_updatedBalance' WHERE id=?;";

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
        mysqli_close($this->conn);
    }
}
