<?php
session_start();

include "../Config/db.php";

include "../Models/addOrganizationModel.php";

include "../Controllers/addOrganizationController.php";
include "../Views/addOrganization.php";

if (isset($_POST['registerOrg'])) {
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
    
    $addOrg_contr = new addOrganizationController();


    $addOrg_contr->addOrganization($orgName,$regNo,$regDate,$building,$street,$city,$district,$province,$zipcode,$contactNo,$email);

    header("Location: ../orderNow.php");

}