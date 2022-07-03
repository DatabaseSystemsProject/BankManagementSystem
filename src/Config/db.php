<?php

class Connector
{
    private $conn;
    function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "phoenix_trust_bank");


        if (!$this->conn) {
            die("Connection failed: "
                . mysqli_connect_error());
        }
        echo "Connected successfully";
    }

    public function getConnector()
    {
        return $this->conn;
    }
}
