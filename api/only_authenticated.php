<?php
    // Imports
    include_once "../config/token.php";
    include_once "../config/database.php";

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST; GET");

    // Initiate
    $db = new Database();
    $tokenConfig = new JWTToken();

    // Read fetch POST body
    $post = json_decode(file_get_contents('php://input'), true);

    // getAllHeaders
    $headers = $tokenConfig->getAllHeaders();
    if (!isset($headers["Authorization"])) {
        http_response_code(400);
        $json->message = "You are not authorized to view this page.";
        echo json_encode($json);
        exit();
    }

    // Verify Tokens
    $token = explode(" ", $headers["Authorization"])[1];

    if (!$tokenConfig->verifyToken($token)) {
        http_response_code(403);
        $json->message = "You are not authorized to view this page.";
        echo json_encode($json);
        exit();
    }


?>
