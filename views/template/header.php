<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <title><?php
            if (isset($title)) {
                echo $title;
            } else {
                echo 'Todo List PHP';
            }
            ?></title>
</head>


<body class="container-sm d-flex flex-column align-items-stretch" style="max-width: 800px;">
    <?php require_once(__DIR__ . "/navbar.php") ?>