<?php
include_once("DBCon.php");

class ModelLog
{
    public function addNewLog($userId, $action)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO log (user_id, action) VALUES (?, ?)");
        if ($stmt === false) {
            die("Failed to prepare the SQL statement: " . $mysqli->error);
        }
        $stmt->bind_param("ss", $userId, $action);
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
}