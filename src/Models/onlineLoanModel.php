<?php
include_once "../Config/db.php";

class OnlineLoanModle
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function getFixedDepositeID($account_no)
    {
        $sql = "SELECT * FROM fd_account where saving_account_id=? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $account_no);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
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

    function getFixedDepositeData($fd_id)
    {
        $sql = "SELECT * FROM fd_account join fd_type USING(fd_type_id) where fd_account_id= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $fd_id);
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
    function getAccount($account_no)
    {
        $sql = "SELECT * FROM account INNER JOIN owner_type USING(owner_type_id) where account_no= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $account_no);
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

    function submitApplication($loan_type, $customer_NIC, $amount, $duration, $liability, $type, $tax_no, $reg_no, $fd_id, $monthly_instalment)
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
            } else {
                $id = $this->conn->insert_id;
                $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

                $start_month = date("m") + 1;
                $year = date("Y");

                for ($i = 1; $i <= $duration; $i++) {
                    $j = $i % 12;
                    $no = $j - 1 + $start_month - 1;
                    if ($no <= 11) {
                        $month = $months[$no];
                        if ($month == "January" && $i != 1) {
                            $year = $year + 1;
                        }
                    } else {
                        $month = $months[$no - 12];
                        if ($month == "January" && $i != 1) {
                            $year = $year + 1;
                        }
                    }

                    $ins_no = $i;
                    $paid = 0;

                    $sql = "INSERT INTO loan_installment(loan_id, month, year, installment_no, paid)
                            VALUES (?,?,?,?,?)";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("isiii", $id, $month, $year, $ins_no, $paid);
                    $result = $stmt->execute();

                    if (!$result) {
                        $state = FALSE;
                        echo "Error: " . mysqli_error($this->conn) . ".";
                    }
                }
            }



            // $sql2 = "SELECT loan_id FROM loan ORDER BY loan_id DESC LIMIT 1;";
            // $id = mysqli_query($this->conn, $sql2)->fetch_assoc()["loan_id"];



            $sql = "INSERT INTO online_loan (loan_id,fd_id) VALUES(?,?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $id, $fd_id);
            $result = $stmt->execute();

            if (!$result) {
                echo "Error: " . mysqli_error($this->conn) . ".";
                $state = false;
            }


            $stmt->close();
            var_dump($reg_no);
            if (!empty($reg_no)) {

                $sql = "INSERT INTO business_loan (loan_id,reg_no) VALUES(?,?);";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ii", $id, $reg_no);
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
