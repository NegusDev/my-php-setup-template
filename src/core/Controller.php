<?php

declare(strict_types=1);

namespace Core;

class Controller
{
    public function loadModel(string $model): object
    {
        $modelClass = '\\models\\' . ucfirst($model);

        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die('The model does not exist');
        }
    }

    public function loadView(string $view, array $data = [], array $errors = []): void
    {
        $viewFile = APP_ROOT . '/views//' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            extract($errors);

            require_once $viewFile;
        } else {
            die('The view does not exist');
        }
    }
}
