<?php

include_once '../Config/db.php';

class TransactionReportModel{

    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }


    public function getBranch($branchmanager_NIC){
        
        $sql = "SELECT branch_name FROM staff st JOIN branch br ON st.branch_id = br.branch_id AND st.user_NIC = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $branchmanager_NIC);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result;
    }
    
    
}

?>