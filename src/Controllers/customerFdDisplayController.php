<?php
include_once '../Config/db.php';
include_once '../Models/customerFdDisplayModel.php';

class CustomerFdDisplayController
{
    private $model;
    private $details;
    function __construct()
    {
        $this->model = new customerFdDisplayModel();
    }

    public function getCustomerFdDetails($account_number)
    {
        $isFdAccountExist = $this->model->checkFd($account_number);
        if ($isFdAccountExist == true) {
            $this->details = $this->model->getDetails();
            return true;
        } else {
            return false;
        }
    }

    public function getDetails()
    {
        return $this->details;
    }
}
