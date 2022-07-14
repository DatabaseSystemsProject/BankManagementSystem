<?php
require_once('../Core/Controller.php');
include_once("../Models/branchModel.php");

class BranchController
{
    private $branchModel;

    public function __construct()
    {
        $this->branchModel = new BranchModel();
    }

    public function getBranches(){

        $result = $this->branchModel->selectBranches();
        $brachList = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $branch = array( $row["branch_id"],$row["branch_name"]);
                array_push($brachList,$branch);
            }
        }
       // echo $brachList;
        return $brachList;
    }
}
?>