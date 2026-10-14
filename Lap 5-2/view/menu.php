<?php $currentPage = $currentPage ?? ''; ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark rounded mb-4" aria-label="Điều hướng chính">
    <a class="navbar-brand" href="index.php">Lab 5-2</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link <?= $currentPage === 'home' ? 'active' : '' ?>" href="index.php">Trang chủ</a>
        <a class="nav-item nav-link <?= $currentPage === 'list' ? 'active' : '' ?>" href="theloai.php">Quản lý thể loại</a>
        <a class="nav-item nav-link <?= $currentPage === 'add' ? 'active' : '' ?>" href="theloai_them.php">Thêm thể loại</a>
    </div>
</nav>
