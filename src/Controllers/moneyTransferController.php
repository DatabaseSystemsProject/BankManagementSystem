<?php
include_once '../Models/moneyTransfermodel.php';
include_once '../Config/db.php';
include_once '../Helpers/mail.php';

class moneyTransferController
{
    private $model;
    private $senderDetails;
    private $mailSender;
    private $email;

    function __construct()
    {
        $this->model = new MoneyTransferMOdel();
        $this->mailSender = new Mailer();
    }

    public function submitForm()
    {
        if (!empty($_POST["accountNumber"]) && !empty($_POST["fullName"]) && !empty($_POST["amount"])) {
            $accountNumber = $_POST["accountNumber"];
            $fullName = $_POST["fullName"];
            $this->email = $_POST["inputEmail"];
            $amount = $_POST["amount"];
            $validity = $this->model->checkID($accountNumber);
            if ($validity == true) {
                return array($accountNumber, $amount);
            } else {
                return array();
            }
        } else {
            echo "invalid data";
        }
    }

    public function updateBalance($id, $transferredAmount, $senderId)
    {
        if ($this->checkBalanceAvailability($senderId, $transferredAmount) == true) {
            if ($this->checkWithdrawalCount($senderId) == true) {
               $this->model->updateAmount($id, $transferredAmount, $senderId); 
                // $this->model->updateWithdrawalCount($senderId);
                // $this->model->updateTransactionTable($senderId, $id, $transferredAmount);
                $senderEmail = $this->model->getCustomerEmail($senderId);
                $senderEmailBody = "You have transferred Rs. " . $transferredAmount . " amount of money to account number " . $id;
                $this->mailSender->sendMail($senderEmail, "Money Transfer", $senderEmailBody);
                $receiverEmailBody = "Account Number " . $senderId . " has transferred Rs. " . $transferredAmount . " of money to your account " . $id;
                if ($this->email != null) {
                    $this->mailSender->sendMail($this->email, "Money Transfer", $receiverEmailBody);
                } else {
                    $receiverEmail = $this->model->getCustomerEmail($id);
                    $this->mailSender->sendMail($receiverEmail, "Money Transfer", $receiverEmailBody);
                }
                // header("Location: transferSuccess.php");
            } else {
                header("Location: withdrawalLimitExceeded.php");
            }
        } else {
            header("Location: insufficientBalance.php");
        }
    }

    public function checkBalanceAvailability($id, $transferredAmount)
    {
        $minimumBalance = 100;
        $this->senderDetails = $this->model->selectRowById($id);
        $availableBalance = $this->senderDetails['balance'];
        if (($availableBalance - $transferredAmount) >= $minimumBalance) {
            return true;
        } else {
            return false;
        }
    }

    public function checkWithdrawalCount($id)
    {
        $accountType = $this->senderDetails['acc_type_name'];
        if ($accountType == "checking") {
            return true;
        } else {
            $isCountRemaining = $this->model->checkWithdrawalCount($id);
            return $isCountRemaining;
        }
    }
}
