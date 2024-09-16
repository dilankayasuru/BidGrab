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
}

?>