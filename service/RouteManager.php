<?php
declare(strict_types=1);

namespace App\Service;

/**
 * Gestionnaire de routes - Charge et centralise toutes les routes de l'application
 */
class RouteManager
{
    /**
     * Collection de toutes les routes de l'application
     * @var array
     */
    private array $routes = [];

    /**
     * Dossier contenant les définitions de routes
     * @var string
     */
    private string $routesDirectory;

    /**
     * Constructeur
     *
     * @param string $routesDirectory Chemin vers le dossier contenant les fichiers de routes
     */
    public function __construct(string $routesDirectory)
    {
        $this->routesDirectory = $routesDirectory;
    }

    /**
     * Charge toutes les définitions de routes depuis le dossier des routes
     *
     * @return self
     */
    public function loadRoutes(): self
    {
        $this->routes = [];
        
        // Si le répertoire de routes n'existe pas, on utilise le fichier Route.php existant
        if (!is_dir($this->routesDirectory)) {
            $this->routes = require dirname(__DIR__) . '/config/Route.php';
            return $this;
        }
        
        // Parcourir tous les fichiers de route
        foreach (glob($this->routesDirectory . '/*.php') as $routeFile) {
            $routeSegment = require $routeFile;
            
            // Vérifier que le fichier retourne bien un tableau
            if (!is_array($routeSegment)) {
                continue;
            }
            
            // Fusionner avec les routes existantes
            $this->routes = array_merge($this->routes, $routeSegment);
        }
        
        return $this;
    }

    /**
     * Retourne toutes les routes chargées
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Retourne les routes filtrées par un critère
     * 
     * @param string $key Clé du critère (ex: 'roles', 'category', etc.)
     * @param mixed $value Valeur recherchée
     * @return array Routes filtrées
     */
    public function getRoutesByFilter(string $key, $value): array
    {
        return array_filter($this->routes, function($route) use ($key, $value) {
            // Pour les tableaux (comme 'roles'), vérifier si la valeur est présente
            if (isset($route[$key]) && is_array($route[$key])) {
                return in_array($value, $route[$key]);
            }
            
            // Pour les valeurs simples
            return isset($route[$key]) && $route[$key] === $value;
        });
    }

    /**
     * Recherche une route par son nom
     *
     * @param string $name Nom de la route
     * @return array|null Route trouvée ou null
     */
    public function getRouteByName(string $name): ?array
    {
        foreach ($this->routes as $route) {
            if (isset($route['name']) && $route['name'] === $name) {
                return $route;
            }
        }
        
        return null;
    }
}