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

// 確認是否提供了商品編號
if (!isset($_GET['pNo'])) {
    echo "未提供商品編號";
    exit();
}

$pNo = $_GET['pNo'];

// 獲取商品資訊
$sql = "SELECT * FROM Product WHERE pNo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pNo);
$stmt->execute();
$result = $stmt->get_result();

$product = $result->fetch_assoc();

// 獲取允許的運送方式
$shippingMethods = explode(", ", $product['method']);

// 獲取允許的付款方式
$paymentMethods = explode(", ", $product['payment_method']);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/form_upload.css">
    <link rel="stylesheet" type="text/css" href="style/preview_image.css">
    <title>Edit Product</title>
</head>
<body>
<div class="navbar">
    <a href="welcome.php"><img src='icon/orange_icon.png'></a>
    <a href="#home">Index</a>
    <a href="sell.php">On shelves</a>
    <a href="store.php">Your Store</a>
    <a href="logout.php" style="float:right">Logout</a>
    <p style="float:right; color:black; padding:14px 20px;">Welcome!<?php echo $_SESSION['username']; ?>！</p>
</div>

<div class="content">
    <fieldset>
        <legend><h2>Edit Product</h2></legend>
        <form action="update_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pNo" value="<?php echo $product['pNo']; ?>">
            <div class="sell_1">
                <div class='left'>
                    <div class="form-group">
                        <label for="p_img">Product Image (Click to upload)</label><br>
                        <input type="file" id="p_img" name="p_img" accept="image/*" onchange="preview_image(this, 'preview_img')" style="display: none;"><br>
                        <img id="preview_img" src="<?php echo $product['p_img']; ?>" alt="Image Preview" onclick="document.getElementById('p_img').click();"><br>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label for="pName">Product Name:</label><br>
                        <input type="text" id="pName" name="pName" value="<?php echo $product['pName']; ?>" required><br>
                    </div>
                    <div class="form-group">
                        <label for="unitPrice">Unit Price:</label><br>
                        <input type="number" id="unitPrice" name="unitPrice" value="<?php echo $product['unitPrice']; ?>" min="0" required><br>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label><br>
                        <select id="category" name="category" required>
                            <option value="" disabled>Select a Category</option>
                            <option value="Fiction & Literature" <?php if ($product['category'] === "Fiction & Literature") echo "selected"; ?>>Fiction & Literature</option>
                            <option value="Business & Finance" <?php if ($product['category'] === "Business & Finance") echo "selected"; ?>>Business & Finance</option>
                            <option value="Arts & Design" <?php if ($product['category'] === "Arts & Design") echo "selected"; ?>>Arts & Design</option>
                            <option value="Social Sciences" <?php if ($product['category'] === "Social Sciences") echo "selected"; ?>>Social Sciences</option>
                            <option value="Self-Help" <?php if ($product['category'] === "Self-Help") echo "selected"; ?>>Self-Help</option>
                            <option value="Religion & Spirituality" <?php if ($product['category'] === "Religion & Spirituality") echo "selected"; ?>>Religion & Spirituality</option>
                            <option value="Natural Sciences" <?php if ($product['category'] === "Natural Sciences") echo "selected"; ?>>Natural Sciences</option>
                            <option value="Health & Wellness" <?php if ($product['category'] === "Health & Wellness") echo "selected"; ?>>Health & Wellness</option>
                            <option value="Cooking" <?php if ($product['category'] === "Cooking") echo "selected"; ?>>Cooking</option>
                            <option value="Lifestyle" <?php if ($product['category'] === "Lifestyle") echo "selected"; ?>>Lifestyle</option>
                            <option value="Travel" <?php if ($product['category'] === "Travel") echo "selected"; ?>>Travel</option>
                            <option value="Children's & Young Adult" <?php if ($product['category'] === "Children's & Young Adult") echo "selected"; ?>>Children's & Young Adult</option>
                            <option value="Reference" <?php if ($product['category'] === "Reference") echo "selected"; ?>>Reference</option>
                            <option value="Parenting & Family" <?php if ($product['category'] === "Parenting & Family") echo "selected"; ?>>Parenting & Family</option>
                            <option value="Entertainment" <?php if ($product['category'] === "Entertainment") echo "selected"; ?>>Entertainment</option>
                            <option value="Light Novel" <?php if ($product['category'] === "Light Novel") echo "selected"; ?>>Light Novel</option>
                            <option value="Comics & Graphic Novels" <?php if ($product['category'] === "Comics & Graphic Novels") echo "selected"; ?>>Comics & Graphic Novels</option>
                            <option value="Language Learning" <?php if ($product['category'] === "Language Learning") echo "selected"; ?>>Language Learning</option>
                            <option value="Test Preparation" <?php if ($product['category'] === "Test Preparation") echo "selected"; ?>>Test Preparation</option>
                            <option value="Computers & Technology" <?php if ($product['category'] === "Computers & Technology") echo "selected"; ?>>Computers & Technology</option>
                            <option value="Textbooks & Government Publications" <?php if ($product['category'] === "Textbooks & Government Publications") echo "selected"; ?>>Textbooks & Government Publications</option>
                            <option value="Arts & Design" <?php if ($product['category'] === "Arts & Design") echo "selected"; ?>>Arts & Design</option>
                            <option value="History & Geography" <?php if ($product['category'] === "History & Geography") echo "selected"; ?>>History & Geography</option>
                            <option value="Other" <?php if ($product['category'] === "Other") echo "selected"; ?>>Other</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label for="language">Language:</label><br>
                        <select id="language" name="language" required>
                            <option value="" disabled>Select a Language</option>
                            <option value="English" <?php if ($product['language'] === "English") echo "selected"; ?>>English</option>
                            <option value="Chinese" <?php if ($product['language'] === "Chinese") echo "selected"; ?>>Chinese</option>
                            <option value="Spanish" <?php if ($product['language'] === "Spanish") echo "selected"; ?>>Spanish</option>
                            <option value="French" <?php if ($product['language'] === "French") echo "selected"; ?>>French</option>
                            <option value="German" <?php if ($product['language'] === "German") echo "selected"; ?>>German</option>
                            <option value="Japanese" <?php if ($product['language'] === "Japanese") echo "selected"; ?>>Japanese</option>
                            <option value="Korean" <?php if ($product['language'] === "Korean") echo "selected"; ?>>Korean</option>
                            <option value="Italian" <?php if ($product['language'] === "Italian") echo "selected"; ?>>Italian</option>
                            <option value="Portuguese" <?php if ($product['language'] === "Portuguese") echo "selected"; ?>>Portuguese</option>
                            <option value="Russian" <?php if ($product['language'] === "Russian") echo "selected"; ?>>Russian</option>
                            <option value="Arabic" <?php if ($product['language'] === "Arabic") echo "selected"; ?>>Arabic</option>
                            <option value="Dutch" <?php if ($product['language'] === "Dutch") echo "selected"; ?>>Dutch</option>
                            <option value="Swedish" <?php if ($product['language'] === "Swedish") echo "selected"; ?>>Swedish</option>
                            <option value="Polish" <?php if ($product['language'] === "Polish") echo "selected"; ?>>Polish</option>
                            <option value="Danish" <?php if ($product['language'] === "Danish") echo "selected"; ?>>Danish</option>
                            <option value="Norwegian" <?php if ($product['language'] === "Norwegian") echo "selected"; ?>>Norwegian</option>
                            <option value="Finnish" <?php if ($product['language'] === "Finnish") echo "selected"; ?>>Finnish</option>
                            <option value="Greek" <?php if ($product['language'] === "Greek") echo "selected"; ?>>Greek</option>
                            <option value="Hebrew" <?php if ($product['language'] === "Hebrew") echo "selected"; ?>>Hebrew</option>
                            <option value="Hindi" <?php if ($product['language'] === "Hindi") echo "selected"; ?>>Hindi</option>
                            <option value="Indonesian" <?php if ($product['language'] === "Indonesian") echo "selected"; ?>>Indonesian</option>
                            <option value="Thai" <?php if ($product['language'] === "Thai") echo "selected"; ?>>Thai</option>
                            <option value="Turkish" <?php if ($product['language'] === "Turkish") echo "selected"; ?>>Turkish</option>
                            <option value="Vietnamese" <?php if ($product['language'] === "Vietnamese") echo "selected"; ?>>Vietnamese</option>
                            <option value="Other" <?php if ($product['language'] === "Other") echo "selected"; ?>>Other</option>
                        </select><br>
                    </div>
                    <label for="method">Shipping Method:</label><br>
                <input type="checkbox" id="seller_delivery" name="method[]" value="Seller Delivery" <?php if (in_array("Seller Delivery", $shippingMethods)) echo "checked"; ?>> <label for="seller_delivery">Seller Delivery</label><br>
                <input type="checkbox" id="convenience_store" name="method[]" value="Convenience Store" <?php if (in_array("Convenience Store", $shippingMethods)) echo "checked"; ?>> <label for="convenience_store">Convenience Store</label><br>
                <input type="checkbox" id="self_pickup" name="method[]" value="Self Pickup" <?php if (in_array("Self Pickup", $shippingMethods)) echo "checked"; ?>> <label for="self_pickup">Self Pickup</label><br><br>
                
                <label for="payment">Payment Method:</label><br>
                <input type="checkbox" id="credit_card" name="payment_method[]" value="Credit Card/Debit Card" <?php if (in_array("Credit Card/Debit Card", $paymentMethods)) echo "checked"; ?>> <label for="credit_card">Credit Card/Debit Card</label><br>
                <input type="checkbox" id="bank_transfer" name="payment_method[]" value="Bank Transfer" <?php if (in_array("Bank Transfer", $paymentMethods)) echo "checked"; ?>> <label for="bank_transfer">Bank Transfer</label><br>
                <input type="checkbox" id="cash_on_delivery" name="payment_method[]" value="Cash on Delivery" <?php if (in_array("Cash on Delivery", $paymentMethods)) echo "checked"; ?>> <label for="cash_on_delivery">Cash on Delivery</label><br>
                <input type="checkbox" id="paypal" name="payment_method[]" value="PayPal" <?php if (in_array("PayPal", $paymentMethods)) echo "checked"; ?>> <label for="paypal">PayPal</label><br>
                <input type="checkbox" id="mobile_payment" name="payment_method[]" value="Mobile Payment" <?php if (in_array("Mobile Payment", $paymentMethods)) echo "checked"; ?>> <label for="mobile_payment">Mobile Payment</label><br><br>
                
                </div>
            </div>
            <div class="form-group">
                <label for="p_intro">Product Description:</label><br>
                <textarea id="p_intro" name="p_intro" rows="4" required><?php echo $product['p_intro']; ?></textarea><br>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Product">
            </div>
        </form>
    </fieldset>
</div>

<style>
    #preview_img {
        max-width: 300px;
        max-height: 250px;
        border: 2px dashed #ccc;
        border-radius: 5px;
        cursor: pointer;
        width: auto;
        height: 250px;
    }
</style>
<script>
    function preview_image(input, previewId) {
        var preview = document.getElementById(previewId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "icon/upload.png";
        }
    }
</script>

</body>
</html>
