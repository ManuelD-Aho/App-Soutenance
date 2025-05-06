<?php
declare(strict_types=1);

// 1) Autoload de Composer
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// 2) Chargement des variables d’environnement (via phpdotenv si présent)
if (class_exists(Dotenv::class)) {
    Dotenv::createImmutable(__DIR__ . '/..')->load();
}

// 3) Configuration globale
require __DIR__ . '/../config/app.php';           // app.php : clés, debug, etc.
require __DIR__ . '/../config/Database.php';      // Database.php : PDO connection
require __DIR__ . '/../config/auth.php';          // auth.php : JWT / session settings
require __DIR__ . '/../config/QueryBuilder.php';  // QueryBuilder helper
require __DIR__ . '/../config/Repository.php';    // Base Repository

// 4) Chargement des définitions de routes
$routes = require __DIR__ . '/../config/Route.php';

// 5) Dispatcher principal
require __DIR__ . '/../config/Routage.php';
