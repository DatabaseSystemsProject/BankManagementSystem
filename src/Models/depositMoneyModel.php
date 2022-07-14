<?php 
include_once "../Config/db.php";

class DepositMoneyModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function depositMoney($accountNo,$amount,$remarks,$empID) //this should be a transaction
    {
        $transactionType = 2;
        $sql="INSERT INTO transaction(transaction_type,destination,amount,details,teller) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidss",$transactionType,$accountNo,$amount,$remarks,$empID);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        else{
            
        }
    }

}
?>