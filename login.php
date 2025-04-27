<?php
include 'db.php';
session_start();

$message = '';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $email;
        header('Location: index.html');
        exit();
    } else {
        $message = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('back2.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            padding: 20px;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.8); 
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 450px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #4caf50;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            font-size: 1rem;
        }

        .btn-link {
            text-decoration: none;
            color: black;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        
        .logo {
            display: block;
            width: 80px;
            height: 80px;
            background-color: #4caf50;
            border-radius: 50%;
            margin: 0 auto;
            text-align: center;
            line-height: 80px;
            font-size: 2rem;
            color: white;
        }

        .logo::before {
            content: '🌸'; 
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo or Flower icon -->
        <div class="logo"></div>
        
        <h2>Login</h2>
        
        <?php if ($message) echo "<div class='alert alert-danger'>$message</div>"; ?>
        
        <form method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-link">Register</a>
        </form>
    </div>

</body>
</html>
