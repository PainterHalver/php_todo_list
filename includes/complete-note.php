<?php
session_start();

$conf = include($_SERVER["DOCUMENT_ROOT"] . '/config.php');
$username = $_SESSION['user'] ?? $conf['global_username'];

$db = new SQLite3("../todo.db");

// $_POST is empty if front-end uses `fetch`
$payload = file_get_contents('php://input');
$data = json_decode($payload);

if ($data->noteId) {
    $noteId = SQLite3::escapeString($data->noteId);
    $db->exec("UPDATE todos SET completed = 1 - (SELECT completed FROM todos WHERE id = '$noteId' AND username = '$username') WHERE id = '$noteId' AND username = '$username'"); // Toggle completed
    header('Location: /');
}
