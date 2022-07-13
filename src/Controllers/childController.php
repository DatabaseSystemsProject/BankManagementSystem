<?php
require_once('../Core/Controller.php');
include_once("../Models/childModel.php");

class ChildController
{
    private $childModel;

    public function __construct()
    {
        $this->childModel = new ChildModel();
    }

    public function addChild()
    {
        if(isset($_POST["registerChild"])){
            //if(!empty($_POST["inputOrgName"]))
            //$title=$_POST['inputTitle'];
            $fName=$_POST['inputFirstName'];
            $mName=$_POST['inputMiddleName'];
            $lName=$_POST['inputLastName'];
            $guardianNIC=$_POST['guardianNIC'];
            $gender=$_POST['radio'];
            $dob=$_POST['inputDoB'];
            //$occupation=$_POST['inputOccupation'];

            $this->childModel->addChild($guardianNIC,$fName,$mName,$lName,$gender,$dob);
    
        }
    }
    public function getChildList()
    {
        $childList = $this->childModel->getChildList();
        return $childList;
    }
}
?>