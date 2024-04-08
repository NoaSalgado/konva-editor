<?php

session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . '/controllers/' . $class . '.php';
});

$action = $_GET['action'] ?? 'login';
unset($_SESSION['user']);

switch ($action) {
    case "start":
        $isAuthenticated = false;
        if (isset($_SESSION['user'])) {
            $isAuthenticated = true;
        }
        echo json_encode($isAuthenticated);
        break;
    case "loadLogin":
        $authController = new AuthController();
        $authController->loadLogin();
        break;
    case "loadRegister":
        $authController = new AuthController();
        $authController->loadRegister();
        break;
    case 'loadHome':
        $homeController = new HomeController();
        $homeController->loadHome();
}
