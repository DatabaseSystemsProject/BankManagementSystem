<?php
session_start();
include 'base.php';
include_once("../Controllers/addOrganizationController.php");
include_once("../Controllers/individualCustomerController.php");
session_start();

$orgCtrl = new addOrganizationController();
$individualCtrl = new individualCustomerController();
$account_type = $_SESSION['login_type'];
$login = $_SESSION['login'];
$myUrl = strval($account_type) . "Dashboard.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <script>
        function gotoDashboard() {
            var url = <?php echo (json_encode($myUrl)); ?>;
            window.location.href = url;
        }
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Organization</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2> Add Organization </h2> <br>
    <form action="" method="post" enctype="multipart/form-data">
            <?php if (isset($_SESSION['error_message'])) {
                echo '<p style="color:red; font-size:1.2rem; padding:0px;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputOrgName">Name of the Organization</label>
                <input type="text" class="form-control" id="inputOrgName" name="inputOrgName" placeholder="Organization Name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputRegNo">Registration Number</label>
                <input type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="Registration Number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputRegDate">Registered Date</label>
                <input type="date" class="form-control" id="inputRegDate" name="inputRegDate" placeholder="Registered Date" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputStakeholder1">First Stakeholder</label>
                <select class="chosen" name="inputStakeholder1" id="inputStakeholder1" required>
                    <?php
                    $nicList = $individualCtrl->getNIClist();
                    if ($nicList->num_rows > 0) {
                        while ($row = $nicList->fetch_assoc()) {
                            echo "id: " . $row["user_NIC"] .  "<br>";
                    ?><option value="<?= $row["user_NIC"]; ?>"><?= $row["user_NIC"]; ?></option><?php
                                                                                            }
                                                                                        }
                                                                                                ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="inputStakeholder2">Second Stakeholder (Optional)</label>
                <select class="chosen" name="inputStakeholder2" id="inputStakeholder2" required>
                    <option value="None">None</option>
                    <?php
                    $nicList = $individualCtrl->getNIClist();
                    if ($nicList->num_rows > 0) {
                        while ($row = $nicList->fetch_assoc()) {
                            echo "id: " . $row["user_NIC"] .  "<br>";
                    ?><option value="<?= $row["user_NIC"]; ?>"><?= $row["user_NIC"]; ?></option><?php
                                                                                            }
                                                                                        }
                                                                                                ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputBuildingName">Building Name</label>
                <input type="text" class="form-control" id="inputBuildingName" name="inputBuildingName">
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
                <input type="number" class="form-control" id="inputZip" name="inputZip">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmailAddress">Email Address</label>
                <input type="email" class="form-control" id="inputEmailAddress" name="inputEmailAddress" placeholder="Email Address">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputContactNo">Contact No.</label>
                <input type="text" class="form-control" id="inputContactNo" name="inputContactNo" placeholder="Contact No.">
            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-primary" id="registerOrg" name="registerOrg">Register</button>

    </form>
</div>

<script type="text/javascript">
    $(".chosen").chosen();

    //form validation TODO
    //check whether stakeholders are different
</script>
<?php
$orgCtrl->addOrganization();
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>