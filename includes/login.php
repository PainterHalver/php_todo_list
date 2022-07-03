<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    echo "Username: " . $_POST['username'] . "<br>";
    echo "Password: " . $_POST['password'] . "<br>";
}
