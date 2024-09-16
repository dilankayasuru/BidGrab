<?php
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";

class Auth extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function login()
    {
        if (isset($_SESSION["user"])) {
            header("Location: ./");
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $this->user->login($email, $password);
        }
        $this->renderView("pages/login");

    }

    public function register()
    {
        if (isset($_SESSION["user"])) {
            header("Location: ./");
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $this->user->registerUser($firstName, $lastName, $email, $password);
        }
        $this->renderView("pages/register");

    }

    public function signOut()
    {
        session_destroy();
        header("Location: login");
    }

    public function authenticate($userId)
    {
        if ($_SESSION["user"]["user_id"] !== $userId) {
            header("Location: login");
        }
    }

    public function authorize($role)
    {
        if ($_SESSION["user"]["user_role"] !== $role) {
            header("Location: login");
        }
    }
}