<?php

include_once '../Config/db.php';

class staffRegisterModel{
    
    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    
    public function insert($user_NIC, $password, $username, $branch_id, $title, $f_name, $m_name, $l_name, $residence, $city, $district, $province, $zip_code, $email, $dob, $contact_number, $staff_type){
        
        $user_NIC = mysqli_real_escape_string($this->conn, $user_NIC);
        $password = mysqli_real_escape_string($this->conn, $password);
        $username = mysqli_real_escape_string($this->conn, $username);

        $title = mysqli_real_escape_string($this->conn, $title);
        $f_name = mysqli_real_escape_string($this->conn, $f_name);
        $m_name = mysqli_real_escape_string($this->conn, $m_name);
        $l_name = mysqli_real_escape_string($this->conn, $l_name);
        $residence = mysqli_real_escape_string($this->conn, $residence);
        $city = mysqli_real_escape_string($this->conn, $city);
        $district = mysqli_real_escape_string($this->conn, $district);
        $province = mysqli_real_escape_string($this->conn, $province);
        $zip_code = mysqli_real_escape_string($this->conn, $zip_code);
        $email = mysqli_real_escape_string($this->conn, $email);
        $dob = mysqli_real_escape_string($this->conn, $dob);
        $contact_number = mysqli_real_escape_string($this->conn, $contact_number);

        $encrypted_password = md5($password);
        
        $sql = "INSERT INTO staff(user_NIC, password, username, branch_id, title, f_name, m_name, l_name, residence, city, district, province, zip_code, email, dob, contact_number, staff_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssissssssssisssi", $user_NIC, $encrypted_password, $username, $branch_id, $title, $f_name, $m_name, $l_name, $residence, $city, $district, $province, $zip_code, $email, $dob, $contact_number, $staff_type);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }


    public function selectBranches(){

        $sql = "SELECT branch_id, branch_name FROM branch";
        $result = $this->conn->query($sql);

        return $result;
    }


}
