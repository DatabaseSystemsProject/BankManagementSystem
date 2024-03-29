<?php
require_once('../Core/Controller.php');
include_once("../Models/accountModel.php");
include_once("../Helpers/mail.php");
include_once("../Models/individualCustomerModel.php");
include_once("../Models/addOrganizationModel.php");
include_once("../Models/savingsPlanModel.php");
include_once("../Models/childModel.php");

class AccountController
{
    private $accountModel;
    private $mailer;
    private $customerModel;
    private $orgModel;
    private $savingsPlanModel;
    private $childModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->mailer = new Mailer();
        $this->customerModel = new IndividualCustomerModel();
        $this->orgModel = new addOrganizationModel();
        $this->savingsPlanModel = new SavingsPlanModel();
        $this->childModel = new ChildModel();
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
    public function getAccountDetails($accountNo)
    {
        $details =$this->accountModel->getAccountDetails($accountNo);
        return $details;
    }
    //transactions
    public function addIndividualAccountT()
    {
        if(isset($_POST["addAccount"])){
            if(!empty($_POST['SOrC']) && !empty($_POST['inputNIC']) && $_POST['branch'])
            {
                //$accountNo = $this->generateAccountNo(1);
                $accountType = $_POST['SOrC'];
                $customerNIC = $_POST['inputNIC'];
                $branch = $_POST['branch'];
                $plan = 0;
                $balance = $_POST['inputAmount'];
                //check eligibility
                $isEligible = $this->accountModel->isEligibleAdult($customerNIC,$accountType);
                if(!$isEligible){
                    $replyType = "Checking Account";
                    if($accountType == 1){
                        $replyType = "Savings Account";
                    }
                    //echo "You already have a ".$replyType." account in our Bank.";
                    $_SESSION['error_message'] = "You already have a ".$replyType." account in our Bank.";
                    echo '<script>window.location.href="../Views/addIndividualAccount.php?error=accountExists"</script>';
                    return;
                    
                }

                if($accountType == 1){
                    $plan = $_POST['plan'];

                    //validate for plan
                    $age = $this->customerModel->getAge($customerNIC);
                    $suitablePlan = $this->savingsPlanModel->selectPersonalPlans($age);
                    $suitablePlanID = $suitablePlan['savings_plan_id'];
                    $minamount = $suitablePlan['minimum_amount'];
                    if($suitablePlanID != $plan){
                        // echo "You are not eligible for this plan";
                        // return;
                        $_SESSION['error_message'] = "You are not eligible for this savings plan";
                        echo '<script>window.location.href="../Views/addIndividualAccount.php?error=accountExists"</script>';
                        return;
                    }elseif($minamount > $balance){
                        // echo "Minimum Initial Deposit for this savings plan is ".$minamount." Rs/=";
                        // return;
                        $_SESSION['error_message'] = "Minimum Initial Deposit for this savings plan is ".$minamount." Rs/=";
                        echo '<script>window.location.href="../Views/addIndividualAccount.php?error=InvalidMinBalance"</script>';
                        return;
                    }
                }
                $password = $this->generatePassword();

                //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

                $result = $this->accountModel->addIndividualAccountT($customerNIC,$accountType,$balance,$branch,$password,$plan);
                if($result){
                    //echo "account added";
                    $accountTypeToMail = "";
                    if($accountType == 1){
                        //$this->accountModel->addSavingsPlan($accountNo,$plan);
                        $accountTypeToMail = "Savings Account";
                    }
                    elseif($accountType == 2){
                        //$this->accountModel->addCheckbook($accountNo);
                        $accountTypeToMail = "Checking Account";
                    }
                    //send email to owner 
                    $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                    $body = $this->mailer->generateMailBody($result,$password,$accountTypeToMail);
                    $receiver = $this->customerModel->getEmailAddress($customerNIC);
                    $receiver = $receiver['email'];

                    $this->mailer->sendMail($receiver,$subject,$body);
                    echo '<script>window.location.href="../Views/accountAddSuccess.php"</script>';
                }else{
                    echo '<script>window.location.href="../Views/accountAddFailed.php?"</script>';
                }
            }
        }
    }
    public function addChildAccountT()
    {
        if(isset($_POST["addAccount"])){
            if(!empty($_POST['inputNIC']) && !empty($_POST['branch']) && !empty($_POST['plan'])){
                //$accountNo = $this->generateAccountNo(1);
                $accountType = 3; //child savings account

                $NIC_childID = (explode("|",$_POST['inputNIC']));
                $guardianNIC = $NIC_childID[0];
                $childID = $NIC_childID[1];

                $branch = $_POST['branch'];
                $plan = $_POST['plan'];
                $balance = $_POST['inputAmount'];
                $password = $this->generatePassword();
                //check eligibility
                $isEligible = $this->accountModel->isEligibleChild($childID);
                if(!$isEligible){
                    //echo "You already have a child savings account in our bank";
                    //echo '<script type="text/javascript">alert("You already have a child savings account in our bank");</script>';
                    $_SESSION['error_message'] = "You already have a child savings account in our bank";
                    echo '<script>window.location.href="../Views/addChildAccount.php?error=invalidAccount"</script>';
                    return;
                    //return;
                }

                //validate for plan
                    $age = $this->childModel->getAge($childID);
                    $suitablePlan = $this->savingsPlanModel->selectPersonalPlans($age);
                    $suitablePlanID = $suitablePlan['savings_plan_id'];
                    $minamount = $suitablePlan['minimum_amount'];
                    if($suitablePlanID != $plan){
                        // echo "You are not eligible for this plan";
                        // return;
                        $_SESSION['error_message'] = "You are not eligible for this savings plan";
                        echo '<script>window.location.href="../Views/addChildAccount.php?error=invalidSavingsPlan"</script>';
                        return;
                    }elseif($minamount > $balance){
                        // echo "Minimum Initial Deposit for this savings plan is ".$minamount." Rs/=";
                        // return;
                        $_SESSION['error_message'] = "Minimum Initial Deposit for this savings plan is ".$minamount." Rs/=";
                        echo '<script>window.location.href="../Views/addChildAccount.php?error=invalidMinBalance"</script>';
                        return;
                    }

                //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

                $result = $this->accountModel->addChildAccountT($guardianNIC,$accountType,$balance,$branch,$password,$childID,$plan);
                if($result){
                    echo "account added";
                    $accountTypeToMail = "Child Savings Account";
                    //$this->accountModel->addSavingsPlan($accountNo,$plan);
                    //$this->accountModel->addChildSavingsAccount($accountNo,$childID);
                    //send email to owner 
                    $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                    $body = $this->mailer->generateMailBody($result,$password,$accountTypeToMail);
                    $receiver = $this->customerModel->getEmailAddress($guardianNIC); // email will be sent to the guardian
                    $receiver = $receiver['email'];

                    $this->mailer->sendMail($receiver,$subject,$body);
                    echo '<script>window.location.href="../Views/accountAddSuccess.php"</script>';
                }else{
                    echo '<script>window.location.href="../Views/accountAddFailed.php?"</script>';
                }
            }
    
        }
    }
    public function addOrgAccountT()
    {
        if(isset($_POST["addAccount"])){
            //if(!empty($_POST["inputOrgName"]))
            //$accountNo = $this->generateAccountNo(2);
            $accountType = $_POST['SOrC'];
            $orgRegNo = $_POST['inputRegNo'];
            $customerNIC = $this->orgModel->getFirstStakeholderNIC($orgRegNo);
            $branch = $_POST['branch'];
            $plan = 0;
            if($accountType == 1)
            {
                $plan = $_POST['plan'];
                //$plan = 5;
            }
            $balance = $_POST['inputAmount'];
            $password = $this->generatePassword();

            //echo $accountNo." - ".$accountType." - ".$customerNIC." - ".$branch." - ".$plan." - ".$balance." - ".$password." ";

            $result = $this->accountModel->addOrgAccountT($customerNIC,$accountType,$balance,$branch,$password,$plan,$orgRegNo);
            if($result){
                //echo "account added";
                $accountTypeToMail = "";
                if($accountType == 1){
                    //$this->accountModel->addSavingsPlan($accountNo,$plan);
                    $accountTypeToMail = "Organization Savings Account";
                }
                elseif($accountType == 2){
                    //$this->accountModel->addCheckbook($accountNo);
                    $accountTypeToMail = "Organization Checking Account";
                }
                //add to orgaccount table
                //$this->accountModel->addOrgAccount($orgRegNo,$accountNo);
                //send email to owner 
                $subject = $this->mailer->generateMailSubject($accountTypeToMail);
                $body = $this->mailer->generateMailBody($result,$password,$accountTypeToMail);
                $receiver = $this->orgModel->getEmail($orgRegNo);
                $receiver = $receiver['email'];

                $this->mailer->sendMail($receiver,$subject,$body);
                echo '<script>window.location.href="../Views/accountAddSuccess.php"</script>';
            }else{
                echo '<script>window.location.href="../Views/accountAddFailed.php?"</script>';
            }
    
        }
    }
    public function getOrgName($accountNo){
        $result = $this->accountModel->getOrgName($accountNo);
        return $result;
    }

}
?>