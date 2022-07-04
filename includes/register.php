<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    // Check if passwords match
    if ($_POST['password'] !== $_POST['confirmPassword']) {
        echo "Passwords do not match.";
        exit();
    }

    $username = SQLite3::escapeString($_POST['username']);
    $password = SQLite3::escapeString($_POST['password']);
    $passwordHash = md5($password);

    $db = new SQLite3("../todo.db");

    // Check if username already exists
    $result = $db->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->fetchArray()) {
        echo "Username already exists.";
        exit();
    }

    // Add user to database
    $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')");
    $_SESSION['user'] = $username;
    header("Location: /");
}
