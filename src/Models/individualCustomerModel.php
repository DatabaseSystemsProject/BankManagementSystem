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

    function addCustomer($title,$fName,$mName,$lName,$NIC,$gender,$residence,$street,$city,$district,$province,$zipcode,$contactNo,$email,$dob,$occupation)
    {
        $sql="INSERT INTO customer(NIC,title,f_name,m_name,l_name,residence_id,street_name,city,district,province,zip_code,email_address,contact_no,gender,dob,occupation) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssisssss",$title,$fName,$mName,$lName,$NIC,$gender,$residence,$street,$city,$district,$province,$zipcode,$contactNo,$email,$dob,$occupation);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

}
?>