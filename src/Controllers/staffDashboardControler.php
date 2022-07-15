<?php
include "../Models/staffDashboardModel.php";

class StaffDashboardController
{
    private $dashModel;
    function __construct()
    {
        $this->dashModel = new StaffDashboardModel();
    }

    function staffDetails($login)
    {
        return $this->dashModel->getStaffContact($login);
        

    }
}

?>