<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = SQLite3::escapeString($_POST['username']);
    $password = SQLite3::escapeString($_POST['password']);
    $passwordHash = md5($password);

    $db = new SQLite3("../todo.db");

    $result = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$passwordHash'");
    if ($result->fetchArray()) {
        $_SESSION['user'] = $username;
        header("Location: /");
    } else {
        echo "Wrong username or password.";
        exit();
    }
}
