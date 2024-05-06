<?php
session_start();

// 檢查用戶是否已經登錄，如果已經登錄，導向到歡迎頁面
if (isset($_SESSION["username"])) {
    header("Location: welcome.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/login.css">
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
    <div class="container">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <div class= "new"><p>New user? <a href="sign.php">Sign up here.</a></p></div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

