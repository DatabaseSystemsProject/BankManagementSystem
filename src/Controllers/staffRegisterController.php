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
            if(!empty($_POST["NIC"]) && !empty($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["branch"]) 
                && !empty($_POST["title"]) && !empty($_POST["first_name"]) && !empty($_POST["middle_name"]) && !empty($_POST["last_name"])
                && !empty($_POST["residence"]) && !empty($_POST["city"]) && !empty($_POST["district"]) && !empty($_POST["province"]) 
                && !empty($_POST["zip_code"]) && !empty($_POST["email"]) && !empty($_POST["dob"]) && !empty($_POST["contact_number"])
                && !empty($_POST["staff_type"])){

                $user_NIC = $_POST["NIC"];
                $password = $_POST["password"];
                $username = $_POST["username"];
                $branch_id = (int)$_POST["branch"];
                $title = $_POST["title"];
                $f_name = $_POST["first_name"];
                $m_name = $_POST["middle_name"];
                $l_name = $_POST["last_name"];
                $residence = $_POST["residence"];
                $city = $_POST["city"];
                $district = $_POST["district"];
                $province = $_POST["province"];
                $zip_code = (int)$_POST["zip_code"];
                $email = $_POST["email"];
                $dob = $_POST["dob"];
                $contact_number = $_POST["contact_number"];
                $staff_type = (int)$_POST["staff_type"];

                $this->staffRegisterModel->insert($user_NIC, $password, $username, $branch_id, $title, $f_name, $m_name, $l_name, $residence, $city, $district, $province, $zip_code, $email, $dob, $contact_number, $staff_type);
                
            }
        }
    }

    public function getBranches(){

        $result = $this->staffRegisterModel->selectBranches();

        while($row = $result->fetch_assoc()):
            $branch_name = $row['branch_name'];
            $branch_id = $row['branch_id']; ?>
            <option value="<?php echo $branch_id ?>"> <?php echo $branch_name?> </option>
        <?php    
        endwhile;
    }


}




?>