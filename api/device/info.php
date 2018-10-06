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

    // Echo Device Info
//echo $payload['houseID'];
    echo json_encode($db->getDevice($deviceID, $payload->houseID));
?>
