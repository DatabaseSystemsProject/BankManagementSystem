<?php
include "../Config/db.php";

class CardModel
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

    public function createCard($accountNo, $pin)
    {

        $sql = "INSERT INTO card(account_no, pin_no) values(?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $accountNo, $pin);
        $result = $stmt->execute();
        return $result;
    }

    public function getDetails($accountNo)
    {
        $sql = "SELECT card_no,pin_no FROM card WHERE account_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
}
