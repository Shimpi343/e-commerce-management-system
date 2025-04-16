<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

$grand_total = 0;
$customer_id = 1; // Static for now, replace with session logic later

$query = "SELECT cart.Quantity, product.Price 
          FROM cart 
          JOIN product ON cart.ProductID = product.ProductID 
          WHERE cart.CustomerID = $customer_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grand_total += $row['Quantity'] * $row['Price'];
    }
} else {
    echo "<p style='text-align:center; font-weight:bold;'>No items in cart.</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Amount = $grand_total;
    $OrderDate = date("Y-m-d");
    $PaymentMethod = $_POST['PaymentMethod'] ?? '';

    $orderSql = "INSERT INTO orders (CustomerID, OrderDate, PaymentMethod) 
                 VALUES ($customer_id, '$OrderDate', '$PaymentMethod')";

    if ($conn->query($orderSql)) {
        $orderID = $conn->insert_id;
        $paymentSql = "INSERT INTO payment (OrderID, Amount, PaymentDate, PaymentMethod) 
                       VALUES ($orderID, $Amount, '$OrderDate', '$PaymentMethod')";

        if ($conn->query($paymentSql)) {
            echo "<script>alert('✅ Order and payment placed successfully!');</script>";
        } else {
            echo "<script>alert('❌ Payment error: {$conn->error}');</script>";
        }
    } else {
        echo "<script>alert('❌ Order error: {$conn->error}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <style>
    body {
      background: linear-gradient(to right, #e9dfff, #f5e8ff);
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    .checkout-container {
      max-width: 500px;
      margin: 60px auto;
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    h2 {
      text-align: center;
      color: #6a0dad;
      margin-bottom: 30px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 20px;
      color: #4b0082;
    }

    select {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #f8f8f8;
    }

    .amount-display {
      background: #f4eaff;
      color: #6a0dad;
      padding: 14px;
      margin-top: 20px;
      font-size: 1.2rem;
      text-align: center;
      border-radius: 10px;
      font-weight: bold;
    }

    input[type="submit"] {
      background-color: #7f5af0;
      color: white;
      padding: 12px 20px;
      margin-top: 30px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s, transform 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #6841c6;
      transform: scale(1.03);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="checkout-container">
  <h2>🛍️ Checkout</h2>

  <form action="checkout.php" method="POST">
    <label for="PaymentMethod">Select Payment Method</label>
    <select name="PaymentMethod" id="PaymentMethod" required>
      <option value="Credit Card">💳 Credit Card</option>
      <option value="PayPal">🅿️ PayPal</option>
      <option value="Cash">💵 Cash</option>
    </select>

    <div class="amount-display">
      Total Amount: ₹<?php echo number_format($grand_total, 2); ?>
    </div>

    <input type="submit" value="Place Order ✅">
  </form>
</div>

</body>
</html>
