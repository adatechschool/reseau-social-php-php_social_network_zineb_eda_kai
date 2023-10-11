<?php
session_start();

include "config.php";

$userId = intval($_POST['user_id']);
$content = $_POST['content'];

$insertQuery =
    "INSERT INTO posts"
    . "(user_id, content, created, parent_id) "
    . "VALUES ('$userId', '$content', NOW(), NULL)";

if ($mysqli->query($insertQuery) === TRUE) {

    header("Location: wall.php?user_id=$userId");
    exit();
} else {
    echo "Error: " . $mysqli->error;
}
