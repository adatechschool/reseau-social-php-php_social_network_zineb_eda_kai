<?php
session_start();
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
            <li><a href="settings.php?user_id=<?php echo $connectedUserId; ?>">Paramètres</a></li>
            <li><a href="followers.php?user_id=<?php echo $connectedUserId; ?>">Mes suiveurs</a></li>
            <li><a href="subscriptions.php?user_id=<?php echo $connectedUserId; ?>">Mes abonnements</a></li>
            <li><a href="logout.php?user_id=<?php echo $connectedUserId; ?>">Déconnexion</a></li>

        </ul>

    </nav>
</header>