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

// 接收來自 HTML 表單的數據
$email = $_POST['email'];
$password = $_POST['password'];

// 查詢用戶
$sql = "SELECT * FROM users WHERE U_EMAIL='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['PASSWORD'])) {
        // 密碼驗證成功，登錄成功
        $_SESSION['username'] = $row['U_NAME'];
        echo "login successed！Welcome," . $_SESSION['username'] . "！";
        header('Location:welcome.php');
    } else {
        // 密碼驗證失敗
        echo "password error，try again";
        header('Location:login.php'); 

    }
} else {
    // 用戶不存在
    echo "user not exist，please sign up the account";
    header('Location:login.php');
}

$conn->close();
?>
