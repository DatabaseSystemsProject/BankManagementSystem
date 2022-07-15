<?php
require_once('../Core/Controller.php');
include_once("../Models/individualCustomerModel.php");

class individualCustomerController
{
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = new IndividualCustomerModel();
    }

    public function addCustomer()
    {
        if(isset($_POST["registerCustomer"])){
            //if(!empty($_POST["inputOrgName"]))
            if(!empty($_POST['inputTitle']) && !empty($_POST['inputFirstName']) && !empty($_POST['inputMiddleName']) && !empty($_POST['inputLastName']) && !empty($_POST['inputNIC']) && !empty($_POST['inputResidence']) && !empty($_POST['inputStreetName']) && !empty($_POST['inputCity']) && !empty($_POST['inputDistrict']) && !empty($_POST['inputProvince']) && !empty($_POST['inputZip']) && !empty($_POST['inputContactNo']) && !empty($_POST['inputEmailAddress']) && !empty($_POST['inputDoB']))
            {
                $title=$_POST['inputTitle'];
                $fName=$_POST['inputFirstName'];
                $mName=$_POST['inputMiddleName'];
                $lName=$_POST['inputLastName'];
                $NIC=$_POST['inputNIC'];
                //$gender=$_POST['radio'];
                $residence=$_POST['inputResidence'];
                $street=$_POST['inputStreetName'];
                $city=$_POST['inputCity'];
                $district=$_POST['inputDistrict'];
                $province=$_POST['inputProvince'];
                $zipcode=$_POST['inputZip'];
                $contactNo=$_POST['inputContactNo'];
                $email=$_POST['inputEmailAddress'];
                $dob=$_POST['inputDoB'];
                //$occupation=$_POST['inputOccupation'];

                $result = $this->customerModel->addCustomer($NIC,$title,$fName,$mName,$lName,$residence,$street,$city,$district,$province,$zipcode,$email,$dob,$contactNo);
                if($result){
                    header("Location: customerAddSuccess.php");
                    //echo '<script>window.location.href="../Views/customerAddSuccess.php"</script>';
                }else{
                    header("Location: customerAddFailed.php");
                    //echo '<script>window.location.href="../Views/customerAddFailed.php"</script>';
                }
            }else{
                echo "invalid data";
            }
        }
    }
    public function getNIClist()
    {
        $nicList = $this->customerModel->getAllNIC();
        return $nicList;
    }
    public function getName($customerNIC)
    {
        $name = $this->customerModel->getName($customerNIC);
        return $name;
    }
    public function getAge($customerNIC)
    {
        $age = $this->customerModel->getAge($customerNIC);
        return $age;
    }
}
?>