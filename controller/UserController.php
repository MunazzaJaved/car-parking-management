<?php
include_once '../model/UserModel.php';
include_once '../config.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new UserModel($pdo);
        session_start();  // Start session
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $contact = trim($_POST['contact']);

            if (empty($name) || empty($email) || empty($password) || empty($contact)) {
                $_SESSION['error_message'] = "Please fill in all fields";
                header('Location: ../view/guest/register.php');
                exit;
            }

            if ($this->userModel->emailExists($email)) {
                $_SESSION['error_message'] = "This email is already registered";
                header('Location: ../view/guest/register.php');
                exit;
            }

            if ($this->userModel->register($name, $email, $password, $contact)) {
                $_SESSION['success_message'] = "Registration successful. Please login.";
                header('Location: ../view/guest/login.php');
                exit;
            } else {
                $_SESSION['error_message'] = "Error registering user. Please try again.";
                header('Location: ../view/guest/register.php');
                exit;
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $_SESSION['error_message'] = "Please fill in all fields";
                header('Location: ../view/guest/login.php');
                exit;
            }

            if (!$this->userModel->emailExists($email)) {
                $_SESSION['error_message'] = "Email not found. Please register first.";
                header('Location: ../view/guest/login.php');
                exit;
            }

            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header('Location: ../view/admin/admin-dashboard.php');
                } else {
                    header('Location: ../view/customer/customer-dashboard.php');
                }
                exit;
            } else {
                $_SESSION['error_message'] = "Invalid email or password.";
                header('Location: ../view/guest/login.php');
                exit;
            }
        }
    }
}

// Handle actions
$action = $_GET['action'] ?? '';

$userController = new UserController($pdo);

switch ($action) {
    case 'register':
        $userController->register();
        break;
    case 'login':
        $userController->login();
        break;
    default:
        header('Location: ../view/guest/login.php');
        exit;
}
