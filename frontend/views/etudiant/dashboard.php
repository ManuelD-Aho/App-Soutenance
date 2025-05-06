<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation Étudiant</title>
    <!-- Liens vers une feuille CSS (externe ou CDN comme Tailwind ou Bootstrap) -->
    <link rel="stylesheet" href="../../css/dashEtudiants.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="header">
    <?php include_once '../composants/header.php'; ?>
</div>
<div class="container">


    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <span>MENU</span>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li class="menu-item"><a href="#"><i class="fas fa-home icone-menu"></i> Accueil</a></li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-user-graduate icone-menu"></i> Étudiants <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Liste des étudiants</a></li>
                        <li><a href="#">Ajouter un étudiant</a></li>
                        <li><a href="#">Recherche</a></li>
                        <li><a href="#">Statistiques</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-chart-bar icone-menu"></i> Notes <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Saisie des notes</a></li>
                        <li><a href="#">Bulletins</a></li>
                        <li><a href="#">Relevés</a></li>
                        <li><a href="#">Validation des UE</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-book icone-menu"></i> Cours <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Liste des cours</a></li>
                        <li><a href="#">Planning</a></li>
                        <li><a href="#">Matières</a></li>
                        <li><a href="#">Professeurs</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-cogs icone-menu"></i> Administration <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Utilisateurs</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li><a href="#">Années académiques</a></li>
                        <li><a href="#">Établissements</a></li>
                    </ul>
                </li>
                <li class="menu-item"><a href="#"><i class="fas fa-file-alt icone-menu"></i> Rapports</a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-question-circle icone-menu"></i> Aide</a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-sign-out-alt icone-menu"></i> Déconnexion</a></li>
            </ul>
        </nav>
    </div>

    <button id="sidebar-toggle" class="sidebar-toggle">
        <span class="arrow-icon">◀</span>
    </button>

    <div id="main-content" class="main-content">
        <div class="header-content">
            <h1 class="titre-page">ÉVALUATION ÉTUDIANT</h1>
            <div class="annee-academique">Année académique: 2024-2025</div>
        </div>

        <div class="info-etudiant">
            <div class="form-group num-etudiant">
                <label for="nom">N°Etudiant</label>
                <select id="numetudiant" name="numetudiant" class="select">
                    <option value="option1">CI0125877899</option>
                    <option value="option2">CI0146877739</option>
                    <option value="option3">CI0123431920</option>
                </select>
            </div>
            <div class="form-group nom">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'étudiant">
            </div>
            <div class="form-group prenom">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom de l'étudiant">
            </div>
            <div class="form-group promotion">
                <label for="promotion">Promotion</label>
                <input type="text" id="promotion" name="promotion" placeholder="Ex: L1, L2, L3...">
            </div>
        </div>

        <div class="notes-container">
            <h3 class="notes-header">Notes</h3>

            <div class="notes-grid">
                <div class="header-n">Matière</div>
                <div class="header-n">Semestre</div>
                <div class="header-n">UE</div>
                <div class="header-n">Moyenne</div>
                <div class="header-n">Crédit</div>
            </div>

            <div class="notes-row">
                <div>Mathématiques</div>
                <div>S1</div>
                <div>UE 1</div>
                <div contenteditable="true">15.5</div>
                <div>4</div>
            </div>

            <div class="notes-row">
                <div>Informatique</div>
                <div>S1</div>
                <div>UE 1</div>
                <div contenteditable="true">16.5</div>
                <div>4</div>
            </div>

            <div class="notes-row">
                <div>Anglais</div>
                <div>S1</div>
                <div>UE 2</div>
                <div contenteditable="true">14.0</div>
                <div>2</div>
            </div>

            <div class="moyenne-container">
                <div class="moyenne-label">Moyenne générale:</div>
                <div class="moyenne-value" id="moyenne-generale">15.5</div>
            </div>
        </div>

        <div class="btn-container">
            <button class="btn btn-secondary" id="annuler">Annuler</button>
            <button class="btn" id="valider">Valider</button>
        </div>

        <div class="historique">
            <h3 class="historique-title">Historique</h3>

            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Promotion</th>
                    <th>Validé</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Martin</td>
                    <td>Thomas</td>
                    <td>L2</td>
                    <td><input type="checkbox" class="checkbox-custom" checked></td>
                    <td><span class="status-tag success">Admis</span></td>
                </tr>
                <tr>
                    <td>Dupont</td>
                    <td>Marie</td>
                    <td>L3</td>
                    <td><input type="checkbox" class="checkbox-custom" checked></td>
                    <td><span class="status-tag success">Admise</span></td>
                </tr>
                <tr>
                    <td>Dubois</td>
                    <td>Lucas</td>
                    <td>L3</td>
                    <td><input type="checkbox" class="checkbox-custom"></td>
                    <td><span class="status-tag error">Ajourné</span></td>
                </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>

<!-- Script JavaScript à ajouter à la fin de votre body -->
<script src =" ../../js/dashEtudiants.js"></script>
</body>
</html>