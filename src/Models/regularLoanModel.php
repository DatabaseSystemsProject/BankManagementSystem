<?php
include_once "../Config/db.php";

class ReguarLoanModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }


    function getLoanType($loan_type_name)
    {
        $sql = "SELECT * FROM loan_plan where loan_plan_name=? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $loan_type_name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getRegNo($org_account)
    {

        $sql = "SELECT * FROM org_bankaccount where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $org_account);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getCustomerContact($user_id)
    {

        $sql = "SELECT * FROM customer   where user_NIC= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getOgranization($user_id)
    {

        $sql = "SELECT * FROM organization   where reg_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getAccount($sav_acc_no)
    {
        $sql = "SELECT * FROM account INNER JOIN owner_type on account.owner_type_id=owner_type.owner_type_id where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $sav_acc_no);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getStackholder($reg_no, $applicant)
    {
        $sql = "SELECT * FROM org_stakeholder where reg_no= ? && customer_NIC=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $reg_no, $applicant);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();
        $stmt->close();
        return $result;
    }


    function submitApplication($loan_type, $customer_NIC, $amount, $duration, $liability, $type, $tax_no, $reg_no, $g_full_name, $g_nic, $g_passport, $g_email, $g_mobile, $loan_status, $req_staff_id, $savings_acc_no, $monthly_instalment)
    {
        $mysqli = $this->conn;
        $state = true;
        /* Start transaction */
        $mysqli->begin_transaction();
        try {
            $sql = "INSERT INTO loan (loan_type,customer_NIC,amount,duration,liability,	monthly_installment,type,tax_no) VALUES(?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("isdiddss", $loan_type, $customer_NIC, $amount, $duration, $liability, $monthly_instalment, $type, $tax_no);
            $result = $stmt->execute();

            if (!$result) {
                echo "Error: " . mysqli_error($this->conn) . ".";
                $state = false;
            }


            // $sql1="LOCK TABLES loan READ;";
            // $sql2="SELECT loan_id FROM loan ORDER BY loan_id DESC LIMIT 1;";
            // $sql3="UNLOCK TABLES;";
            // mysqli_query($this->conn, $sql1);
            // $id=mysqli_query($this->conn, $sql2)->fetch_assoc()["loan_id"];
            // mysqli_query($this->conn, $sql3);

            $id = $mysqli->insert_id;
            // var_dump($id);

            $sql = "INSERT INTO regular_loan (loan_id,guarantor_name,guarantor_NIC,guarantor_pass_no,guarantor_mobile,guarantor_email,loan_status,requested_staff_id,savings_acc_no) VALUES(?,?,?,?,?,?,?,?,?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("isssisssi", $id, $g_full_name, $g_nic, $g_passport, $g_mobile, $g_email, $loan_status, $req_staff_id, $savings_acc_no);
            $result = $stmt->execute();
            if (!$result) {
                echo "Error: " . mysqli_error($this->conn) . ".";
                $state = false;
            }
            $stmt->close();

            if (!empty($reg_no)) {
                // var_dump($reg_no);

                $sql = "INSERT INTO business_loan (loan_id,reg_no) VALUES(?,?);";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("is", $id, $reg_no);
                $result = $stmt->execute();

                if (!$result) {
                    echo "Error: " . mysqli_error($this->conn) . ".";
                    $state = false;
                }


                $stmt->close();
            }

            /* If code reaches this point without errors then commit the data in the database */
            if ($state) {
                $mysqli->commit();
                return $result;
            }
        } catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();

            throw $exception;
        }
    }
}
