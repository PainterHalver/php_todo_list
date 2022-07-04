<?php
session_start();

$conf = include($_SERVER["DOCUMENT_ROOT"] . '/config.php');
$username = $_SESSION['user'] ?? $conf['global_username'];

$db = new SQLite3("../todo.db");

if (isset($_POST['noteTitle']) && isset($_POST['noteBody'])) {
    $title = SQLite3::escapeString($_POST['noteTitle']);
    $body = SQLite3::escapeString($_POST['noteBody']);
    $db->exec("INSERT INTO todos (title, body, username) VALUES ('$title', '$body', '$username')");
    header('Location: /');
}
