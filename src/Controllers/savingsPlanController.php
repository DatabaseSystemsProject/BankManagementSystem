<?php
require_once('../Core/Controller.php');
include_once("../Models/savingsPlanModel.php");

class SavingsPlanController
{
    private $savingsPlanModel;

    public function __construct()
    {
        $this->savingsPlanModel = new SavingsPlanModel();
    }

    public function getsavingsPlans($age)
    {

        $result = $this->savingsPlanModel->selectPlans($age);
        $planList = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $plan = array( $row["savings_plan_id"],$row["savings_plan_name"],$row["intrest_rate"],$row["minimum_age"],$row["minimum_amount"]);
                array_push($planList,$plan);
            }
        }
       // echo $planList;
        return $planList;
    }
}
?>