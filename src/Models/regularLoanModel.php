<?php
include_once "../Config/db.php";

class ReguarLoanModel{ 
private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }


    function getLoanTypes()
    {
        $sql="SELECT * FROM loan_plan ";
        $result = mysqli_query($this->conn, $sql);
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

    function getAccount($sav_acc_no)
    {
        $sql="SELECT * FROM account INNER JOIN customer_type on account.customer_type_id=customer_type.customer_type_id where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $sav_acc_no);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;

    }

    function getStackholder($reg_no,$applicant)
    {
        $sql="SELECT * FROM org_stakeholder where reg_no= ? && customer_NIC=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $reg_no,$applicant);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();
        $stmt->close();
        return $result;

    }


    function submitApplication($loan_type,$customer_NIC,$amount,$duration,$liability,$type,$tax_no,$reg_no,$g_full_name,$g_nic,$g_passport,$g_email,$g_mobile,$loan_status,$req_staff_id,$savings_acc_no)
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
        var_dump($id);

        $sql="INSERT INTO regular_loan (loan_id,guarantor_name,guarantor_NIC,guarantor_pass_no,guarantor_mobile,guarantor_email,loan_status,requested_staff_id,savings_acc_no) VALUES(?,?,?,?,?,?,?,?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssisssi",$id,$g_full_name,$g_nic,$g_passport,$g_mobile,$g_email,$loan_status,$req_staff_id,$savings_acc_no);
        $stmt->execute();
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
