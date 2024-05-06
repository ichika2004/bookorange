<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/welcome.css">
    
</head>
<body>
    <div class="navbar">
        <a href="welcome.php"><img src="icon/orange_icon.png" alt="Orange Icon"></a>
        <form id="searchForm" action="search.php" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Search...">
            <button type="submit" id="searchButton">Search</button>
        </form>
        <a href="welcome.php">Index</a>
        <a href="sell.php">On shelves</a>
        <a href="store.php">Your store</a>
        <a href="logout.php" style="float:right">Logout</a>
        <p style="float:right; color:black; padding:14px 20px;">Welcome! <?php echo $_SESSION['username']; ?>！</p>
    </div>

    <div class="content">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <h3>Random Products</h3>
        <div class="products">
            <?php
                // Connect to MySQL database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "bookorangeDB";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch random products
                $sql = "SELECT pNo, pName, p_img, unitPrice FROM Product ORDER BY RAND() LIMIT 9";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product-container'>";
                        echo "<a href='shop.php?pNo=" . $row['pNo'] . "'>";
                        echo "<div class='product'>";
                        echo "<img src='" . $row['p_img'] . "' alt='" . $row['pName'] . "'>";
                        echo "<div class='product-info'>";
                        echo "<h3>" . $row['pName'] . "</h3>";
                        echo "<p>Price: $" . $row['unitPrice'] . "</p>";
                        echo "</div></div></a></div>";
                    }
                } else {
                    echo "No products found";
                }

                $conn->close();
            ?>
        </div>
    </div>

</body>
</html>
