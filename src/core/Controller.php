<?php
declare(strict_types=1);

// CALL NAMESPACE AS SPECIFIED IN COMPOSER.JSON FILE
namespace Example\Core;

class Controller {
    public function model(string $model){
        // Models are initiated here
    }

    public function view(string $view, array $data = [],array $errors = []) {
        if (file_exists(APP_ROOT.'/Views/'. $view . '.php')) {
			// IF FILE EXIST
			require_once APP_ROOT.'/Views/'. $view . '.php';

		}else {
			die('The view does not exist');
		}

    }
}
