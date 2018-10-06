<?php

require_once('../../vendor/firebase/php-jwt/src/JWT.php');
require_once('../../vendor/firebase/php-jwt/src/ExpiredException.php');
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

class JWTToken {
    private $key="my_super_private_key";
    private $expiry=360;
    
    public function obtainToken($uuid, $houseID) {
        $exp = time() + 4000;
        $payload = Array(
            "uuid" => $uuid,
            "houseID" => $houseID,
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
            return false;
        }
        return true;
    }

    public function getPayload($token) {
	try {
            $decoded = JWT::decode($token, $this->key, array('HS256'));
        } catch (Exception $e) {
            print_r($e);
        }
        return $decoded;
    }

    public function getAllHeaders() {
        if (!function_exists('getallheaders'))  {
            
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
        return getallheaders();
    }

}

//$jwtToken = new JwtToken();
//$token = $jwtToken->obtainToken();
//echo $token;
//echo ' <br />Payload: ';
//echo JWT::jsonEncode($jwtToken->getPayload($token));
//echo '<br />Verify: ';
//echo JWT::jsonEncode($jwtToken->verifyToken($token));
?>
