<?php
namespace Authenticate;
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use DateTimeImmutable;

class Authenticate{
  function JWTCreateToken(){

    try {

    $date   = new DateTimeImmutable();
    $expire_at  = $date->modify('+60 minutes')->getTimestamp();  
    $domain = 'http://test.comssssssss';
    $attribute1 = 'this is an reserve variable';
    $userName = 'user1';
    $roleId = '1';
  
    if(isset($SERVER['HTTP_REFERER'])){
      $domain = $SERVER['HTTP_REFERER'];
    }
    
    if(isset($SERVER['attribute1'])){
      $attribute1 = $SERVER['attribute1'];
    }
  
    if(isset($SERVER['username'])){
      $userName = $SERVER['username'];
    }
  
    if(isset($SERVER['role_id'])){
      $roleId = $SERVER['role_id'];
    }
  
    $token_payload = [
      'iat'  => $date->getTimestamp(),    // Issued at: time when the token was generated
      'iss' => $domain,                   // Issuer
      'nbf'  => $date->getTimestamp(),    // Not before
      'attribute1' => $attribute1,
      'exp'  => $expire_at,               // Expiration
      'username' => $userName,
      'role_id' => $roleId
    ];
  
    $key = 'i9SULzmOGOnuuU89Y2tg0J0yBWGQEF';
    $jwt = JWT::encode($token_payload, $key, 'HS256');
 
    return $jwt;

    }catch(Exception $e){

      return $e->getMessage();

    }
  }
  
  function JWTAuthenticate(){
    try {

      $token = '';
 
      if (isset($_POST['token'])){
        $token = $_POST['token'];
      }
      
      if (isset($_COOKIE['token'])){
        $token = $_COOKIE['token'];
      }

      if($token === ''){
        return json_encode(array("status" => 0,"login message" => "No Toke Found"));
      }

      $secretKey = "i9SULzmOGOnuuU89Y2tg0J0yBWGQEF";
      try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
      }catch(\Exception $e){
        return json_encode(array("status" => 0,"login message" => "Wrong Token"));
      }
      return json_encode(array("status" => 1,"login message" => "Authentication Success"));

    } catch (Exception $e) {
      // echo 'Invalid token: ' . $e->getMessage();
      echo json_encode(array("status" => 0," message" => $e->getMessage()));
    }
    
  }
}

?>