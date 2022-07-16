<?php
require_once('../Core/Controller.php');
include_once("../Models/childModel.php");

class ChildController
{
    private $childModel;

    public function __construct()
    {
        $this->childModel = new ChildModel();
    }

    public function addChild()
    {
        if(isset($_POST["registerChild"])){
            if(!empty($_POST['inputFirstName']) && !empty($_POST['inputLastName']) && !empty($_POST['guardianNIC']) && !empty($_POST['radio']) && !empty($_POST['inputDoB']))
            {
                //$title=$_POST['inputTitle'];
                $fName=$_POST['inputFirstName'];
                $mName=$_POST['inputMiddleName'];
                $lName=$_POST['inputLastName'];
                $guardianNIC=$_POST['guardianNIC'];
                $gender=$_POST['radio'];
                $dob=$_POST['inputDoB'];
                //$occupation=$_POST['inputOccupation'];

                $result = $this->childModel->addChild($guardianNIC,$fName,$mName,$lName,$gender,$dob);
                if($result){
                    //header("Location: customerAddSuccess.php");
                    echo '<script>window.location.href="../Views/customerAddSuccess.php"</script>';
                }else{
                    //header("Location: customerAddFailed.php");
                    echo '<script>window.location.href="../Views/customerAddFailed.php"</script>';
                }
            }else{
                echo "invalid data";
            }
        }
    
    }
    public function getChildList()
    {
        $childList = $this->childModel->getChildList();
        return $childList;
    }
    public function getAge($childID)
    {
        $age = $this->childModel->getAge($childID);
        return $age;
    }
}
?>