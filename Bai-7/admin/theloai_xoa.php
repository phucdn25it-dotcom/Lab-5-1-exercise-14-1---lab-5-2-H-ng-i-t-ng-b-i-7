<?php
require_once __DIR__ . '/../class/class.db.theloai.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Phương thức không được hỗ trợ.'); }
$id = filter_input(INPUT_POST, 'idTL', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID thể loại không hợp lệ.'); }
try {
    (new DB_TheLoai())->xoa_theloai($id);
    header('Location: theloai.php');
} catch (Throwable $e) {
    http_response_code(500);
    exit('Không thể xóa thể loại. Hãy kiểm tra database.');
}
exit;
