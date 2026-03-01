<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . "/connexion.php";

// Sécurité minimale : uniquement POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Méthode non autorisée.");
}

// Récupération & nettoyage
$username = trim($_POST["username"] ?? "");
$email    = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Validation simple mais efficace
if ($username === "" || $email === "" || $password === "") {
    exit("Tous les champs sont obligatoires.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Adresse email invalide.");
}

if (strlen($password) < 8) {
    exit("Le mot de passe doit contenir au moins 8 caractères.");
}

try {
    // Vérifier si username ou email existe déjà
    $stmt = $pdo->prepare(
        "SELECT id FROM utilisateurs WHERE username = :username OR email = :email"
    );
    $stmt->execute([
        "username" => $username,
        "email"    => $email
    ]);

    if ($stmt->fetch()) {
        exit("Nom d’utilisateur ou email déjà utilisé.");
    }

    // Hash du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertion utilisateur
    $stmt = $pdo->prepare(
        "INSERT INTO utilisateurs (username, email, password)
         VALUES (:username, :email, :password_hash)"
    );

    $stmt->execute([
        "username"      => $username,
        "email"         => $email,
        "password_hash"=> $passwordHash
    ]);

    // Connexion automatique après inscription
    $_SESSION["user_id"]  = (int)$pdo->lastInsertId();
    $_SESSION["username"] = $username;

    // Redirection (à adapter)
    header("Location: dashboard.php");
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    exit("Erreur lors de l’inscription.");
}
