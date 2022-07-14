<?php 

require_once('../Core/Controller.php');
include "../Models/bmDashboardModel.php";


class bmDashboardController{

    private $bmDashboardModel;

    public function __construct(){
        $this->bmDashboardModel = new bmDashboardModel();
    }


    public function getFirstName($branch_manager_NIC){
        $result = $this->bmDashboardModel->getBMDetails($branch_manager_NIC);
        $first_name = $result["first_name"];
        return $first_name;
    }


    public function getLastName($branch_manager_NIC){
        $result = $this->bmDashboardModel->getBMDetails($branch_manager_NIC);
        $last_name = $result["last_name"];
        return $last_name;
    }


    public function getBranchName($branch_manager_NIC){
        $result = $this->bmDashboardModel->getBMDetails($branch_manager_NIC);
        $branch_name = $result["branch_name"];
        return $branch_name;
    }
}

?>