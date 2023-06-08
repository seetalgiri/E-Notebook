<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$emailaccount = "personal";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Client/styles/globalas.css" />
    <link rel="stylesheet" href="../Client/styles/verify.css" />
    <title>Verification Account UI</title>
</head>

<body>
    <div class="container">
        <div id="heading">
            <h2>Verify Your Account</h2>
            <p>
                We emailed you the six digit code to <?php echo $emailaccount ?>@email.com <br />
                Enter the code below to confirm your email address.
            </p>
        </div>

        <div class="code-container">
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
        </div>

        <form action="./verify.php" method="get">
            <div>
                <button type="button" class="btn btn-primary" name="verify">Verify</button>
            </div>
        </form>

        <small class="info">
            Thank you for register !!!</strong>
        </small>
    </div>
    <script>
        const codes = document.querySelectorAll(".code");
        codes[0].focus();
        codes.forEach((code, idx) => {
            code.addEventListener("keydown", (e) => {
                if (e.key >= 0 && e.key <= 9) {
                    codes[idx].value = "";
                    setTimeout(() => codes[idx + 1].focus(), 10);
                } else if (e.key === "Backspace") {
                    setTimeout(() => codes[idx - 1].focus(), 10);
                }
            });
        });
    </script>
</body>

</html>