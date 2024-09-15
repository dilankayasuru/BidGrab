<?php
require_once "../app/core/Controller.php";

class OrderController extends Controller
{
    private $orderModel;

    public function getAllOrders($filter = "all")
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        $this->orderModel = $this->loadModel("Order");

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "orders", "orders" => $this->orderModel->getAllOrders(), "filter" => $filter]);
        }

    }
}