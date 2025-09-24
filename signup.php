<?php
include("include/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $display_name = $_POST['display_name'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } else if (empty($name) || empty($email) || empty($password) || empty($display_name)) {
        echo "<script>alert('All fields are required');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';

        
        $query = "INSERT INTO user (name, email, password, display_name, role, created_at) 
                  VALUES ('$name', '$email', '$hashed_password', '$display_name', '$role', NOW())";

        
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Account created successfully. Please log in.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Email already exists!');</script>";
            }
        
    
    }
}
$conn->close();
?>


<html>
<head>
    <title>Create Account</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            background-color: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-box {
            background-color: whitesmoke; 
            padding: 20px; 
            width: 400px; 
        }

        img {
            display: block;
            margin: 0 auto 20px;
        }

        h2 { text-align: center; }

        input, button { 
            width: 100%; 
            padding: 10px; 
            margin: 8px 0; 
            box-sizing: border-box;
            border-radius: 4px;
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
            let fields = ["name", "email", "password", "cpassword", "display_name"];
            for (let i = 0; i < fields.length; i++) {
                if (document.forms["signupForm"][fields[i]].value === "") {
                    alert("Please fill all fields!");
                    return false;
                }
            }
            if (document.forms["signupForm"]["password"].value !== document.forms["signupForm"]["cpassword"].value) {
                alert("Passwords do not match!");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="signup-box">
        <img src="assets/img/logo.jpg" alt="Logo" width="80px" height="80px">
        <h2>Create Account</h2>
        <form name="signupForm" method="POST" onsubmit="return validateForm()">
            <input type="text" name="name" placeholder="Full Name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="display_name" placeholder="Display Name">
            <input type="password" name="password" placeholder="Create Password">
            <input type="password" name="cpassword" placeholder="Confirm Password">
            <button type="submit" name="create">Create Account</button>
        </form>
    </div>
</body>
</html>