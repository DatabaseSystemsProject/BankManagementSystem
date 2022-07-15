<?php 

session_start();
include "base.php";
include "../Controllers/staffRegisterController.php";

$staffRegContr = new staffRegisterController();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff Member </title>

    <style>
        .container{
            background-color: white;
        }
    </style>
</head>

<body>

<main-header></main-header>
<br>
<div class="container border border-2 m-5 p-5 mx-auto ">
    <h2> Add Staff Member </h2> <br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="title">Title</label>
                <select id="title" name="title" class="custom-select mr-sm-2" required>
                    <option selected value="Mr"> Mr. </option>
                    <option value="Mrs"> Mrs. </option>
                    <option value="Miss"> Miss. </option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
            </div>
            <div class="form-group col-md-3">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" required>
            </div>
            <div class="form-group col-md-4">
                <label for="NIC"> NIC </label>
                <input type="text" class="form-control" id="NIC" name="NIC" placeholder="NIC" required>
            </div>
            <div class="form-group col-md-4">
                <label for="contact_number"> Contact Number </label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="residence"> Residence </label>
                <input type="text" class="form-control" id="residence" name="residence" placeholder="Residence" required>
            </div>
            <div class="form-group col-md-4">
                <label for="city"> City </label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="district"> District </label>
                <select id="district" name="district" class="custom-select mr-sm-2" required>
                    <option selected value="Colombo"> Colombo </option>
                    <option value="Gampaha"> Gampaha </option>
                    <option value="Kaluthara"> Kaluthara </option>
                    <option value="Kandy"> Kandy </option>
                    <option value="Mathale"> Mathale </option>
                    <option value="Nuwara Eliya"> Nuwara Eliya </option>
                    <option value="Kurunegala"> Kurunegala </option>
                    <option value="Puttalam"> Puttalam </option>
                    <option value="Galle"> Galle </option>
                    <option value="Matara"> Matara </option>
                    <option value="Hambanthota"> Hambanthota </option>
                    <option value="Ratnapura"> Ratnapura </option>
                    <option value="Kegalle"> Kegalle </option>
                    <option value="Anuradhapura"> ANuradhapura </option>
                    <option value="Polonnaruwa"> Polonnaruwa </option>
                    <option value="Badulla"> Badulla </option>
                    <option value="Moneragala"> Moneragala </option>
                    <option value="Trincomalee"> Trincomalee </option>
                    <option value="Batticalao"> Batticalao </option>
                    <option value="Ampara"> Ampara </option>
                    <option value="Jaffna"> Jaffna </option>
                    <option value="Kilinochchi"> Kilinochchi </option>
                    <option value="Mannar"> Mannar </option>
                    <option value="Vavuniya"> Vavuniya </option>
                    <option value="Mullaitivu"> Mullaitivu </option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="province"> Province </label>
                <select id="province" name="province" class="custom-select mr-sm-2" required>
                    <option selected value="Western"> Western </option>
                    <option value="Central"> Central </option>
                    <option value="North Western"> North Western </option>
                    <option value="Southern"> Southern </option>
                    <option value="Sabaragamuwa"> Sabaragamuwa </option>
                    <option value="North Central"> North Central </option>
                    <option value="Eastern"> Eastern </option>
                    <option value="Uva"> Uva </option>
                    <option value="Nothern"> Nothern </option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="zip_code"> Zip Code </label>
                <input type="number" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputStaffType"> Type </label>
                <select id="staff_type" class="custom-select mr-sm-2" name="staff_type" required>
                    <option selected value="2"> Branch Manager </option>
                    <option value="1"> Employee </option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="branch">Branch</label>
                <select id="branch" class="custom-select mr-sm-2" name="branch" required>
                    <?php $staffRegContr->getBranches(); ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username"> Username </label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email"> Email </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group col-md-6">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
        </div>
         
        <br>
        <button type="submit" name="register" class="btn btn-primary" onclick="return Validate()"> Register </button>

    </form>

    <?php  $staffRegContr->registerStaffMember(); ?>

</div>


<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if(password.length<8) {  
            //document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters"; 
            alert("Passowrd should be atleast 8 characters"); 
            return false;  
        } 
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
        }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>