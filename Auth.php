#!/usr/bin/env php
<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

//create a token when user is authenticated
JWTCreateToken();

//check if the token fo the request is valid
JWTAuthenticate();

function JWTCreateToken(){
  $date   = new DateTimeImmutable();
  $expire_at  = $date->modify('+60 minutes')->getTimestamp();  
  $domain = 'http://test.comssssssss';
  $attribute1 = 'asdasd';
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
  print "JWT:\n";
  print_r($jwt);

}

function JWTAuthenticate(){
  try {
    $secretKey = "i9SULzmOGOnuuU89Y2tg0J0yBWGQEF";
    $decoded = JWT::decode($_POST['token'], new Key($secretKey, 'HS256'));
    // print "\n\n";
    // print "Decoded:\n";
    echo json_encode(array("status" => 1,"login message" => "Authentication Success","data" => $decoded));
  } catch (Exception $e) {
    echo "<br>";
    echo 'Invalid token: ' . $e->getMessage();
  }
  
}

?>