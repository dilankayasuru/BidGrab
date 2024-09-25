<?php
require_once "../app/core/Controller.php";
require_once "../app/core/Database.php";

class WalletController extends Controller
{
    private $walletModel;
    private $db;

    // Constructor to initialize Wallet model and Database
    public function __construct()
    {
        $this->walletModel = $this->loadModel("Wallet");
        $this->db = new Database();
    }

    // Method to get user wallet details with optional filter and sort parameters
    public function getUserWallet($filter = "all", $sort = "all")
    {
        // Redirect to login if user is not logged in
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        // Redirect to login if user is an admin
        if ($_SESSION["user"]["user_role"] == "admin") {
            header("Location: login");
        } else {
            // Retrieve transactions based on filter and sort parameters
            $transactions = $this->loadModel("Transactions")->getTransactions($filter, $sort);
            // Render the user dashboard view with wallet and transactions data
            $this->renderView("pages/userDashboard", ["tab" => "wallet", "data" => $this->walletModel->getUserWallet(), "transactions" => $transactions, "filter" => $filter]);
        }
    }

    // Method to handle deposit action
    public function deposit()
    {
        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            // Call the deposit method on the Wallet model
            $this->walletModel->deposit($amount);
        }
    }

    // Method to handle withdraw action
    public function withdraw()
    {
        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            // Call the withdraw method on the Wallet model
            $this->walletModel->withdraw($amount);
        }
    }
}