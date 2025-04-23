<?php
session_start();
include('streetwearfinal_connection.php');

if (!isset($_SESSION['user'])) {
    header("Location: add-to-cart.php"); // Redirect to login, not this page
    exit;
}

$user = $_SESSION['user'];
$query = "SELECT id, product_name, product_price, image_path FROM cart_items WHERE user_id = ?";
$stmt = $conn->prepare(query: $query);
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $total += floatval($row['product_price']);
}
$stmt->close();
?>
<!-- HTML starts here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* CSS STYLES (as you have it, unchanged) */
    </style>
</head>
<body>
<!-- HTML BODY (unchanged, with cart items) -->
<!-- your HTML structure here remains the same -->
<script>
    const addons = document.querySelectorAll('.addon');
    addons.forEach(addon => addon.addEventListener('change', updateTotal));

    function updateTotal() {
        let addonTotal = 0;
        addons.forEach(addon => {
            if (addon.checked) {
                addonTotal += parseFloat(addon.dataset.price);
            }
        });
        const baseTotal = <?= $total ?>;
        document.getElementById("addon-total").textContent = `₱${addonTotal.toFixed(2)}`;
        document.getElementById("total-amount").textContent = `₱${(baseTotal + addonTotal).toFixed(2)}`;
    }
</script>
</body>
</html>
