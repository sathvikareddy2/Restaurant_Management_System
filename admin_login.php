<?php
session_start();

// Hardcoded admin credentials
$admin_username = 'admin';
$admin_password = 'password';

if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #ff7e5f, #feb47b, #86a8e7, #91eae4);
            background-size: 400% 400%;
            animation: gradientBG 7s ease infinite;
        }
        .login-container {
            width: 400px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            text-align: center;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            transition: border-color 0.3s ease;
        }
        .login-container input[type="text"]:hover,
        .login-container input[type="password"]:hover {
            border-color: #ff69b4;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff69b4;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container input[type="submit"]:hover {
            background-color: #cc1b71;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <br/>
        <br/>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>
            <input type="submit" name="admin_login" value="Login">
            <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
        </form>
    </div>
</body>
</html>
