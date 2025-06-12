<?php
// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('/assets/images/logimg.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .container {
            position: relative;
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
            color: white;
        }

        h2 {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid white;
            border-radius: 5px;
            background: transparent;
            color: white;
        }

        input::placeholder {
            color: white;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            background: rgb(175, 40, 40);
            color: white;
            margin-top: 10px;
        }

        .btn:hover {
            background: rgb(200, 50, 50);
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container" id="loginForm">
        <h2>Login</h2>
        
        <input type="email" id="loginEmail" placeholder="Email address">
        <input type="password" id="loginPassword" placeholder="Password">
        
        <button class="btn" id="loginBtn">Log in</button>
        
        <div class="links">
            <p><a href="#">Forgot your password?</a></p>
            <p>Don't have an account? <a href="#" onclick="toggleForms()">Register</a></p>
        </div>
    </div>
    
    <div class="container" id="registerForm" style="display:none;">
        <h2>Enjoy Exclusive Perks</h2>
        <p>✔ Be one of the first to get presale tickets</p>
        <p>✔ Set up alerts for your favourite artists</p>
        <p>✔ Receive our newsletter about the latest tours</p>
        
        <input type="text" id="firstName" placeholder="First Name">
        <input type="text" id="lastName" placeholder="Last Name">
        <input type="text" id="postcode" placeholder="Postcode">
        <input type="email" id="registerEmail" placeholder="Email address">
        <input type="password" id="registerPassword" placeholder="Password">
        
        <button class="btn" id="registerBtn">Register</button>
        
        <div class="links">
            <p>Already Registered? <a href="#" onclick="toggleForms()">Log in</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Login Function
            $("#loginBtn").click(function () {
                let email = $("#loginEmail").val();
                let password = $("#loginPassword").val();

                if (email !== "" && password !== "") {
                    $.ajax({
                        url: "login_ajax.php",
                        type: "POST",
                        data: { email: email, password: password },
                        success: function (response) {
                            if (response === "success") {
                                window.location.href = "index.php";
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Please fill in all fields.");
                }
            });

            // Register Function
            $("#registerBtn").click(function () {
                let firstName = $("#firstName").val();
                let lastName = $("#lastName").val();
                let email = $("#registerEmail").val();
                let password = $("#registerPassword").val();
                let postcode = $("#postcode").val();

                if (firstName !== "" && lastName !== "" && email !== "" && password !== "" && postcode !== "") {
                    $.ajax({
                        url: "register_ajax.php",
                        type: "POST",
                        data: { first_name: firstName, last_name: lastName, email: email, password: password , postcode: postcode},
                        success: function (response) {
                            if (response === "success") {
                                alert("Registration successful! You can now log in.");
                                window.location.href = "index.php";
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Please fill in all fields.");
                }
            });

            // Logout Function
            $("#logoutBtn").click(function () {
                $.ajax({
                    url: "logout_ajax.php",
                    type: "POST",
                    success: function () {
                        window.location.href = "index.php";
                    }
                });
            });
        });
    </script>

    
    <script>
        function toggleForms() {
            let registerForm = document.getElementById("registerForm");
            let loginForm = document.getElementById("loginForm");
            
            if (registerForm.style.display === "none") {
                registerForm.style.display = "block";
                loginForm.style.display = "none";
            } else {
                registerForm.style.display = "none";
                loginForm.style.display = "block";
            }
        }
    </script>
</body>
</html>