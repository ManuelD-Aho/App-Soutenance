<?php
declare(strict_types=1);

// Config/Routage.php
namespace Config;

use Throwable;

// 1) Chargement de l’autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// 2) Chargement des définitions de routes
$routes = require __DIR__ . '/Route.php';

// 3) Récupération de la méthode HTTP et de l’URI
$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 4) Dispatch
$router = new Routage($routes);
try {
    $router->dispatch($method, $uri);
} catch (HttpException $e) {
    http_response_code($e->getStatusCode());
    include __DIR__ . '/../Frontend/Errors/' . $e->getStatusCode() . '.php';
} catch (Throwable $e) {
    http_response_code(500);
    include __DIR__ . '/../Frontend/Views/Errors/500.php';
}


/**
 * Classe Router : matching et exécution
 */
class Routage
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Trouve la première route correspondante et l’exécute
     *
     * @throws HttpException si pas de route ou middleware rejette
     */
    public function dispatch(string $method, string $uri): void
    {
        foreach ($this->routes as $route) {
            if (strtoupper($route['method']) !== strtoupper($method)) {
                continue;
            }
            $pattern = $this->toRegex($route['uri']);
            if (!preg_match($pattern, $uri, $matches)) {
                continue;
            }

            // Extraction des paramètres nommés
            $params = [];
            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $params[$key] = $value;
                }
            }

            $this->run($route, $params);
            return;
        }

        throw new HttpException(404, 'Route not found');
    }

    /**
     * Convertit une URI à {param} en regex nommée
     */
    private function toRegex(string $uri): string
    {
        $r = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $uri);
        return '#^' . $r . '$#';
    }

    /**
     * Exécute les middlewares puis le controller#action
     *
     * @throws HttpException|Throwable
     */
    private function run(array $route, array $params): void
    {
        // --- a) Middlewares ---
        foreach ($route['middleware'] ?? [] as $mw) {
            // PSR-4 : App\Middleware\NomMiddleware
            $class = "App\\Middleware\\{$mw}";
            if (!class_exists($class)) {
                throw new HttpException(500, "Middleware introuvable : {$class}");
            }
            $instance = new $class();
            // handle() lance HttpException(403) si refusé
            $instance->handle();
        }

        // --- b) Controller et action ---
        [$ctrlShort, $action] = explode('@', $route['controller'], 2);

        // On s’attend à un FQCN, mais si c’est un raccourci, on préfixe
        $controllerClass = str_contains($ctrlShort, '\\')
            ? $ctrlShort
            : "App\\Controllers\\{$ctrlShort}";

        if (!class_exists($controllerClass)) {
            throw new HttpException(500, "Controller introuvable : {$controllerClass}");
        }
        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            throw new HttpException(500, "Méthode {$action} introuvable dans {$controllerClass}");
        }

        // --- c) Appel de l’action ---
        call_user_func_array([$controller, $action], $params);
    }
}


/**
 * Exception dédiée aux erreurs HTTP (403,404...)
 */
class HttpException extends \Exception
{
    private int $statusCode;

    public function __construct(int $statusCode, string $message = '')
    {
        parent::__construct($message, $statusCode);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
