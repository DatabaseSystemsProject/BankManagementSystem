<?php
require_once('../Core/Controller.php');
include "../Models/cardModel.php";

class CardController extends Controller
{

    private $cardModel;

    public function __construct()
    {
        $this->cardModel = new CardModel();
    }

    public function validateAndCreate()
    {
        $result = $this->cardModel->checkDetails($_POST['accountNo']);
        if ($result == null) {
            $_SESSION['error_message'] = "Invalid Account Number";
            echo '<script>window.location.href="../Views/createCard.php"</script>';
            return;
        } else if ($result["customer_NIC"] != $_POST["nic"]) {
            $_SESSION['error_message'] = "NIC not registered for the account number";
            echo '<script>window.location.href="../Views/createCard.php"</script>';
            return;
        } else {
            $card = $this->cardModel->getDetails($_POST['accountNo']);
            if ($card != null) {
                $_SESSION['error_message'] = "Card already exsits";
                echo '<script>window.location.href="../Views/createCard.php"</script>';
                return;
            } else {
                $_SESSION["account_no"] = $result["account_no"];
                $this->create();
                return;
            }
        }
    }

    public function create()
    {
        $pin = mt_rand(1001, 9999);
        $res = $this->cardModel->createCard($_SESSION["account_no"], $pin);
        if ($res) {
            echo '<script>window.location.href="../Views/cardCreateDetails.php"</script>';
        } else {
            $_SESSION['error_message'] = "Card Creation Failed";
            echo '<script>window.location.href="../Views/createCard.php"</script>';
        }
    }

    public function getCardDetails($accountNo)
    {
        $result = $this->cardModel->getDetails($accountNo);
        return $result;
    }
}
