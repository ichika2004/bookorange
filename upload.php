<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Connect to the MySQL database
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$database = "bookorangeDB"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user UID
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Get user UID
    $sqlUser = "SELECT UID FROM users WHERE U_NAME = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $stmtUser->store_result();
    $stmtUser->bind_result($userId);
    $stmtUser->fetch();
    $stmtUser->close();
}

$target_dir = "Product_img/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if directory is writable
if (!is_writable($target_dir)) {
    echo 'Directory is not writable. Please modify directory permissions.';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 接收表單提交的資料
    $pName = $_POST['pName'];
    $unitPrice = $_POST['unitPrice'];
    $category = $_POST['category'];
    $language = $_POST['language'];
    $p_intro = $_POST['p_intro'];
    $methods = implode(", ", $_POST['method']);
    $payment_methods = implode(", ", $_POST['payment_method']);

    $pNo = ""; // 初始化商品編號
    $target_file = ""; // 初始化目標檔案名稱
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["p_img"]["name"], PATHINFO_EXTENSION));

    // 取得最後一筆商品編號
    $sql_last_pNo = "SELECT MAX(pNo) AS max_pNo FROM Product";
    $result_last_pNo = mysqli_query($conn, $sql_last_pNo);
    $row_last_pNo = mysqli_fetch_assoc($result_last_pNo);
    $last_pNo = $row_last_pNo['max_pNo'];
    
    // 計算新商品的編號
    if ($last_pNo === null) {
        $pNo = str_pad(1, 10, '0', STR_PAD_LEFT);
    } else {
        $pNo = str_pad($last_pNo + 1, 10, '0', STR_PAD_LEFT);
    }

    // 生成唯一的檔名
    $unique_id = uniqid();
    $target_file = $target_dir . $pNo . '_' . $unique_id . "." . $imageFileType;

    // 檢查是否為圖片檔案
    $check = getimagesize($_FILES["p_img"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // 檢查檔案大小
    if ($_FILES["p_img"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // 允許特定的檔案格式
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp") {
        echo "Sorry, only JPG, JPEG, PNG, GIF & WebP files are allowed.";
        $uploadOk = 0;
    }
    // 檢查 $uploadOk 是否為 0
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // 如果一切正確，嘗試上傳檔案
    } else {
        if (move_uploaded_file($_FILES["p_img"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["p_img"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // 將資料插入到資料庫中
    $sql_product = "INSERT INTO Product (pNo, pName, p_img, p_intro, category, unitPrice, method, language, payment_method)
    VALUES ('$pNo', '$pName', '$target_file', '$p_intro', '$category', '$unitPrice', '$methods', '$language', '$payment_methods')";
    $sql_sell = "INSERT INTO SELL (UID, pNo, date)
    VALUES ('$userId', '$pNo', NOW())";

    if (mysqli_query($conn, $sql_product) && mysqli_query($conn, $sql_sell)) {
        header("Location: welcome.php");
        exit();
    } else {
        echo "ERROR: Could not able to execute $sql_product and $sql_sell. " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
