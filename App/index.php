<?php
session_start();

spl_autoload_register(function ($class) {
    $file =  __DIR__ . '/controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

spl_autoload_register(function ($class) {
    $file =  __DIR__ . '/models/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$authController = new AuthController();
$homeController = new HomeController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = $requestMethod === 'POST' ? $_POST['action'] : $_GET['action'];


switch ($action) {
    case "start":
        $userType = 'guest';
        if (isset($_SESSION['user'])) {
            $userType = 'auth';
        }
        echo json_encode($userType);
        break;
    case "loadLogin":
        $authController->loadLogin();
        break;
    case "loadRegister":
        $authController->loadRegister();
        break;
    case 'loadHome':
        $homeController->loadHome();
        break;
    case 'register':
        $authController->register($_POST['user']);
        break;
    case 'login':
        $authController->login($_POST['user']);
        break;
    case 'logout':
        $authController->logout();
        break;
}
