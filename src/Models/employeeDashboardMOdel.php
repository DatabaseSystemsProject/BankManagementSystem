<?php
include_once '../Config/db.php';

class EmployeeDashboardMOdel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function getEmployeeDetails($id)
    {
        $sql = "SELECT f_name,l_name FROM `staff` WHERE user_NIC=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
}
