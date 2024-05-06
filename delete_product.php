<?php
session_start();

// 檢查用戶是否已經登錄，如果沒有登錄，導向到登錄頁面
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// 檢查是否收到 pNo
if (isset($_POST['pNo']) && !empty($_POST['pNo'])) {
    $pNo = $_POST['pNo'];

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

    // 獲取使用者的 UID
    $username = $_SESSION["username"];
    $sqlUser = "SELECT UID FROM users WHERE U_NAME = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $stmtUser->store_result();
    $stmtUser->bind_result($userId);

    if ($stmtUser->fetch()) {
        $stmtUser->close();

        // 獲取商品圖片路徑
        $sqlImage = "SELECT p_img FROM Product WHERE pNo = ?";
        $stmtImage = $conn->prepare($sqlImage);
        $stmtImage->bind_param("i", $pNo);
        $stmtImage->execute();
        $stmtImage->store_result();
        $stmtImage->bind_result($imgPath);
        $stmtImage->fetch();
        $stmtImage->close();

        // 刪除圖片文件
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }

        // 刪除 SELL 表中的相應記錄
        $sqlDeleteSELL = "DELETE FROM SELL WHERE pNo = ? AND UID = ?";
        $stmtDeleteSELL = $conn->prepare($sqlDeleteSELL);
        $stmtDeleteSELL->bind_param("ii", $pNo, $userId);
        $stmtDeleteSELL->execute();
        $stmtDeleteSELL->close();

        // 刪除 Product 表中的相應記錄
        $sqlDeleteProduct = "DELETE FROM Product WHERE pNo = ?";
        $stmtDeleteProduct = $conn->prepare($sqlDeleteProduct);
        $stmtDeleteProduct->bind_param("i", $pNo);
        $stmtDeleteProduct->execute();
        $stmtDeleteProduct->close();

        // 關閉連線
        $conn->close();

        // 重新導向到 store.php
        header("Location: store.php");
        exit();
    } else {
        echo "Error fetching user information.";
    }
} else {
    // 如果未收到 pNo，重新導向到 store.php
    header("Location: store.php");
    exit();
}
?>
