<?php

include_once '../Config/db.php';

class staffRegisterModel{
    
    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    
    public function insert($title, $first_name, $last_name, $username, $nic, $staff_type, $branch, $encrypted_password){
        
        $title = mysqli_real_escape_string($this->conn,"$title");
        $first_name = mysqli_real_escape_string($this->conn,"$first_name");
        $last_name = mysqli_real_escape_string($this->conn,"$last_name");
        $username = mysqli_real_escape_string($this->conn,"$username");
        $nic = mysqli_real_escape_string($this->conn,"$nic");
        $staff_type = mysqli_real_escape_string($this->conn,"$staff_type");
        $branch = mysqli_real_escape_string($this->conn,"$branch");

        $sql = "INSERT INTO staff(nic, password, username, first_name, last_name, title, branch_id, staff_type) VALUES ('$nic', '$encrypted_password', '$username', '$first_name', '$last_name', '$title', '1' , '$staff_type');";

        $result = $this->conn->query($sql);

        $this->conn->close();

        return $result;

    }
}


?>