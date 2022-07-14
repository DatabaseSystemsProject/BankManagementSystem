<?php 
include_once "../Config/db.php";

class addOrganizationModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function addOrganization($regNo,$orgName,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email)
    {
        $sql="INSERT INTO organization(reg_no,org_name,reg_date,building_name,street_name,city,district,province,zip_code,contact_no,email) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssiss",$regNo,$orgName,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

    function addStakeholder($orgRegNo,$stakeholderNIC)
    {
        $sql = "INSERT INTO org_stakeholder(reg_no,customer_NIC) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss",$orgRegNo,$stakeholderNIC);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

    function getStakeholders($orgRegNo)
    {
        $sql = "SELECT customer_NIC FROM org_stakeholder WHERE reg_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orgRegNo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    function getFirstStakeholderNIC($orgRegNo)
    {
        $stakeholderList = $this->getStakeholders($orgRegNo);
        if($stakeholderList->num_rows > 0){
            $row = $stakeholderList->fetch_assoc(); 
            return $row['customer_NIC'];
        }
    }
    function getAllRegNo()
    {
        $sql = "SELECT reg_no,org_name FROM organization";
        $result = $this->conn->query($sql);
        return $result;
    }
    function getEmail($orgRegNo)
    {
        $sql = "SELECT email FROM organization WHERE reg_no = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orgRegNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }
}
?>