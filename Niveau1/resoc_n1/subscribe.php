<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subscriberId = $_SESSION['connected_id']; //id de la session connecté 
    $followedUserId = intval($_POST['followed_user_id']); // id de la personne suivie

    // on vérifie si la personne est déjà suivie
    $checkQuery = "SELECT * FROM followers WHERE following_user_id = $subscriberId AND followed_user_id = $followedUserId";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows == 0) {
        // Insérer l'abonnement dans la table des abonnements
        $sql = "INSERT INTO followers (following_user_id, followed_user_id) VALUES ($subscriberId, $followedUserId)";
        if ($mysqli->query($sql)) {
            echo 'Abonnement réussi !';
        } else {
            echo 'Erreur lors de l\'abonnement : ' . $mysqli->error;
        }
    } else {
        echo 'Vous êtes déjà abonné à cet utilisateur.';
    }
} else {
    echo 'Méthode non autorisée.';
}
