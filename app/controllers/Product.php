<?php
require_once "../app/core/Controller.php";
class Product extends Controller
{
    public function index()
    {
        $this->renderView("pages/products");
    }
    public function getProductById($id = 0)
    {
        $this->renderView("pages/productView");
    }
}