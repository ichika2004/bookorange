# bookorange
BookOrange -web 

V1:
old Account to test:

Email: test@gmail.com
password: 11111111

Email: homo@gmail.com
password: 1145141919810

Email: test2@gmail.com
password: 11111111

目前v1功能：
註冊帳號，使用php的非對稱加密方式hash加密，所以無法解密
登錄帳號，用php的password_verify()檢測hash()的密碼
大廳展示隨機商品（待改良）
搜尋功能（能依照類別跟語言分類）:
---搜尋關鍵字後用語言跟類別篩選

新增商品資料（到資料庫bookOrangeDB與商品圖片資料夾product_img/）
編輯商品資料（更改圖片時會刪除原圖片檔）
刪除商品資料（先刪除SELL的資料再動Product），並且會刪除圖片資料夾內的對應商品圖
