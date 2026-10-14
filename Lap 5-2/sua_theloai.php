<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/class/class.db.theloai.php';
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID thể loại không hợp lệ.'); }
$db = new DB_TheLoai();
$rows = $db->get_theloai($id);
if (!$rows) { http_response_code(404); exit('Không tìm thấy thể loại.'); }
$category = $rows[0];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['ten_theloai'] ?? '');
    $sort = filter_input(INPUT_POST, 'thu_tu', FILTER_VALIDATE_INT);
    $show = filter_input(INPUT_POST, 'an_hien', FILTER_VALIDATE_INT);
    if ($name === '' || $sort === false || $sort === null || !in_array($show, [0, 1], true)) {
        $error = 'Vui lòng nhập tên hợp lệ, thứ tự là số nguyên và chọn trạng thái.';
        $category = array_merge($category, ['TenTL' => $name, 'ThuTu' => $_POST['thu_tu'] ?? '', 'AnHien' => $_POST['an_hien'] ?? '1']);
    } else {
        try { $db->sua_theloai($id, $name, $sort, $show); header('Location: theloai.php?status=updated'); exit; }
        catch (Throwable $e) { $error = 'Cập nhật không thành công. Hãy kiểm tra kết nối và dữ liệu.'; }
    }
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sửa thể loại</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></head>
<body><main class="container py-4"><?php $currentPage = 'list'; require __DIR__ . '/view/menu.php'; ?><h1>Cập nhật thể loại</h1><?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="post"><div class="form-group"><label for="ten">Tên thể loại</label><input class="form-control" id="ten" name="ten_theloai" required maxlength="255" value="<?= e($category['TenTL']) ?>"></div>
<div class="form-group"><label for="sort">Thứ tự</label><input class="form-control" id="sort" name="thu_tu" type="number" required value="<?= e($category['ThuTu']) ?>"></div>
<div class="form-group"><label for="show">Ẩn/Hiện</label><select class="form-control" id="show" name="an_hien"><option value="1" <?= (int)$category['AnHien'] === 1 ? 'selected' : '' ?>>Hiện</option><option value="0" <?= (int)$category['AnHien'] === 0 ? 'selected' : '' ?>>Ẩn</option></select></div>
<button class="btn btn-primary" type="submit">Cập nhật thể loại</button> <a class="btn btn-secondary" href="theloai.php">Quay lại</a></form></main></body></html>
