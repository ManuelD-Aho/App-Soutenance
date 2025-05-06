<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title><!-- Votre fichier avec les variables root -->
    <link rel="stylesheet" href="../../css/login.css"> <!-- Le nouveau fichier CSS -->
</head>
<body>
<div class="container">
    <h1>Connexion</h1>
    <form>
        <div class="form-group">
            <input type="email" class="form-input" id="email" placeholder=" ">
            <div class="form-underline"></div>
            <label class="form-label" for="email">Adresse e-mail</label>
        </div>

        <div class="form-group">
            <input type="password" class="form-input" id="password" placeholder=" ">
            <div class="form-underline"></div>
            <label class="form-label" for="password">Mot de passe</label>
        </div>

        <button type="submit" class="btn">Se connecter</button>

        <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
        </div>
    </form>
</div>
</body>
</html>