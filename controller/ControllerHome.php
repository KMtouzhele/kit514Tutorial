<?php

include_once("view/ViewHome.php");
include_once("view/ViewLogin.php");
include_once("view/ViewRegistration.php");
include_once("view/ViewLog.php");
include_once("model/ModelRegistration.php");
include_once("model/ModelLog.php");
include_once("model/ModelPermission.php");

class ControllerHome
{
    private $viewHome;
    private $modelRegistration;
    private $modelLog;
    private $modelPermission;
    private $viewRegistration;
    private $viewLog;

    public function __construct()
    {
        $this->viewHome = new ViewHome();
        $this->modelRegistration = new ModelRegistration();
        $this->modelLog = new ModelLog();
        $this->modelPermission = new ModelPermission();
        $this->viewRegistration = new ViewRegistration();
        $this->viewLog = new ViewLog();
    }

    public function showUserHome($userId)
    {
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

    public function handlePermission($user_id)
    {
        $priv = $this->modelPermission->hasPermissionPrivileges($user_id);
        if ($priv) {
            header("Location: ?action=permission");
            exit();
        } else {
            header("Location: ?action=home");
            exit();
        }
    }

    public function handleAccessLog($user_id)
    {
        $priv = $this->modelLog->hasLogPrivileges($user_id);
        if ($priv) {
            header("Location: index.php?action=accesslog");
            exit();
        } else {
            header("Location: index.php?action=home");
            exit();
        }
    }

}