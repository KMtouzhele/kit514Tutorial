<?php
class User
{
    public $id;
    public $username;
    public $roleId;
    public $driverId;
    public $description;

    public function __construct(
        $id,
        $username,
        $roleId,
        $driverId,
        $description
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->roleId = $roleId;
        $this->driverId = $driverId;
        $this->description = $description;
    }
}
