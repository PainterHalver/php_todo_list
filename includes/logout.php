<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /views/login.php");
} else {
    session_destroy();
    header("Location: /");
}
