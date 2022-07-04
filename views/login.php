<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: /");
}

require_once(__DIR__ . "/template/header.php");
?>

<div class='d-flex justify-content-center align-items-center'>
    <form action="/includes/login.php" method="POST" style="width: 35%;">
        <div class="form-group mb-2">
            <label for="username" class="mb-1">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password" class="mb-1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mt-4">Login</button>
        </div>
    </form>
</div>

<?php
require_once(__DIR__ . "/template/footer.php");
