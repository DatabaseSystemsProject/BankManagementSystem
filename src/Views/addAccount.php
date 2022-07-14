<?php include 'base.php' ?>
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
    <title>Add Account</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="container border border-2 m-5 p-5 mx-auto ">
    <h2> Add Account - meka wedak na wge </h2> <br>
    <form>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Account Type</legend>

                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Savings" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Savings
                    </label>
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Checking">
                    <label class="form-check-label" for="gridRadios2">
                        Checking
                    </label>
                </div>
            </div>

        </fieldset>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputRegNo">Registration Number</label>
                <input type="text" class="form-control" id="inputRegNo" placeholder="RegNo">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputBranch">Branch</label>
                <input type="text" class="form-control" id="inputBranch" placeholder="Branch">
            </div>
        </div>
        <div>
            <label for="cars">Select a savings plan:</label>
                <select id="cars">
                    <option value="Plan 1">Plan 1</option>
                    <option value="Plan 2">Plan 2</option>
                    <option value="Plan 3">Plan 3</option>
                    <option value="Plan 4">Plan 4</option>
                </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Register</button>

    </form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>