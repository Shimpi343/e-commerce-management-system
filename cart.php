<?php
include 'db.php';
include 'header.php';

// Handle "Add to Cart"
if (isset($_GET['add'])) {
  $product_id = $_GET['add'];
  $conn->query("INSERT INTO cart (CustomerID, ProductID, Quantity) VALUES (1, $product_id, 1)");
}

// Handle "Remove from Cart"
if (isset($_GET['remove'])) {
  $cart_id = $_GET['remove'];
  $conn->query("DELETE FROM cart WHERE CartID = $cart_id");
}
?>

<style>
  body {
    background: linear-gradient(to right, #f0e6ff, #e6f0ff);
    font-family: 'Segoe UI', sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 960px;
    margin: 50px auto;
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1.2s ease-in;
  }

  h2 {
    text-align: center;
    color: #6a0dad;
    font-size: 2rem;
    margin-bottom: 30px;
  }

  .cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
  }

  .cart-table th, .cart-table td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: center;
  }

  .cart-table th {
    background-color: #e0ccff;
    color: #4b0082;
  }

  .btn-remove {
    background-color: #ff6666;
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.3s;
  }

  .btn-remove:hover {
    background-color: #cc0000;
  }

  .btn-main {
    background-color: #7f5af0;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: transform 0.3s ease;
  }

  .btn-main:hover {
    background-color: #6841c6;
    transform: scale(1.05);
  }

  .checkout-btn {
    text-align: center;
    margin-top: 20px;
  }

  .cart-gif {
    display: block;
    margin: 30px auto;
    width: 220px;
    height: auto;
    animation: floaty 4s ease-in-out infinite;
  }

  @keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  @keyframes floaty {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
</style>

<div class="container">
  <h2>Your Cart 🛒</h2>

  <img src="https://moein.video/wp-content/uploads/stuff26/Shopping-Cart-Royalty-Free-Animated-Icon-GIF-350px-after-effects-project.gif" alt="Cart GIF" class="cart-gif" />

  <table class="cart-table">
    <tr>
      <th>Product</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Total</th>
      <th>Action</th>
    </tr>

    <?php
    $sql = "SELECT cart.CartID, product.ProductName, product.Price, cart.Quantity 
            FROM cart 
            JOIN product ON cart.ProductID = product.ProductID 
            WHERE cart.CustomerID = 1";
    $result = $conn->query($sql);
    $grand_total = 0;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $total = $row['Price'] * $row['Quantity'];
        $grand_total += $total;
        echo "
        <tr>
          <td>{$row['ProductName']}</td>
          <td>₹{$row['Price']}</td>
          <td>{$row['Quantity']}</td>
          <td>₹$total</td>
          <td><a href='cart.php?remove={$row['CartID']}' class='btn-remove'>Remove</a></td>
        </tr>
        ";
      }
      echo "<tr>
        <td colspan='3'><strong>Grand Total</strong></td>
        <td colspan='2'><strong>₹$grand_total</strong></td>
      </tr>";
    } else {
      echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
    }
    ?>
  </table>

  <div class="checkout-btn">
    <a href="checkout.php" class="btn-main">Proceed to Checkout</a>
  </div>
</div>

<?php include 'footer.php'; ?>
