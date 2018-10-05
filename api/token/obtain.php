<?php
    include_once "../only_post.php";
    
    // Imports
//    include_once "../config/database.php";
    include_once "../config/token.php";

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");

    // Initiate Classes
    $tokenConfig = new JWTToken();
//    $db = new Database();

    // Auth with db username/password

    // If successful
    $json->token = $tokenConfig->obtainToken("test_user");
    
    echo json_encode($json);


?>
