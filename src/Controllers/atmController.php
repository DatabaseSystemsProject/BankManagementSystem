<?php
require_once('../Core/Controller.php');
include "../Models/AtmModel";

class AtmController extends Controller
{
    private $atmModel;

    public function __construct()
    {
        $this->atmModel = new AtmModel();
    }

    public function checkPin()
    {
        if (isset($_POST["submit"])) {
            $result = $this->atmModel->getPin($_POST["pinNo"]);
            if ($result == null) {
                $_SESSION['error_message'] = "Invalid pin number";
                header("Location: ../Views/atm1.php");
            } else {
                header("Location: ../Views/atm2.php");
            }
        }
    }
}
