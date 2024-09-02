<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once("controller/ControllerAuth.php");
include_once("controller/ControllerHome.php");
include_once("controller/ControllerLog.php");
include_once("controller/ControllerPermission.php");

$action = $_GET['action'] ?? 'tologin';
$method = $_SERVER['REQUEST_METHOD'];

$viewHome = new ViewHome();
$viewRegistration = new ViewRegistration();
$viewLogin = new ViewLogin();
$modelRegistration = new ModelRegistration();
$controllerAuth = new ControllerAuth();
$controllerHome = new ControllerHome();
$controllerLog = new ControllerLog();
$controllerPermission = new ControllerPermission();

switch ($action) {
    case 'toregister':
        $controllerAuth->showRegistration();
        break;
    case 'register':
        $controllerAuth->handleRegistration();
        break;
    case 'tologin':
        $controllerAuth->showLogin();
        break;
    case 'login':
        $controllerAuth->handleLogin();
        break;
    case 'home':
        if (!isset($_SESSION['id']) || $_SESSION['id'] < 0) {
            header("Location: ?action=tologin");
            exit();
        }
        $controllerHome->showUserHome($_SESSION['id']);
        break;
    case 'toaccesslog':
        if (!isset($_SESSION['id']) || $_SESSION['id'] < 0) {
            header("Location: ?action=tologin");
            exit();
        }
        $controllerHome->handleAccessLog($_SESSION['id']);
    case 'accesslog':
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $controllerLog->showLogs($search);
    case 'topermission':
        if (!isset($_SESSION['id']) || $_SESSION['id'] < 0) {
            header("Location: ?action=tologin");
            exit();
        }
        $controllerHome->handlePermission($_SESSION['id']);
    case 'permission':
        $controllerPermission->showPermission();
    default:
        break;
}