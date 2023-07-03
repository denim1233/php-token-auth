<?php
namespace Tools;

class Tools{

    function createCookie($expire,$httpOnly = true){
        try{
            if(!isset($expire)){
                $expire = time() + time()+3600; /* 1hr */
            }

            $cookie_name = "Apit";
            $cookie_value = "Secured cookie"; /*$POST['user']*/
            setcookie($cookie_name, $cookie_value,$expire, "/",$httpOnly); // 86400 = 1 day
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function getCookie($cookieName){
        $cookieValue = '';
        try{
            if(isset($_COOKIE[$cookieName])){
                $cookieValue =  $_COOKIE[$cookieName];
            }else{
                $cookieValue = 'cookie doesnt exist';
            }
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $cookieValue;
    }

    function loadSQLData(){

    }

}

?>