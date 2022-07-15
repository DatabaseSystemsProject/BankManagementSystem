<?php
include 'base.php';
include '../Controllers/viewStaffController.php';

$staffController=new StaffController;
$account_type = "personal";
$account_no = 123;
$login = 111111111;




if (isset($_SESSION['error_message'])) {
    echo '<p style="color:red; font-size:1.2rem; align-self:center">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Staff Members</title>
</head>

<body style="background-color: rgb(0,0,205);">

    <main-header></main-header>
    <div class="container border border-2 m-5 p-5 mx-auto bg-light">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIC</th>
                    <th>Branch</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Staff member type</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php 
                $resultStaff=$staffController->getStaff();
                foreach($resultStaff as $member):?>
                <tr>
                    <td><?php echo $member['user_NIC'];?></td>
                    <td><?php echo $member['branch_name'];?></td>
                    <td><?php echo $member['f_name'].' '.$member['l_name'];?></td>
                    <td><?php echo $member['email'];?></td>
                    <td><?php echo $member['contact_number'];?></td>
                    <td><?php echo $member['staff_type_name'];?></td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>



</body>

</html>