<?php
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";

class Auth extends Controller
{
    private $user;

    // Constructor to initialize the User model
    public function __construct()
    {
        $this->user = new User();
    }

    // Handle user login
    public function login()
    {
        // Redirect to home if user is already logged in
        if (isset($_SESSION["user"])) {
            header("Location: ./");
            return;
        }

        // Process login form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Call the login method of the User model
            $response = $this->user->login($email, $password);
        }

        // Render the login view
        $this->renderView("pages/login", ["error" => $response ?? '']);
    }

    // Handle user registration
    public function register()
    {
        // Redirect to home if user is already logged in
        if (isset($_SESSION["user"])) {
            header("Location: ./");
            return;
        }

        // Process registration form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $confirmPassword = $_POST["confirmPassword"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
                $error = 'Enter valid email';
            }
            if (empty($firstName) || empty($lastName)) {
                $error = 'Please enter your first name and last name';
            }
            if (!password_verify($confirmPassword, $password)) {
                $error = 'Please verify your password';
            }
            if (!isset($error)) {
                // Call the registerUser method of the User model
                $response = $this->user->registerUser($firstName, $lastName, $email, $password);
            }
        }
        // Render the registration view
        $this->renderView("pages/register", ["error" => $error ?? $response ?? '']);
    }

    // Handle user sign out
    public function signOut()
    {
        // Destroy the session and redirect to login page
        session_destroy();
        header("Location: login");
    }

    // Authenticate the user by user ID
    public function authenticate($userId)
    {
        // Redirect to login if the user ID does not match
        if ($_SESSION["user"]["user_id"] !== $userId) {
            header("Location: login");
        }
    }

    // Authorize the user by role
    public function authorize($role)
    {
        // Redirect to login if the user role does not match
        if ($_SESSION["user"]["user_role"] !== $role) {
            header("Location: login");
        }
    }
}