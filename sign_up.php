<?php
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
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

// 加密密碼
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL 插入語句
$sql = "INSERT INTO users (PASSWORD, U_NAME, U_EMAIL, U_PHONE)
VALUES ('$hashed_password', '$username', '$email', '$phone')";


if ($conn->query($sql) === TRUE) {
    echo "sign up success！";
    header("Location:login.php");
    
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
