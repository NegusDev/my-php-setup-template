<?php
require_once 'src/require.php';

Router::get('/', function () {
    echo "Index Page";
});

Router::get(Router::uri(), function () {
    http_response_code(404);
    echo 'NOT FOUND';
});