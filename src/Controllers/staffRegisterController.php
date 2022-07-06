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
            if(!empty($_POST["title"]) && !empty($_POST["first_name"]) && !empty($_POST["middle_name"]) && !empty($_POST["last_name"]) 
                && !empty($_POST["dob"]) && !empty($_POST["NIC"]) && !empty($_POST["contact_number"]) && !empty($_POST["residence"]) 
                && !empty($_POST["city"]) && !empty($_POST["district"]) && !empty($_POST["province"]) && !empty($_POST["zip_code"]) 
                && !empty($_POST["staff_type"]) && !empty($_POST["branch"]) && !empty($_POST["username"]) && !empty($_POST["email"]) 
                && !empty($_POST["password"])) {

                $title = $_POST["title"];
                $first_name = $_POST["first_name"];
                $middle_name = $_POST["middle_name"];
                $last_name = $_POST["last_name"];
                $dob = $_POST["dob"];
                $NIC = $_POST["NIC"];
                $contact_number = $_POST["contact_number"];
                $residence = $_POST["residence"];
                $city = $_POST["city"];
                $district = $_POST["district"];
                $province = $_POST["province"];
                $zip_code = $_POST["zip_code"];
                $staff_type = $_POST["staff_type"];
                $branch_id = $_POST["branch"];
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $result = $this->staffRegisterModel->insert($title, $first_name, $middle_name, $last_name, $dob, $NIC, $contact_number, $residence, $city, $district, $province, $zip_code, $staff_type, $branch_id, $username, $email, $password);

                if($result === TRUE){
                    //header("Location: staffRegister.php");
                } else {
                    $_SESSION['error_message'] = "Unable to register";
                    //header("Location: staffRegister.php");
                }
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