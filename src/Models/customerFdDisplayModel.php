<?php
include_once '../Config/db.php';

class customerFdDisplayModel
{
    private $conn;
    private $details;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    public function checkFd($accountId)
    {
        $sql = "SELECT fd_account_id,fd_type_name,amount,monthly_interest,remaining_months FROM fd_account INNER JOIN fd_type ON fd_account.fd_type_id=fd_type.fd_type_id WHERE fd_account.saving_account_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountId);
        $stmt->execute();
        $result = $stmt->get_result();
        // $this->details = $result->fetch_assoc();
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $fd = array($row['fd_account_id'], $row['fd_type_name'], $row['amount'], $row['monthly_interest'], $row['remaining_months']);
                    array_push($rows, $fd);
                }
                $this->details = $rows;
                return true;
            } else {
                return false;
            }
        } else {
            echo 'Error: ' . mysqli_error($this->conn);
            return false;
        }
    }

    public function getDetails()
    {
        return $this->details;
    }
}
