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
        // $sql = "SELECT * FROM loan_installment WHERE loan_id = ? AND paid = 0 ";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("i", $loanID);
        // $stmt->execute();
        // $result1 = $stmt->get_result();
        // $unpaidArray = array();
        // while ($row = $result1->fetch_assoc()) {
        //     $monthNoYear = array("month" => $row["month"], "installment_no" => $row["installment_no"], "year" => $row["year"]);
        //     array_push($unpaidArray, $monthNoYear);
        // }

        $month = date('F');
        $year = (int)date('Y');

        $sql2 = "SELECT installment_no FROM loan_installment WHERE loan_id = ? AND month = ? AND year = ?";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("isi", $loanID, $month, $year);
        $stmt2->execute();
        $result2 = $stmt2->get_result()->fetch_assoc();
        if ($result2 == null) {
            return null;
        }
        $currentInsNo = $result2["installment_no"];

        $sql3 = "SELECT * FROM loan_installment WHERE loan_id = ? AND paid = 0 AND installment_no <= '$currentInsNo'";
        $stmt3 = $this->conn->prepare($sql3);
        $stmt3->bind_param("i", $loanID);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        $unpaidArray = array();
        while ($row = $result3->fetch_assoc()) {
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
