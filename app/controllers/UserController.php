<?php
require_once "../app/core/Controller.php";

class UserController extends Controller
{
    public function changeProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userModel = $this->loadModel("User");
            $userModel->changeProfile();
        }
    }

    public function resetPassword()
    {
        $userModel = $this->loadModel("User");
        $userModel->resetPassword();
    }

    public function profile()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "profile"]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "profile"]);
        }
    }

    public function getAllUsers($filter = "all", $sort = "default")
    {
        if (!isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] !== "admin") {
            header("Location: login");
            return;
        }
        $userModel = $this->loadModel("User");
        $users = $userModel->getAllUsers($filter, $sort);
        $this->renderView("pages/adminDashboard", ["tab" => "users", "filter" => $filter, "sort" => $sort, "users" => $users]);
    }

    public function activate($id)
    {
        $userModel = $this->loadModel('User');
        $userModel->changeStatus($id, "active");
    }

    public function deactivate($id)
    {
        $userModel = $this->loadModel('User');
        $userModel->changeStatus($id, "deactive");
    }

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

        if ($_SESSION["user"]["user_role"] === "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "createNewUser"]);
        } else {
            header("Location: /login");
        }
    }
}

?>