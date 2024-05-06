<?php
session_start();

// 檢查用戶是否已經登錄，如果沒有登錄，導向到登錄頁面
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// 確認是否提供了商品編號
if (!isset($_POST['pNo'])) {
    echo "未提供商品編號";
    exit();
}

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

// 獲取原始商品資訊
$sql = "SELECT * FROM Product WHERE pNo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pNo);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// 原始圖片路徑
$oldImagePath = $product['p_img'];

$conn->close();

// 刪除原始圖片
if (file_exists($oldImagePath)) {
    unlink($oldImagePath);
}

// 上傳新圖片
$targetDir = "Product_img/";
$targetFile = ""; // 初始化目標檔案名稱
$pNo = str_pad($pNo, 10, '0', STR_PAD_LEFT);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES["p_img"]["name"], PATHINFO_EXTENSION));
$unique_id = uniqid();
$targetFile = $targetDir.$pNo . '_' . $unique_id . "." . $imageFileType;

// 檢查檔案是否為圖片
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["p_img"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "檔案不是圖片。";
        $uploadOk = 0;
    }
}

// 檢查檔案是否已經存在
if (file_exists($targetFile)) {
    echo "抱歉，檔案已經存在。";
    $uploadOk = 0;
}

// 檢查檔案大小
if ($_FILES["p_img"]["size"] > 500000) {
    echo "抱歉，檔案太大。";
    $uploadOk = 0;
}

// 允許特定的檔案格式
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "抱歉，只接受 JPG, JPEG, PNG & GIF 檔案。";
    $uploadOk = 0;
}

// 檢查 $uploadOk 是否為 0
if ($uploadOk == 0) {
    echo "抱歉，檔案未上傳。";
// 如果一切正確，嘗試上傳檔案
} else {
    if (move_uploaded_file($_FILES["p_img"]["tmp_name"], $targetFile)) {
        echo "檔案 ". basename( $_FILES["p_img"]["name"]). " 已經上傳。";
    } else {
        echo "抱歉，上傳檔案時發生錯誤。";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <script>
        function confirmUpdate() {
            var confirmation = confirm("Are you sure you want to update this product?");
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>
<body>
<?php
// 確認是否要更新商品
if (isset($_POST['pName']) && isset($_POST['unitPrice']) && isset($_POST['category']) && isset($_POST['language']) && isset($_POST['method']) && isset($_POST['payment_method']) && isset($_POST['p_intro'])) {
    if ($_POST['pName'] != $product['pName'] || $_POST['unitPrice'] != $product['unitPrice'] || $_POST['category'] != $product['category'] || $_POST['language'] != $product['language'] || $_POST['method'] != $product['method'] || $_POST['payment_method'] != $product['payment_method'] || $_POST['p_intro'] != $product['p_intro']) {
        echo "<script>if(!confirmUpdate()) { window.location = 'sell.php'; } </script>";
    }
}

// 更新商品資訊
if (isset($_POST['pName']) && isset($_POST['unitPrice']) && isset($_POST['category']) && isset($_POST['language']) && isset($_POST['method']) && isset($_POST['payment_method']) && isset($_POST['p_intro'])) {
    // 連接到 MySQL 資料庫
    $conn = new mysqli($servername, $username, $password, $database);

    // 檢查連線是否成功
    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    }

    $pName = $_POST['pName'];
    $unitPrice = $_POST['unitPrice'];
    $category = $_POST['category'];
    $language = $_POST['language'];
    $method = implode(", ", $_POST['method']);
    $payment_method = implode(", ", $_POST['payment_method']);
    $p_intro = $_POST['p_intro'];

    $sql = "UPDATE Product SET pName=?, unitPrice=?, category=?, language=?, method=?, payment_method=?, p_intro=?, p_img=? WHERE pNo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssssi", $pName, $unitPrice, $category, $language, $method, $payment_method, $p_intro, $targetFile, $pNo);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating product: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
<script>
    setTimeout(function() {
        window.location = 'store.php';
    }, 300);
</script>

</body>
</html>
