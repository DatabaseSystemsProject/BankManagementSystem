<?php

require_once('../Core/Controller.php');
include "../Models/regularLoansModel.php";

class RegularLoansController {
    private $rl_model;

    public function __construct(){
        $this->rl_model = new RegularLoansModel();
    }

    public function getBranchID($branch_manager_NIC){
        $result = $this->rl_model->getBranch($branch_manager_NIC);
        $branch_id = $result["branch_id"];
        return $branch_id;
    }

    public function getBranchName($branch_manager_NIC){
        $result = $this->rl_model->getBranch($branch_manager_NIC);
        $branch_name = $result["branch_name"];
        return $branch_name;
    }



    public function getRequestedLoans($branch_id, $branch_manager_NIC){
        
        $result = $this->rl_model->getRequestedLoans($branch_id);
        
        $i = 0;

        while($row = $result->fetch_assoc()):
            $i = $i + 1 ;
            $loan_id = $row["loan_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $date_time = $row["date_time"];
            $amount = $row["amount"];
            $duration = $row["duration"];
            $liability = $row["liability"];
            $guarantor_name = $row["guarantor_name"];

            $applier_name = $first_name." ".$last_name;
            $date = substr($date_time, 0, 10);
            ?>

            <tr>
                <th scope="row"> <?php echo $i ?> </th>
                <td> <?php echo $loan_id ?> </td>
                <td> <?php echo $applier_name ?> </td>
                <td> <?php echo $date ?> </td>
                <td> Rs. <?php echo $amount ?> </td>
                <td> <?php echo $duration ?> months </td>
                <td> <?php echo $liability ?> </td>
                <td> <?php echo $guarantor_name ?> </td>
                <td>
                    <!-- <form method="post">
                        <button type="sumbit" name="approve" class="btn btn-primary"> Approve </button>
                        <button type="submit" name="reject" class="btn btn-danger"> Reject </button>
                    </form> -->

                    <a href="../Views/approveRegularLoans.php?approve_loan_id=<?php echo $loan_id?>&approve_bmID=<?php echo $branch_manager_NIC?>" class="btn btn-primary"> Approve </a>
                    <a href="../Views/approveRegularLoans.php?reject_loan_id=<?php echo $loan_id?>&reject_bmID=<?php echo $branch_manager_NIC?>" class="btn btn-danger"> Reject </a> 
                    
                </td>
            </tr>
            <?php
            
            if (isset($_GET['approve_loan_id']) && isset($_GET['approve_bmID'])) {
                $loan_id = $_GET['approve_loan_id'];
                $branch_manager_NIC = $_GET['approve_bmID'];

                $this->rl_model->approveLoan($loan_id, $branch_manager_NIC);
            }

            elseif (isset($_GET['reject_loan_id']) && isset($_GET['reject_bmID'])) {
                $loan_id = $_GET['reject_loan_id'];
                $branch_manager_NIC = $_GET['reject_bmID'];

                $this->rl_model->rejectLoan($loan_id, $branch_manager_NIC);
            }

        endwhile;
                    
    }

}

?>