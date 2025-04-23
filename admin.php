<?php
session_start();

// block non-admins (or guests)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Streetwear Admin Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body { background-color: #f4f7f9; font-family: 'Segoe UI', sans-serif; }
    .sidebar { height: 100vh; background: #112b3c; color: #fff; }
    .sidebar .nav-link { color: #cfd8dc; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { background: #00d1c1; color: #112b3c; }
    .profile-img { width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00d1c1; object-fit: cover; }
    .card-icon { font-size: 2rem; color: #00d1c1; }
    .status-delivered { background-color: #4caf50; color: #fff; }
    .status-pending { background-color: #ff9800; color: #fff; }
    .status-return { background-color: #f44336; color: #fff; }
    .status-inProgress { background-color: #2196f3; color: #fff; }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-md-block sidebar py-4">
      <div class="text-center mb-4">
        <h4>STREETWEAR</h4>
        <img src="image\millenium.jpeg" class="profile-img mb-2">
        <h6><?= htmlspecialchars($user['firstname']) ?></h6>
        <p>Admin</p>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="customer.php">Customer</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>
      </ul>
    </nav>

    <!-- Main -->
    <main class="col-md-10 ms-sm-auto px-md-4 py-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h2>Dashboard</h2>
        <div class="input-group w-50">
          <input type="text" class="form-control" placeholder="Search here">
          <span class="input-group-text"><ion-icon name="search-outline"></ion-icon></span>
        </div>
      </div>

      <!-- Cards -->
      <div class="row g-4 mb-4">
        <div class="col-md-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4>1,504</h4>
                <small>Daily Views</small>
              </div>
              <ion-icon class="card-icon" name="eye-outline"></ion-icon>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4>157</h4>
                <small>Sales</small>
              </div>
              <ion-icon class="card-icon" name="cart-outline"></ion-icon>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4>284</h4>
                <small>Comments</small>
              </div>
              <ion-icon class="card-icon" name="chatbubbles-outline"></ion-icon>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4>₱46,284</h4>
                <small>Earnings</small>
              </div>
              <ion-icon class="card-icon" name="cash-outline"></ion-icon>
            </div>
          </div>
        </div>
      </div>

      <!-- Orders & Customers -->
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5>Recent Orders</h5>
              <a href="orders.php" class="btn btn-sm btn-info text-white">View All</a>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="table-dark">
                  <tr><th>Name</th><th>Price</th><th>Payment</th><th>Status</th></tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Nike G.T. Jump 2</td>
                    <td>₱1700</td>
                    <td>Paid</td>
                    <td><span class="badge status-delivered">Delivered</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5>Recent Customers</h5>
              <a href="customers.php" class="btn btn-sm btn-info text-white">View All</a>
            </div>
            <ul class="list-group list-group-flush">
  <li class="list-group-item d-flex align-items-center">
    <img src="image/price 1.jpg" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
    <div>
      <div>Loxes Kawaii</div>
      <small class="text-muted">Tokyo, Japan</small>
    </div>
  </li>
  <li class="list-group-item d-flex align-items-center">
    <img src="image/low air force.jpeg" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
    <div>
      <div>Denjzel</div>
      <small class="text-muted">Osaka, Japan</small>
    </div>
  </li>
  <li class="list-group-item d-flex align-items-center">
    <img src="image/nike dunk.jpeg" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
    <div>
      <div>Yurii</div>
      <small class="text-muted">Nagoya, Japan</small>
    </div>
  </li>
  <li class="list-group-item d-flex align-items-center">
    <img src="image/air force 1.jpeg" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
    <div>
      <div>Taguro</div>
      <small class="text-muted">Fukuoka, Japan</small>
    </div>
  </li>
  <li class="list-group-item d-flex align-items-center">
    <img src="image/th.jpeg" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
    <div>
      <div>Sensui</div>
      <small class="text-muted">Kyoto, Japan</small>
    </div>
  </li>
</ul>

          </div>
        </div>
      </div>
    </main>
  </div>
</>

<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
