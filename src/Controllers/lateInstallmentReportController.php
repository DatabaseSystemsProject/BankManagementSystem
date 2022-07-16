<?php
include_once '../Config/db.php';
include_once '../Models/lateInstallmentReportModel.php';


// $month = "February";
// $year = 2022;
// $model = new LateInstallmentModel();
// $details = $model->getOnlineLateInstallments($month, $year);

// echo $details['loan_id'];


class lateInstallmentReportController
{
    private $model;
    private $month;
    private $year;

    function __construct()
    {
        $this->model = new LateInstallmentModel();
    }

    public function getMonthAndYear()
    {
        if (isset($_POST["submit"])) {
            $this->month = $_POST['month'];
            $this->year = $_POST['year'];
            // echo $this->month;
            // echo $this->year;
        }
    }

    public function getOnlineLateLoanInstallments($branchId)
    {
        $details = $this->model->getOnlineLateInstallments($this->month, $this->year, $branchId);
        //echo $details['loan_id'];
        return $details;
    }

    public function getRegularLateLoanInstallments($branchId)
    {
        $details = $this->model->getRegularLateLoanInstallments($this->month, $this->year, $branchId);
        //echo $details['loan_id'];
        return $details;
    }

    public function getMonth()
    {
        return $this->month;
    }
    public function getYear()
    {
        return $this->year;
    }

    public function getBranchs()
    {
        // header('location:employeeDashboard.php');
        return $this->getBranchs();
    }
}
