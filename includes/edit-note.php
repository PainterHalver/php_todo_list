<?php
session_start();

$conf = include($_SERVER["DOCUMENT_ROOT"] . '/config.php');
$username = $_SESSION['user'] ?? $conf['global_username'];

$db = new SQLite3("../todo.db");

if (isset($_POST['noteId']) && isset($_POST['noteTitle']) && isset($_POST['noteBody'])) {
    $noteId = SQLite3::escapeString($_POST['noteId']);
    $noteTitle = SQLite3::escapeString($_POST['noteTitle']);
    $noteBody = SQLite3::escapeString($_POST['noteBody']);
    $db->exec("UPDATE todos SET title='$noteTitle', body='$noteBody' WHERE id='$noteId' AND username='$username'");
    header("Location: /");
}
