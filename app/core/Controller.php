<?php

class Controller
{
    protected function LoadModel($model)
    {
        require_once "../app/models/$model.php";
        return new $model;
    }

    protected function renderView($viewPath, $data = [], $title = "BidGrab")
    {
        extract($data);
        require_once "../app/views/layout.php";
    }
}