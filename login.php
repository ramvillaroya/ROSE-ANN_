<?php
session_start(); // start session at top

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "streetwearfinal";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim inputs
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Prepare and execute lookup by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If we found exactly one user, verify password
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct: store user in session
            $_SESSION['user'] = $user;

            // Redirect according to role
            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #00D1C1;
      height: 100vh;
      display: flex;
      justify-content: right;
      align-items: center;
      background-size: cover;
      background-position: left;
      background-attachment: fixed;
    }
    .login-container {
      display: flex;
      height: 100vh;
      max-width: 100%;
    }
    .left-side {
      flex: 0.7;
      background-color: #00D1C1;
      display: flex;
      justify-content: left;
      align-items: left;
    }
    .left-side img {
      max-width: 100%;
      height: auto;
      display: block;
    }
    .form-side {
      flex: 1;
      padding: 60px;
      background-color: #112b3c;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      max-width: 400px;
    }
    h2 { margin-bottom: 20px; color: #00D1C1; }
    form { display: flex; flex-direction: column; }
    label {
      margin-top: 10px;
      margin-bottom: 5px;
      font-weight: bold;
      color: white;
    }
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      color: white;
      background-color: #333;
      width: 80%;
    }
    button {
      padding: 12px;
      margin-top: 15px;
      background-color: #00D1C1;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background-color: #00b3a9; }
    .links { margin-top: 15px; }
    .links a {
      color: white;
      text-decoration: none;
      font-size: 14px;
    }
    .top-link {
      margin-top: 20px;
      font-size: 14px;
      color: white;
    }
    .top-link a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    .error-message {
      color: red;
      margin-top: 10px;
      font-weight: bold;
    }
    @media (max-width: 480px) {
      .form-side {
        width: 90%;
        padding: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="left-side">
      <img src="image/new shoes.avif" alt="Streetwear Image">
    </div>
    <div class="form-side">
      <h2>Login</h2>
      <form method="POST" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
      </form>
      <?php if (!empty($error)) : ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
      <div class="links">
        <a href="#">Forgot password?</a>
      </div>
      <div class="top-link">
        Don't have an account? <a href="register.php">Sign up</a>
      </div>
    </div>
  </div>
</body>
</html>
