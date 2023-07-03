This is for my own reference no intended copy right infringement is intended.

PHP FIREBASE JWT Authentication

create token when user is logged
this is for reference only

you just need to composer install to use
this reference

you can use

in Middleware.php

// To create token
echo Authenticate::JWTCreateToken();

// To authenticate token
echo Authenticate::JWTAuthenticate();
to test the function

parameter = token
or
cookie name = token
