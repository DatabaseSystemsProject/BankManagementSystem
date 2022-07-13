<?php
include "../Models/regularLoanModel.php";

class RegularLoanController 
{
    private $loanModel;
    private $sav_acc;
    private $applicant;
    private $reg_no;


    function __construct()
    {
        $this->loanModel = new ReguarLoanModel();
    }

    
    function getLoanTypes()
    {
        $loanTypes = $this->loanModel->getLoanTypes();
        return $loanTypes;
    }

    function checkEligibility()
    {
        if (isset($_POST["check"]) ) {
            $this->sav_acc = $_POST["inputAccNo"];
            $this->applicant = $_POST["inputNIC"];
            $accountResult=$this->loanModel->getAccount($this->sav_acc);
            if($accountResult["customer_type_name"]=="organization")
            {
                $owners=$this->loanModel->getStackholder($accountResult['customer_NIC'],$this->applicant);

                if(!empty($owners))
                {
                    $this->reg_no=$accountResult['customer_NIC'];
                    return true;
                }
                else{
                    return false;
                }
            }else
            {
                if($this->applicant=$accountResult['customer_NIC'])
                {
                    return true;
                }
                else{
                    return false;
                }
            }

        }
    }

    function autoFill()
    {
        
        $array = array();

        $result = $this->loanModel->getCustomerContact($this->applicant);

        $array["full_name"] = $result["f_name"] . " " . $result["m_name"] . " " . $result["l_name"];
        $array["nic"] = $result["user_NIC"];

        $array["email"] = $result["email"];
        $array["mobile"] = $result["contact_number"];
        $array["sav_acc_no"] = $this->sav_acc;


        $resultOrg = $this->loanModel->getOgranization($this->reg_no);
        
        if (!is_null($resultOrg)) {

            $array["org_name"] = $resultOrg["org_name"];
            $array["reg_no"] = $resultOrg["reg_no"];
            
        }


        return $array;
    }

    function isOrg()
    {
        if(!is_null($this->reg_no))
        {
            return true;
        }else{
            return false;
        }
    }

    function submitAppication($login)
    {
        if (isset($_POST["apply"])) {
            if (!empty($_POST['inputLoanAmount']) && !empty($_POST['inputLoanType'])) {
                
               
                $loan_type = $_POST['inputLoanType'];
                $customer_NIC = $_POST['inputNIC'];
                $amount = $_POST["inputLoanAmount"];
                $year =$_POST["inputYear"];
                $month=$_POST["inputMonth"] ;
                $duration=$year*12+$month;
                $tax_no = $_POST['inputTaxNo'];
                $reg_no = $_POST['inputRegNo'];
                $mode = "regular";
                $liability=$amount;
                $g_full_name=$_POST['inputGuarantorFullName'];
                $g_nic=$_POST['inputGuarantorNIC'];
                $g_passport=$_POST['inputGuarantorPassNo'];
                $g_email=$_POST['inputGuarantorEmail'];
                $g_mobile=$_POST['inputGuarantorMobile'];
                $sav_acc_no=$_POST['inputAccNo'];
                $loan_status="requested";
                $req_staff_id=$login;

               $result= $this->loanModel->submitApplication($loan_type,$customer_NIC,$amount,$duration,$liability,$mode,$tax_no,$reg_no,$g_full_name,$g_nic,$g_passport,$g_email,$g_mobile,$sav_acc_no,$loan_status,$req_staff_id);
               var_dump($result);
            }else{
                echo '<script type="text/javascript">alert("You cannot apply this loan");</script>'; 
            }
        }
    }

}
?>