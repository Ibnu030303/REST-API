<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/JWTlib.php');

use \Firebase\JWT\JWT;

class Jwtlib
{
    private $key;

    public function __construct()
    {
        $this->key = 'Train4Best#1';
    }

    public function generate_token($data)
    {
        $token = array(
            "iss" => base_url(),
            "aud" => base_url(),
            "iat" => time(),
            "exp" => time() + (60 * 60), // Token expired after 1 hour
            "data" => $data
        );

        return JWT::encode($token, $this->key);
    }

    public function validate_token($token)
    {
        try {
            $decoded = JWT::decode($token, $this->key, array('HS256'));

            return $decoded->data;

        } catch (Exception $e) {
            return false;
        }
    }
}
