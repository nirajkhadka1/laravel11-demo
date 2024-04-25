<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function generateRandomString()
    {
        return once(function(){
            return Str::random(10);
        });
    }
}
