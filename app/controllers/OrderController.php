<?php
require_once "../app/core/Controller.php";

class OrderController extends Controller
{
    private $orderModel;

    // Constructor to initialize the Order model
    public function __construct()
    {
        $this->orderModel = $this->loadModel("Order");
    }

    // Method to get all orders with optional filter and sort parameters
    public function getAllOrders($filter = "all", $sort = "default")
    {
        // Check if the user is logged in
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        // Render the appropriate dashboard view based on user role
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter, "sort" => $sort]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter, "sort" => $sort]);
        }
    }

    // Method to submit an order
    public function submitOrder()
    {
        // Check if the user is logged in
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        // Handle POST request to submit an order
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["itemId"];
            $tracking_no = $_POST["trackingNo"];
        }

        // Call the model method to submit the order
        $this->orderModel->submitOrder($id, $tracking_no);
    }

    // Method to manage an order (approve or cancel)
    public function manageOrder()
    {
        // Handle POST request to manage an order
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["orderId"];
            if (isset($_POST["approve"])) {
                $this->orderModel->manageOrder($id, "completed");
            } else {
                $this->orderModel->manageOrder($id, "canceled");
            }
        }
    }
}