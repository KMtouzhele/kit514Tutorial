<?php

include_once('model/ModelPermission.php');
include_once('view/ViewPermission.php');

class ControllerPermission
{
    private $modelPermission;
    private $viewPermission;

    public function __construct()
    {
        $this->modelPermission = new ModelPermission();
        $this->viewPermission = new ViewPermission();
    }

    public function showPermission()
    {
        $permissions = $this->modelPermission->getAllPermissions();
        $this->viewPermission->output($permissions);
    }
}