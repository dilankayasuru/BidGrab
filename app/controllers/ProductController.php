<?php
require_once "../app/core/Controller.php";

class ProductController extends Controller
{
    private $productModel;

    public function index()
    {

        $this->renderView("pages/products");
    }

    public function getProductById($id)
    {
        $this->renderView("pages/productView", ['id' => $id], "View $id");
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

            $this->productModel = $this->loadModel("Product");
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

        $this->productModel = $this->loadModel("Product");


        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("admin", $sort), "filter" => $filter, "sort" => $sort]);
        } else {
            $this->renderView("pages/userDashboard", ["tab" => "auctions", "products" => $this->productModel->getAllAuctions("user", $sort), "filter" => $filter, "sort" => $sort]);
        }

    }

    public function deleteProduct($id)
    {
        $this->productModel = $this->loadModel("Product");
        $this->productModel->deleteProduct($id);
    }

    public function editProduct($id)
    {
        $this->productModel = $this->loadModel("Product");
        $categoryModel = $this->loadModel("Category");
        $itemImageModel = $this->loadModel("ItemImage");

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
            "images"=> $itemImageModel->getItemImages($id),
            "product" => $this->productModel->getProduct($id)
        ]);
    }
}