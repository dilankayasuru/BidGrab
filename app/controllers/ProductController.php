<?php
require_once "../app/core/Controller.php";

class ProductController extends Controller
{
    private $productModel;

    // Constructor to initialize the Product model
    public function __construct()
    {
        $this->productModel = $this->loadModel("Product");
    }

    // Method to display the home page with recently added auctions and trending categories
    public function index()
    {
        $recentItems = $this->productModel->getRecentlyAddedAuctions();
        $categories = $this->loadModel("Category")->getTrendingCategories();
        $this->renderView("pages/home", ["recentItems" => $recentItems, "categories" => $categories]);
    }

    // Method to view all products with sorting, category, and search options
    public function viewAllProducts($sort = "default", $category = "all", $search = '')
    {
        $sortQuery = '';

        // Determine the sorting query based on the sort parameter
        if ($sort == "lowtohigh") {
            $sortQuery = "current_price ASC";
        } elseif ($sort == "hightolow") {
            $sortQuery = "current_price DESC";
        } elseif ($sort == "recent") {
            $sortQuery = "date_added DESC";
        }

        // Fetch and display auctions based on the sorting query
        $displayAuction = $this->productModel->displayAuctions($category, $sortQuery, 'approved', $search);
        $this->renderView("pages/products", ["auctions" => $displayAuction, "sort" => $sort, "category" => $category]);
    }

    // Method to get product details by ID and handle bidding
    public function getProductById($id)
    {
        $recentItems = $this->productModel->getRecentlyAddedAuctions();
        $productInfo = $this->productModel->getProduct($id);
        $product = $productInfo["product"];
        $images = $productInfo["images"];
        $seller = $productInfo["seller"];
        $isStarted = $productInfo["isStarted"];
        $isExpired = $productInfo["isExpired"];

        // Redirect if the product is not approved and the user is not an admin
        if ($product["status"] !== 'approved' && $_SESSION["user"]["user_role"] !== "admin") {
            header("Location: item-not-found");
        }

        // Handle POST request to place a bid
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isset($_SESSION["user"]) || $_SESSION["user"]["user_role"] === "admin") {
                $error = "Please log in as a user to place bids!";
            }
            if (isset($_SESSION['user']) && ($product["seller_id"] === $_SESSION["user"]["user_id"])) {
                $error = "Seller can not bid on own items!";
            }
            if (isset($_SESSION['user']) && $_SESSION["user"]["user_role"] === "admin") {
                $error = "Please log in as a user to place bids!";
            }

            if (!isset($error)) {
                $result = $this->productModel->placeBid($productInfo["product"]["auction_id"], $_POST["bidAmount"]);
            }

            if (!empty($result)) {
                header("Location: product?id=$id");
            } else {
                $error = "Insufficient wallet balance";
            }
        }

        // Render the product view page
        $this->renderView(
            "pages/productView", [
            "recentItems" => $recentItems,
            "product" => $product,
            "images" => $images,
            "seller" => $seller,
            "isStarted" => $isStarted,
            "isExpired" => $isExpired,
            "error" => $error ?? ''
        ]);
    }

    // Method to add a new product (auction)
    public function addNew()
    {
        $errors = [];

        // Handle POST request to add a new product
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

            // Validate input fields
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

            // If there are errors, return without adding the product
            if (!empty($errors)) {
                return;
            }

            // Add the new product
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

        // Render the appropriate view based on user role
        if ($_SESSION["user"]["user_role"] == "user") {
            $this->renderView("pages/userDashboard", ["tab" => "createNewAuction", "categories" => $categoryModel->getAllCategories()]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    // Method to get all auctions with optional filter and sort parameters
    public function getAllAuctions($filter = "all", $sort = "default")
    {
        // Check if the user is logged in
        if (!isset($_SESSION["user"])) {
            header("Location: login");
            return;
        }

        // Render the appropriate dashboard view based on user role
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("admin", $sort), "filter" => $filter, "sort" => $sort]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("user", $sort), "filter" => $filter, "sort" => $sort]);
        }
    }

    // Method to delete a product by ID
    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);
    }

    // Method to edit a product by ID
    public function editProduct($id)
    {
        $this->productModel = $this->loadModel("Product");
        $categoryModel = $this->loadModel("Category");

        // Handle POST request to edit a product
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

            // Update the product details
            $this->productModel->editProduct($id, $productTitle, $description, $condition, $category, $startDate, $endDate, $startTime, $endTime, $basePrice);
        }

        // Render the edit product view
        $this->renderView("pages/userDashboard", [
            "tab" => "createNewAuction",
            "categories" => $categoryModel->getAllCategories(),
            "images" => $this->productModel->getProduct($id)["images"],
            "product" => $this->productModel->getProduct($id)["product"]
        ]);
    }

    // Method for admin to approve or reject an auction
    public function adminAuction($id)
    {
        // Handle POST request to approve or reject an auction
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

    public function about()
    {
        $this->renderView("pages/about", [], "About us");
    }

    public function contact()
    {
        $this->renderView("pages/contact", [], "Contact us");
    }
}