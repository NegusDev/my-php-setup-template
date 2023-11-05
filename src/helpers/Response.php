<?php

declare(strict_types=1);

namespace helpers;

class Response
{
    public static function send(array $data, int $statusCode = 200)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: PUT, POST, PATCH, DELETE');
        header("Access-Control-Allow-Headers: 'X-Requested-With,content-type'");

        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    public static function curlRequest(string $url, string $requestMethod, array $postFields = [], array $headers = []): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestMethod,
            CURLOPT_POSTFIELDS => http_build_query($postFields), // Convert array to query string
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
