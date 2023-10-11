<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$connectedUserId = $_SESSION['connected_id'];
?>
<header>
    <img src="resoc.jpg" alt="Logo de notre réseau social" />
    <nav id="menu">
        <a href="news.php">Actualités</a>
        <a href="wall.php?user_id=<?php echo $connectedUserId; ?>">Mur</a>
        <a href="feed.php?user_id=<?php echo $connectedUserId; ?>">Flux</a>
        <a href=" tags.php?tag_id=5">Mots-clés</a>
    </nav>
    <nav id="user">
        <a href="#">Profil</a>
        <ul>
            <?php
            if ($connectedUserId) {
                echo '<li><a href="settings.php?user_id=' . $connectedUserId . '">Paramètres</a></li>';
                echo '<li><a href="followers.php?user_id=' . $connectedUserId . '">Mes suiveurs</a></li>';
                echo '<li><a href="subscriptions.php?user_id=' . $connectedUserId . '">Mes abonnements</a></li>';
                echo '<li><a href="logout.php?user_id=' . $connectedUserId . '">Déconnexion</a></li>';
            } else {
                echo '<li><a href="login.php">Connexion</a></li>';
            }
            ?>

    </nav>
</header>