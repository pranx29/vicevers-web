<?php

class Controller
{
    
    public function loadModel($model){
        require_once  BASE_URL . '/app/models/' . $model . '.php';
        return new $model();
    }

    public function renderView($view, $data = []){
        extract($data);
        require_once BASE_URL . '/app/views/' . $view . '.php';
    }

}
