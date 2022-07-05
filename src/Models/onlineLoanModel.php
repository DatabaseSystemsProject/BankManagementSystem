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
    
    function getFixedDepositeID($sav_no)
    {
        $sql="SELECT fd_id FROM fd_account where savings_account_id= '$sav_no'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function getLoanTypes()
    {
        $sql="SELECT * FROM loan_plan ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getCustomerContact($sav_no)
    {
        
        $sql="SELECT * FROM account natural join customer  where account_no='$sav_no'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function getCustomerDetails($customer_id)
    {
        $sql="SELECT * FROM individual_customer natural join adult_individual where customer_id='$customer_id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    
}
?>