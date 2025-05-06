<?php
// config/routes/etudiant.php
// -----------------------------------------------------------------------------
// Définition des routes liées aux étudiants
// -----------------------------------------------------------------------------

return [
    // -------------------------------------------------------------------------
    // Étudiant (N1)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/etudiant/dashboard',
        'controller' => 'EtudiantController@dashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.dashboard',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['etudiant', 'dashboard', 'view'],
        'description' => 'Tableau de bord étudiant'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/rapport/new',
        'controller' => 'EtudiantController@showCreateForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'etudiant.rapport.new',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'create', 'form'],
        'description' => 'Formulaire création rapport'
    ],
    [
        'method' => 'POST',
        'uri' => '/etudiant/rapport',
        'controller' => 'EtudiantController@create',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'etudiant.rapport.create',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'create', 'save'],
        'description' => 'Enregistrement rapport'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/rapport/{id}/edit',
        'controller' => 'EtudiantController@showEditForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'etudiant.rapport.edit',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'edit', 'form'],
        'description' => 'Formulaire modification rapport'
    ],
    [
        'method' => 'POST',
        'uri' => '/etudiant/rapport/{id}',
        'controller' => 'EtudiantController@update',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'etudiant.rapport.update',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'edit', 'save'],
        'description' => 'Mise à jour rapport'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/rapport/{id}/televersement',
        'controller' => 'EtudiantController@showUploadForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'etudiant.rapport.upload.form',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'upload', 'form'],
        'description' => 'Formulaire téléversement'
    ],
    [
        'method' => 'POST',
        'uri' => '/etudiant/rapport/{id}/televersement',
        'controller' => 'EtudiantController@uploadFiles',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'ValidationService'],
        'name' => 'etudiant.rapport.upload',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'upload', 'process'],
        'description' => 'Traitement téléversement'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/suivi',
        'controller' => 'EtudiantController@suivi',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.suivi',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['workflow', 'history'],
        'description' => 'Suivi des états'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/rapport/{id}',
        'controller' => 'EtudiantController@details',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.rapport.details',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'view'],
        'description' => 'Détails rapport'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/rapport/{id}/commentaires',
        'controller' => 'EtudiantController@commentaires',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.rapport.comments',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['rapport', 'comments', 'view'],
        'description' => 'Commentaires rapport'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/profile',
        'controller' => 'EtudiantController@showProfile',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.profile.view',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['profile', 'view'],
        'description' => 'Voir profil'
    ],
    [
        'method' => 'POST',
        'uri' => '/etudiant/profile',
        'controller' => 'EtudiantController@updateProfile',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'etudiant.profile.update',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['profile', 'update'],
        'description' => 'Modifier profil'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/messages',
        'controller' => 'EtudiantController@messages',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.messages',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['messages', 'view'],
        'description' => 'Messagerie interne'
    ],
    [
        'method' => 'GET',
        'uri' => '/etudiant/historique',
        'controller' => 'EtudiantController@historique',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'etudiant.history',
        'roles' => ['ETU'],
        'category' => 'etudiant',
        'tags' => ['history', 'actions'],
        'description' => 'Historique actions'
    ],
];