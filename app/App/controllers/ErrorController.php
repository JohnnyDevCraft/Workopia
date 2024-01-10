<?php

namespace App\Controllers;

class ErrorController
{
    public static function NotFound($uri){
        http_response_code(404);
        loadView('error', [
            'status'=>'404 NOT FOUND ',
            'message'=>'Path Not Found: ' . $uri
        ]);
    }
}