<?php
session_start();

// 檢查用戶是否已經登錄，如果沒有登錄，導向到登錄頁面
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// 連接到 MySQL 資料庫
$servername = "localhost";
$username = "root"; // 資料庫使用者名稱
$password = ""; // 資料庫密碼
$database = "bookorangeDB"; // 資料庫名稱

// 建立連線
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// 獲取當前使用者的商品
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // 獲取使用者的 UID
    $sqlUser = "SELECT UID FROM users WHERE U_NAME = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $stmtUser->store_result();
    $stmtUser->bind_result($userId);


    if ($stmtUser->fetch()) {
        $stmtUser->close();

        // 獲取使用者上架的商品
        $sql = "SELECT Product.pNo, pName, p_img, p_intro, category, language, unitPrice, method FROM SELL 
                INNER JOIN Product ON Product.pNo = SELL.pNo WHERE UID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        echo "Error fetching user information.";
    }
} else {
    // Redirect to login page or handle as appropriate
    header("Location: login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/store.css">
    <title>Store</title>
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
<h1>Store</h1>
<h3>Your Products:</h3>
<div id="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <a href="shop.php?pNo=<?php echo $product['pNo']; ?>">
                <img src="<?php echo $product['p_img']; ?>" alt="<?php echo $product['pName']; ?>">
            </a>
            <div class="product-info">
                <h3><?php echo $product['pName']; ?></h3>
                <div class="price">Price: $<?php echo $product['unitPrice']; ?></div>
                <div class="button_product">
                    <a href="edit_product.php?pNo=<?php echo $product['pNo']; ?>" class="edit-button">Edit</a>
                    <form action="delete_product.php" method="post">
                        <input type="hidden" name="pNo" value="<?php echo $product['pNo']; ?>">
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="delete-button">
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
