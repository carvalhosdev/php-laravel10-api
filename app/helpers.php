<?php

use Illuminate\Validation\ValidationException;

if (!function_exists('myGlobalHelper')) {
    function myGlobalHelper($param) {
        // Your helper function logic here
        return "Hello, $param!";
    }
}

if (!function_exists('responseError')) {
    function responseError($type, $message) {
        // Your helper function logic here
        throw ValidationException::withMessages([
            $type => [$message]
        ]);
    }
}
if (!function_exists('userLevelAvailable')) {
    function userLevelAvailable($level) {
        $levels = ['user', 'admin'];

        if(!in_array($level, $levels)){
            throw ValidationException::withMessages([
                'level' => "Nível de usuario inválido, apenas user e admin"
            ]);
        }
        // Your helper function logic here
       
    }
}