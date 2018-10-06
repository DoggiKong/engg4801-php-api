<?php
    // Imports
    include_once "../only_authenticated.php";

    // Get deviceAlias from fetch body
    $deviceID = $post["deviceID"];
    $deviceAlias = $post["deviceAlias"];

    // Validate
    if (is_null($deviceID) || is_null($deviceAlias)) {
        http_response_code(400);
        exit();
    }

    // Get Payload
    $payload = json_decode(json_encode($tokenConfig->getPayload($token)));

    // Set Alias to DB
    try {
        $db->setDeviceAlias($deviceID, $payload->houseID, $deviceAlias);
        echo "OK";
    } catch (Exception $e) {
        echo $e;
    }


?>
