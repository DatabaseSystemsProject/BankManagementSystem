<?php 
include_once "../Config/db.php";

class ChildModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function addChild($guardianNIC,$fName,$mName,$lName,$gender,$dob)
    {
        $sql="INSERT INTO child(guardian_NIC,f_name,m_name,l_name,gender,dob) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss",$guardianNIC,$fName,$mName,$lName,$gender,$dob);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        else{
            
        }
    }

}
?>