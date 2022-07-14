<?php
include_once "../Config/db.php";


class LoginModel
{
    private $conn;

    function __construct()
    {
        $connector = Connector::getInstance();
        $this->conn = $connector->getConnector();
    }

    function isCustomer($acc_no, $passwrd)
    {
        $sql = "SELECT * FROM account INNER JOIN owner_type on account.owner_type_id=owner_type.owner_type_id where account_no= ? and acc_password= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $acc_no, $passwrd);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
    function getOrganization($account)
    {
        $sql = "SELECT reg_no FROM org_account where account_no=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $account);
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

    function isStaff($user_name, $passwrd)
    {
        $sql = "SELECT * FROM staff INNER JOIN staff_type on staff.staff_type=staff_type.staff_type_id where username= ? and password= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $user_name, $passwrd);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
}
