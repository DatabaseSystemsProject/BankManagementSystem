<?php
require_once('../Core/Controller.php');
include_once("../Models/depositMoneyModel.php");
include_once("../Models/accountModel.php");

class DepositMoneyController
{
    private $depositMoneyModel;
    private $accountModel;

    public function __construct()
    {
        $this->depositMoneyModel = new DepositMoneyModel();
        $this->accountModel = new AccountModel();
    }
    public function depositMoney($empID)
    {
        if(isset($_POST["deposit"])){
            if(!empty($_POST['inputAccNo']) && !empty($_POST['inputAmount'])) 
            {
                $accountNo=$_POST['inputAccNo'];
                $amount=$_POST['inputAmount'];
                $remarks=$_POST['inputRemarks'];

                //validating account number
                $isExist = $this->accountModel->isValidAccount($accountNo);
                if($isExist)
                {   
                    if($amount <= 0){
                        $_SESSION['error_message'] = "Enter a positive amount";
                        echo '<script>window.location.href="../Views/depositMoneyForm.php?error=Invalidamount"</script>';
                        return;
                    }
                    else{
                        $result = $this->depositMoneyModel->depositMoney($accountNo,$amount,$remarks,$empID);
                        //return $result;
                        if($result){
                            echo '<script>window.location.href="../Views/depositSuccess.php"</script>';
                        }else{
                            echo '<script>window.location.href="../Views/depositFailed.php"</script>';
                        }
                    }
                }else{
                    $_SESSION['error_message'] = "This account does not exist!";
                    echo '<script>window.location.href="../Views/depositMoneyForm.php?error=InvalidAccount"</script>';
                    return;
                }
            }
        }
    }
}
?>