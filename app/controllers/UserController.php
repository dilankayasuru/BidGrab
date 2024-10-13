<?php
require_once "../app/core/Controller.php";

class UserController extends Controller
{
    // Method to change user profile
    public function changeProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userModel = $this->loadModel("User");
            $userModel->changeProfile();
        }
    }

    // Method to reset user password
    public function resetPassword()
    {
        $currentPassword = $_POST["currentPassword"];
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        $userModel = $this->loadModel("User");
        $userModel->resetPassword($currentPassword, $newPassword, $confirmPassword);
    }

    // Method to display user profile
    public function profile($error = '')
    {
        // Redirect to login if user is not logged in
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        // Render the appropriate dashboard view based on user role
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "profile", "error" => $error]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "profile", "error" => $error]);
        }
    }

    // Method to get all users with optional filter and sort parameters
    public function getAllUsers($filter = "all", $sort = "default")
    {
        // Redirect to login if user is not logged in or not an admin
        if (!isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] !== "admin") {
            header("Location: login");
            return;
        }
        $userModel = $this->loadModel("User");
        $users = $userModel->getAllUsers($filter, $sort);
        $this->renderView("pages/adminDashboard", ["tab" => "users", "filter" => $filter, "sort" => $sort, "users" => $users]);
    }

    // Method to activate a user by ID
    public function activate($id)
    {
        $userModel = $this->loadModel('User');
        $userModel->changeStatus($id, "active");
    }

    // Method to deactivate a user by ID
    public function deactivate($id)
    {
        $userModel = $this->loadModel('User');
        $userModel->changeStatus($id, "deactive");
    }

    // Method to add a new user
    public function addNew()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST["first-name"];
            $lastName = $_POST["last-name"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $userType = $_POST["userType"];
            $phone = $_POST["phone-number"] ?? '';
            $address = $_POST["address"] ?? '';
            $street = $_POST["street"] ?? '';
            $city = $_POST["city"] ?? '';
            $district = $_POST["district"] ?? '';
            $province = $_POST["province"] ?? '';

            $userModel = $this->loadModel('User');
            $userModel->createNew(
                $firstName,
                $lastName,
                $email,
                $password,
                $userType,
                $phone,
                $address,
                $street,
                $city,
                $district,
                $province
            );
        }

        // Render the create new user view if the user is an admin
        if ($_SESSION["user"]["user_role"] === "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "createNewUser"]);
        } else {
            header("Location: /login");
        }
    }
}

?>