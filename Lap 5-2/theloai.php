<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/class/class.db.theloai.php';

try {
    $categories = (new DB_TheLoai())->get_theloai();
} catch (Throwable $e) {
    http_response_code(500);
    $error = 'Không thể kết nối hoặc đọc dữ liệu. Hãy kiểm tra cấu hình MySQL và bảng theloai.';
    $categories = [];
}
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="vi"><head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị thể loại</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head><body><main class="container py-4"><?php $currentPage = 'list'; require __DIR__ . '/view/menu.php'; ?>
    <h1 class="mb-4">Quản trị thể loại</h1>
    <?php if (isset($error)): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
    <p><a class="btn btn-primary" href="theloai_them.php">Thêm thể loại</a></p>
    <?php if (!$categories && !isset($error)): ?>
        <div class="alert alert-info">Chưa có thể loại nào.</div>
    <?php elseif ($categories): ?>
    <div class="table-responsive"><table class="table table-bordered table-striped">
        <thead class="thead-light"><tr><th>Tên thể loại</th><th>Thứ tự</th><th>Ẩn hiện</th><th>Thao tác</th></tr></thead>
        <tbody><?php foreach ($categories as $item): ?><tr>
            <td><?= e($item['TenTL']) ?></td><td><?= e($item['ThuTu']) ?></td>
            <td><?= (int)$item['AnHien'] === 1 ? 'Hiện' : 'Ẩn' ?></td>
            <td class="text-nowrap"><a class="btn btn-sm btn-outline-primary" href="sua_theloai.php?id=<?= (int)$item['idTL'] ?>">Sửa</a>
                <form class="d-inline" method="post" action="delete.php" onsubmit="return confirm('Bạn có thực sự muốn xóa thể loại này?')">
                    <input type="hidden" name="id" value="<?= (int)$item['idTL'] ?>">
                    <button class="btn btn-sm btn-outline-danger" type="submit">Xóa</button>
                </form></td>
        </tr><?php endforeach; ?></tbody>
    </table></div><?php endif; ?>
</main></body></html>
