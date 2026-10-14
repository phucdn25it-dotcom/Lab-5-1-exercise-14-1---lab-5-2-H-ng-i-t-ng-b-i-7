<?php
require_once __DIR__ . '/../class/class.db.theloai.php';
$categories = (new DB_TheLoai())->get_theloai();
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Quản lý thể loại</title>
<style>body{font-family:Arial,sans-serif;margin:30px;background:#f5f5f5}.box{max-width:1000px;margin:auto;background:#fff;padding:25px;border-radius:8px}h2{text-align:center}a{color:#06c;text-decoration:none}table{width:100%;border-collapse:collapse;margin-top:20px}th,td{border:1px solid #ccc;padding:10px;text-align:center}th{background:#eee}img{max-width:70px;max-height:70px}.btn{display:inline-block;padding:8px 12px;background:#eee;border-radius:4px}</style></head>
<body><div class="box">
    <?php require __DIR__ . '/../view/menu.php'; ?>
    <h2>QUẢN LÝ THỂ LOẠI</h2>
    <p><a class="btn" href="theloai_them.php">+ Thêm thể loại</a></p>
    <?php if (!$categories): ?><p>Chưa có thể loại nào.</p><?php else: ?>
    <table><thead><tr><th>ID</th><th>Tên thể loại</th><th>Thứ tự</th><th>Ẩn/Hiện</th><th>Icon</th><th>Thao tác</th></tr></thead><tbody>
    <?php foreach ($categories as $row): ?><tr>
        <td><?= (int)$row['idTL'] ?></td><td><?= e($row['TenTL']) ?></td><td><?= e($row['ThuTu']) ?></td>
        <td><?= (int)$row['AnHien'] === 1 ? 'Hiện' : 'Ẩn' ?></td>
        <td><?php if (!empty($row['icon']) && is_file(__DIR__ . '/../image/' . basename($row['icon']))): ?><img src="../image/<?= rawurlencode(basename($row['icon'])) ?>" alt="Icon <?= e($row['TenTL']) ?>"><?php else: ?>Không có<?php endif; ?></td>
        <td><a href="theloai_sua.php?idTL=<?= (int)$row['idTL'] ?>">Sửa</a> |
            <form method="post" action="theloai_xoa.php" style="display:inline" onsubmit="return confirm('Bạn có chắc muốn xóa không?')"><input type="hidden" name="idTL" value="<?= (int)$row['idTL'] ?>"><button type="submit">Xóa</button></form></td>
    </tr><?php endforeach; ?></tbody></table><?php endif; ?>
</div></body></html>
