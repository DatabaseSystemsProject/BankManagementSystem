<?php

require_once('../Core/Controller.php');
include "../Models/staffRegisterModel.php";

class staffRegisterController{

    private $staffRegisterModel;

    public function __construct()
    {
        $this->staffRegisterModel = new staffRegisterModel();
    }

    public function registerStaffMember(){
        if (isset($_POST["register"])) {
            if(!empty($_POST["title"]) && !empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["username"]) 
                && !empty($_POST["nic"]) && !empty($_POST["staff_type"]) && !empty($_POST["branch"]) && !empty($_POST["password"])) {

                $title = $_POST["title"];
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $username = $_POST["username"];
                $nic = $_POST["nic"];
                $staff_type = $_POST["staff_type"];
                $branch = $_POST["branch"];
                $password = $_POST["password"];
                $encrypted_password = md5($password);

                $result = $this->staffRegisterModel->insert($title, $first_name, $last_name, $username, $nic, $staff_type, $branch, $encrypted_password);

                if($result === TRUE){
                    //header("Location: staffRegister.php");
                } else {
                    $_SESSION['error_message'] = "Unable to register";
                    //header("Location: staffRegister.php");
                }
            }
        }
    }


}




?>