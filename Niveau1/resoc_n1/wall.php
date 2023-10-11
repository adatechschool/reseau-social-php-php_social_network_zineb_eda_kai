<?php session_start(); ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div id="wrapper">
        <?php
        /**
         * Etape 1: Le mur concerne un utilisateur en particulier
         * La première étape est donc de trouver quel est l'id de l'utilisateur
         * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
         * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
         * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
         */
        $userId = intval($_GET['user_id']);
        ?>
        <?php
        /**
         * Etape 2: se connecter à la base de donnée
         */
        include "config.php";
        ?>

        <aside>
            <?php
            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
            echo "<pre>" . print_r($user, 1) . "</pre>";
            ?>
            <img src="user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $user['alias'] ?>
                    (n° <?php echo $userId ?>)
                </p>


            </section>
        </aside>
        <main>
            <?php if ($userId == $_SESSION['connected_id']) : ?>
                <article>
                    <h2>Poster un message</h2>
                    <form action="handle_message.php" method="post">
                        <input type='hidden' name='user_id' value=<?php echo $userId; ?>>
                        <dl>
                            <dt><label for='content'>Message</label></dt>
                            <dd><textarea name='content'></textarea></dd>
                        </dl>
                        <input type='submit' value='Envoyer'>
                    </form>
                </article>
            <?php elseif (!$userId) : ?>
                <article>
                    <p>Veuillez vous connecter pour poster un message.</p>
                </article>
                <?php include('login.php'); ?>
            <?php endif; ?>
            ​
            <?php
            /**
             * Etape 3: récupérer tous les messages de l'utilisatrice
             */
            $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist,                     
                    posts.user_id,
                    likes.post_id AS post_id,
                    MAX(posts_tags.tag_id) AS tag_id
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
            }

            /**
             * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
             */
            while ($post = $lesInformations->fetch_assoc()) {

                echo "<pre>" . print_r($post, 1) . "</pre>";
            ?>
                <article>
                    <h3>
                        <time><?php echo $post['created'] ?></time>
                    </h3>
                    <address>par <a href="wall.php?user_id=<?php echo $post['user_id']; ?>"><?php echo $post['author_name']; ?></a></address>
                    <div>
                        <p><?php echo $post['content']   ?></p>
                        <?php echo $post['post_id']; ?>

                    </div>
                    <footer>
                        <small>♥ <?php echo $post['like_number']   ?></small>
                        <form action="like.php" method="post">
                            <input type="hidden" name="message_id" value="<?php echo $post['post_id']; ?>">
                            <input type="hidden" name="action" value="like">
                            <button type="submit" name="like">J'aime</button>
                        </form>
                        <a href=""><?php $tags = $post['taglist'];
                                    $tagId = $post['tag_id'];
                                    if (!empty($tags)) {
                                        $tagArray = explode(',', $tags);
                                        foreach ($tagArray as $tag) {
                                            echo '<a href="tags.php?tag_id=' . $tagId . '"> #' . $tag . '</a>';
                                        }
                                    } else {
                                        echo '#';
                                    }
                                    ?></a>
                    </footer>
                </article>

            <?php } ?>

        </main>
    </div>
</body>

</html>