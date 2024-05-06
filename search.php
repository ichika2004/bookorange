<?php

session_start();

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

// 取得商品類別列表
$sqlCategory = "SELECT DISTINCT category FROM Product";
$resultCategory = $conn->query($sqlCategory);
$categories = [];
if ($resultCategory->num_rows > 0) {
    while ($row = $resultCategory->fetch_assoc()) {
        $categories[] = $row['category'];
    }
}

// 取得語言列表
$sqlLanguage = "SELECT DISTINCT language FROM Product";
$resultLanguage = $conn->query($sqlLanguage);
$languages = [];
if ($resultLanguage->num_rows > 0) {
    while ($row = $resultLanguage->fetch_assoc()) {
        $languages[] = $row['language'];
    }
}

// 進行搜尋
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search = $_GET['query'];
    $category = $_GET['category'] ?? '';
    $language = $_GET['language'] ?? '';

    $sql = "SELECT * FROM Product WHERE 
                (pName LIKE '%$search%' OR 
                p_intro LIKE '%$search%')";

    if (!empty($category)) {
        $sql .= " AND category = '$category'";
    }

    if (!empty($language)) {
        $sql .= " AND language = '$language'";
    }

    $sql .= " ORDER BY pNo DESC";

    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        $message = "No products found!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/search.css">
    <title>Search Results</title>
</head>
<body>
<div class="navbar">
    <a href="welcome.php"><img src='icon/orange_icon.png'></a>
    <form id="searchForm" action="search.php" method="GET">
        <input type="text" name="query" id="searchInput" placeholder="Search..." value="<?php if (isset($search)) echo $search; ?>">
        <select name="category" id="category" onchange="document.getElementById('searchForm').submit()">
            <option value="">Select Category</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category; ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $category) echo 'selected'; ?>><?php echo $category; ?></option>
            <?php endforeach; ?>
        </select>
        <select name="language" id="language" onchange="document.getElementById('searchForm').submit()">
            <option value="">Select Language</option>
            <?php foreach ($languages as $language) : ?>
                <option value="<?php echo $language; ?>" <?php if (isset($_GET['language']) && $_GET['language'] == $language) echo 'selected'; ?>><?php echo $language; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" id="searchButton">Search</button>
    </form>
    <a href="welcome.php">Index</a>
    <a href="sell.php">On shelves</a>
    <a href="store.php">Your store</a>
    <?php if(isset($_SESSION['username'])) : ?>
        <p style="float:right; color:black; padding:14px 20px;">Welcome!<?php echo $_SESSION['username']; ?>！</p>
        <a href="logout.php" style="float:right">Logout</a>
    <?php else : ?>
        <a href="login.php" style="float:right">Login</a>
    <?php endif; ?>
</div>

<div class="content">
    <h2>Search Results</h2>
    <?php if (!empty($products)) : ?>
        <div id="products">
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <a href="shop.php?pNo=<?php echo $product['pNo']; ?>">
                        <img src="<?php echo $product['p_img']; ?>" alt="<?php echo $product['pName']; ?>">
                    </a>
                    <div class="product-info">
                        <h3><?php echo $product['pName']; ?></h3>
                        <p>Price: $<?php echo $product['unitPrice']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
