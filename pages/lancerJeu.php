<?php
$mode = strtolower($_GET['mode'] ?? 'facile');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lettrix - Le Jeu de Mots Intéressant</title>
    <link rel="stylesheet" href="../CSS/style.css">

    <script>
        const modeJeu = "<?php echo $mode; ?>";
    </script>

    <script type="module" src="../JS/script.js" defer></script>
</head>
<body>
    <?php require_once "../includes/menu.php"; ?>
    <div class="zone-jeu">
        <div class="grille" id="grille">
            <!-- Les lignes du jeu et leurs boutons correspondants seront générées ici -->
        </div>
    </div>
</body>
</html>