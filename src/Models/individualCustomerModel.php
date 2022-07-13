<?php 
include_once "../Config/db.php";

class IndividualCustomerModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function addCustomer($NIC,$title,$fName,$mName,$lName,$residence,$street,$city,$district,$province,$zipcode,$email,$dob,$contactNo)
    {
        $sql="INSERT INTO customer(user_NIC,title,f_name,m_name,l_name,residence,street_name,city,district,province,zip_code,email,dob,contact_number) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssisss",$NIC,$title,$fName,$mName,$lName,$residence,$street,$city,$district,$province,$zipcode,$email,$dob,$contactNo);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        else{
            // $customer_type_id = 1; //personal
            // $sql="INSERT INTO customer(user_NIC,customer_type_id) VALUES (?,?)";
            // $stmt = $this->conn->prepare($sql);
            // $stmt->bind_param("si",$NIC,$customer_type_id);
            // $result = $stmt->execute();

            // if (!$result) {
            //     echo "Error: " . mysqli_error($this->conn) . ".";
            // }
        }
    }
    function getAllNIC()
    {
        $sql = "SELECT user_NIC FROM customer";
        $result = $this->conn->query($sql);
        return $result;
    }
    function getEmailAddress($customerNIC)
    {
        $sql = "SELECT email FROM customer WHERE user_NIC = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $customerNIC);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }

}
?>