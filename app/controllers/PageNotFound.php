<?php
require_once "../app/core/Controller.php";
//Handle undefined routes
class PageNotFound extends Controller
{
    public function index()
    {
        // Render 404 page view
        $this->renderView("404");
    }
}