<?php 

include "../Models/viewStaffModel.php";

class StaffController
{
    private $staffModel;

    function __construct()
    {
        $this->staffModel=new StaffModel();
    }


    function getStaff()
    {
        return $this->staffModel->getStaff();
    }
}
?>