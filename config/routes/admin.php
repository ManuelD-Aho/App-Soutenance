<?php
// config/routes/admin.php
// -----------------------------------------------------------------------------
// Définition des routes liées à l'administration
// -----------------------------------------------------------------------------

return [
    // -------------------------------------------------------------------------
    // Administration (N4)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/administration/dashboard',
        'controller' => 'AdminController@dashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.dashboard',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['admin', 'dashboard'],
        'description' => 'Tableau de bord administration'
    ],

    // -- Utilisateurs techniques
    [
        'method' => 'GET',
        'uri' => '/administration/utilisateurs/etudiants',
        'controller' => 'AdminController@listEtudiants',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.users.students',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'students', 'list'],
        'description' => 'CRUD étudiants'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/utilisateurs/enseignants',
        'controller' => 'AdminController@listEnseignants',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.users.teachers',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'teachers', 'list'],
        'description' => 'CRUD enseignants'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/utilisateurs/personnel',
        'controller' => 'AdminController@listPersonnel',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.users.staff',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'staff', 'list'],
        'description' => 'CRUD personnel administratif'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/utilisateurs/import',
        'controller' => 'AdminController@importUsers',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.users.import',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'import'],
        'description' => 'Import CSV utilisateurs'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/utilisateurs/export',
        'controller' => 'AdminController@exportUsers',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.users.export',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'export'],
        'description' => 'Export utilisateurs'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/utilisateurs/{id}/reset-password',
        'controller' => 'AdminController@resetPassword',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.users.reset_password',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'reset_password'],
        'description' => 'Réinitialiser mot de passe'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/utilisateurs/logs-connexion',
        'controller' => 'AdminController@loginLogs',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.users.login_logs',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['users', 'logs', 'login'],
        'description' => 'Journal connexions'
    ],

    // -- Référentiels académiques
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/ue-ecue',
        'controller' => 'ReferentielController@manageUeEcue',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.ue_ecue',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'ue', 'ecue'],
        'description' => 'Gestion UE/ECUE'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/fonctions',
        'controller' => 'ReferentielController@manageFonctions',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.fonctions',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'fonctions'],
        'description' => 'Gestion fonctions'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/grades',
        'controller' => 'ReferentielController@manageGrades',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.grades',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'grades'],
        'description' => 'Gestion grades'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/specialites',
        'controller' => 'ReferentielController@manageSpecialites',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.specialites',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'specialites'],
        'description' => 'Gestion spécialités'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/niveaux-etude',
        'controller' => 'ReferentielController@manageNiveaux',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.niveaux',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'niveaux_etude'],
        'description' => 'Gestion niveaux d\'étude'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/annees-academiques',
        'controller' => 'ReferentielController@manageAnnees',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.annees',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'annees'],
        'description' => 'Gestion années académiques'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/referentiels/entreprises',
        'controller' => 'ReferentielController@manageEntreprises',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.ref.entreprises',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['referentiel', 'entreprises'],
        'description' => 'Gestion entreprises'
    ],

    // -- Configuration commission
    [
        'method' => 'GET',
        'uri' => '/administration/commission',
        'controller' => 'AdminController@showCommissionConfig',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.commission.config',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['commission', 'config'],
        'description' => 'Configurer membres commission'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/commission',
        'controller' => 'AdminController@saveCommissionConfig',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.commission.save',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['commission', 'config', 'save'],
        'description' => 'Enregistrer config commission'
    ],

    // -- Workflow global
    [
        'method' => 'GET',
        'uri' => '/administration/workflow',
        'controller' => 'AdminController@workflowSettings',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.workflow.settings',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['workflow', 'settings'],
        'description' => 'Paramètres transitions workflow'
    ],

    // -- Système général
    [
        'method' => 'GET',
        'uri' => '/administration/systeme',
        'controller' => 'AdminController@systemSettings',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.system.settings',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['system', 'settings'],
        'description' => 'Paramètres généraux système'
    ],

    // -- Sauvegarde / restauration
    [
        'method' => 'GET',
        'uri' => '/administration/backup',
        'controller' => 'AdminController@showBackup',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.backup',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['backup', 'restore'],
        'description' => 'Sauvegarde / restauration'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/backup/run',
        'controller' => 'AdminController@runBackup',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.backup.run',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['backup', 'run'],
        'description' => 'Lancer sauvegarde'
    ],

    // -- Maintenance et diagnostics
    [
        'method' => 'GET',
        'uri' => '/administration/maintenance',
        'controller' => 'AdminController@maintenanceMode',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.maintenance',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['maintenance', 'mode'],
        'description' => 'Mode maintenance'
    ],

    // -- Templates emails
    [
        'method' => 'GET',
        'uri' => '/administration/emails',
        'controller' => 'AdminController@emailTemplates',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.emails.templates',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['emails', 'templates', 'gestion'],
        'description' => 'Gestion templates emails'
    ],

    // -- Routes supplémentaires pour compléter
    [
        'method' => 'GET',
        'uri' => '/administration/rapports-problematiques',
        'controller' => 'AdminController@problemReports',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.reports.problems',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['rapports', 'problemes'],
        'description' => 'Rapports bloqués / exception'
    ],

    // -- Administration Scolarité (N4a)
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/dashboard',
        'controller' => 'AdminController@scolariteDashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.dashboard',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'dashboard'],
        'description' => 'Tableau de bord scolarité'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/inscriptions',
        'controller' => 'AdminController@manageInscriptions',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.inscriptions',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'inscriptions'],
        'description' => 'Gestion inscriptions'
    ]
];