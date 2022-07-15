<?php
require_once('../Core/Controller.php');
include "../Models/AtmModel";

class AtmController extends Controller
{
    private $atmModel;

    public function __construct()
    {
        $this->atmModel = new AtmModel();
    }

    public function checkPin()
    {
        if (!empty($_POST["pinNo"])) {
            $result = $this->atmModel->getPin($_POST["pinNo"]);
            if ($result == null) {
                $_SESSION['error_message'] = "Invalid pin number";
                header("Location: ../Views/atm1.php");
            } else {
                $_SESSION["atm1direct"] = "direct from atm1";
                header("Location: ../Views/atm2.php");
            }
        } else {
            $_SESSION['error_message'] = "Pin number cannot be empty";
            header("Location: ../Views/atm1.php");
        }
    }

    public function checkCardNo()
    {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["cardNo"])) {
                $result = $this->atmModel->getCardNo($_POST["cardNo"]);
                if ($result == null) {
                    $_SESSION['error_message'] = "Invalid card number";
                    header("Location: ../Views/atm0.php");
                } else {
                    $_SESSION["account_no"] = $result["account_no"];
                    $_SESSION["atm0direct"] = "direct from atm0";
                    header("Location: ../Views/atm1.php");
                }
            } else {
                $_SESSION['error_message'] = "Card number cannot be empty";
                header("Location: ../Views/atm0.php");
            }
        }
    }

    public function checkAccount()
    {
        if (isset($_POST["checking"])) {
            $_SESSION["accountType"] = "checking";
            $result = $this->atmModel->getAccount($_SESSION["account_no"], "checking");
            if (!$result) {
                $_SESSION['error_message'] = "No checking account ";
                header("Location: ../Views/atm2.php");
            } else {
                $_SESSION["atm2direct"] = "direct from atm2";
                header("Location: ../Views/atm3.php");
            }
        } else if (isset($_POST["savings"])) {
            $_SESSION["accountType"] = "savings";
            $result = $this->atmModel->getAccount($_SESSION["account_no"], "savings");
            if (!$result) {
                $_SESSION['error_message'] = "No savings account ";
                header("Location: ../Views/atm2.php");
            } else {
                $_SESSION["atm2direct"] = "direct from atm2";
                header("Location: ../Views/atm3.php");
            }
        }
    }
    public function withdraw()
    {
        if (isset($_POST["submit"])) {
            $this->checkAccountAndWithdraw();
        }
    }
    private function checkAccountAndWithdraw()
    {
        if (!empty($_POST["amount"])) {
            if ($_SESSION["accountType"] == "savings") {
                $result = $this->atmModel->getSavingsAcc($_SESSION["account_no"]);
                if (trim($result["state"], " ") == "active") {
                    if ($result["withdrawal_count"] < 5) {
                        $newWithdrawalAmount = $result["withdrawal_count"] + 1;
                        $amount = $_POST["amount"];
                        $remainingbalance = $result["balance"] -  $amount;

                        if ($remainingbalance > 0) {

                            $res = $this->atmModel->withdrawAndUpdateBalance($_SESSION["account_no"], $newWithdrawalAmount, $remainingbalance);
                            if ($res) {
                                header("Location: ../Views/withdrawSuccessCus.php");
                            } else {
                                $_SESSION['error_message'] = "Withdrawal Failed";
                                header("Location: ../Views/atm3.php");
                            }
                        } else {
                            $_SESSION['error_message'] = "Not enough balance in the account";
                            header("Location: ../Views/atm3.php");
                        }
                    } else {
                        $_SESSION['error_message'] = "Maximum withdrawal limit is reached for the month";
                        header("Location: ../Views/atm3.php");
                    }
                } else {
                    $_SESSION['error_message'] = "Account is not active";
                    header("Location: ../Views/atm3.php");
                }
            } else if ($_SESSION["accountType"] == "checking") {
                $result = $this->atmModel->getCheckingAcc($_SESSION["account_no"]);
                if (trim($result["state"], " ") == "active") {
                    $amount = $_POST["amount"];
                    $remainingbalance = $result["balance"] -  $amount;
                    if ($remainingbalance > 0) {
                        $res = $this->atmModel->updateCheckingBalance($_SESSION["account_no"], $remainingbalance);
                        if ($res) {
                            header("Location: ../Views/withdrawSuccessCus.php");
                        } else {
                            $_SESSION['error_message'] = "Withdrawal Failed";
                            header("Location: ../Views/atm3.php");
                        }
                    } else {
                        $_SESSION['error_message'] = "Not enough balance in the account";
                        header("Location: ../Views/atm3.php");
                    }
                } else {
                    $_SESSION['error_message'] = "Account is not active";
                    header("Location: ../Views/atm3.php");
                }
            }
        } else {
            $_SESSION['error_message'] = "Please enter an amount to withdraw";
            header("Location: ../Views/atm3.php");
        }
    }
}
