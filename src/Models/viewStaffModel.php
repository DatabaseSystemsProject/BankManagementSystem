<?php
include_once "../Config/db.php";


class StaffModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function getStaff()
    {
        $sql = "SELECT * FROM staff_for_superuser ORDER BY (user_NIC) DESC; ";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }

}
?>