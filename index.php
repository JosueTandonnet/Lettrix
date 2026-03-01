<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lettrix - Le Jeu de Mots Intéressant</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <script type="module" src="./JS/script.js" defer></script>
</head>
<body>
    <?php require_once "./includes/menu.php"; ?>
    <element id="accueil">
        <h1>Bienvenue sur Lettrix !</h1>
        <p>Le jeu de mots qui met votre logique à l'épreuve. Découvrez et testez vos compétences avec Lettrix.</p>
        <button onclick="window.location.href='pages/parametresJeu.php'">Jouer</button>
    </element>
</body>
</html>