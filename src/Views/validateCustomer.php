<?php 
$username = null;
$username_error = null;
$password = null;
$password_error = null;
$success = null;

if(isset($_POST['registerCustomer'])){
    $username = $_POST['inputEmailAddress'];
    //$password = $_POST['password'];

    // if(empty(trim($username))){
    //     $username_error = "username cannot be empty";
    // }else{
    //     if(empty(trim($password))){
    //         $password_error = "password cannot be empty";
    //     }else{
    //         $success = "success";
    //     }
    // }
    //$email = $_POST('inputEmailAddress'); 
    if(filter_var($username, FILTER_VALIDATE_EMAIL) === false)
    {
        $username_error = "invalid format";
        //exit("invalid format");
    }
}
?>  