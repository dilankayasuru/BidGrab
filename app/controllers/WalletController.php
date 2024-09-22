<?php
require_once "../app/core/Controller.php";
require_once "../app/core/Database.php";

class WalletController extends Controller
{
    private $walletModel;
    private $db;

    public function __construct()
    {
        $this->walletModel = $this->loadModel("Wallet");
        $this->db = new Database();
    }

    public function getUserWallet($filter = "all")
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            header("Location: login");
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "wallet", "wallet" => $this->walletModel->getUserWallet($filter), "filter" => $filter]);
        }

    }

    public function deposit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            $this->walletModel->deposit($amount);
        }
    }

    public function withdraw()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            $this->walletModel->withdraw($amount);
        }
    }

}