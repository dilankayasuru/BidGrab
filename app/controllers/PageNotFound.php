<?php
require_once "../app/core/Controller.php";
class PageNotFound extends Controller
{
    public function index()
    {
        $this->renderView("404");
    }
}