<?php

$db = new SQLite3("../todo.db");

if ($_SERVER['REQUEST_METHOD'] === "DELETE" && isset($_REQUEST['noteId'])) {
    $noteId = $_REQUEST['noteId'];
    $db->exec("UPDATE todos SET deleted = 1 WHERE id = $noteId");
}