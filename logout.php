<?php
session_start();

// 清除所有 session 變數
session_unset();

// 銷毀 session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Out</title>
    <!-- 添加一個自動跳轉的 JavaScript 代碼 -->
    <script>
        setTimeout(function () {
            window.location.href = "index.php";
        }, 300); // 0.3 秒後跳轉
    </script>
</head>

<body>
    <h1>Sign Out Successful</h1>
</body>

</html>