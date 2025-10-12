<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile Keys
    |--------------------------------------------------------------------------
    |
    | These are your Cloudflare Turnstile site key and secret key.
    | You can obtain these from your Cloudflare dashboard.
    |
    */

    'site_key' => env('TURNSTILE_SITE_KEY', ''),
    'secret_key' => env('TURNSTILE_SECRET_KEY', ''),

];
