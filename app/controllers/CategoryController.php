<?php
require_once "../app/core/Controller.php";

class CategoryController extends Controller
{
    private $categoryModel;

    // Constructor to load the Category model
    public function __construct()
    {
        $this->categoryModel = $this->loadModel("Category");
    }

    // Method to display categories on the admin dashboard
    public function dashBoardCategories($error = '')
    {
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", [
                "tab" => "categories",
                "categories" => $this->categoryModel->getAllCategories(),
                "error" => $error
            ]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    // Method to add a new category
    public function addNew()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST["category-name"];
            $description = $_POST["description"];
            $categoryPic = '';

            // Validate input fields
            if (empty($categoryName)) {
                $errors[] = "Name is empty!";
            }
            if (empty($description)) {
                $errors[] = "Description is empty!";
            }

            // Handle file upload if a file is provided
            if (is_uploaded_file($_FILES["category-pic"]['tmp_name'])) {
                $fileHandler = new FileHandler("category-pic");
                $categoryPic = $fileHandler->uploadFile(uniqid("category-"), "categoryImages");
            } else {
                $errors[] = "Category image is empty!";
            }

            if (!$categoryPic) {
                $errors[] = "File must be less than 5MB";
            }

            // If there are validation errors, return early
            if (empty($errors)) {
                // Add the new category to the database
                $response = $this->categoryModel->addNew($categoryName, $description, $categoryPic);
            }
        }
        // Render the admin dashboard view for creating a new category
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", ["tab" => "createNewCategory", "errors" => $errors ?? [], "response" => $response ?? '']);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    // Method to edit an existing category
    public function edit($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST["category-name"];
            $description = $_POST["description"];
            $oldCategoryPic = $_POST["saved-category-pic"];

            // Validate input fields
            if (empty($categoryName)) {
                $errors[] = "Name is empty";
            }
            if (empty($description)) {
                $errors[] = "Description is empty";
            }

            // Handle file upload if a new file is provided
            if (is_uploaded_file($_FILES["category-pic"]['tmp_name'])) {
                $fileHandler = new FileHandler("category-pic");
                $categoryPic = $fileHandler->uploadFile(uniqid("category-"), "categoryImages");
                if (!empty($oldCategoryPic) && !$categoryPic === false ) {
                    FileHandler::removeImage($oldCategoryPic, "categoryImages");
                }
            }

            if (isset($categoryPic) && $categoryPic === false) {
                $errors[] = "File must be less than 5MB";
            }

            // If there are validation errors, return early
            if (empty($errors)) {
                // Determine the new category picture
                $newCategoryPic = (empty($categoryPic)) ? $oldCategoryPic : $categoryPic;

                // Update the category in the database
                $response = $this->categoryModel->edit($id, $categoryName, $description, $newCategoryPic);
            }
        }

        // Render the admin dashboard view to edit category
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->renderView("pages/adminDashboard", [
                "tab" => "createNewCategory",
                "category" => $this->categoryModel->getCategory($id),
                "errors" => $errors ?? [],
                "response" => $response ?? ''
            ]);
        } else {
            header("Location: /bidgrab/public/dashboard");
        }
    }

    // Method to delete a category
    public function delete($id)
    {
        $this->categoryModel->delete($id);
    }

    public function getAllCategories()
    {
        $this->renderView("pages/categories", ["categories" => $this->categoryModel->getAllCategories()]);
    }
}