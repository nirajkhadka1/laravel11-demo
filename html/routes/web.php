<?php

use App\Helpers\Helper;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/once',function(){
    $helper = new Helper();
    dump($helper->generateRandomString());
    dump($helper->generateRandomString());

    $helper = new Helper();
    dump($helper->generateRandomString());
})->middleware([ThrottleRequests::using('laravel-second')]);
