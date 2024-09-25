<?php
require_once "../app/core/Controller.php";

class TransactionController extends Controller
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = $this->loadModel("Transactions");
    }

    public function index($sort = "default")
    {

        if (!isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] === "user") {
            header("Location: login");
            return;
        }
        $transactions = $this->transactionModel->getTransactions("all", $sort);

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "transactions", "transactions" => $transactions, "sort" => $sort]);
        }
    }

}