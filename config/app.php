<?php
// config/app.php
// Configuration générale de l’application App-Soutenance

return [

    /*
    |--------------------------------------------------------------------------
    | Environnement de l’application
    |--------------------------------------------------------------------------
    |
    | Valeur possible : "production", "staging", "development", "testing"
    |
    */
    'env' => getenv('APP_ENV') ?: 'production',

    /*
    |--------------------------------------------------------------------------
    | Mode Debug
    |--------------------------------------------------------------------------
    |
    | Active ou non l’affichage des erreurs détaillées.
    |
    */
    'debug' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN),

    /*
    |--------------------------------------------------------------------------
    | URL de l’application
    |--------------------------------------------------------------------------
    |
    | Utilisée pour générer les liens absolus (redirections, URL canoniques…)
    |
    */
    'url' => getenv('APP_URL') ?: 'http://localhost:8080',

    /*
    |--------------------------------------------------------------------------
    | Fuseau horaire
    |--------------------------------------------------------------------------
    |
    | Doit correspondre à date.timezone dans php.ini
    |
    */
    'timezone' => 'Africa/Abidjan',

    /*
    |--------------------------------------------------------------------------
    | Langue par défaut
    |--------------------------------------------------------------------------
    |
    | Pour les traductions et localisations éventuelles
    |
    */
    'locale' => getenv('APP_LOCALE') ?: 'fr',

    /*
    |--------------------------------------------------------------------------
    | Niveau de journalisation
    |--------------------------------------------------------------------------
    |
    | Par exemple : "debug", "info", "notice", "warning", "error", "critical"
    |
    */
    'log_level' => getenv('LOG_LEVEL') ?: 'warning',

    /*
    |--------------------------------------------------------------------------
    | Configuration Mail
    |--------------------------------------------------------------------------
    |
    | Paramètres SMTP pour EmailService
    |
    */
    'mail' => [
        'host'       => getenv('MAIL_HOST'),
        'port'       => getenv('MAIL_PORT'),
        'username'   => getenv('MAIL_USERNAME'),
        'password'   => getenv('MAIL_PASSWORD'),
        'encryption' => getenv('MAIL_ENCRYPTION') ?: 'tls',
        'from'       => [
            'address' => getenv('MAIL_FROM_ADDRESS') ?: 'no-reply@localhost',
            'name'    => getenv('MAIL_FROM_NAME')    ?: 'App-Soutenance',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration JWT
    |--------------------------------------------------------------------------
    |
    | Secret et options pour JWT via firebase/php-jwt
    |
    */
    'jwt' => [
        'secret' => getenv('JWT_SECRET') ?: 'ChangeMeInProduction',
        'algo'   => getenv('JWT_ALGO')   ?: 'HS256',
        'ttl'    => getenv('JWT_TTL')    ?: 3600,
    ],

];
