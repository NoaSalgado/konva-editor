<?php

class AuthController
{
    public function loadLogin()
    {
        require __DIR__ . "/../views/login.php";
    }

    public function loadRegister()
    {
        require __DIR__ . "/../views/register.php";
    }
}
