<?php
require_once "../app/core/Controller.php";

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = $this->loadModel("Category");
    }

    public function dashBoardCategories()
    {
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "categories", "categories" => $this->categoryModel->getAllCategories()]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }
}