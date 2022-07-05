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

        $stmt = "SELECT * FROM savings_account WHERE account_no='$id';";
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
        $sql = "SELECT * FROM savings_account WHERE account_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
}
