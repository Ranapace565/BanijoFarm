<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'telegram/webhook',          // tanpa awalan slash juga boleh
        '/telegram/webhook',         // aman-aman saja jika keduanya ada
    ];
}
