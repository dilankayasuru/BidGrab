<?php

class Controller
{
    // Method to load the model class
    protected function LoadModel($model)
    {
        require_once "../app/models/$model.php";
        return new $model;
    }

    // Method to get the view file and render it
    protected function renderView($viewPath, $data = [], $title = "BidGrab")
    {
        extract($data);
        require_once "../app/views/layout.php";
    }
}