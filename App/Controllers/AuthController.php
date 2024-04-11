<?php

class AuthController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function loadLogin()
    {
        require __DIR__ . "/../views/login.php";
    }

    public function loadRegister()
    {
        require __DIR__ . "/../views/register.php";
    }

    public function register(array $user)
    {
        if ($this->user->emailAlreadyExist($user) > 0) {
            http_response_code(400);
            echo json_encode('Email no válido');
            return;
        }
        $this->user->createUser($user);
        http_response_code(201);
        echo json_encode('Usuariio creado correctamente');
    }

    public function login(array $user)
    {
        $loginUser = $this->user->findUser($user);
        if (!$loginUser) {
            http_response_code(404);
            echo json_encode('Credenciales erróneas');
            return;
        }

        if (!$this->user->identifyUser($user)) {
            http_response_code(404);
            echo json_encode('Credenciales erróneas');
        }

        http_response_code(200);
        echo json_encode("Usuario logueado correctamente");
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}
