<?php 

include 'base.php';
include_once ("../Controllers/individualCustomerController.php");

$customerCtrl = new individualCustomerController();

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
<div class="container border border-2 m-5 p-5 mx-auto ">
    <h2> Add Customer </h2> <br>
    <form action="" method = "post" enctype = "multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputTitle">Title</label>
                <select id="inputTitle" name="inputTitle" class="custom-select mr-sm-2">
                    <option selected>Choose...</option>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss</option>
                    <option>Ven.</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputFirstName">First Name</label>
                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name">
            </div>
            <div class="form-group col-md-3">
                <label for="inputMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="inputMiddleName" name="inputMiddleName" placeholder="Middle Name">
            </div>
            <div class="form-group col-md-3">
                <label for="inputLastName">Last Name</label>
                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name">
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNIC">NIC</label>
                <input type="text" class="form-control" id="inputNIC" name="inputNIC" placeholder="NIC">
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
                <input type="text" class="form-control" id="inputResidence" name="inputResidence">
            </div>
            <div class="form-group col-md-4">
                <label for="inputStreetName">Street Name</label>
                <input type="text" class="form-control" id="inputStreetName" name="inputStreetName">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity">
            </div>
            <div class="form-group col-md-3">
                <label for="inputDistrict">District</label>
                <input type="text" class="form-control" id="inputDistrict" name="inputDistrict">
            </div>
            <div class="form-group col-md-3">
                <label for="inputProvince">Province</label>
                <input type="text" class="form-control" id="inputProvince" name="inputProvince">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip Code</label>
                <input type="text" class="form-control" id="inputZip" name="inputZip">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmailAddress">Email Address</label>
                <input type="text" class="form-control" id="inputEmailAddress" name="inputEmailAddress" placeholder="Email Address">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputDoB">Date of Birth</label>
                <input type="date" class="form-control" id="inputDoB" name="inputDoB" placeholder="Date of Birth">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputOccupation">Occupation</label>
                <input type="text" class="form-control" id="inputOccupation" name="inputOccupation" placeholder="Occupation">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputContactNo">Contact No.</label>
                <input type="text" class="form-control" id="inputContactNo" name="inputContactNo" placeholder="Contact No.">
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
<?php
    $customerCtrl->addCustomer();
?> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>