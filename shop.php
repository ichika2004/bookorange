<?php
session_start();

// Connect to MySQL database
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$database = "bookorangeDB"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pNo = $_GET['pNo'];

// Get product information
$sql = "SELECT * FROM Product WHERE pNo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pNo);
$stmt->execute();
$result = $stmt->get_result();

$product = $result->fetch_assoc();

// Get allowed shipping methods
$shippingMethods = explode(", ", $product['method']);

// Get allowed payment methods
$paymentMethods = explode(", ", $product['payment_method']);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/shop.css">
    <title>Shop</title>
</head>
<body>
<div class="navbar">
    <a href="welcome.php"><img src='icon/orange_icon.png'></a>
    <form id="searchForm" action="search.php" method="GET">
        <input type="text" name="query" id="searchInput" placeholder="Search...">
        <button type="submit" id="searchButton">Search</button>
    </form>
    <a href="welcome.php">Index</a>
    
    <a href="sell.php">On shelves</a>
    <a href="store.php">Your Store</a>
    <a href="logout.php" style="float:right">Logout</a>
    <p style="float:right; color:black; padding:14px 20px;">Welcome!<?php echo $_SESSION['username']; ?>！</p>
</div>

<div class="content">
    <h2>Product Information</h2>
    <div class="product">
        <img src="<?php echo $product['p_img']; ?>" alt="<?php echo $product['pName']; ?>">
        <div class="product-info">
            <h3><?php echo $product['pName']; ?></h3>
            <p>Category: <?php echo $product['category']; ?></p>
            <p>Language: <?php echo $product['language']; ?></p>
            <p>Unit Price: $<?php echo $product['unitPrice']; ?></p>
            
            <form action="order.php" method="post">
                <input type="hidden" name="pNo" value="<?php echo $product['pNo']; ?>">
                <label for="quantity">Quantity:</label>
                <div class="quantity">
                    <input type="button" value="-" onclick="minus()">
                    <input type="number" id="quantity" name="quantity" min="0" max="99" value="0" required>
                    <input type="button" value="+" onclick="plus()">
                </div>
                <br>
                <label for="shippingMethod">Shipping Method:</label>
                <select name="shippingMethod" id="shippingMethod">
                    <?php foreach ($shippingMethods as $method): ?>
                        <option value="<?php echo $method; ?>"><?php echo $method; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label for="paymentMethod">Payment Method:</label>
                <select name="paymentMethod" id="paymentMethod">
                    <?php foreach ($paymentMethods as $method): ?>
                        <option value="<?php echo $method; ?>"><?php echo $method; ?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
                <input type="submit" value="Order Now" class="order-button">
            </form>
        </div>
    </div>
    <div class='product_description'>
        <h3>Description</h3>
        <p><?php echo $product['p_intro']; ?></p>
    </div>
</div>

<script>
    function plus() {
        var quantity = document.getElementById('quantity');
        if (quantity.value < 99) {
            quantity.value = parseInt(quantity.value) + 1;
        }
    }

    function minus() {
        var quantity = document.getElementById('quantity');
        if (quantity.value > 0) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }
</script>

</body>
</html>
<script src="search.js"></script>