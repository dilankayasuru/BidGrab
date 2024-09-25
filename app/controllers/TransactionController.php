<?php
require_once "../app/core/Controller.php";

class TransactionController extends Controller
{
    private $transactionModel;

    // Constructor to load the Transactions model
    public function __construct()
    {
        $this->transactionModel = $this->loadModel("Transactions");
    }

    // Method to display transactions, sorted by the specified parameter
    public function index($sort = "default")
    {
        // Check if the user is logged in and has the user role
        if (!isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] === "user") {
            header("Location: login");
            return;
        }

        // Retrieve all transactions with the specified sort order
        $transactions = $this->transactionModel->getTransactions("all", $sort);

        // Render the admin dashboard view with the transactions data
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "transactions", "transactions" => $transactions, "sort" => $sort]);
        }
    }
}