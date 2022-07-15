<?php

class Connector
{
    private static $instance;
    private $host;
    private $user;
    private $password;
    private $db;
    private $connec;

    private function __construct()
    {


        $connection = mysqli_connect("localhost", "root", "", "phoenix_trust_bank");


        $this->connec = $connection;
        if (!$connection) {
            echo ("connection error" . mysqli_connect_error() . "<br/>");
            die();
        }
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Connector();
        }
        return self::$instance;
    }
    public function getConnector()
    {
        return $this->connec;
    }
}
