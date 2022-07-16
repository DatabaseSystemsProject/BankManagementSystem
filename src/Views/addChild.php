<?php
session_start();
include 'base.php';
require("validateCustomer.php");
include_once("../Controllers/childController.php");
include_once("../Controllers/individualCustomerController.php");

$childCtrl = new ChildController();
$guardianCtrl = new individualCustomerController();
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Child</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto bg-light">
    <h2> Add a Child </h2> <br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
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
                <label for="inputNIC">Guardian NIC</label>
                <select class="chosen" name="guardianNIC" id="guardianNIC" required>
                    <!-- <option value="************">************</option> -->
                    <?php
                    $nicList = $guardianCtrl->getNIClist();
                    if ($nicList->num_rows > 0) {
                        while ($row = $nicList->fetch_assoc()) {
                    ?><option value="<?= $row["user_NIC"]; ?>"><?= $row["user_NIC"]; ?></option><?php
                                                                                            }
                                                                                        }
                                                                                                ?>
                    <!-- <option value="198278564732">198278564732</option>
                    <option value="199978564732">199978564732</option> -->
                </select>
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
                <label for="inputDoB">Date of Birth</label>
                <input type="date" class="form-control" id="inputDoB" name="inputDoB" placeholder="Date of Birth" required>
            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-primary" id="registerChild" name="registerChild">Register</button>

    </form>
</div>

<script type="text/javascript">
    $(".chosen").chosen();

    
</script>
<?php
$childCtrl->addChild();
//validation done
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>


</html>