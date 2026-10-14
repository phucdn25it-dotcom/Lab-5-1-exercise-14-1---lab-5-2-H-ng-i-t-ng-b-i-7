<?php
require_once __DIR__ . '/../class/class.db.theloai.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Phương thức không được hỗ trợ.');
}

$name = trim($_POST['TenTL'] ?? '');
$sort = filter_input(INPUT_POST, 'ThuTu', FILTER_VALIDATE_INT);
$show = filter_input(INPUT_POST, 'AnHien', FILTER_VALIDATE_INT);
if ($name === '' || $sort === false || $sort === null || !in_array($show, [0, 1], true)) {
    exit('Vui lòng nhập tên, thứ tự hợp lệ và chọn trạng thái.');
}

$icon = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $icon = basename($_FILES['image']['name']);
    if (!move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/' . $icon)) {
        exit('Không thể lưu tệp icon.');
    }
}

try {
    (new DB_TheLoai())->them_theloai($name, $sort, $show, $icon);
    header('Location: theloai.php');
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    exit('Không thể thêm thể loại. Hãy kiểm tra database và dữ liệu.');
}
