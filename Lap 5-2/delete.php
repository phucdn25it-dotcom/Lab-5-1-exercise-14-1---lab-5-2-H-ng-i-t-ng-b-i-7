<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/class/class.db.theloai.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Phương thức không được hỗ trợ.'); }
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID thể loại không hợp lệ.'); }
try {
    (new DB_TheLoai())->xoa_theloai($id);
    header('Location: theloai.php?status=deleted');
} catch (Throwable $e) {
    header('Location: theloai.php?status=delete_error');
}
exit;
