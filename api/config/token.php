<?php

require_once('../../vendor/firebase/php-jwt/src/JWT.php');
require_once('../../vendor/firebase/php-jwt/src/ExpiredException.php');
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

class JWTToken {
    private $key="my_super_private_key";
    private $expiry=360;
    
    public function getToken() {
        $exp = time() + 4000;
        $payload = Array(
            "uuid" => "something",
            "exp" => $exp,
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );
        
        return $jwt = JWT::encode($payload, $this->key);      
     }

    public function verifyToken($token) {
        try {
            $decoded = JWT::decode($token, $this->key, array('HS256'));
        } catch (Exception $e) {
            http_response_code(403);
            return JWT::jsonEncode('{"success": "false"}');
        }
        return JWT::jsonEncode('{"success": "true"');
    }

    public function getPayload($token) {
	try {
            $decoded = JWT::decode($token, $this->key, array('HS256'));
        } catch (Exception $e) {
            print_r($e);
        }
        return $decoded;
    }

}

$jwtToken = new JwtToken();
$token = $jwtToken->getToken();
echo $token;
echo ' <br />Payload: ';
echo JWT::jsonEncode($jwtToken->getPayload($token));
echo '<br />Verify: ';
echo JWT::jsonEncode($jwtToken->verifyToken($token));
?>
