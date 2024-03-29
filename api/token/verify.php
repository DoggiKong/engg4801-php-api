<?php

    //include_once "../only_get.php";

    // Imports
    include_once "../config/token.php";

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST; GET");

    // Initiate Classes
    $tokenConfig = new JWTToken();

    $headers = $tokenConfig->getAllHeaders();

    if (!isset($headers["Authorization"])) {
        http_response_code(400);
        exit();
    }
    $token = explode(" ", $headers["Authorization"])[1];

   
    if (!$tokenConfig->verifyToken($token)) {
        http_response_code(403);
        exit();
    }

    $json->message = "Token is valiated";

    echo json_encode($json);
?>
