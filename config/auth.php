<?php
// config/auth.php
// Paramètres de sécurité : rôles, hashing, JWT et CSRF

return [

    /*
    |--------------------------------------------------------------------------
    | Rôles système (Niveaux d’accès)
    |--------------------------------------------------------------------------
    |
    | Clés identifiants et codes numériques pour RoleMiddleware.
    |
    */
    'roles' => [
        'VIS' => 0,  // Visiteur (public)
        'ETU' => 1,  // Étudiant
        'ENS' => 2,  // Enseignant-Visiteur
        'COM' => 3,  // Commission
        'ADM' => 4,  // Admin (N4)
    ],

    /*
    |--------------------------------------------------------------------------
    | Hashing des mots de passe
    |--------------------------------------------------------------------------
    */
    'password' => [
        'algo'    => PASSWORD_BCRYPT,
        'options' => [
            'cost' => 12,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration JWT
    |--------------------------------------------------------------------------
    */
    'jwt' => [
        'secret'    => getenv('JWT_SECRET') ?: 'ChangeMeInProduction',
        'algo'      => getenv('JWT_ALGO')   ?: 'HS256',
        'ttl'       => intval(getenv('JWT_TTL') ?: 3600),
        'issuer'    => getenv('JWT_ISSUER') ?: (getenv('APP_URL') ?: 'http://localhost:8080'),
        'audience'  => getenv('JWT_AUD')    ?: (getenv('APP_URL') ?: 'http://localhost:8080'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Protection CSRF
    |--------------------------------------------------------------------------
    */
    'csrf' => [
        'token_key'   => '_csrf_token',    // champ/form name
        'header_name' => 'X-CSRF-TOKEN',   // en-tête HTTP
        'cookie_name' => 'csrf_token',     // nom du cookie
        'lifetime'    => 7200,             // en secondes
    ],

];
