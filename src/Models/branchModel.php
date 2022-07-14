<?php 
include_once "../Config/db.php";

class BranchModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function selectBranches(){

        $sql = "SELECT branch_id, branch_name FROM branch";
        $result = $this->conn->query($sql);

        return $result;
    }

}
?>