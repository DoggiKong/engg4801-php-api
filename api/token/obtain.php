<?php //phpinfo();
    include_once "../only_post.php";
    
    // Imports
    include_once "../config/database.php";
    include_once "../config/token.php";

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");

    // Initiate Classes
    $tokenConfig = new JWTToken();
    $db = new Database();

    // Auth with db username/password
    $post = json_decode(file_get_contents('php://input'), true);

    // If successful
    if (!isset($post["username"]) || !isset($post["password"])) {
       http_response_code(400); // Bad Request
       exit();
    }
    $account = json_encode($db->getAccount($post["username"]));
    $account = json_decode($account, true);
   

    if (strtolower(trim($account["id"])) != strtolower(trim($post["username"]))) {
        echo "Wrong account username";
        http_response_code(403);
        exit();
    }
    //$hashedPassword = sha256($_POST["password"]);
    $hashedPassword = hash_hmac("sha256", $post["password"], "key");

    if ($account["password"] != $hashedPassword && $account["password"] != "") {
        echo "Wrong password";
        http_response_code(403);
        exit(); 
    }

    $json->token = $tokenConfig->obtainToken($account['id'], $account['houseID']);
    
    echo json_encode($json);

?>
