<?php
include 'db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM customer WHERE Email = '$email'");
    if ($check->num_rows > 0) {
        $message = "❌ Email already registered!";
    } else {
        $conn->query("INSERT INTO customer (FirstName, LastName, Email, PhoneNo, Address, Password) 
                      VALUES ('$first', '$last', '$email', '$phone', '$address', '$password')");
        $message = "✅ Registered successfully! You can now login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - EZCommerce</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; }
    .register-box {
      width: 400px;
      margin: 100px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    input, button {
      width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      background: #7b4b94;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }
    .message { color: red; margin-top: 10px; }
  </style>
</head>
<body>

<div class="register-box">
  <h2>Create Account</h2>
  <form method="post">
    <input type="text" name="first" placeholder="First Name" required>
    <input type="text" name="last" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone No" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
    <div class="message"><?php echo $message; ?></div>
  </form>
  <p style="text-align:center;">Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
