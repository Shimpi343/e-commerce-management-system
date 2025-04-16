<?php
include 'db.php';
include 'header.php';
?>

<head>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f4e6ff, #e9ddf8);
      overflow-x: hidden;
    }

    .hero-section {
      max-width: 1200px;
      margin: 60px auto;
      padding: 40px 20px;
      text-align: center;
      position: relative;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-gif {
      width: 100%;
      max-width: 700px;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(107, 60, 201, 0.3);
      margin-bottom: 30px;
      transform: perspective(1000px);
      transition: transform 0.6s ease;
    }

    .hero-gif:hover {
      transform: perspective(1000px) rotateY(4deg) rotateX(2deg) scale(1.02);
    }

    h1 {
      font-size: 3rem;
      color: #6b3cc9;
      margin-bottom: 10px;
      animation: floatIn 1.5s ease-out;
    }

    p {
      font-size: 1.2rem;
      color: #555;
      margin-bottom: 30px;
      animation: floatIn 2s ease-out;
    }

    @keyframes floatIn {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn-main {
      background-color: #6b3cc9;
      color: white;
      padding: 14px 30px;
      font-size: 1.1rem;
      border: none;
      border-radius: 10px;
      text-decoration: none;
      box-shadow: 0 10px 20px rgba(107, 60, 201, 0.3);
      transition: all 0.3s ease;
    }

    .btn-main:hover {
      background-color: #5125aa;
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0 15px 25px rgba(107, 60, 201, 0.4);
    }

    /* Background animated dots */
    .animated-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .animated-bg span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(107, 60, 201, 0.2);
      animation: moveUp 20s linear infinite;
      border-radius: 50%;
    }

    .animated-bg span:nth-child(1) {
      left: 10%;
      width: 25px;
      height: 25px;
      animation-duration: 22s;
    }

    .animated-bg span:nth-child(2) {
      left: 30%;
      width: 15px;
      height: 15px;
      animation-duration: 18s;
    }

    .animated-bg span:nth-child(3) {
      left: 50%;
      width: 30px;
      height: 30px;
      animation-duration: 25s;
    }

    .animated-bg span:nth-child(4) {
      left: 70%;
      width: 20px;
      height: 20px;
      animation-duration: 19s;
    }

    .animated-bg span:nth-child(5) {
      left: 90%;
      width: 10px;
      height: 10px;
      animation-duration: 23s;
    }

    @keyframes moveUp {
      0% {
        bottom: -100px;
        transform: translateX(0) rotate(0deg);
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
      100% {
        bottom: 110%;
        transform: translateX(20px) rotate(360deg);
        opacity: 0;
      }
    }
  </style>
</head>

<div class="hero-section">
  <div class="animated-bg">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
  <img src="https://blog.gemfind.com/hubfs/ecommerce-subway-studio-malaysia%20%281%29.gif" alt="E-commerce Hero GIF" class="hero-gif">
  <h1>Welcome to EZCommerce</h1>
  <p>Your one-stop shop for smart, simple, and seamless online shopping.</p>
  <a href="product.php" class="btn-main">Shop Now</a>
</div>

<?php include 'footer.php'; ?>
