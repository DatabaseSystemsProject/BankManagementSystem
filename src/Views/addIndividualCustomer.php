<?php

include 'base.php';
include_once ("../Controllers/individualCustomerController.php");

$customerCtrl = new individualCustomerController();

if(isset($_POST["registerCustomer"])){
    $customerCtrl->addCustomer();
}

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
    <title>Add Customer</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2> Add Customer </h2> <br>
    <form action="" method = "post" enctype = "multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputTitle">Title</label>
                <select id="inputTitle" name="inputTitle" class="custom-select mr-sm-2" required>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss</option>
                    <option>Ven.</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputFirstName">First Name</label>
                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="inputMiddleName" name="inputMiddleName" placeholder="Middle Name" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputLastName">Last Name</label>
                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name" required>
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNIC">NIC</label>
                <input type="text" class="form-control" id="inputNIC" name="inputNIC" placeholder="NIC" required>
            </div>
        </div>
        <br>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>

                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="radio" id="radio" value="Female" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Female
                    </label>
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="radio" id="radio" value="Male">
                    <label class="form-check-label" for="gridRadios2">
                        Male
                    </label>
                </div>
            </div>

        </fieldset>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputResidence">Residence</label>
                <input type="text" class="form-control" id="inputResidence" name="inputResidence" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputStreetName">Street Name</label>
                <input type="text" class="form-control" id="inputStreetName" name="inputStreetName"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity"  required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputDistrict">District</label>
                <!-- <input type="text" class="form-control" id="inputDistrict" name="inputDistrict"  required> -->
                <select id="inputDistrict" name="inputDistrict" class="custom-select mr-sm-2" required>
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
                    <option value="Anuradhapura"> Anuradhapura </option>
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
            <div class="form-group col-md-3">
                <label for="inputProvince">Province</label>
                <!-- <input type="text" class="form-control" id="inputProvince" name="inputProvince"  required> -->
                <select id="inputProvince" name="inputProvince" class="custom-select mr-sm-2" required>
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
            <div class="form-group col-md-2">
                <label for="inputZip">Zip Code</label>
                <input type="number" class="form-control" id="inputZip" name="inputZip"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmailAddress">Email Address</label>
                <input type="email" class="form-control" id="inputEmailAddress" name="inputEmailAddress" placeholder="Email Address"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputDoB">Date of Birth</label>
                <input type="date" class="form-control" id="inputDoB" name="inputDoB" placeholder="Date of Birth" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputOccupation">Occupation</label>
                <input type="text" class="form-control" id="inputOccupation" name="inputOccupation" placeholder="Occupation" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputContactNo">Contact No.</label>
                <input type="text" class="form-control" id="inputContactNo" name="inputContactNo" placeholder="Contact No." required>
            </div>
        </div>
         
        <br>
        <button type="submit" class="btn btn-primary" id="registerCustomer" name="registerCustomer">Register</button>

    </form>
</div>

<script type="text/javascript">
    //form validation TODO
    //test if an adult
    //test email , tp, and nic
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>