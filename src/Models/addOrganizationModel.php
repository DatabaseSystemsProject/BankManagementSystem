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

    function addOrganization($orgName,$regNo,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email)
    {
        $sql="INSERT INTO organization(org_name,reg_no,reg_date,building_name,street_name,city,district,province,zip_code,contact_no,email) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssiis",$orgName,$regNo,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

    function addStakeholder($orgRegNo,$stakeholderNIC)
    {
        $sql = "INSERT INTO org_stakeholder(org_regNo,stakeholder_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss",$orgRegNo,$stakeholderNIC);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

    


}
?>