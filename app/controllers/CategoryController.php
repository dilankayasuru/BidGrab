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

    public function addNew()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST["category-name"];
            $description = $_POST["description"];
            $categoryPic = '';

            if (empty($categoryName)) {
                $errors[] = "Name is empty";
            }
            if (empty($description)) {
                $errors[] = "Description is empty";
            }

            if (is_uploaded_file($_FILES["category-pic"]['tmp_name'])) {
                $fileHandler = new FileHandler("category-pic");
                $categoryPic = $fileHandler->uploadFile(uniqid("category-"), "categoryImages");
            }

            if (!empty($errors)) {
                return;
            }

            $this->categoryModel->addNew($categoryName, $description, $categoryPic);
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "createNewCategory"]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    public function edit($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST["category-name"];
            $description = $_POST["description"];
            $oldCategoryPic = $_POST["saved-category-pic"];

            if (empty($categoryName)) {
                $errors[] = "Name is empty";
            }
            if (empty($description)) {
                $errors[] = "Description is empty";
            }

            if (is_uploaded_file($_FILES["category-pic"]['tmp_name'])) {
                $fileHandler = new FileHandler("category-pic");
                if (!empty($oldCategoryPic)) {
                    FileHandler::removeImage($oldCategoryPic, "categoryImages");
                }
                $categoryPic = $fileHandler->uploadFile(uniqid("category-"), "categoryImages");
            }

            if (!empty($errors)) {
                return;
            }

            $newCategoryPic = (empty($categoryPic)) ? $oldCategoryPic : $categoryPic;

            $this->categoryModel->edit($id, $categoryName, $description, $newCategoryPic);
        }

        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", [
                "tab" => "createNewCategory",
                "category" => $this->categoryModel->getCategory($id),
            ]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
    }
}