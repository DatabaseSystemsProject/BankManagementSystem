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
        $sql = "SELECT user_NIC,branch_name,f_name,l_name,email,contact_number,staff_type_name FROM staff INNER JOIN staff_type ON staff.staff_type=staff_type.staff_type_id JOIN branch USING(branch_id) ORDER BY (user_NIC) DESC; ";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }

}
?>