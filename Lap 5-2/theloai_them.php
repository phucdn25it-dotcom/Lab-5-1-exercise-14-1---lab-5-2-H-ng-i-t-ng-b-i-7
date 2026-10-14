<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/class/class.db.theloai.php';
$error = '';
$name = trim($_POST['ten_theloai'] ?? '');
$sort = filter_input(INPUT_POST, 'thu_tu', FILTER_VALIDATE_INT);
$show = filter_input(INPUT_POST, 'an_hien', FILTER_VALIDATE_INT);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($name === '' || $sort === false || $sort === null || !in_array($show, [0, 1], true)) {
        $error = 'Vui lòng nhập tên hợp lệ, thứ tự là số nguyên và chọn trạng thái.';
    } else {
        try {
            (new DB_TheLoai())->them_theloai($name, $sort, $show);
            header('Location: theloai.php?status=added'); exit;
        } catch (Throwable $e) { $error = 'Thêm thể loại không thành công. Hãy kiểm tra kết nối và dữ liệu.'; }
    }
}
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Thêm thể loại</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></head>
<body><main class="container py-4"><?php $currentPage = 'add'; require __DIR__ . '/view/menu.php'; ?><h1>Thêm thể loại</h1>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="post"><div class="form-group"><label for="ten">Tên thể loại</label><input class="form-control" id="ten" name="ten_theloai" required maxlength="255" value="<?= e($name) ?>"></div>
<div class="form-group"><label for="sort">Thứ tự</label><input class="form-control" id="sort" name="thu_tu" type="number" value="<?= e($_POST['thu_tu'] ?? '0') ?>" required></div>
<div class="form-group"><label for="show">Ẩn/Hiện</label><select class="form-control" id="show" name="an_hien"><option value="1" <?= (($_POST['an_hien'] ?? '1') === '1') ? 'selected' : '' ?>>Hiện</option><option value="0" <?= (($_POST['an_hien'] ?? '') === '0') ? 'selected' : '' ?>>Ẩn</option></select></div>
<button class="btn btn-primary" type="submit">Thêm thể loại</button> <a class="btn btn-secondary" href="theloai.php">Quay lại</a></form></main></body></html>
