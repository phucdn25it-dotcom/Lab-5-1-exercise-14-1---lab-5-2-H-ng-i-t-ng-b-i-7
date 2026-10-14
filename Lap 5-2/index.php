<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 5-2 | Quản lý thể loại</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container py-4">
    <?php $currentPage = 'home'; require __DIR__ . '/view/menu.php'; ?>
    <section class="jumbotron">
        <h1 class="display-4">Quản lý thể loại</h1>
        <p class="lead">Chọn một chức năng để bắt đầu làm việc với danh sách thể loại tin tức.</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg mr-2" href="theloai.php">Xem danh sách</a>
        <a class="btn btn-outline-primary btn-lg" href="theloai_them.php">Thêm thể loại</a>
    </section>
</main>
</body>
</html>
