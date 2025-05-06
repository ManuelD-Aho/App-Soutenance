document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    // Affiche/cache le menu lors du clic sur le profil
    profileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('active');
    });

    // Ferme le menu si on clique ailleurs sur la page
    document.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target)) {
            profileDropdown.classList.remove('active');
        }
    });
});