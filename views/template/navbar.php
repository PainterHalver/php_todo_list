<div class='d-flex justify-content-between align-items-center mb-3 pt-2'>
    <h1>To do list</h1>
    <div>
        <div class="clock text-end"></div>
        <div class="d-flex justify-content-end">
            <?php
            if (isset($_SESSION['user'])) {
                echo "<strong>Hello, " . $_SESSION['user'] . "!</strong> &nbsp;<a href='/includes/logout.php' class=''>Logout</a>";
            } else {
                echo "<strong>Hello, Global user!</strong> &nbsp;<a href='/views/login.php'>Login</a><a class='ms-2' href='/views/register.php'>Register</a>";
            }
            ?>

        </div>
    </div>
</div>

<script>
    /**
     * Display Current Time
     */
    const clock = document.querySelector(".clock");
    const setClockTime = () => {
        clock.innerHTML = new Date().toLocaleTimeString([], {
            day: "numeric",
            month: "short",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        });
    }
    setClockTime();
    setInterval(setClockTime, 1000);
</script>