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
    <main id="paramètresJeu">
        <h2>Paramètres du Jeu</h2>
        <label for="niveau">Choisissez une option :</label>
        <select id="niveau" name="niveau">
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
        </select>
        <button id="validerBtn" onclick="window.location.href='lancerJeu.php'">Valider</button>
    </main>
</body>
</html>