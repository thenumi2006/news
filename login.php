<?php
session_start();
include("include/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT id, email, password, display_name, role FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['display_name'] = $user['display_name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['loggedin'] = true;

                
                if ($user['role'] === 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            }
        }
    }
    echo "<script>alert('Invalid Email or Password');</script>";
}
$conn->close();
?>


<html>
<head>
    <title>News Portal - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 0;
        }

        .login-box {
            background-color: whitesmoke;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        img {
            margin-bottom: 20px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid white;
        }

        button {
            cursor: pointer;
            background-color: blueviolet;
            color: white;
            border: none;
            font-size: 16px;
        }

       
    </style>
    <script>
        function validateForm() {
            let email = document.forms["loginForm"]["email"].value;
            let password = document.forms["loginForm"]["password"].value;
            
            if (email === "" || password === "") {
                alert("Please fill all fields!");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="login-box">
        <img src="assets/img/logo.jpg" alt="Logo" width="80px" height="80px">
        <h2>News Portal Login</h2>
        <form name="loginForm" method="POST" action="login.php" onsubmit="return validateForm()">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
        <button onclick="window.location.href='signup.php'">Create Account</button>
    </div>
</body>
</html>