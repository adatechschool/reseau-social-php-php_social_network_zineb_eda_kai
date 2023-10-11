<?php
session_start();

// Connexion à la base de données (à adapter selon votre configuration)
include "config.php";
// Récupérez l'ID de l'utilisateur connecté à partir de la session
$connectedUserId = isset($_SESSION['connected_id']) ? $_SESSION['connected_id'] : null;

// Récupérez l'ID du message que l'utilisateur veut liker/désaimer
$messageId = isset($_POST['message_id']) ? intval($_POST['message_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : null;

// if (isset($messageId)) {
//         // Obtenez la valeur de 'id' depuis $_GET
//         $getid = (int) $messageId;
    
//         // Affichez la valeur pour l'inspection
        // var_dump($_POST['action']); // Vous pouvez utiliser aussi "echo $_POST['action'];"
        // echo $_POST['action'];
        // Reste du code pour insérer le like dans la base de données
        // ...
// }
//     } else {
//         echo "L'ID n'est pas défini dans la requête GET.";
        // Gérez cette situation d'erreur comme vous le souhaitez
//     }if ($mysqli->connect_error) {
//     die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
// }


if ($connectedUserId && $messageId) {
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($action === 'like') {
        // L'utilisateur veut liker le message
        // Vérifiez si l'utilisateur a déjà aimé ce message
        $sql = "SELECT * FROM likes WHERE user_id = $connectedUserId AND post_id = $messageId";
        $result = $mysqli->query($sql);

        if ($result->num_rows === 0) {
            // L'utilisateur n'a pas encore aimé ce message, ajoutez son like
            $sql = "INSERT INTO likes (user_id, post_id) VALUES ($connectedUserId, $messageId)";
            $mysqli->query($sql);
        }
    else {
        // L'utilisateur veut retirer son like du message
        $sql = "DELETE FROM likes WHERE user_id = $connectedUserId AND post_id = $messageId";
        $mysqli->query($sql);
        }
    }
}

// Redirigez l'utilisateur vers la page précédente (ou ailleurs) après l'interaction
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
