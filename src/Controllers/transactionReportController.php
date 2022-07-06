<?php

require_once('../Core/Controller.php');
include "../Models/transactionReportModel.php";

class TransactionReportController{

    private $transactionReportModel;

    public function __construct(){
        $this->transactionReportModel = new TransactionReportModel();
    }
}

?>