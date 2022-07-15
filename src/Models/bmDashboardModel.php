<?php 

include_once '../Config/db.php';

class bmDashboardModel {
    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function getBMDetails($branch_manager_NIC){
        
        $sql = "SELECT s.f_name AS first_name,
                       s.l_name AS last_name,
                       b.branch_name AS branch_name,
                       b.branch_id AS branch_id
                FROM staff s
                JOIN branch b ON b.branch_id = s.branch_id
                WHERE s.user_NIC = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $branch_manager_NIC);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result;
    }
}

?>