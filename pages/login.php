<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lettrix - Le Jeu de Mots Intéressant</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <script type="module" src="../JS/script.js" defer></script>
</head>
<body>
    <?php require_once "../includes/menu.php"; ?>
    <div class="form-container">
    <form action="" method="POST">
        <h2>Connexion</h2>

        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>
</div>
</body>
</html>