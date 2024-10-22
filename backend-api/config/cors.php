<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    //'paths' => ['*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8080', 'http://127.0.0.1:8000'], 
    //'allowed_origins' => ["http://localhost:8080"], // Altere para o domínio que está usando

    'allowed_origins_patterns' => ["*localhost*"],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Defina como true se precisar de cookies
];

