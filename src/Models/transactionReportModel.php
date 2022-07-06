<?php

include_once '../Config/db.php';

class TransactionReportModel{

    private $conn;

    function __construct() {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }


    
}

?>