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

    // Changer la direction de la flèche
    if (sidebar.classList.contains('collapsed')) {
        arrowIcon.textContent = '▶';
    } else {
        arrowIcon.textContent = '◀';
    }
});

// Sous-menus
document.querySelectorAll('.submenu-toggle').forEach(toggle => {
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const submenu = this.closest('.has-submenu').querySelector('.submenu');

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
});

// Bouton annuler
document.getElementById('annuler').addEventListener('click', function() {
    // Réinitialiser le formulaire
    document.getElementById('nom').value = '';
    document.getElementById('prenom').value = '';
    document.getElementById('promotion').value = '';
    document.getElementById('parcours').value = '';
});

// Initialisation au chargement de la page
window.addEventListener('load', function() {
    // Calculer la moyenne au chargement
    calculerMoyenne();

    // Initialiser les sous-menus comme fermés
    document.querySelectorAll('.submenu').forEach(submenu => {
        submenu.style.display = 'none';
    });
});