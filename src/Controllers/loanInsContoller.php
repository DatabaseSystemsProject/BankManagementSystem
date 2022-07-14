<?php
require_once('../Core/Controller.php');
include "../Models/loanInsModel.php";

class LoanInsController extends Controller
{
    private $loanInsModel;

    public function __construct()
    {
        $this->loanInsModel = new LoanInsModel();
    }

    public function checkLoanID()
    {
        if (!empty($_POST["loanID"])) {
            $_SESSION["id"] = $_POST["loanID"];
            $result = $this->loanInsModel->getLoanDetails($_POST["loanID"]);
            if ($result == null) {
                $_SESSION['error_message'] = "Loan ID not found";
                echo '<script>window.location.href="../Views/loanInstallmentForm.php"</script>';
                return;
            } else {
                $_SESSION["loan_details"] = $result;
                $_SESSION["success"] = "successful";
                $this->checkUnpaidInstallments();
                return;
            }
        }
    }

    public function checkUnpaidInstallments()
    {
        $unpaidIns = $this->loanInsModel->getUnpaidInstallments($_SESSION["loan_details"]["loan_id"]);
        if ($unpaidIns == null) {
            $_SESSION["uptodate"] = "Installments are paid up to date";
        } else {
            $monthsYear = array();
            foreach ($unpaidIns as $ins) {
                $var = $ins["month"] . ' ' . $ins["year"];
                array_push($monthsYear, $var);
            }
            $_SESSION["unpaidMonthsYear"] = $monthsYear;
            $months = array();
            foreach ($monthsYear as $row) {
                $temp = explode(" ", $row);
                $tempArray = array("month" => $temp[0]);
                array_push($months, $tempArray);
            }
            $_SESSION["unpaidMonths"] = $months;
        }
        $_SESSION["installments"] = $unpaidIns;
        $this->view("loanInstallmentForm2");
    }

    public function payInstallment()
    {
        $liability = $_SESSION["loan_details"]["liability"];
        $monthlyIns = $_SESSION["loan_details"]["monthly_installment"];
        if ($liability > 0) {
            $remainingLiability = $liability - $monthlyIns;
            if ($remainingLiability >= 0) {
                $this->loanInsModel->updateLoanLiability($_SESSION["loan_details"]["loan_id"], $remainingLiability);
                $this->loanInsModel->updateInstallment($_SESSION["loan_details"]["loan_id"], $_POST["insNo"]);
                $_SESSION["Updated"] = "payment done successfully";
                echo '<script>window.location.href="../Views/instPaySuccessful.php"</script>';
            }
        }
    }
}
