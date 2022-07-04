<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === "admin" && $_POST['password'] === "admin") {
        $_SESSION['user'] = "admin";
        header("Location: /");
    } else {
        echo "Invalid username or password <br>";
    }

    echo "Username: " . $_POST['username'] . "<br>";
    echo "Password: " . $_POST['password'] . "<br>";
}
