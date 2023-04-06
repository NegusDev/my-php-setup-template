<?php 
declare(strict_types=1);

namespace Example\helpers;


class Response {

    public static function send($response) {
        header('Access-Control-Allow-Origin: *');
        header('Origin: Vary');
        header('Content-Type: application/json');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: PUT, POST, PATCH, DELETE');
        header("Access-Control-Allow-Headers:  'X-Requested-With,content-type'");

        echo json_encode($response);
        exit;
    }
}