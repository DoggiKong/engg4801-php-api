<?php

    // Imports
    include_once "../only_authenticated.php";

    // Get DeviceID
    $deviceID = $post['deviceID'];
    if (is_null($deviceID)) {
        http_response_code(400);
        exit();
    }

    // Get Payload

    $payload = json_decode(json_encode($tokenConfig->getPayload($token)));

    try {
        $data = json_encode($db->getScores($deviceID, $payload->houseID));

        echo $data;
    } catch (Exception $e) {
        echo $e;
        http_response_code(404);
        exit();
    }

    

?>
