<?php
require_once "../app/core/Controller.php";

class ProductController extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel("Product");
    }

    public function index()
    {
        $recentItems = $this->productModel->getRecentlyAddedAuctions();
        $categories = $this->loadModel("Category")->getTrendingCategories();
        $this->renderView("pages/home", ["recentItems" => $recentItems, "categories" => $categories]);
    }

    public function viewAllProducts($sort = "default", $category = "all", $search = '')
    {
        $sortQuery = '';

        if ($sort == "lowtohigh") {
            $sortQuery = "current_price ASC";
        } elseif ($sort == "hightolow") {
            $sortQuery = "current_price DESC";
        } elseif ($sort == "recent") {
            $sortQuery = "date_added DESC";
        }

        $displayAuction = $this->productModel->displayAuctions("all", $sortQuery, 'approved', $search);
        $this->renderView("pages/products", ["auctions" => $displayAuction, "sort" => $sort, "category" => $category]);
    }

    public function getProductById($id)
    {
        $recentItems = $this->productModel->getRecentlyAddedAuctions();
        $productInfo = $this->productModel->getProduct($id);
        $product = $productInfo["product"];
        $images = $productInfo["images"];
        $seller = $productInfo["seller"];
        $isStarted = $productInfo["isStarted"];
        $isExpired = $productInfo["isExpired"];


        if ($product["status"] !== 'approved' && $_SESSION["user"]["user_role"] !== "admin") {
            header("Location: item-not-found");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!isset($_SESSION["user"]) || $_SESSION["user"]["user_role"] === "admin") {
                header("Location: ./login");
            }

            $result = $this->productModel->placeBid($productInfo["product"]["auction_id"], $_POST["bidAmount"]);
            if ($result) {
                header("Location: product?id=$id");
            }
        }

        $this->renderView(
            "pages/productView", [
            "recentItems" => $recentItems,
            "product" => $product,
            "images" => $images,
            "seller" => $seller,
            "isStarted" => $isStarted,
            "isExpired" => $isExpired,
        ]);
    }

    public function addNew()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productTitle = $_POST["auction-title"];
            $description = $_POST["description"];
            $condition = $_POST["condition"];
            $category = $_POST["category"];
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];
            $startTime = $_POST["startTime"];
            $endTime = $_POST["endTime"];
            $basePrice = $_POST["basePrice"];

            if (empty($productTitle)) {
                $errors[] = "Title is empty";
            }
            if (empty($description)) {
                $errors[] = "Description is empty";
            }
            if (empty($condition)) {
                $errors[] = "Condition is empty";
            }
            if (empty($category)) {
                echo "Category is empty";
            }
            if (empty($startDate)) {
                $errors[] = "Start date is empty";
            }
            if (empty($endDate)) {
                $errors[] = "End date is empty";
            }
            if (empty($startTime)) {
                $errors[] = "Start time is empty";
            }
            if (empty($endTime)) {
                $errors[] = "End time is empty";
            }
            if (empty($basePrice)) {
                $errors[] = "Base price is empty";
            }

            if (!empty($errors)) {
                return;
            }

            $this->productModel->addNew(
                $productTitle,
                $description,
                $condition,
                $category,
                $startDate,
                $endDate,
                $startTime,
                $endTime,
                $basePrice);
        }

        $categoryModel = $this->loadModel("Category");

        if ($_SESSION["user"]["user_role"] == "user") {
            $this->renderView("pages/userDashboard", ["tab" => "createNewAuction", "categories" => $categoryModel->getAllCategories()]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    public function getAllAuctions($filter = "all", $sort = "default")
    {
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }


        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("admin", $sort), "filter" => $filter, "sort" => $sort]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("user", $sort), "filter" => $filter, "sort" => $sort]);
        }

    }

    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);
    }

    public function editProduct($id)
    {
        $this->productModel = $this->loadModel("Product");
        $categoryModel = $this->loadModel("Category");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $description = $_POST["description"];
            $productTitle = $_POST["auction-title"];
            $category = $_POST["category"];
            $condition = $_POST["condition"];
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];
            $startTime = $_POST["startTime"];
            $endTime = $_POST["endTime"];
            $basePrice = $_POST["basePrice"];

            $this->productModel->editProduct($id, $productTitle, $description, $condition, $category, $startDate, $endDate, $startTime, $endTime, $basePrice);
        }

        $this->renderView("pages/userDashboard", [
            "tab" => "createNewAuction",
            "categories" => $categoryModel->getAllCategories(),
            "images" => $this->productModel->getProduct($id)["images"],
            "product" => $this->productModel->getProduct($id)["product"]
        ]);
    }

    public function adminAuction($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["approve"])) {
                $this->productModel->changeStatus("approved", $id);
                header("Location: dashboard/auctions");
            }
            if (isset($_POST["reject"])) {
                $this->productModel->changeStatus("rejected", $id);
                header("Location: dashboard/auctions");
            }
        }
    }
}