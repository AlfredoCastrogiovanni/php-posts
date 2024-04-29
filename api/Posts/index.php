<?php

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];

    $cleanUri = parse_url($requestUri, PHP_URL_PATH);
    $uriSegments = explode('/', $cleanUri);

    switch ($uriSegments[5]) {
        case 'posts':
            include 'posts.php';
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
    }
?>
