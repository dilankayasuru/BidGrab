<?php
require_once "../app/core/Controller.php";
class HomeController extends Controller
{
    public function index()
    {
        $this->renderView("pages/home");
    }
}