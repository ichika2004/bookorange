# BookOrange - Web 系統 (V1)

一個用於書籍買賣的網頁系統，具備帳號註冊、商品管理與搜尋功能。

---

## 🔐 測試帳號 (V1)

| Email                | Password       |
|---------------------|----------------|
| test@gmail.com      | 11111111       |
| homo@gmail.com      | 1145141919810  |
| test2@gmail.com     | 11111111       |

---

## 📌 目前功能說明

### 🧑‍💻 帳號管理
- **註冊帳號**  
  使用 PHP 的 `password_hash()` 進行不可逆加密，保障使用者密碼安全。
- **登入帳號**  
  使用 `password_verify()` 驗證輸入密碼與資料庫中的 hash 是否相符。

### 🛍️ 商品操作
- **大廳展示**  
  隨機顯示商品資訊（未來將改良推薦排序邏輯）。
- **商品搜尋與篩選**  
  可依據「關鍵字」、「語言」與「類別」進行搜尋與過濾。
- **新增商品**  
  將商品資訊寫入 MySQL 資料庫 `bookOrangeDB`，圖片會儲存至 `product_img/` 資料夾。
- **編輯商品**  
  可修改商品資訊與圖片。若更換圖片，會自動刪除舊圖以節省空間。
- **刪除商品**  
  會先從 `SELL` 表格移除，接著刪除對應商品於 `Product` 表格與圖片檔案。

---

## ⚙️ 系統需求

- PHP 7.4 以上
- MySQL 5.7 以上
- Apache 或其他支援 PHP 的 Web Server
- 建議使用 XAMPP、MAMP、或 Docker 進行本地開發

---

## 🛠️ 安裝與使用方式

1. **下載專案**
   ```bash
   git clone https://github.com/your-username/bookorange-web.git
2. **建立資料庫**

使用 phpMyAdmin 或 CLI 匯入 bookOrangeDB.sql

資料庫名稱為 bookOrangeDB

3. **設定環境**

修改 config.php（或其他連線設定檔）中的資料庫連線資訊

4. **啟動伺服器**

使用 Apache 或其他方式啟動本地伺服器

瀏覽 http://localhost/bookorange-web/ 進行操作
