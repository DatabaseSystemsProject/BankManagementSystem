<?php

require_once('../Core/Controller.php');
include "../Models/approveRegularLoansModel.php";

class ApproveRegularLoansController {
    private $arl_model;

    public function __construct(){
        $this->arl_model = new ApproveRegularLoansModel();
    }


    public function getBranchID($branch_manager_NIC){
        $result = $this->arl_model->getBranch($branch_manager_NIC);
        $branch_id = $result["branch_id"];
        return $branch_id;
    }


    public function getBranchName($branch_manager_NIC){
        $result = $this->arl_model->getBranch($branch_manager_NIC);
        $branch_name = $result["branch_name"];
        return $branch_name;
    }


    public function getRequestedLoans($branch_id, $branch_manager_NIC){  
        $result = $this->arl_model->getRequestedLoans($branch_id);
        return $result;            
    }


    public function approveLoan($loan_id, $branch_manager_NIC, $duration){
        $this->arl_model->approveLoan($loan_id, $branch_manager_NIC, $duration);
    }


    public function rejectLoan($loan_id, $branch_manager_NIC){
        $this->arl_model->rejectLoan($loan_id, $branch_manager_NIC);
    }

}

?>