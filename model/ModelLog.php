<?php
include_once("DBCon.php");
include_once("model/Log.php");

class ModelLog
{
    public function addNewLog($userId, $action)
    {
        global $mysqli;
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $stmt = $mysqli->prepare("INSERT INTO log (user_id, action, ip_address) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Failed to prepare the SQL statement: " . $mysqli->error);
        }
        $stmt->bind_param("sss", $userId, $action, $ipAddress);
        $result = $stmt->execute();
        if ($result === false) {
            echo "Error occurred while adding new log: " . $stmt->error;
            $stmt->close();
            return false;
        } else {
            $stmt->close();
            return true;
        }
    }

    public function getLogs($ipAddress = null)
    {
        global $mysqli;
        $sql = "SELECT log.id, users.username, log.action, log.timestamp, log.ip_address 
            FROM log JOIN users ON log.user_id = users.id";

        if ($ipAddress !== null) {
            $sql .= " WHERE log.ip_address LIKE ?";
            $ipAddress = "%" . $ipAddress . "%";
        }

        $sql .= " ORDER BY log.id";

        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Failed to prepare the SQL statement: " . $mysqli->error);
        }

        if ($ipAddress !== null) {
            $stmt->bind_param("s", $ipAddress);
        }

        $result = $stmt->execute();
        if ($result === false) {
            echo "Error occurred while fetching logs: " . $stmt->error;
            $stmt->close();
            return false;
        } else {
            $stmt->store_result();
            $stmt->bind_result($id, $username, $action, $timestamp, $ipAddress);
            $logs = array();
            while ($stmt->fetch()) {
                $log = new Log();
                $log->id = $id;
                $log->username = $username;
                $log->action = $action;
                $log->timestamp = $timestamp;
                $log->ipAddress = $ipAddress;
                $logs[] = $log;
            }
            $stmt->close();
            return $logs;
        }
    }


    public function hasLogPrivileges($userId)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT role_id FROM users WHERE id = ?");
        if ($stmt === false) {
            die("Failed to prepare the SQL statement: " . $mysqli->error);
        }
        $stmt->bind_param("s", $userId);
        $result = $stmt->execute();
        if ($result === false) {
            echo "Error occurred while fetching user role: " . $stmt->error;
            $stmt->close();
            return false;
        } else {
            $stmt->store_result();
            $stmt->bind_result($role_id);
            $stmt->fetch();
            $stmt->close();
            if ($role_id !== 2) {
                return true;
            } else {
                return false;
            }
        }
    }
}