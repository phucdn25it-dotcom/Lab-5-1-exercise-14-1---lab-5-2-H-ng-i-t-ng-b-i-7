<?php
require_once __DIR__ . '/../class/class.db.theloai.php';
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
$id = filter_input(INPUT_GET, 'idTL', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID thể loại không hợp lệ.'); }
$db = new DB_TheLoai();
$matches = $db->get_theloai($id);
if (!$matches) { http_response_code(404); exit('Không tìm thấy thể loại.'); }
$category = $matches[0];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['TenTL'] ?? '');
    $sort = filter_input(INPUT_POST, 'ThuTu', FILTER_VALIDATE_INT);
    $show = filter_input(INPUT_POST, 'AnHien', FILTER_VALIDATE_INT);
    if ($name === '' || $sort === false || $sort === null || !in_array($show, [0, 1], true)) {
        $error = 'Vui lòng nhập tên, thứ tự hợp lệ và chọn trạng thái.';
        $category['TenTL'] = $name;
        $category['ThuTu'] = $_POST['ThuTu'] ?? '';
        $category['AnHien'] = $_POST['AnHien'] ?? 1;
    } else {
        $icon = $category['icon'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $icon = basename($_FILES['image']['name']);
            if (!move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/' . $icon)) {
                $error = 'Không thể lưu tệp icon.';
            }
        }
        if ($error === '') {
            try { $db->sua_theloai($id, $name, $sort, $show, $icon); header('Location: theloai.php'); exit; }
            catch (Throwable $e) { $error = 'Không thể cập nhật thể loại. Hãy kiểm tra database và dữ liệu.'; }
        }
    }
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sửa thể loại</title>
<style>body{font-family:Arial,sans-serif;background:#f2f4f7;margin:0;padding:30px}.container{max-width:700px;margin:auto;background:#fff;padding:30px 40px;border-radius:8px}.form-group{margin:16px 0}.form-group label{display:block;margin-bottom:6px;font-weight:bold}input,select{padding:8px;min-width:280px}.btn{padding:9px 16px}</style></head><body><main class="container">
<?php require __DIR__ . '/../view/menu.php'; ?><h2>Sửa thể loại</h2>
<?php if ($error): ?><p style="color:#b00"><?= e($error) ?></p><?php endif; ?>
<form method="post" enctype="multipart/form-data"><div class="form-group"><label for="name">Tên thể loại</label><input id="name" type="text" name="TenTL" required value="<?= e($category['TenTL']) ?>"></div>
<div class="form-group"><label for="sort">Thứ tự</label><input id="sort" type="number" name="ThuTu" required value="<?= e($category['ThuTu']) ?>"></div>
<div class="form-group"><label for="show">Ẩn/Hiện</label><select id="show" name="AnHien"><option value="1" <?= (int)$category['AnHien'] === 1 ? 'selected' : '' ?>>Hiện</option><option value="0" <?= (int)$category['AnHien'] === 0 ? 'selected' : '' ?>>Ẩn</option></select></div>
<div class="form-group"><label>Icon hiện tại</label><?php if (!empty($category['icon']) && is_file(__DIR__ . '/../image/' . basename($category['icon']))): ?><p><img src="../image/<?= rawurlencode(basename($category['icon'])) ?>" alt="" width="80"></p><?php else: ?><p>Không có</p><?php endif; ?></div>
<div class="form-group"><label for="image">Icon mới (không bắt buộc)</label><input id="image" type="file" name="image" accept="image/*"></div>
<button class="btn" type="submit">Cập nhật</button> <a href="theloai.php">Quay lại</a></form></main></body></html>
