<?php
require_once('../Core/Controller.php');
include_once("../Models/addOrganizationModel.php");

class addOrganizationController
{
    private $orgModel;

    public function __construct()
    {
        $this->orgModel = new addOrganizationModel();
    }

    public function addOrganization()
    {
        if(isset($_POST["registerOrg"])){
            //if(!empty($_POST["inputOrgName"]))
            $orgName = $_POST['inputOrgName'];
            $regNo = $_POST['inputRegNo'];
            $regDate = $_POST['inputRegDate'];
            $stakeHolder1 = $_POST['inputStakeholder1'];
            $stakeHolder2 = $_POST['inputStakeholder2'];
            $building = $_POST['inputBuildingName'];
            $street = $_POST['inputStreetName'];
            $city = $_POST['inputCity'];
            $district = $_POST['inputDistrict'];
            $province = $_POST['inputProvince'];
            $zipcode = $_POST['inputZip'];
            $email = $_POST['inputEmailAddress'];
            $contactNo = $_POST['inputContactNo'];

            $this->orgModel->addOrganization($regNo,$orgName,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email);
            $this->orgModel->addStakeholder($regNo,$stakeHolder1);
            $this->orgModel->addStakeholder($regNo,$stakeHolder2);
    
        }
    }
    public function getAllRegNo()
    {
        $regNoList = $this->orgModel->getAllRegNo();
        return $regNoList;
    }
    public function getStakeholders($orgRegNo)
    {
        $stakeholderList = $this->orgModel->getStakeholders($orgRegNo);
        return $stakeholderList;
    }
    public function getFirstStakeholderNIC($orgRegNo)
    {
        $stakeholder = $this->orgModel->getFirstStakeholderNIC($orgRegNo);
        return $stakeholder;
    }
    public function getEmail($orgRegNo)
    {
        $email = $this->orgModel->getEmail($orgRegNo);
        return $email;
    }
}
?>