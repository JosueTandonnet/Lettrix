<?php
/**
 * login.php
 * Connexion utilisateur – Lettrix
 * PHP 8+
 */

declare(strict_types=1);

session_start();
require_once __DIR__ . "/connexion.php";

// POST uniquement
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Méthode non autorisée.");
}

// Récupération des données
$identifier = trim($_POST["identifier"] ?? ""); // email OU username
$password   = $_POST["password"] ?? "";

if ($identifier === "" || $password === "") {
    exit("Identifiants manquants.");
}

try {
    // Recherche par email ou username
    $stmt = $pdo->prepare(
        "SELECT id, username, password_hash
         FROM users
         WHERE email = :identifier OR username = :identifier
         LIMIT 1"
    );

    $stmt->execute([
        "identifier" => $identifier
    ]);

    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user["password_hash"])) {
        exit("Identifiants incorrects.");
    }

    // Connexion OK → session
    session_regenerate_id(true); // anti session fixation
    $_SESSION["user_id"]   = (int)$user["id"];
    $_SESSION["username"] = $user["username"];

    // Redirection après connexion
    header("Location: dashboard.php");
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    exit("Erreur lors de la connexion.");
}