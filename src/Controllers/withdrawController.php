<?php
require_once('../Core/Controller.php');
include "../Models/withdrawModel.php";

class  WithdrawController extends Controller
{

    private $withdrawModel;

    public function __construct()
    {
        $this->withdrawModel = new WithdrawModel();
    }

    public function validateDetails()
    {
        $result = $this->withdrawModel->checkDetails($_POST['accountNo']);
        if ($result == null) {
            $_SESSION['error_message'] = "Invalid Account Number";
            echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=invalidAccount"</script>';
            return;
        } else if ($result["customer_NIC"] != $_POST["nic"]) {
            $_SESSION['error_message'] = "NIC not registered for the account number";
            echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=invalidNIC"</script>';
            return;
        } else {
            $_SESSION["account_no"] = $result["account_no"];
            $_SESSION["account_type"] = trim($result["acc_type_name"], " ");
            $this->withdraw();
            return;
        }
    }
    public function withdraw()
    {
        if ($_SESSION["account_type"] == "savings") {
            $result = $this->withdrawModel->getSavingsAcc($_SESSION["account_no"]);
            if (trim($result["state"], " ") == "active") {
                if ($result["withdrawal_count"] < 5) {
                    $newWithdrawalAmount = $result["withdrawal_count"] + 1;
                    $amount = $_POST["amount"];
                    $remainingbalance = $result["balance"] -  $amount;

                    if ($remainingbalance > 0) {
                        $this->withdrawModel->updateWithdrawalCount($_SESSION["account_no"], $newWithdrawalAmount);
                        $this->withdrawModel->updateAccountBalance($_SESSION["account_no"], $remainingbalance);
                        $employee_id = 199974401842;
                        $this->withdrawModel->updateTransactionTable($_SESSION["account_no"], $amount, $employee_id);
                        // $_SESSION["success"] = "Successfully withdrawn";
                        echo '<script>window.location.href="../Views/withdrawSuccess.php"</script>';

                        return;
                    } else {
                        $_SESSION['error_message'] = "Not enough balance in the account";
                        echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=insufficientbalance"</script>';
                        return;
                    }
                } else {
                    $_SESSION['error_message'] = "Maximum withdrawal limit is reached for the month";
                    echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=withdrawalLimit"</script>';
                    return;
                }
            } else {
                $_SESSION['error_message'] = "Account is not active";
                echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=inactive"</script>';
                return;
            }
        } else if ($_SESSION["account_type"] == "checking") {
            $result = $this->withdrawModel->getCheckingAcc($_SESSION["account_no"]);
            if (trim($result["state"], " ") == "active") {
                $amount = $_POST["amount"];
                $remainingbalance = $result["balance"] -  $amount;
                if ($remainingbalance > 0) {
                    $this->withdrawModel->updateAccountBalance($_SESSION["account_no"], $remainingbalance);
                    // $_SESSION["success"] = "Successfully withdrawn";
                    echo '<script>window.location.href="../Views/withdrawSuccess.php"</script>';
                    return;
                } else {
                    $_SESSION['error_message'] = "Not enough balance in the account";
                    echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=insufficientBalance"</script>';
                    return;
                }
            } else {
                $_SESSION['error_message'] = "Account is not active";
                echo '<script>window.location.href="../Views/withdrawMoneyForm.php?error=inactive"</script>';

                return;
            }
        }
    }
}
