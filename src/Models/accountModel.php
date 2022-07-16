<?php 
include_once "../Config/db.php";

//include_once("../Helpers/mail.php");

class AccountModel
{
    private $conn;

    //private $mailer;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();

        //$this->mailer = new Mailer();
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
    function getTotalAccounts($ownerType) // accessing a view
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
    function getAccountDetails($accountNo)
    {
        $sql = "SELECT account_no,customer_NIC,acc_type_name,owner_type_id,date_created,state,balance,branch_name FROM account,account_type,branch WHERE account_no = ? AND account.account_type_id = account_type.acc_type_id AND account.branch_id = branch.branch_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            echo "Error: " . mysqli_error($this->conn) . ".";
        }
        return $result;
    }
    function getOrgName($accountNo)
    {
        $sql = "SELECT org_name FROM org_bankaccount INNER JOIN organization ON org_bankaccount.org_regNo = organization.reg_no";
        $result = $this->conn->query($sql);
        $result = $result->fetch_assoc();
        return $result['org_name'];
    }
    //transactions
    function addIndividualAccountT($customerNIC,$accountType,$balance,$branch,$password,$savingsPlanId)
    {
        mysqli_begin_transaction($this->conn);

        try {
            $state = TRUE;

            $ownerType = 1;//personal
            $sql="INSERT INTO account(customer_NIC,account_type_id,owner_type_id,balance,branch_id,acc_password) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siidis",$customerNIC,$accountType,$ownerType,$balance,$branch,$password);
            $result = $stmt->execute();

            $accountNo = 0;

            //get last inserted ID
            if ($result === TRUE) {
                $accountNo = $this->conn->insert_id;

                //getting account type (only for personal)
                if($accountType == 1 or $accountType ==3) // savings
                {
                    $withdrawalCount = 0;
                    $sql = "INSERT INTO savings_account(savings_acc_no,saving_plan_id,withdrawal_count) VALUES (?,?,?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("iii",$accountNo,$savingsPlanId,$withdrawalCount);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                    // elseif($accountType == 3)//insert into child table
                    // {
                    //     $sql = "INSERT INTO child_saving(account_no,child_id) VALUES (?,?)";
                    //     $stmt = $this->conn->prepare($sql);
                    //     $stmt->bind_param("ii",$accountNo,$childId);
                    //     $result = $stmt->execute();

                    //     if (!$result) {
                    //         echo "Error: " . mysqli_error($this->conn) . ".";
                    //     }
                    // }
                }elseif($accountType==2)
                {
                    $sql = "INSERT INTO checking_account(checking_acc_no) VALUES (?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("i",$accountNo);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                }
            }   
            if($state)
            {
                mysqli_commit($this->conn);
                return $accountNo;
            }

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->conn);

            throw $exception;
        }
    }
    function addChildAccountT($guardianNIC,$accountType,$balance,$branch,$password,$childID,$plan)
    {
        mysqli_begin_transaction($this->conn);

        try {
            $state = TRUE;

            $ownerType = 1;//personal
            $sql="INSERT INTO account(customer_NIC,account_type_id,owner_type_id,balance,branch_id,acc_password) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siidis",$guardianNIC,$accountType,$ownerType,$balance,$branch,$password);
            $result = $stmt->execute();

            $accountNo = 0;

            //get last inserted ID
            if ($result === TRUE) {
                $accountNo = $this->conn->insert_id;
                
                $withdrawalCount = 0;
                $sql = "INSERT INTO savings_account(savings_acc_no,saving_plan_id,withdrawal_count) VALUES (?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iii",$accountNo,$plan,$withdrawalCount);
                $result = $stmt->execute();

                if (!$result) {
                    $state = FALSE;
                    echo "Error: " . mysqli_error($this->conn) . ".";
                }
                else
                {
                    $sql = "INSERT INTO child_saving(account_no,child_id) VALUES (?,?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ii",$accountNo,$childID);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                }
            }   
            if($state)
            {
                mysqli_commit($this->conn);
                return $accountNo;
            }

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->conn);

            throw $exception;
        }
    }
    function addOrgAccountT($customerNIC,$accountType,$balance,$branch,$password,$plan,$orgRegNo)
    {
        mysqli_begin_transaction($this->conn);

        try {
            $state = TRUE;

            $ownerType = 2;//organization
            $sql="INSERT INTO account(customer_NIC,account_type_id,owner_type_id,balance,branch_id,acc_password) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siidis",$customerNIC,$accountType,$ownerType,$balance,$branch,$password);
            $result = $stmt->execute();

            $accountNo = 0;

            //get last inserted ID
            if ($result === TRUE) {
                $accountNo = $this->conn->insert_id;

                //getting account type (only for personal)
                if($accountType == 1 ) // savings
                {
                    $withdrawalCount = 0;
                    $sql = "INSERT INTO savings_account(savings_acc_no,saving_plan_id,withdrawal_count) VALUES (?,?,?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("iii",$accountNo,$plan,$withdrawalCount);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                    // elseif($accountType == 3)//insert into child table
                    // {
                    //     $sql = "INSERT INTO child_saving(account_no,child_id) VALUES (?,?)";
                    //     $stmt = $this->conn->prepare($sql);
                    //     $stmt->bind_param("ii",$accountNo,$childId);
                    //     $result = $stmt->execute();

                    //     if (!$result) {
                    //         echo "Error: " . mysqli_error($this->conn) . ".";
                    //     }
                    // }
                }elseif($accountType==2)
                {
                    $sql = "INSERT INTO checking_account(checking_acc_no) VALUES (?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("i",$accountNo);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                }
                if($state)
                {
                    $sql="INSERT INTO org_bankaccount(org_regNo,account_no) VALUES (?,?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("si",$orgRegNo,$accountNo);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                }
            }   
            if($state)
            {
                mysqli_commit($this->conn);
                return $accountNo;
            }

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->conn);

            throw $exception;
        }
    }
    function isEligibleAdult($customerNIC,$account_type)
    {
        $sql = "SELECT account_no FROM account WHERE customer_NIC = ? AND account_type_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si",$customerNIC,$account_type);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if($result){
            return FALSE;
        }
        return TRUE;
    }
    function isEligibleChild($childID)
    {
        $sql = "SELECT account_no FROM child_saving WHERE child_id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$childID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if($result){
            return FALSE;
        }
        return TRUE;
    }
    function isValidAccount($accountNo)
    {
        $sql = "SELECT account_no FROM account WHERE account_no = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$accountNo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
}
?>