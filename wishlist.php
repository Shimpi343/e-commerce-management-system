<?php
include 'db.php';
include 'header.php';

// Add to wishlist
if (isset($_GET['add'])) {
  $product_id = $_GET['add'];
  $conn->query("INSERT INTO wishlist (customer_id, product_id) VALUES (1, $product_id)");
}

// Remove from wishlist
if (isset($_GET['remove'])) {
  $wishlist_id = $_GET['remove'];
  $conn->query("DELETE FROM wishlist WHERE wishlist_id = $wishlist_id");
}
?>

<div class="container">
  <h2>My Wishlist ❤️</h2>

  <div class="product-grid">
    <?php
    $sql = "SELECT wishlist.WishlistID, product.ProductName, product.Price
            FROM wishlist 
            JOIN product ON wishlist.ProductID = product.productID 
            WHERE wishlist.CustomerID = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="product-card">
         
          <h3>' . $row["ProductName"] . '</h3>
          <p>₹' . $row["Price"] . '</p>
          <a href="cart.php?add=' . $row["WishlistID"] . '" class="btn-main">Add to Cart</a>
          <a href="wishlist.php?remove=' . $row["WishlistID"] . '" class="btn-remove">Remove</a>
        </div>';
      }
    } else {
      echo "<p>Your wishlist is empty.</p>";
    }
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
