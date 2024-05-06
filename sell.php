<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sell</title>
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/form_upload.css">
    <link rel="stylesheet" type="text/css" href="style/preview_image.css">
</head>
<body>

<div class="navbar">   
    <a href="welcome.php"><img src='icon/orange_icon.png'></a>
    <a href="welcome.php">Home</a>
    <a href="sell.php">Sell</a>
    <a href="store.php">Your Store</a>
    <a href="logout.php" style="float:right">Logout</a>
    <p style="float:right; color:black; padding:14px 20px;">Welcome!<?php echo $_SESSION['username']; ?>！</p>

</div>

<div class="content">
    <fieldset>
        <legend><h2>Sell</h2></legend>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="sell_1">
                <div class='left'>
                    <div class="form-group">
                        <label for="p_img">Product Image(Click to upload)</label><br>

                        <input type="file" id="p_img" name="p_img" accept="image/*" onchange="preview_image(this, 'preview_img')" style="display: none;" required><br>
                        <img id="preview_img" src="icon/upload.png" alt="Image Preview" onclick="document.getElementById('p_img').click();"><br>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label for="pName">Product Name:</label><br>
                        <input type="text" id="pName" name="pName" required><br>
                    </div>
                    <div class="form-group">
                        <label for="unitPrice">Unit Price:</label><br>
                        <input type="number" id="unitPrice" name="unitPrice" min="0" required><br>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label><br>
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Select a Category</option>
                            <option value="Fiction & Literature">Fiction & Literature</option>
                            <option value="Business & Finance">Business & Finance</option>
                            <option value="Arts & Design">Arts & Design</option>
                            <option value="Social Sciences">Social Sciences</option>
                            <option value="Self-Help">Self-Help</option>
                            <option value="Religion & Spirituality">Religion & Spirituality</option>
                            <option value="Natural Sciences">Natural Sciences</option>
                            <option value="Health & Wellness">Health & Wellness</option>
                            <option value="Cooking">Cooking</option>
                            <option value="Lifestyle">Lifestyle</option>
                            <option value="Travel">Travel</option>
                            <option value="Children's & Young Adult">Children's & Young Adult</option>
                            <option value="Reference">Reference</option>
                            <option value="Parenting & Family">Parenting & Family</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Light Novel">Light Novel</option>
                            <option value="Comics & Graphic Novels">Comics & Graphic Novels</option>
                            <option value="Language Learning">Language Learning</option>
                            <option value="Test Preparation">Test Preparation</option>
                            <option value="Computers & Technology">Computers & Technology</option>
                            <option value="Textbooks & Government Publications">Textbooks & Government Publications</option>
                            <option value="Arts & Design">Arts & Design</option>
                            <option value="History & Geography">History & Geography</option>
                            <option value="Other">Other</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label for="language">Language:</label><br>
                        <select id="language" name="language" required>
                            <option value="" disabled selected>Select a Language</option>
                            <option value="English">English</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French">French</option>
                            <option value="German">German</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Korean">Korean</option>
                            <option value="Italian">Italian</option>
                            <option value="Portuguese">Portuguese</option>
                            <option value="Russian">Russian</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Dutch">Dutch</option>
                            <option value="Swedish">Swedish</option>
                            <option value="Polish">Polish</option>
                            <option value="Danish">Danish</option>
                            <option value="Norwegian">Norwegian</option>
                            <option value="Finnish">Finnish</option>
                            <option value="Greek">Greek</option>
                            <option value="Hebrew">Hebrew</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Indonesian">Indonesian</option>
                            <option value="Thai">Thai</option>
                            <option value="Turkish">Turkish</option>
                            <option value="Vietnamese">Vietnamese</option>
                            <option value="Other">Other</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label for="method">Shipping Method:</label><br>
                        <input type="checkbox" id="seller_delivery" name="method[]" value="Seller Delivery"> <label for="seller_delivery">Seller Delivery</label><br>
                        <input type="checkbox" id="convenience_store" name="method[]" value="Convenience Store"> <label for="convenience_store">Convenience Store</label><br>
                        <input type="checkbox" id="self_pickup" name="method[]" value="Self Pickup"> <label for="self_pickup">Self Pickup</label><br>
                    </div>
                    <div class="form-group">
                        <label for="payment">Payment Method:</label><br>
                        <input type="checkbox" id="credit_card" name="payment_method[]" value="Credit Card/Debit Card"> <label for="credit_card">Credit Card/Debit Card</label><br>
                        <input type="checkbox" id="bank_transfer" name="payment_method[]" value="Bank Transfer"> <label for="bank_transfer">Bank Transfer</label><br>
                        <input type="checkbox" id="cash_on_delivery" name="payment_method[]" value="Cash on Delivery"> <label for="cash_on_delivery">Cash on Delivery</label><br>
                        <input type="checkbox" id="paypal" name="payment_method[]" value="PayPal"> <label for="paypal">PayPal</label><br>
                        <input type="checkbox" id="mobile_payment" name="payment_method[]" value="Mobile Payment"> <label for="mobile_payment">Mobile Payment</label><br>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="p_intro">Product Description:</label><br>
                <textarea id="p_intro" name="p_intro" rows="4" required></textarea><br>
            </div>
            <div class="form-group">
                <input type="submit" value="Sell Product">
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



