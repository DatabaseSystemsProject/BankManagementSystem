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

    function depositMoneyOLD_ONE($accountNo,$amount,$remarks,$empID) //this should be a transaction
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
    function depositMoney($accountNo,$amount,$remarks,$empID) //this is a transaction
    {
        mysqli_begin_transaction($this->conn);

        try {
            $state = TRUE;
            $sql1 = "SELECT balance FROM account WHERE account_no=?";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bind_param("i", $accountNo);
            $stmt1->execute();
            $result = $stmt1->get_result()->fetch_assoc();

            $state = $state && $result;
            $oldBalance = $result['balance'];

            $newBalance = $oldBalance + $amount;

            $sql2 = "UPDATE account SET balance = ? WHERE account_no=?";

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("di", $newBalance,$accountNo);
            $result2 =$stmt2->execute();

            $state = $state && $result2;

            //updating transaction table
            $transactionType = 2;
            $sql="INSERT INTO transaction(transaction_type,destination,amount,details,teller) VALUES (?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iidss",$transactionType,$accountNo,$amount,$remarks,$empID);
            $result3 = $stmt->execute();

            $state = $state && $result3;

            if($state){
                mysqli_commit($this->conn);
                return TRUE;
            }

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->conn);

            throw $exception;
        }
    }

}
?>