<?php

class Controller
{

    public function view($path, $data = [])
    {
        if (file_exists("../Views/" . $path . ".php")) {
            include "../Views/" . $path . ".php";
        }
    }
}
