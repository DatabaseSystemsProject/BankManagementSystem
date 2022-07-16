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
            if(!empty($_POST["inputOrgName"]) && !empty($_POST['inputRegNo']) && !empty($_POST['inputRegDate']) && !empty($_POST['inputStakeholder1']) && !empty($_POST['inputBuildingName']) && !empty($_POST['inputEmailAddress']))
            {
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

                //validating stakeholders
                if(strcmp($stakeHolder1,$stakeHolder2)==0){
                    $_SESSION['error_message'] = "Stakeholders shouldn't be the same person";
                    echo '<script>window.location.href="../Views/addOrganization.php?error=InvalidStakeholders"</script>';
                    return;
                }

                $result = $this->orgModel->addOrganization($regNo,$orgName,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email);
                $this->orgModel->addStakeholder($regNo,$stakeHolder1);
                if($stakeHolder2 != "None"){
                    $this->orgModel->addStakeholder($regNo,$stakeHolder2);
                }
                if($result){
                    echo '<script>window.location.href="../Views/customerAddSuccess.php"</script>';
                }else{
                    echo '<script>window.location.href="../Views/customerAddFailed.php"</script>';
                }
            }else{
                echo "invalid data";
            }
            
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
    public function getName($orgRegNo)
    {
        $name = $this->orgModel->getName($orgRegNo);
        return $name;
    }
}
?>