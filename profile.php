<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['CustomerID'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

include 'db.php';
include 'header.php';

// Get customer details using the customer ID from the session
$customer = $conn->query("SELECT * FROM customer WHERE CustomerID = {$_SESSION['CustomerID']}")->fetch_assoc();
?>

<div class="container">
  <h2>My Profile 👤</h2>
  <div class="profile-box">
    <p><strong>FirstName:</strong> <?php echo $customer['FirstName']; ?></p>
    <p><strong>LastName:</strong> <?php echo $customer['LastName']; ?></p>
    <p><strong>Email:</strong> <?php echo $customer['Email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $customer['PhoneNo']; ?></p>
    <p><strong>Address:</strong> <?php echo $customer['Address']; ?></p>
  </div>

  <h3 style="margin-top: 40px;">My Orders 📦</h3>
  <table class="cart-table">
    <tr>
      <th>Order ID</th>
      <th>Total</th>
      <th>Date</th>
      <th>Payment</th>
    </tr>
    <?php
    // Get all orders of the logged-in user
    $orders = $conn->query("SELECT * FROM orders WHERE CustomerID = {$_SESSION['CustomerID']} ORDER BY OrderDate DESC");
    if ($orders->num_rows > 0) {
        while ($order = $orders->fetch_assoc()) {
            echo "<tr>
              <td>#{$order['OrderID']}</td>
              <td>₹{$order['Amount']}</td>
              <td>{$order['OrderDate']}</td>
              <td>{$order['PaymentMethod']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No orders placed yet.</td></tr>";
    }
    ?>
  </table>

  <!-- Logout Button -->
  <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include 'footer.php'; ?>
