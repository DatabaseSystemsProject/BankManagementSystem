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

            $this->customerModel->addCustomer($NIC,$title,$fName,$mName,$lName,$residence,$street,$city,$district,$province,$zipcode,$email,$dob,$contactNo);
    
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
}
?>