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

    if (!function_exists('getallheaders'))  {
        function getallheaders() {
            if (!is_array($_SERVER)) {
                return array();
            }

            $headers = array();
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        }
    }
    $headers = getallheaders();

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
