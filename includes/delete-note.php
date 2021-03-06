<?php
session_start();

$conf = include($_SERVER["DOCUMENT_ROOT"] . '/config.php');
$username = $_SESSION['user'] ?? $conf['global_username'];

$db = new SQLite3("../todo.db");

if ($_SERVER['REQUEST_METHOD'] === "DELETE" && isset($_REQUEST['noteId'])) {
    $noteId = SQLite3::escapeString($_REQUEST['noteId']);
    $db->exec("UPDATE todos SET deleted = 1 WHERE id = $noteId AND username = '$username'");
}
