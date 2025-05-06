<?php
declare(strict_types=1);

// Page de navigation centralisée (tous les liens) organisée par tags

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Service\AuthService;
use App\Service\JwtService;
use App\Service\PermissionService;

// 1) Charger .env
Dotenv::createImmutable(__DIR__ . '/../')->load();

// 2) Authentifier l'utilisateur si JWT présent
$user = null;
if (!empty($_SERVER['HTTP_AUTHORIZATION'])
    && preg_match('/Bearer\s+(.+)$/i', $_SERVER['HTTP_AUTHORIZATION'], $m)
) {
    try {
        // instancier JwtService avec votre clé secrète
        $jwtSvc = new JwtService((string) ($_ENV['JWT_SECRET'] ?? 'changeme'));
        $authSvc = new AuthService($jwtSvc);
        $user = $authSvc->authenticate($m[1]);
    } catch (\Exception $e) {
        // token invalide → on reste en invité
        $user = null;
    }
}

// 3) Charger les définitions de routes
$routes = require __DIR__ . '/../config/Route.php';

// 4) Regrouper par tag et filtrer selon droits (si utilisateur authentifié)
$grouped = [];
foreach ($routes as $route) {
    // chaque route doit avoir une clé "tags" : tableau de chaînes
    foreach ($route['tags'] ?? [] as $tag) {
        // si restriction de rôle et user non autorisé, on saute
        if (!empty($route['roles']) && $user !== null) {
            if (!PermissionService::canAccessRoute($user, $route)) {
                continue;
            }
        }
        $grouped[$tag][] = $route;
    }
}
ksort($grouped);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation App-Soutenance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #333;
            --light-text: #fff;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-text);
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .user-status {
            background-color: var(--primary-color);
            color: var(--light-text);
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            display: inline-flex;
            align-items: center;
        }

        .user-status i {
            margin-right: 0.5rem;
        }

        .tag-section {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        h2 {
            background-color: var(--secondary-color);
            color: var(--light-text);
            padding: 0.8rem 1.5rem;
            text-transform: capitalize;
            font-weight: 500;
            margin: 0;
        }

        ul {
            list-style: none;
            padding: 1.2rem 1.5rem;
        }

        li {
            margin: 0.8rem 0;
        }

        a {
            text-decoration: none;
            color: var(--primary-color);
            display: inline-block;
            padding: 0.5rem 0;
            transition: all 0.3s;
            position: relative;
        }

        a:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }

        a:before {
            content: "→";
            margin-right: 8px;
            opacity: 0;
            transition: all 0.3s;
        }

        a:hover:before {
            opacity: 1;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .user-status {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="header-content">
        <h1>Navigation App-Soutenance</h1>
        <div class="user-status">
            <?php if ($user): ?>
                <i class="fas fa-user-check"></i> Connecté en tant que <strong><?= htmlspecialchars($user->role) ?></strong>
            <?php else: ?>
                <i class="fas fa-user-slash"></i> Non authentifié (affichage public)
            <?php endif ?>
        </div>
    </div>
</header>

<div class="container">
    <?php foreach ($grouped as $tag => $routesByTag): ?>
        <div class="tag-section">
            <h2><?= htmlspecialchars($tag) ?></h2>
            <ul>
                <?php foreach ($routesByTag as $r): ?>
                    <li>
                        <a href="<?= htmlspecialchars($r['uri']) ?>">
                            <?= htmlspecialchars($r['name']) ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endforeach ?>
</div>

<footer>
    &copy; <?= date('Y') ?> UFR MIAGE - Application de gestion des soutenances
</footer>
</body>
</html>