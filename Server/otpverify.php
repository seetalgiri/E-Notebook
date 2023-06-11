<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);
$emailaccount = "personal";

if (isset($_SESSION['email'])) {
    $emailaccount = $_SESSION['email'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Client/styles/globalas.css" />
    <link rel="stylesheet" href="../Client/styles/verify.css" />
    <title>Verification Account UI</title>
    <style>
        .errorVer {
            color: red;
            font-size: 13px;
            margin: auto;
            margin-top: -40px;
            width: 96%;
            letter-spacing: 1px;
            display: flex;
            align-items: start;
            justify-content: start;
            margin-bottom: 30px;
        }
    </style>
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

        <form>
            <div class="code-container">
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
                <input type="number" class="code" placeholder="0" min="0" max="9" required />
            </div>
            <p class="errorVer" id="vererror"></p>

            <div>
                <button type="button" class="btn btn-primary" name="verify">Verify</button>
            </div>
        </form>

        <small class="info">
            Thank you for register !!!</strong>
        </small>
    </div>
    <script>
        const vererror = document.getElementById("vererror")
        vererror.innerText = "";
        const codes = document.querySelectorAll(".code");
        codes[0].focus();

        codes.forEach((code, idx) => {
            code.addEventListener("keydown", (e) => {
                if (e.key >= 0 && e.key <= 9) {
                    codes[idx].value = "";
                    if (idx < 5) {
                        setTimeout(() => codes[idx + 1].focus(), 10);
                    }
                    vererror.innerText = "";

                } else if (e.key === "Backspace") {
                    if (idx > 0) {
                        setTimeout(() => codes[idx - 1].focus(), 10);
                    }
                }
            });
            code.addEventListener('paste', function(e) {
                e.preventDefault();
                vererror.innerText = "Please type verification code manually.";
            });
        });

        // Get the button element
        var verifyButton = document.querySelector('button[name="verify"]');

        // Add a click event listener to the button
        verifyButton.addEventListener('click', function() {
            getInputValues();
        });

        // Add a keydown event listener to the input fields
        var codeInputs = document.querySelectorAll('.code');
        codeInputs.forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    getInputValues();
                }
            });
        });

        // Function to retrieve the input values
        function getInputValues() {
            var codeInputs = document.querySelectorAll('.code');
            var inputValues = [];
            codeInputs.forEach(function(input) {
                inputValues.push(input.value);
            });
            // Convert the input values into a string
            const inpVal = inputValues.join('');

            if (inpVal.length === 6) {
                // Make an AJAX request to update the is_verified status
                fetch('otpverificationBack.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'verificationCode=' + encodeURIComponent(inpVal)
                    })
                    .then(function(response) {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw new Error('Error: ' + response.status);
                        }
                    })
                    .then(function(data) {
                        if (data === "success") {
                            window.location.href = "../index.php";
                        }
                        // Handle the response as needed
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            } else {
                vererror.innerText = "Please enter valid verification code";
            }
        }
    </script>
</body>

</html>