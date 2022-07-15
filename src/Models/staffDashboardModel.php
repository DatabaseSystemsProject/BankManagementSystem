<?php
include_once "../Config/db.php";
 class StaffDashboardModel
 {
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function getStaffContact($user_id)
    {
        
        $sql="SELECT * FROM staff  where user_NIC= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
 }


?>