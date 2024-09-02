<?php
include_once('view/ViewLog.php');
include_once('model/ModelLog.php');
class ControllerLog
{
    private $viewLog;
    private $modelLog;

    public function __construct()
    {
        $this->viewLog = new ViewLog();
        $this->modelLog = new ModelLog();
    }

    public function showLogs($search=null)
    {
        $logs = $this->modelLog->getLogs($search);
        $this->viewLog->output($logs);
    }

}