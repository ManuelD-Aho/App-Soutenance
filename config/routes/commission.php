<?php
// config/routes/commission.php
// -----------------------------------------------------------------------------
// Définition des routes liées à la commission et son président
// -----------------------------------------------------------------------------

return [
    // -------------------------------------------------------------------------
    // Commission (N3)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/commission/file-attente',
        'controller' => 'CommissionController@queue',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.queue',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['commission', 'queue', 'view'],
        'description' => 'Rapports en attente'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/deliberation/{id}',
        'controller' => 'CommissionController@showDeliberationForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware'],
        'name' => 'commission.deliberation.form',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['deliberation', 'form'],
        'description' => 'Formulaire délibération'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/deliberation/{id}',
        'controller' => 'CommissionController@deliberer',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'commission.deliberation.submit',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['deliberation', 'submit'],
        'description' => 'Envoyer décision'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/attribution/{id}',
        'controller' => 'CommissionController@showAttributionForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.attribution.form',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['attribution', 'form'],
        'description' => 'Formulaire attribution jury/encadrant'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/attribution/{id}',
        'controller' => 'CommissionController@attribution',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'commission.attribution.submit',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['attribution', 'submit'],
        'description' => 'Enregistrer attribution'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/planification/{id}',
        'controller' => 'CommissionController@showPlanningForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.planning.form',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['planning', 'form'],
        'description' => 'Formulaire planification soutenance'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/planification/{id}',
        'controller' => 'CommissionController@planifier',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'commission.planning.submit',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['planning', 'submit'],
        'description' => 'Enregistrer date soutenance'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/generation-pv/{id}',
        'controller' => 'CommissionController@showGeneratePvForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.pv.form',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['pv', 'generate', 'form'],
        'description' => 'Formulaire génération PV'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/generation-pv/{id}',
        'controller' => 'CommissionController@generatePv',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware'],
        'name' => 'commission.pv.generate',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['pv', 'generate', 'submit'],
        'description' => 'Générer PV officiel'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/signature/{pvId}',
        'controller' => 'CommissionController@showSignatureForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.pv.signature.form',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['pv', 'signature', 'form'],
        'description' => 'Formulaire signature électronique'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/signature/{pvId}',
        'controller' => 'CommissionController@signPv',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware', 'CsrfMiddleware'],
        'name' => 'commission.pv.signature.submit',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['pv', 'signature', 'submit'],
        'description' => 'Signer PV'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/decisions-anterieures',
        'controller' => 'CommissionController@pastDecisions',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.decisions.past',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['decisions', 'history'],
        'description' => 'Historique décisions'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/mes-decisions',
        'controller' => 'CommissionController@myDecisions',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.decisions.mine',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['decisions', 'mine'],
        'description' => 'Mes décisions'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/statistiques',
        'controller' => 'CommissionController@statistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CommissionMiddleware'],
        'name' => 'commission.statistics',
        'roles' => ['COM'],
        'category' => 'commission',
        'tags' => ['statistics', 'commission'],
        'description' => 'Statistiques commission'
    ],

    // -------------------------------------------------------------------------
    // Président Commission (N4c)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/commission/president/dashboard',
        'controller' => 'CommissionController@presidentDashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'commission.president.dashboard',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['president', 'dashboard'],
        'description' => 'Tableau de bord président'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/president/validation-finale/{id}',
        'controller' => 'CommissionController@showFinalValidationForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'commission.president.validation.form',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['validation', 'final', 'form'],
        'description' => 'Formulaire validation finale'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/president/validation-finale/{id}',
        'controller' => 'CommissionController@finalValidation',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'commission.president.validation.submit',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['validation', 'final', 'submit'],
        'description' => 'Valider décision finale'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/president/reassignation/{id}',
        'controller' => 'CommissionController@showReassignForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'commission.president.reassign.form',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['reassignation', 'form'],
        'description' => 'Formulaire réassignation'
    ],
    [
        'method' => 'POST',
        'uri' => '/commission/president/reassignation/{id}',
        'controller' => 'CommissionController@reassign',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'commission.president.reassign.submit',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['reassignation', 'submit'],
        'description' => 'Réassigner dossier'
    ],
    [
        'method' => 'GET',
        'uri' => '/commission/president/statistiques-avancees',
        'controller' => 'CommissionController@advancedStatistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'commission.president.stats.advanced',
        'roles' => ['ADM'],
        'category' => 'commission',
        'tags' => ['statistics', 'advanced'],
        'description' => 'Statistiques avancées'
    ],
];