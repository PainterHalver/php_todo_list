<?php
session_start();

$db = new SQLite3("../todo.db");

// $_POST is empty if front-end uses `fetch`
$payload = file_get_contents('php://input');
$data = json_decode($payload);

if ($data->noteId) {
    $noteId = SQLite3::escapeString($data->noteId);
    $db->exec("UPDATE todos SET completed = 1 - (SELECT completed FROM todos WHERE id = '$noteId') WHERE id = '$noteId'"); // Toggle completed
    header('Location: /');
}
