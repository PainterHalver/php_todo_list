<?php

$db = new SQLite3("../todo.db");

if (isset($_POST['noteId']) && isset($_POST['noteTitle']) && isset($_POST['noteBody'])) {
    $noteId = $_POST['noteId'];
    $noteTitle = $_POST['noteTitle'];
    $noteBody = $_POST['noteBody'];
    $db->exec("UPDATE todos SET title='$noteTitle', body='$noteBody' WHERE id='$noteId'");
    header("Location: /");
}