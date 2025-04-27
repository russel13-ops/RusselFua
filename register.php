<?php
include 'db.php';

$message = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password);

    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check_email) > 0) {
        $message = 'Email already exists!';
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($conn, $query)) {
            $message = 'Registered successfully!';
        } else {
            $message = 'Registration failed!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #fff0f0, #f0f8ff); 
            font-family: 'Arial', sans-serif;
            color: #2a2a2a;
            padding: 20px;
        }

        .container {
            background: #FFB6C1;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            text-align: center;
            max-width: 500px;
        }

        h2 {
            font-size: 2rem;
            color: black;
            margin-bottom: 20px;
            position: relative;
        }

        h2::before {
            content: '🌸'; 
            position: absolute;
            left: -30px;
            top: -5px;
            font-size: 2.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            border: 2px solid #4caf50;
        }

        .btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            width: 100%;
        }

        .btn-link {
            color: black;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .alert-info {
            background-color: #dff0d8;
            color: #3c763d;
        }

        
        .floral-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('background.jpg'); 
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        /* Logo Design Example: A simple circle flower logo */
        .logo {
            width: 100px;
            height: 100px;
            background-color: #f5b7b1; /* Soft floral color */
            border-radius: 50%;
            margin: 10px auto;
            position: relative;
        }

        .logo::before {
            content: '🌸'; /* Flower emoji or you can insert an SVG here */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
        }
    </style>
</head>
<body>
    <div class="floral-background"></div>
    <div class="container">
        <!-- Custom Logo -->
        <div class="logo"></div>

        <h2>Register</h2>
        <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>
        <form method="post">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-link">Login</a>
        </form>
    </div>
</body>
</html>
