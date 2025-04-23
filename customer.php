<?php
// Database connection
$host = 'localhost';
$db = 'streetwearfinal';
$user = '';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get customers who made at least one purchase
$sql = "
    SELECT u.id, u.username, u.email, u.created_at, COUNT(o.id) AS total_orders, SUM(o.total_amount) AS total_spent
    FROM users u
    INNER JOIN orders o ON u.id = o.user_id
    GROUP BY u.id
    ORDER BY total_orders DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Purchase Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #141e30, #243b55);
            color: #f4f4f4;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            background: #1c1c1c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #00ffcc;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2c2c2c;
        }

        th, td {
            padding: 12px 16px;
            text-align: center;
            border: 1px solid #444;
        }

        th {
            background-color: #00b894;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: left;
                border: none;
                border-bottom: 1px solid #555;
            }

            td::before {
                position: absolute;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #00ffcc;
            }

            td:nth-of-type(1)::before { content: "Username"; }
            td:nth-of-type(2)::before { content: "Email"; }
            td:nth-of-type(3)::before { content: "Account Created"; }
            td:nth-of-type(4)::before { content: "Total Orders"; }
            td:nth-of-type(5)::before { content: "Total Spent"; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Customers Who Made Purchases</h2>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Account Created</th>
                <th>Total Orders</th>
                <th>Total Spent</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>johndoe</td>
                <td>johndoe@example.com</td>
                <td>January 15, 2023</td>
                <td>2</td>
                <td>$75.00</td>
            </tr>
            <tr>
                <td>janedoe</td>
                <td>janedoe@example.com</td>
                <td>February 5, 2023</td>
                <td>1</td>
                <td>$40.00</td>
            </tr>
            <tr>
                <td>bobsmith</td>
                <td>bobsmith@example.com</td>
                <td>March 10, 2023</td>
                <td>2</td>
                <td>$140.00</td>
            </tr>
        </tbody>
    </table>
</div>


</body>
</html>

<?php
$conn->close();
?>
