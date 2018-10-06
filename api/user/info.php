<?php

    // Imports
    include_once "../only_authenticated.php";

    // Get Payload
    $payload = json_decode(json_encode($tokenConfig->getPayload($token)));

    try {
        $data = json_encode($db->getAccount($payload->uuid));
        echo $data;
    } catch (Exception $e) {
        echo $e;
        http_response_code(404);
        exit();
    }

    

?>
