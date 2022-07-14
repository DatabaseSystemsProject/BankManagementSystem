<?php 
include_once "../Config/db.php";

class SavingsPlanModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function selectPlans($age)
    {
        $sql = "SELECT savings_plan_id, savings_plan_name,intrest_rate,minimum_age,minimum_amount FROM savings_plan WHERE minimum_age >= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $age);
        $stmt->execute();
        $result = $stmt->get_result();
        //$result = $this->conn->query($sql);

        return $result;
    }

}
?>