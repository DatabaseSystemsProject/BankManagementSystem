<?php
require_once('../Core/Controller.php');
include_once("../Models/accountModel.php");
include_once("../Helpers/mail.php");
include_once("../Models/individualCustomerModel.php");
include_once("../Models/addOrganizationModel.php");

class AccountController
{
    private $accountModel;
    private $mailer;
    private $customerModel;
    private $orgModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->mailer = new Mailer();
        $this->customerModel = new IndividualCustomerModel();
        $this->orgModel = new addOrganizationModel();
    }

    public function addIndividualAccount()
    {
        if(isset($_POST["addAccount"])){
            //if(!empty($_POST["inputOrgName"]))
            $accountNo = $this->generateAccountNo(1);
            $accountType = $_POST['SOrC'];
            $customerNIC = $_POST['inputNIC'];
            $branch = $_POST['branch'];
            $plan = $_POST['plan'];
            $balance = $_POST['inputAmount'];
            $password = $this->generatePassword();

            //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

            $result = $this->accountModel->addIndividualAccount($accountNo,$customerNIC,$accountType,$balance,$branch,$password);
            if($result){
                echo "account added";
                $accountTypeToMail = "";
                if($accountType == 1){
                    $this->accountModel->addSavingsPlan($accountNo,$plan);
                    $accountTypeToMail = "Savings Account";
                }
                elseif($accountType == 2){
                    $this->accountModel->addCheckbook($accountNo);
                    $accountTypeToMail = "Checking Account";
                }
                //send email to owner 
                $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                $body = $this->mailer->generateMailBody($accountNo,$password,$accountTypeToMail);
                $receiver = $this->customerModel->getEmailAddress($customerNIC);
                $receiver = $receiver['email'];

                $this->mailer->sendMail($receiver,$subject,$body);
            }else{
                echo "error occured";
            }
    
        }
    }
    public function addChildAccount()
    {
        if(isset($_POST["addAccount"])){
            $accountNo = $this->generateAccountNo(1);
            $accountType = 3; //child savings account

            $NIC_childID = (explode("|",$_POST['inputNIC']));
            $guardianNIC = $NIC_childID[0];
            $childID = $NIC_childID[1];

            $branch = $_POST['branch'];
            $plan = $_POST['plan'];
            $balance = $_POST['inputAmount'];
            $password = $this->generatePassword();

            //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

            $result = $this->accountModel->addIndividualAccount($accountNo,$guardianNIC,$accountType,$balance,$branch,$password);
            if($result){
                echo "account added";
                $accountTypeToMail = "Child Savings Account";
                $this->accountModel->addSavingsPlan($accountNo,$plan);
                $this->accountModel->addChildSavingsAccount($accountNo,$childID);
                //send email to owner 
                $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                $body = $this->mailer->generateMailBody($accountNo,$password,$accountTypeToMail);
                $receiver = $this->customerModel->getEmailAddress($guardianNIC); // email will be sent to the guardian
                $receiver = $receiver['email'];

                $this->mailer->sendMail($receiver,$subject,$body);
            }else{
                echo "error occured";
            }
    
        }
    }
    public function addOrgAccount()
    {
        if(isset($_POST["addAccount"])){
            //if(!empty($_POST["inputOrgName"]))
            $accountNo = $this->generateAccountNo(2);
            $accountType = $_POST['SOrC'];
            $orgRegNo = $_POST['inputRegNo'];
            $customerNIC = $this->orgModel->getFirstStakeholderNIC($orgRegNo);
            $branch = $_POST['branch'];
            $plan = $_POST['plan'];
            $balance = $_POST['inputAmount'];
            $password = $this->generatePassword();

            //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

            $result = $this->accountModel->addIndividualAccount($accountNo,$customerNIC,$accountType,$balance,$branch,$password);
            if($result){
                echo "account added";
                $accountTypeToMail = "";
                if($accountType == 1){
                    $this->accountModel->addSavingsPlan($accountNo,$plan);
                    $accountTypeToMail = "Savings Account";
                }
                elseif($accountType == 2){
                    $this->accountModel->addCheckbook($accountNo);
                    $accountTypeToMail = "Checking Account";
                }
                //add to orgaccount table
                $this->accountModel->addOrgAccount($orgRegNo,$accountNo);
                //send email to owner 
                $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                $body = $this->mailer->generateMailBody($accountNo,$password,$accountTypeToMail);
                $receiver = $this->orgModel->getEmail($orgRegNo);
                $receiver = $receiver['email'];

                $this->mailer->sendMail($receiver,$subject,$body);
            }else{
                echo "error occured";
            }
    
        }
    }
    public function generateAccountNo($ownerType)
    {
        $totalAccounts = $this->accountModel->getTotalAccounts($ownerType);
        $totalAccounts = $totalAccounts['total_account_count'];
        $accountNo = 1;
        if($ownerType == 1) //personal
        {
            $accountNo = 60000 + $totalAccounts + 1; //20 million people
        }
        elseif($ownerType == 2) //business
        {
            $accountNo = 20000 + $totalAccounts + 1 ; // 1 million businesses // change this later
        }
        echo $totalAccounts."         sfd           ".$accountNo;
        return $accountNo;
    }
    public function generatePassword()
    {
        $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*";
        $password = substr(str_shuffle($string),0,8);
        return $password;
    }
}
?>