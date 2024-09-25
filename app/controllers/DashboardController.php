<?php
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";

class DashboardController extends Controller
{
    private $user;

    // Constructor to initialize the User model and check if the user is logged in
    public function __constructor()
    {
        if (!isset($_SESSION["user"])) {
            // Redirect to login if the user is not logged in
            header("Location: login");
            return;
        }
        $this->user = new User();
    }

    // Method to display the dashboard home page
    public function index()
    {
        if (!isset($_SESSION["user"])) {
            // Redirect to login if the user is not logged in
            header("Location: login");
            return;
        }

        // Load dashboard data
        $data = $this->loadModel('Dashboard')->getDashboardHome();

        // Render the appropriate dashboard view based on user role
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "home", "tabData" => $data]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "home", "tabData" => $data]);
        }
    }
}

?>