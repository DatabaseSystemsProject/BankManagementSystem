<?php 
include_once "../Config/db.php";

class AccountModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function addIndividualAccount($accountNo,$customerNIC,$accountType,$balance,$branch,$password)
    {
        $sql="INSERT INTO account(account_no,customer_NIC,account_type_id,balance,branch_id,acc_password) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isidis",$accountNo,$customerNIC,$accountType,$balance,$branch,$password);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }

    function addSavingsPlan($accountNo,$savingsPlanId)
    {
        $withdrawalCount = 0;
        $sql = "INSERT INTO savings_account(savings_acc_no,saving_plan_id,withdrawal_count) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii",$accountNo,$savingsPlanId,$withdrawalCount);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }

    function addCheckbook($accountNo)
    {
        $sql = "INSERT INTO checking_account(checking_acc_no) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$accountNo);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }
    function getTotalAccounts($ownerType)
    {
        $sql = "SELECT total_account_count FROM total_accounts WHERE owner_type = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $ownerType);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }
    function addChildSavingsAccount($accountNo,$childId)
    {
        $sql = "INSERT INTO child_saving(account_no,child_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$accountNo,$childId);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
    }
    function addOrgAccount($orgRegNo,$accountNo)
    {
        $sql="INSERT INTO org_bankaccount(org_regNo,account_no) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si",$orgRegNo,$accountNo);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }


}
?>