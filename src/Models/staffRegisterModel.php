<?php

include_once '../Config/db.php';

class staffRegisterModel{
    
    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    
    public function insert($title, $first_name, $middle_name, $last_name, $dob, $NIC, $contact_number, $residence, $city, $district, $province, $zip_code, $staff_type, $branch_id, $username, $email, $password){
        
        $title = mysqli_real_escape_string($this->conn,"$title");
        $first_name = mysqli_real_escape_string($this->conn,"$first_name");
        $middle_name = mysqli_real_escape_string($this->conn,"$middle_name");
        $last_name = mysqli_real_escape_string($this->conn,"$last_name");
        $dob = mysqli_real_escape_string($this->conn,"$dob");
        $user_NIC = mysqli_real_escape_string($this->conn,"$NIC");
        $contact_number = mysqli_real_escape_string($this->conn,"$contact_number");
        $residence = mysqli_real_escape_string($this->conn,"$residence");
        $city = mysqli_real_escape_string($this->conn,"$city");
        $district = mysqli_real_escape_string($this->conn,"$district");
        $province = mysqli_real_escape_string($this->conn,"$province");
        $zip_code = mysqli_real_escape_string($this->conn,"$zip_code");
        $username = mysqli_real_escape_string($this->conn,"$username");
        $email = mysqli_real_escape_string($this->conn,"$email");
        $password = mysqli_real_escape_string($this->conn,"$password");

        $encrypted_password = md5($password);

        $sql = "INSERT INTO staff(user_NIC, password, username, branch_id, title, f_name, m_name, l_name, residence, city, district, province, zip_code, email, dob, contact_number, staff_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssissssssssisssi", $user_NIC, $encrypted_password, $username, $branch_id, $title, $first_name, $middle_name, $last_name, $residence, $city, $district, $province, $zip_code, $email, $dob, $contact_number, $staff_type);

        $result = $stmt->execute();

        return $result;
    }



    public function selectBranches(){

        $sql = "SELECT branch_id, branch_name FROM branch";
        $result = $this->conn->query($sql);

        return $result;
    }


}


?>