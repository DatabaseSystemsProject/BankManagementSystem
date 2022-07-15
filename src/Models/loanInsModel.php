<?php

include "../Config/db.php";

class LoanInsModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function getLoanDetails($loanID)
    {

        $sql = "SELECT * FROM loan JOIN loan_plan ON loan.loan_type = loan_plan.loan_plan_id WHERE loan_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $loanID);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function getUnpaidInstallments($loanID)
    {
        $sql = "SELECT * FROM loan_installment WHERE loan_id = ? AND paid = 0 ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $loanID);
        $stmt->execute();
        $result = $stmt->get_result();
        $unpaidArray = array();
        while ($row = $result->fetch_assoc()) {
            $monthNoYear = array("month" => $row["month"], "installment_no" => $row["installment_no"], "year" => $row["year"]);
            array_push($unpaidArray, $monthNoYear);
        }
        return $unpaidArray;
    }

    public function updateLoanLiability($loanID, $remainingLiability)
    {
        $sql = "UPDATE loan SET liability = ? WHERE loan_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $remainingLiability, $loanID);
        $stmt->execute();
        return;
    }
    public function updateInstallment($loanID, $insNo)
    {
        $sql = "UPDATE loan_installment SET paid = 1 WHERE loan_id =? AND installment_no= ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $loanID, $insNo);
        $stmt->execute();

        return;
    }
}
