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

    function getFixedDepositeID($account_no)
    {
        $sql="SELECT * FROM fd_account where saving_account_id=? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $account_no);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
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
        $stmt->close();
        return $result;
    }

    function getCustomerContact($user_id)
    {
        
        $sql="SELECT * FROM customer   where user_NIC= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
    function getAccount($account_no)
    {
        $sql="SELECT * FROM account INNER JOIN customer_type USING(customer_type_id) where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $account_no);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getRegNo($org_account)
    {

        $sql="SELECT * FROM org_account where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $org_account);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getOgranization($user_id)
    {
        
        $sql="SELECT * FROM organization   where reg_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function submitApplication($loan_type,$customer_NIC,$amount,$duration,$liability,$type,$tax_no,$reg_no,$fd_id)
    {
        $sql="INSERT INTO loan (loan_type,customer_NIC,amount,duration,liability,type,tax_no) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdidss",$loan_type,$customer_NIC,$amount,$duration,$liability,$type,$tax_no );
        $stmt->execute();

        

        $sql1="LOCK TABLES loan READ;";
        $sql2="SELECT loan_id FROM loan ORDER BY loan_id DESC LIMIT 1;";
        $sql3="UNLOCK TABLES;";
        // mysqli_query($this->conn, $sql1);
        $id=mysqli_query($this->conn, $sql2)->fetch_assoc()["loan_id"];
        // mysqli_query($this->conn, $sql3);
        
        // $id=$this->conn->insert_id;
        var_dump($id);

        $sql="INSERT INTO online_loan (loan_id,fd_id) VALUES(?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$id,$fd_id );
        $stmt->execute();
        // var_dump($stmt->get_result(->fetch_assoc()));
        $stmt->close();

        if(!is_null($reg_no)){
    
        $sql="INSERT INTO business_loan (loan_id,reg_no) VALUES(?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$id,$reg_no );
        $stmt->execute();
        $stmt->close();
        }

    }
   
    
}
