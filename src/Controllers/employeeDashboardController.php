<?php
include_once '../Config/db.php';
include_once '../Models/employeeDashboardMOdel.php';

class employeeDashboardController
{

    private $model;
    function __construct()
    {
        $this->model = new EmployeeDashboardMOdel();
    }

    public function getEmployeeDetails($id)
    {
        $employee_details = $this->model->getEmployeeDetails($id);
        return $employee_details;
    }
}
