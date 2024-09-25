<?php
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";

class DashboardController extends Controller
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

        $data = $this->loadModel('Dashboard')->getDashboardHome();

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "home", "tabData" => $data]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "home", "tabData" => $data]);
        }
    }
}

?>