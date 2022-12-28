<?php

class Controller {
//    Get the correct model, instantiate and return it
    public function model(string $model): mixed {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    //    Get the correct view, instantiate and return it
    public function view(string $view, Request $request, array $data = []): void {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';

        }else {
            die('Corresponding view does not exist');
        }
    }
}
