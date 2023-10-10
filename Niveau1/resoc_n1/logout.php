<?php
session_start();

// Détruire la session existante
session_destroy();

// Rediriger vers la page d'accueil ou une autre page après la déconnexion
header("Location: news.php"); // Remplacez "index.php" par la page de votre choix
exit;
?>
