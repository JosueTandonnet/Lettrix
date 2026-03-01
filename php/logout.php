<?php

declare(strict_types=1);

session_start();

// Suppression des données de session
$_SESSION = [];

// Destruction du cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruction finale
session_destroy();

// Redirection
header("Location: index.html");
exit;