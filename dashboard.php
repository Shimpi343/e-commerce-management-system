<?php
include 'db.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - EZCommerce</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #f5f0ff, #ece3ff);
    }

    .dashboard-container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
      animation: fadeIn 1s ease;
    }

    h1 {
      text-align: center;
      color: #6b3cc9;
      margin-bottom: 40px;
      font-size: 2.8rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 30px;
    }

    .card {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .card h2 {
      margin: 10px 0;
      color: #6b3cc9;
      font-size: 2rem;
    }

    .card p {
      font-size: 1rem;
      color: #666;
    }

    .icon-circle {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #ede2ff;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      color: #6b3cc9;
      box-shadow: 0 5px 10px rgba(107, 60, 201, 0.2);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card a {
      display: inline-block;
      margin-top: 15px;
      background-color: #6b3cc9;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .card a:hover {
      background-color: #5125aa;
    }

  </style>
</head>
<body>

<div class="dashboard-container">
  <h1>Admin Dashboard</h1>
  <div class="card-grid">
    
    <div class="card">
      <div class="icon-circle">👥</div>
      <h2>Manage Customers</h2>
      <p>View and manage customer accounts.</p>
      <a href="manage_customers.php">View</a>
    </div>

    <div class="card">
      <div class="icon-circle">📦</div>
      <h2>Manage Products</h2>
      <p>Add, edit, or remove products.</p>
      <a href="add_product.php">Add Product</a>
    </div>

    <div class="card">
      <div class="icon-circle">🛒</div>
      <h2>Orders</h2>
      <p>Review and manage all orders.</p>
      <a href="manage_orders.php">Manage Orders</a>
    </div>

    <div class="card">
      <div class="icon-circle">📊</div>
      <h2>Reports</h2>
      <p>Analyze sales and performance.</p>
      <a href="reports.php">View Reports</a>
    </div>

    <div class="card">
      <div class="icon-circle">🏷️</div>
      <h2>Categories</h2>
      <p>Organize products into categories.</p>
      <a href="manage_categories.php">Manage</a>
    </div>

    <div class="card">
      <div class="icon-circle">⭐</div>
      <h2>Feedback</h2>
      <p>See what customers are saying.</p>
      <a href="view_feedback.php">View Feedback</a>
    </div>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
