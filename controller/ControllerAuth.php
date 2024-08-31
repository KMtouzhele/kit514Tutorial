<?php
include_once("view/ViewRegistration.php");
include_once("view/ViewHome.php");
include_once("view/ViewLogin.php");
include_once("model/ModelRegistration.php");
include_once("model/User.php");

class ControllerAuth
{
    private $modelRegistration;
    private $viewRegistration;
    private $viewHome;
    private $viewLogin;
    public function __construct()
    {
        $this->modelRegistration = new ModelRegistration();
        $this->viewRegistration = new ViewRegistration();
        $this->viewHome = new ViewHome();
        $this->viewLogin = new ViewLogin();
    }

    public function showRegistration($error = null)
    {
        $this->viewRegistration->output($error);
    }

    public function handleRegistration()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $verifyPassword = $_POST['verify_password'];
        $driver = $_POST['driver'];
        $description = $_POST['description'];

        if ($password !== $verifyPassword) {
            $this->showRegistration("Passwords do not match. Please try again.");
            return;
        }

        $hashedData = $this->saltPassword($password);
        $salt = $hashedData['salt'];
        $hashedPassword = $hashedData['hashedPassword'];
        $userId = $this
            ->modelRegistration
            ->registerUser(
                $username,
                $hashedPassword,
                $salt,
                $driver,
                $description
            );

        if ($userId === -1) {
            $this->showRegistration("Registration failed. Please try again.");
        } elseif ($userId === -2) {
            $this->showRegistration("Username has been used. Please try another one.");
        } else {
            $_SESSION['id'] = $userId;
            $_SESSION['logged_in'] = true;
            header("Location: /?page=home&user_id=" . urlencode($userId));
        }
    }

    public function handleLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $credential = $this->modelRegistration->getCredentialByUsername($username);
        $salt = $credential['salt'];
        $storedPassword = $credential['password'];
        $id = $credential['id'];
        if ($salt === "") {
            $this->showLogin();
            return;
        } else {
            $hashedPassword = sha1($salt . $password);
        }
        if ($hashedPassword !== $storedPassword) {
            $this->showLogin();
            return;
        } else {
            $_SESSION['id'] = $id;
            $_SESSION['logged_in'] = true;
            header('Location: /?page=home&user_id=' . urlencode($id));

        }
    }

    public function showLogin()
    {
        $this->viewLogin->output();
    }

    private function saltPassword($password)
    {
        $salt = bin2hex(random_bytes(16));
        $saltedPassword = $salt . $password;
        $hashedSaltedPassword = sha1($saltedPassword);
        return [
            'salt' => $salt,
            'hashedPassword' => $hashedSaltedPassword
        ];
    }
}