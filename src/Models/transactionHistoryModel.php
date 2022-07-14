<?php 
include_once "../Config/db.php";

class TransactionHistoryModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }
    
    function getTotalAccounts($ownerType)
    {
        $sql = "SELECT total_account_count FROM total_accounts WHERE owner_type = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $ownerType);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }

    function getTransactionHistory($accountNo)
    {
        $sql = "SELECT * FROM transaction WHERE source = ? OR destination = ?"; // add date later if necessary
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$accountNo,$accountNo);
        $stmt->execute();
        $result = $stmt->get_result();
        //$result = $this->conn->query($sql);

        return $result;
    }
    
}
?>