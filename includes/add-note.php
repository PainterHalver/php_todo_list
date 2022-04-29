<?php

$db = new SQLite3("../todo.db");

if (isset($_POST['noteTitle']) && isset($_POST['noteBody'])) {
    $title = SQLite3::escapeString($_POST['noteTitle']);
    $body = SQLite3::escapeString($_POST['noteBody']);
    $db->exec("INSERT INTO todos (title, body) VALUES ('$title', '$body')");
    header('Location: /');
}