<?php 
include_once "../Config/db.php";

class OnlineLoanModle 
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function getFixedDepositeID($user_id)
    {
        $sql="SELECT * FROM fd_account join account where fd_account.saving_account_id= account.account_no and customer_NIC= ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getLoanTypes()
    {
        $sql="SELECT * FROM loan_plan ";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function getFixedDepositeData($fd_id)
    {
        $sql="SELECT * FROM fd_account join fd_type USING(fd_type_id) where fd_account_id= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $fd_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function getCustomerContact($user_id)
    {
        
        $sql="SELECT * FROM customer   where user_NIC= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function getOgranization($user_id)
    {
        
        $sql="SELECT * FROM organization   where reg_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
   
    
}
?>