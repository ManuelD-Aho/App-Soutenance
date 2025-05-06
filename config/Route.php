<?php
// config/Route.php
// -----------------------------------------------------------------------------
// Définitions de toutes les routes de l’application App-Soutenance
// Chaque route est un tableau associatif contenant :
//  • method     : GET|POST|PUT|DELETE
//  • uri        : chemin URI (possibilité de {param})
//  • controller : "NomController@action"
//  • middleware : liste de classes middleware à exécuter avant appel du contrôleur
//  • name       : identifiant de la route (utile pour URL generation / redirection)
//  • roles      : niveaux d’accès autorisés (clé dans config/auth.php “roles”)
//  • category   : catégorie pour redirection.php (etudiant, enseignant, etc.)
//  • tags       : liste de tags pour faciliter la recherche dans le code
//  • description: description courte pour infobulle
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// Définitions de toutes les routes de l’application App-Soutenance
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
        'description' => 'Gestion niveaux d’étude'
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
        'tags' => ['emails', 'templates'],
        'description' => 'Gestion templates emails'
    ],

    // -- Rapports problématiques
    [
        'method' => 'GET',
        'uri' => '/administration/rapports-problematiques',
        'controller' => 'AdminController@problematicReports',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.reports.problematic',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['reports', 'problematic'],
        'description' => 'Rapports bloqués / exception'
    ],

    // -------------------------------------------------------------------------
    // Administration Scolarité (N4a)
    // -------------------------------------------------------------------------
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
        'controller' => 'AdminController@scolariteInscriptions',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.inscriptions',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'inscriptions'],
        'description' => 'Gestion inscriptions'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/evaluations',
        'controller' => 'AdminController@scolariteEvaluations',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.evaluations',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'evaluations'],
        'description' => 'Gestion évaluations'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/parcours',
        'controller' => 'AdminController@scolariteParcours',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.parcours',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'parcours'],
        'description' => 'Suivi parcours étudiants'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/attestations',
        'controller' => 'AdminController@scolariteAttestations',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.attestations',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'attestations'],
        'description' => 'Génération attestations'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/scolarite/statistiques',
        'controller' => 'AdminController@scolariteStatistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.scolarite.statistics',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['scolarite', 'statistics'],
        'description' => 'Statistiques scolarité'
    ],

    // -------------------------------------------------------------------------
    // Administration Conformité (N4b)
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/administration/conformite/dashboard',
        'controller' => 'AdminController@conformiteDashboard',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.conformite.dashboard',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'dashboard'],
        'description' => 'Tableau de bord conformité'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/conformite/verification/{id}',
        'controller' => 'AdminController@showVerificationForm',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.conformite.verify.form',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'verification', 'form'],
        'description' => 'Formulaire vérification dossier'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/conformite/verification/{id}',
        'controller' => 'AdminController@verify',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware', 'XssMiddleware'],
        'name' => 'admin.conformite.verify.submit',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'verification', 'submit'],
        'description' => 'Marquer conforme/incomplet'
    ],
    [
        'method' => 'POST',
        'uri' => '/administration/conformite/transfert-commission',
        'controller' => 'AdminController@transferToCommission',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware', 'CsrfMiddleware'],
        'name' => 'admin.conformite.transfer',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'transfer', 'commission'],
        'description' => 'Transférer dossiers conformes'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/conformite/relances',
        'controller' => 'AdminController@autoReminders',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.conformite.reminders',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'reminders', 'auto'],
        'description' => 'Relances automatiques'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/conformite/checklist',
        'controller' => 'AdminController@checklist',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.conformite.checklist',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'checklist'],
        'description' => 'Liste contrôle conformité'
    ],
    [
        'method' => 'GET',
        'uri' => '/administration/conformite/statistiques',
        'controller' => 'AdminController@conformiteStatistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'admin.conformite.statistics',
        'roles' => ['ADM'],
        'category' => 'administration',
        'tags' => ['conformite', 'statistics'],
        'description' => 'Statistiques conformité'
    ],

    // -------------------------------------------------------------------------
    // Audit & Reporting
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/audit/journal',
        'controller' => 'AuditController@journal',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.journal',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['audit', 'journal'],
        'description' => 'Consultation logs'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/statistiques',
        'controller' => 'AuditController@statistics',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.statistics',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['audit', 'statistics'],
        'description' => 'KPI et graphiques'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/exports',
        'controller' => 'AuditController@exports',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.exports',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['audit', 'exports'],
        'description' => 'Export données audit'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/alertes',
        'controller' => 'AuditController@alertsConfig',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.alerts',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['audit', 'alerts'],
        'description' => 'Configuration seuils alertes'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/recherche',
        'controller' => 'AuditController@search',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.search',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['audit', 'search'],
        'description' => 'Recherche avancée journal'
    ],

    // -- Rapports analytiques prédéfinis
    [
        'method' => 'GET',
        'uri' => '/audit/rapports/performance-workflow',
        'controller' => 'AuditController@reportPerformanceWorkflow',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.report.performance',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['report', 'performance', 'workflow'],
        'description' => 'Performance processus'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/rapports/activite-utilisateurs',
        'controller' => 'AuditController@reportUserActivity',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.report.activity',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['report', 'activity', 'users'],
        'description' => 'Activité utilisateurs'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/rapports/tendances-validation',
        'controller' => 'AuditController@reportValidationTrends',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.report.trends',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['report', 'trends', 'validation'],
        'description' => 'Tendances validation/rejet'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/rapports/charge-commission',
        'controller' => 'AuditController@reportCommissionLoad',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.report.commission_load',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['report', 'commission', 'load'],
        'description' => 'Charge commission'
    ],
    [
        'method' => 'GET',
        'uri' => '/audit/rapports/temps-traitement',
        'controller' => 'AuditController@reportProcessingTime',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'audit.report.processing_time',
        'roles' => ['ADM'],
        'category' => 'audit',
        'tags' => ['report', 'processing', 'time'],
        'description' => 'Temps moyen traitement'
    ],

    // -------------------------------------------------------------------------
    // Vues Rapports partagés
    // -------------------------------------------------------------------------
    [
        'method' => 'GET',
        'uri' => '/rapports',
        'controller' => 'RapportController@listAll',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'rapports.list',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'rapports',
        'tags' => ['rapports', 'list', 'view'],
        'description' => 'Liste générique rapports'
    ],
    [
        'method' => 'GET',
        'uri' => '/rapports/{id}',
        'controller' => 'RapportController@show',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'rapports.details',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'rapports',
        'tags' => ['rapport', 'details', 'view'],
        'description' => 'Détails rapport partagé'
    ],
    [
        'method' => 'GET',
        'uri' => '/rapports/{id}/historique',
        'controller' => 'RapportController@history',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'rapports.history',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'rapports',
        'tags' => ['rapport', 'history'],
        'description' => 'Historique modifications'
    ],
    [
        'method' => 'GET',
        'uri' => '/rapports/{id}/commentaires',
        'controller' => 'RapportController@comments',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'rapports.comments',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'rapports',
        'tags' => ['rapport', 'comments'],
        'description' => 'Commentaires rapport'
    ],
    [
        'method' => 'GET',
        'uri' => '/rapports/{id}/fichiers',
        'controller' => 'RapportController@attachments',
        'middleware' => ['JwtAuthMiddleware', 'RoleMiddleware'],
        'name' => 'rapports.attachments',
        'roles' => ['ETU', 'ENS', 'COM', 'ADM'],
        'category' => 'rapports',
        'tags' => ['rapport', 'attachments'],
        'description' => 'Pièces jointes du rapport'
    ],

];
