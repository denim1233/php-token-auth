<?php
namespace Middleware;

use Authenticate\Authenticate;

class Middleware{

    public function __construct()
    {
        //check the token here by using the parameter use sent by the front end or the cookie
        $this->checkToken();

        //you can call this class to other class so that you have checker in every request
        
    }

    function checkToken(){
        
        // echo Authenticate::JWTCreateToken();
        echo Authenticate::JWTAuthenticate();

    }

}

?>