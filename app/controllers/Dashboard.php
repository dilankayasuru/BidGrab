<?php
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";

class Dashboard extends Controller
{
    private $user;

    public function __constructor()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }
        $this->user = new User();
    }
    public function index()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "home"]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "home"]);
        }
    }
}

?>