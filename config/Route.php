<?php
// config/Route.php
// -----------------------------------------------------------------------------
// Point d'entrée centralisé pour les routes de l'application App-Soutenance
// 
// Ce fichier charge maintenant les routes depuis les sous-fichiers du dossier config/routes/
// Chaque route est un tableau associatif contenant :
//  • method     : GET|POST|PUT|DELETE
//  • uri        : chemin URI (possibilité de {param})
//  • controller : "NomController@action"
//  • middleware : liste de classes middleware à exécuter avant appel du contrôleur
//  • name       : identifiant de la route (utile pour URL generation / redirection)
//  • roles      : niveaux d'accès autorisés (clé dans config/auth.php "roles")
//  • category   : catégorie pour redirection.php (etudiant, enseignant, etc.)
//  • tags       : liste de tags pour faciliter la recherche dans le code
//  • description: description courte pour infobulle
// -----------------------------------------------------------------------------

use App\Service\RouteManager;

// Initialiser le gestionnaire de routes avec le dossier contenant les fichiers de routes
$routeManager = new RouteManager(__DIR__ . '/routes');

// Charger toutes les routes depuis les fichiers dans le dossier config/routes/
$routeManager->loadRoutes();

// Retourner toutes les routes chargées
return $routeManager->getRoutes();
