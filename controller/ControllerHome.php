<?php

include_once("view/ViewHome.php");
include_once("view/ViewLogin.php");
include_once("view/ViewRegistration.php");
include_once("model/ModelRegistration.php");

class ControllerHome
{
    private $viewHome;
    private $modelRegistration;
    private $viewRegistration;

    public function __construct()
    {
        $this->viewHome = new ViewHome();
        $this->modelRegistration = new ModelRegistration();
        $this->viewRegistration = new ViewRegistration();
    }

    public function showUserHome($userId)
    {
        echo "this is home page";
        $user = $this->modelRegistration->getUserById($userId);
        $buttons = $this->assignButtonsOnRole($user->roleId);
        $this->viewHome->output($user, $buttons);
    }

    private function assignButtonsOnRole($roleId)
    {
        if ($roleId === 1) {
            return ['Logout', 'Permission', 'AccessLog'];
        } elseif ($roleId === 2) {
            return ['Logout'];
        } elseif ($roleId === 3) {
            return ['Logout', 'AccessLog'];
        } else {
            return ['ERROR'];
        }
    }

    public function handleLogout()
    {
        session_destroy();
        header("Location: /?page=login");
        exit();
    }

    public function showPermission()
    {
        echo "You have permission to access this page";
    }

}