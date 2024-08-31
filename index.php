<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once("controller/ControllerAuth.php");
include_once("controller/ControllerHome.php");

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$method = $_SERVER['REQUEST_METHOD'];

$viewHome = new ViewHome();
$viewRegistration = new ViewRegistration();
$viewLogin = new ViewLogin();
$modelRegistration = new ModelRegistration();
$controllerAuth = new ControllerAuth();
$controllerHome = new ControllerHome();

switch ($page) {
    case ('home'):
        if ($method == 'GET' && isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
            $controllerHome->showUserHome($userId);
        } elseif ($method == 'GET') {
            $controllerAuth->showRegistration();
        } elseif ($method == 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];
            if ($action === 'Logout') {
                $controllerHome->handleLogout();
            } elseif ($action === 'Permission') {
                //TODO: implement permission logic
            } elseif ($action === 'AccessLog') {
                //TODO: implement access log logic
                echo "You have access log to this page";
            } else {
                echo "Invalid action";
            }
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Method not allowed for home page";
        }
        break;

    case ('register'):
        if ($method == 'POST') {
            $controllerAuth->handleRegistration();
        } elseif ($method == 'GET') {
            $controllerAuth->showRegistration();
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Method not allowed for register page";
        }
        break;
    case ('login'):
        if ($method == 'POST') {
            $controllerAuth->showLogin();
        } elseif ($method == 'GET') {
            $controllerAuth->showLogin();
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Method not allowed for login page";
        }
        break;
    case ('auth'):
        if ($method == 'POST') {
            $controllerAuth->handleLogin();
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Method not allowed for auth page";
        }
        break;
    default:
        $controllerAuth->showRegistration();
        break;
}