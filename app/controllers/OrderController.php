<?php
require_once "../app/core/Controller.php";

class OrderController extends Controller
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->loadModel("Order");
    }

    public function getAllOrders($filter = "all", $sort = "default")
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter, "sort" => $sort]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter, "sort" => $sort]);
        }

    }

    public function submitOrder()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["itemId"];
            $tracking_no = $_POST["trackingNo"];
        }
        $this->orderModel->submitOrder($id, $tracking_no);
    }

    public function manageOrder()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["orderId"];
            if (isset($_POST["approve"])) {
                $this->orderModel->manageOrder($id, "completed");
            }else {
                $this->orderModel->manageOrder($id, "canceled");
            }
        }
    }
}