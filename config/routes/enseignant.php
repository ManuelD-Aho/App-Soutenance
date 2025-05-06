<?php
// config/routes/enseignant.php
// -----------------------------------------------------------------------------
// Définition des routes liées aux enseignants
// -----------------------------------------------------------------------------

return [
    // -------------------------------------------------------------------------
    // Enseignant-Visiteur (N2)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/enseignant/dashboard',
        'controller' => 'EnseignantController@dashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.dashboard',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['enseignant', 'dashboard', 'view'],
        'description' => 'Tableau de bord enseignant'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/rapports',
        'controller' => 'EnseignantController@listRapports',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.rapports.list',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['rapports', 'list', 'view'],
        'description' => 'Liste rapports validés'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/rapport/{id}/consultation',
        'controller' => 'EnseignantController@consultation',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.rapport.consult',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['rapport', 'consultation', 'view'],
        'description' => 'Visualisation PDF'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/recherche',
        'controller' => 'EnseignantController@search',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.search',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['search', 'rapports'],
        'description' => 'Recherche avancée mémoires'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/specialite',
        'controller' => 'EnseignantController@filterSpecialite',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.filter.specialite',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['filter', 'specialite'],
        'description' => 'Filtrer par spécialité'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/profile',
        'controller' => 'EnseignantController@showProfile',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.profile.view',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['profile', 'view'],
        'description' => 'Profil enseignant'
    ],
    [
        'method' => 'POST',
        'uri' => '/enseignant/profile',
        'controller' => 'EnseignantController@updateProfile',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'enseignant.profile.update',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['profile', 'update'],
        'description' => 'Mettre à jour profil'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/calendrier',
        'controller' => 'EnseignantController@calendar',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.calendar',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['calendar', 'view'],
        'description' => 'Calendrier soutenances'
    ],
    [
        'method' => 'GET',
        'uri' => '/enseignant/statistiques',
        'controller' => 'EnseignantController@statistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'enseignant.statistics',
        'roles' => ['ENS'],
        'category' => 'enseignant',
        'tags' => ['statistics', 'view'],
        'description' => 'Statistiques lecture seule'
    ],
];