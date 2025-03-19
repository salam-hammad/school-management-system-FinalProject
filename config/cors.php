<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // السماح بالوصول إلى الـ API

    'allowed_methods' => ['*'], // السماح بكل أنواع الطلبات (GET, POST, PUT, DELETE, ...)

    'allowed_origins' => ['http://localhost:3000', 'http://127.0.0.1:8000'], // ضع هنا الـ Frontend الخاص بك

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // السماح بكل الهيدرز

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // مهم إذا كنت تستخدم المصادقة مثل Laravel Sanctum

];
