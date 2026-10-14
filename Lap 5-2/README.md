# Lab 5-2: Quản lý thể loại

Ứng dụng PHP/MySQL cho phép xem, thêm, sửa và xóa bản ghi trong bảng `theloai` của database `tintuc`.

## Chạy trên XAMPP

1. Chép thư mục `Lap 5-2` vào `C:\xampp\htdocs` (hoặc cấu hình Apache trỏ tới thư mục này).
2. Tạo database `tintuc` và bảng theo cấu trúc:

```sql
CREATE DATABASE IF NOT EXISTS tintuc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tintuc;
CREATE TABLE IF NOT EXISTS theloai (
    idTL INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TenTL VARCHAR(255) NOT NULL,
    ThuTu TINYINT NOT NULL DEFAULT 0,
    AnHien TINYINT(1) NOT NULL DEFAULT 1
);
```

3. Chỉnh thông tin kết nối trong `config.php` nếu MySQL của bạn dùng tài khoản khác.
4. Mở `http://localhost/Lap%205-2/theloai.php`.
