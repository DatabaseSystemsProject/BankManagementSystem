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

    // public function selectPlans($age)
    // {
    //     $sql = "SELECT savings_plan_id, savings_plan_name,intrest_rate,minimum_age,minimum_amount FROM savings_plan WHERE minimum_age >= ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("i", $age);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     //$result = $this->conn->query($sql);

    //     return $result;
    // }
    public function selectPlans($type)
    {
        $sql = "SELECT savings_plan_id, savings_plan_name,intrest_rate,minimum_age,minimum_amount FROM savings_plan WHERE owner_type_id= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $type);
        $stmt->execute();
        $result = $stmt->get_result();
        //$result = $this->conn->query($sql);

        return $result;
    }
    function selectPersonalPlans($age)
    {
        if(0<=$age and $age<13){
            $sql = "SELECT savings_plan_id,minimum_amount FROM savings_plan WHERE savings_plan_name = 'children'";
        }elseif(13<=$age and $age<18){
            $sql = "SELECT savings_plan_id,minimum_amount FROM savings_plan WHERE savings_plan_name = 'teen'";
        }elseif(18<=$age and $age<60){
            $sql = "SELECT savings_plan_id,minimum_amount FROM savings_plan WHERE savings_plan_name = 'adult'";
        }else{
            $sql = "SELECT savings_plan_id,minimum_amount FROM savings_plan WHERE savings_plan_name = 'senior'";
        }
        $result = $this->conn->query($sql);
        if($result){
            return $result->fetch_assoc();
        }
        return FALSE;
        
    }
}
?>