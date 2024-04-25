<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\text;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('validation', function(){
    $name = text(
        label: 'What is your name?',
        validate: fn (string $value) => match (true) {
            strlen($value) < 3 => 'The name must be at least 3 characters.',
            strlen($value) > 6 => 'The name must not exceed 6 characters.',
            default => null
        }
    );
    
});
