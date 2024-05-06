<?php
session_start();

// 檢查用戶是否已經登錄，如果已經登錄，導向 welcome.php 頁面
if(isset($_SESSION['U_NAME'])){
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="style/welcome.css">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
</head>
<body>

<div class="navbar">
    <a href="index.php"><img src="icon/orange_icon.png" alt="Orange Icon"></a>
    <form id="searchForm" action="search.php" method="GET">
        <input type="text" name="query" id="searchInput" placeholder="Search...">
        <button type="submit" id="searchButton">Search</button>
    </form>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="sign.php">Sign Up</a>
</div>

<div class="content">
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
<script src="search.js"></script>