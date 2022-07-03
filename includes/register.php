<?php

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    echo "Username: " . $_POST['username'] . "<br>";
    echo "Password: " . $_POST['password'] . "<br>";
}
