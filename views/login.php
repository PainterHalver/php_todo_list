<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: /");
}

require_once(__DIR__ . "/template/header.php");
?>

<div class='d-flex justify-content-center align-items-center'>
    <form style="width: 35%;">
        <div class="form-group mb-2">
            <label for="username" class="mb-1">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password" class="mb-1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <button type="button" class="btn btn-primary mt-4 submit-btn">Login</button>
        </div>
    </form>
</div>

<script>
    const submitBtn = document.querySelector('.submit-btn');

    submitBtn.addEventListener('click', async (e) => {
        e.preventDefault();

        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;

        const url = `/includes/login.php`;
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        const res = await fetch(url, {
            method: "POST",
            body: formData
        });

        const data = await res.text();
        if (data === 'Wrong username or password.') {
            alert(data);
        } else {
            window.location.href = '/';
        }
    });
</script>

<?php
require_once(__DIR__ . "/template/footer.php");
