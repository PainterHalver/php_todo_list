<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: /");
}

require_once(__DIR__ . "/template/header.php");
?>

<div class='d-flex justify-content-center align-items-center'>
    <form method="POST" style="width: 35%;" oninput="confirmPassword.setCustomValidity(confirmPassword.value !== password.value ? 'Passwords do not match.' : '')">
        <div class="form-group mb-2">
            <label for="username" class="mb-1">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
            <div class="invalid-feedback user-exist">Username already exists</div>
        </div>
        <div class="form-group mb-2">
            <label for="password" class="mb-1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword" class="mb-1">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <button type="button" class="btn btn-primary mt-4 submit-btn">Register</button>
        </div>
    </form>
</div>

<script>
    const submitBtn = document.querySelector('.submit-btn');
    const userExist = document.querySelector('.user-exist');

    submitBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
        const confirmPassword = document.querySelector('#confirmPassword').value;

        if (username.length < 3) {
            alert('Username must be at least 3 characters');
            return;
        }
        if (password.length < 6) {
            alert('Password must be at least 6 characters');
            return;
        }

        const url = `/includes/register.php`;
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        formData.append('confirmPassword', confirmPassword);

        const res = await fetch(url, {
            method: "POST",
            body: formData
        });

        const data = await res.text();
        if (data === 'Username already exists.') {
            userExist.style.display = 'block';
        } else if (data === 'Passwords do not match.') {
            alert(data);
        } else {
            window.location.href = '/';
        }
    });
</script>

<?php
require_once(__DIR__ . "/template/footer.php");
