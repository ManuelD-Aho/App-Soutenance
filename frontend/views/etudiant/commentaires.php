<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation Étudiant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 100%;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            left: -250px;
        }

        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 250px;
            background-color: #3a539b;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            width: 25px;
            height: 50px;
            cursor: pointer;
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .sidebar-toggle.collapsed {
            left: 0;
        }

        .arrow-icon {
            transition: transform 0.3s ease;
        }

        .arrow-icon.flip {
            transform: rotate(180deg);
        }

        .sidebar-header {
            padding: 20px 15px;
            background-color: #1a2530;
            color: white;
            font-weight: bold;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-container {
            width: 100%;
        }

        .sidebar-menu {
            width: 100%;
        }

        .sidebar-menu ul {
            list-style: none;
        }

        .sidebar-menu .menu-item a {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #ecf0f1;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu .menu-item a:hover {
            background-color: #34495e;
            border-left: 3px solid #3498db;
        }

        .has-submenu {
            position: relative;
        }

        .submenu-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .submenu {
            display: none;
            background-color: #1a2530;
        }

        .submenu li a {
            padding-left: 30px;
            font-size: 0.95em;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .main-content.full-width {
            margin-left: 0;
        }

        .titre-page {
            color: #333;
            font-size: 24px;
        }

        .annee-academique {
            font-style: italic;
            color: #666;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-top: 20px;
            padding-left: 10px;
        }

        .info-etudiant {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .notes-container {
            margin-bottom: 30px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .notes-header {
            margin-bottom: 15px;
            font-weight: bold;
            color: #333;
        }

        .notes-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
        }

        .notes-grid .header {
            font-weight: bold;
            padding: 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .notes-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 10px;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .moyenne-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .moyenne-label {
            font-weight: bold;
            margin-right: 15px;
        }

        .moyenne-value {
            font-weight: bold;
            color: #3a539b;
        }

        .historique {
            margin-top: 40px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .historique-title {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f0f0f0;
        }

        .checkbox-custom {
            width: 20px;
            height: 20px;
            margin: 0 auto;
            display: block;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3a539b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2c3e50;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-toggle {
                left: 10px;
            }

            .sidebar-toggle.active {
                left: 260px;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <span>MENU</span>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li class="menu-item"><a href="#"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-user-graduate"></i> Étudiants <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Liste des étudiants</a></li>
                        <li><a href="#">Ajouter un étudiant</a></li>
                        <li><a href="#">Recherche</a></li>
                        <li><a href="#">Statistiques</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-chart-bar"></i> Notes <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Saisie des notes</a></li>
                        <li><a href="#">Bulletins</a></li>
                        <li><a href="#">Relevés</a></li>
                        <li><a href="#">Validation des UE</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-book"></i> Cours <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Liste des cours</a></li>
                        <li><a href="#">Planning</a></li>
                        <li><a href="#">Matières</a></li>
                        <li><a href="#">Professeurs</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#" class="submenu-toggle"><i class="fas fa-cogs"></i> Administration <span>▼</span></a>
                    <ul class="submenu">
                        <li><a href="#">Utilisateurs</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li><a href="#">Années académiques</a></li>
                        <li><a href="#">Établissements</a></li>
                    </ul>
                </li>
                <li class="menu-item"><a href="#"><i class="fas fa-file-alt"></i> Rapports</a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-question-circle"></i> Aide</a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
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
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="promotion">Promotion</label>
                <input type="text" id="promotion" name="promotion">
            </div>
            <div class="form-group">
                <label for="parcours">Parcours</label>
                <input type="text" id="parcours" name="parcours">
            </div>
        </div>

        <div class="notes-container">
            <h3 class="notes-header">Notes</h3>

            <div class="notes-grid">
                <div class="header">Matière</div>
                <div class="header">Semestre</div>
                <div class="header">UE</div>
                <div class="header">Moyenne</div>
                <div class="header">Crédit</div>
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
                    <td>Admis</td>
                </tr>
                <tr>
                    <td>Dupont</td>
                    <td>Marie</td>
                    <td>L3</td>
                    <td><input type="checkbox" class="checkbox-custom" checked></td>
                    <td>Admise</td>
                </tr>
                <tr>
                    <td>Dubois</td>
                    <td>Lucas</td>
                    <td>L3</td>
                    <td><input type="checkbox" class="checkbox-custom"></td>
                    <td>Ajourné</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="btn-container">
            <button class="btn" id="valider">Valider</button>
        </div>
    </div>
</div>

<script>
    // Fonction pour calculer la moyenne générale
    function calculerMoyenne() {
        const notes = document.querySelectorAll('.notes-row div:nth-child(4)');
        const credits = document.querySelectorAll('.notes-row div:nth-child(5)');

        let sommeNotesPonderees = 0;
        let sommeCredits = 0;

        for (let i = 0; i < notes.length; i++) {
            const note = parseFloat(notes[i].textContent);
            const credit = parseInt(credits[i].textContent);

            if (!isNaN(note) && !isNaN(credit)) {
                sommeNotesPonderees += note * credit;
                sommeCredits += credit;
            }
        }

        if (sommeCredits > 0) {
            const moyenne = sommeNotesPonderees / sommeCredits;
            document.getElementById('moyenne-generale').textContent = moyenne.toFixed(2);
        } else {
            document.getElementById('moyenne-generale').textContent = "N/A";
        }
    }

    // Recalculer la moyenne quand les notes sont modifiées
    const notesCells = document.querySelectorAll('.notes-row div:nth-child(4)');
    notesCells.forEach(cell => {
        cell.addEventListener('blur', calculerMoyenne);
        cell.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.blur();
            }
        });
    });

    // Gestion du menu latéral
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const arrowIcon = document.querySelector('.arrow-icon');

        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('full-width');
        sidebarToggle.classList.toggle('collapsed');
        arrowIcon.classList.toggle('flip');

        // Changer la direction de la flèche
        if (sidebar.classList.contains('collapsed')) {
            arrowIcon.textContent = '▶';
        } else {
            arrowIcon.textContent = '◀';
        }
    });

    // Sous-menus
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                this.querySelector('span').textContent = '▼';
            } else {
                // Fermer tous les autres sous-menus
                document.querySelectorAll('.submenu').forEach(menu => {
                    menu.style.display = 'none';
                });
                document.querySelectorAll('.submenu-toggle span').forEach(span => {
                    span.textContent = '▼';
                });
                submenu.style.display = 'block';
                this.querySelector('span').textContent = '▲';
            }
        });
    });

    // Bouton valider
    document.getElementById('valider').addEventListener('click', function() {
        // Récupérer les données du formulaire
        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const promotion = document.getElementById('promotion').value;

        // Vérifier si les champs obligatoires sont remplis
        if (!nom || !prenom || !promotion) {
            alert("Veuillez remplir tous les champs obligatoires");
            return;
        }

        // Simuler l'envoi des données
        alert("Évaluation enregistrée avec succès!");

        // En production, vous utiliseriez une requête AJAX pour envoyer les données au serveur
        // fetch('/api/evaluation', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //     },
        //     body: JSON.stringify({
        //         nom,
        //         prenom,
        //         promotion,
        //         moyenne: document.getElementById('moyenne-generale').textContent
        //     }),
        // })
        // .then(response => response.json())
        // .then(data => {
        //     console.log('Success:', data);
        //     alert("Évaluation enregistrée avec succès!");
        // })
        // .catch((error) => {
        //     console.error('Error:', error);
        //     alert("Une erreur est survenue lors de l'enregistrement");
        // });
    });

    // Initialisation au chargement de la page
    window.addEventListener('load', function() {
        // Calculer la moyenne au chargement
        calculerMoyenne();

        // Vérifier si on doit commencer avec le menu ouvert ou fermé (préférence utilisateur)
        // Pour cet exemple, nous commençons avec le menu ouvert
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const arrowIcon = document.querySelector('.arrow-icon');

        // Décommenter la ligne suivante pour commencer avec le menu fermé
        // sidebar.classList.add('collapsed');
        // mainContent.classList.add('full-width');
        // sidebarToggle.classList.add('collapsed');
        // arrowIcon.textContent = '▶';
    });
</script>
</body>