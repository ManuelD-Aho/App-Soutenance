<?php
// config/routes/auth.php
// -----------------------------------------------------------------------------
// Définition des routes liées à l'authentification
// -----------------------------------------------------------------------------

return [
    // -------------------------------------------------------------------------
    // Authentification (VIS)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/login',
        'controller' => 'AuthController@showLoginForm',
        'middleware' => ['CsrfMiddleware', 'XssMiddleware'],
        'name' => 'auth.login.form',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'login', 'form'],
        'description' => 'Formulaire de connexion'
    ],
    [
        'method' => 'POST',
        'uri' => '/login',
        'controller' => 'AuthController@login',
        'middleware' => ['CsrfMiddleware', 'XssMiddleware'],
        'name' => 'auth.login.submit',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'login', 'submit'],
        'description' => 'Traitement de la connexion'
    ],
    [
        'method' => 'GET',
        'uri' => '/logout',
        'controller' => 'AuthController@logout',
        'middleware' => ['JwtAuthMiddleware'],
        'name' => 'auth.logout',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'auth',
        'tags' => ['auth', 'logout'],
        'description' => 'Déconnexion'
    ],
    [
        'method' => 'GET',
        'uri' => '/password/reset',
        'controller' => 'AuthController@showResetForm',
        'middleware' => ['CsrfMiddleware'],
        'name' => 'auth.password.request',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'password', 'reset', 'form'],
        'description' => 'Formulaire de réinitialisation mot de passe'
    ],
    [
        'method' => 'POST',
        'uri' => '/password/email',
        'controller' => 'AuthController@sendResetLink',
        'middleware' => ['CsrfMiddleware'],
        'name' => 'auth.password.email',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'password', 'email'],
        'description' => 'Envoi lien de réinitialisation'
    ],
    [
        'method' => 'GET',
        'uri' => '/password/reset/{token}',
        'controller' => 'AuthController@showNewPasswordForm',
        'middleware' => ['CsrfMiddleware'],
        'name' => 'auth.password.reset',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'password', 'reset', 'token'],
        'description' => 'Formulaire nouveau mot de passe'
    ],
    [
        'method' => 'POST',
        'uri' => '/password/reset',
        'controller' => 'AuthController@resetPassword',
        'middleware' => ['CsrfMiddleware', 'XssMiddleware'],
        'name' => 'auth.password.update',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'password', 'update'],
        'description' => 'Traitement de la réinitialisation'
    ],
    [
        'method' => 'GET',
        'uri' => '/first-login',
        'controller' => 'AuthController@showFirstLoginForm',
        'middleware' => ['CsrfMiddleware', 'XssMiddleware'],
        'name' => 'auth.first_login.form',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'first_login', 'form'],
        'description' => 'Premier accès : définition du mot de passe'
    ],
    [
        'method' => 'POST',
        'uri' => '/first-login',
        'controller' => 'AuthController@firstLogin',
        'middleware' => ['CsrfMiddleware', 'XssMiddleware'],
        'name' => 'auth.first_login.submit',
        'roles' => ['VIS'],
        'category' => 'auth',
        'tags' => ['auth', 'first_login', 'submit'],
        'description' => 'Enregistrement du nouveau mot de passe'
    ],
    [
        'method' => 'GET',
        'uri' => '/locked',
        'controller' => 'AuthController@locked',
        'middleware' => [],
        'name' => 'auth.account.locked',
        'roles' => ['VIS', 'ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'auth',
        'tags' => ['auth', 'locked', 'account'],
        'description' => 'Compte verrouillé'
    ],
];