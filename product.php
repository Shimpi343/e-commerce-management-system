<?php
include 'db.php';
include 'header.php';
?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #f5f0ff, #fefbff);
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 20px;
    animation: fadeIn 1.2s ease;
  }

  h2 {
    text-align: center;
    font-size: 3rem;
    color: #6a38b2;
    margin-bottom: 50px;
    position: relative;
  }

  h2::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, #a97fff, #6b3cc9);
    border-radius: 3px;
    margin: 10px auto 0;
  }

  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 30px;
  }

  .product-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(107, 60, 201, 0.1);
    transition: all 0.4s ease;
    padding: 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .product-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 18px 35px rgba(107, 60, 201, 0.2);
  }

  .product-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 15px;
    transition: transform 0.4s ease;
  }

  .product-card:hover .product-img {
    transform: scale(1.03);
  }

  h3 {
    font-size: 1.4rem;
    color: #333;
    margin: 10px 0 5px;
  }

  p {
    font-size: 1.1rem;
    color: #6b3cc9;
    font-weight: bold;
  }

  .btn-main {
    display: inline-block;
    margin-top: 15px;
    padding: 12px 25px;
    background: linear-gradient(to right, #6b3cc9, #9f6fff);
    color: white;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .btn-main:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(107, 60, 201, 0.3);
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @media screen and (max-width: 600px) {
    .product-card {
      padding: 15px;
    }

    .product-img {
      height: 180px;
    }
  }
</style>

<div class="container">
  <h2>Explore Our Products</h2>
  <div class="product-grid">
    <?php
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $productID = $row["ProductID"];
        $productName = htmlspecialchars($row["ProductName"]);
        $price = number_format($row["Price"], 2);

        $webpPath = "product_images/{$productID}.webp";
        $jpgPath = "product_images/{$productID}.jpg";
        $defaultPath = "product_images/default.jpg";

        $hasWebp = file_exists($webpPath);
        $hasJpg = file_exists($jpgPath);

        echo '<div class="product-card">';

        if ($hasWebp && $hasJpg) {
          echo '
            <picture>
              <source srcset="' . $webpPath . '" type="image/webp">
              <img src="' . $jpgPath . '" alt="' . $productName . '" class="product-img">
            </picture>';
        } elseif ($hasJpg) {
          echo '<img src="' . $jpgPath . '" alt="' . $productName . '" class="product-img">';
        } elseif ($hasWebp) {
          echo '<img src="' . $webpPath . '" alt="' . $productName . '" class="product-img">';
        } else {
          echo '<img src="' . $defaultPath . '" alt="No image available" class="product-img">';
        }

        echo '
          <h3>' . $productName . '</h3>
          <p>₹' . $price . '</p>
          <a href="cart.php?add=' . $productID . '" class="btn-main">Add to Cart</a>
        </div>';
      }
    } else {
      echo "<p style='text-align:center;'>No products found.</p>";
    }
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
