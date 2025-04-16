<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM customer WHERE Email = '$email'");
    
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        
        if (password_verify($password, $user['Password'])) {
            $_SESSION['customer_id'] = $user['CustomerID'];
            $_SESSION['customer_name'] = $user['FirstName'];
            header("Location: index.php");
            exit();
        } else {
            $message = "❌ Invalid password!";
        }
    } else {
        $message = "❌ User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - EZCommerce</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right,rgb(198, 159, 194),rgb(153, 139, 166));
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-box {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: slideUp 1s ease-in-out;
    }

    @keyframes slideUp {
      from { transform: translateY(40px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .login-box h2 {
      color: #6b21a8;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    input:focus {
      border-color:rgb(119, 96, 140);
      outline: none;
    }

    button {
      width: 100%;
      background-color:rgb(183, 160, 224);
      color: #fff;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color:rgb(179, 153, 222);
      transform: translateY(-2px);
    }

    .message {
      margin-top: 15px;
      color: red;
      font-weight: 500;
    }

    .login-box p {
      margin-top: 15px;
      font-size: 14px;
    }

    .login-box a {
      color: #7c3aed;
      text-decoration: none;
      font-weight: bold;
    }

    .login-box a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Welcome Back!</h2>
  <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <div class="message"><?php echo $message; ?></div>
  </form>
  <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>
