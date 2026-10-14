<?php
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (preg_match('~/(product_manager|product_catalog|cart)$~', $script_dir)) {
    $app_path = dirname($script_dir);
} else {
    $app_path = $script_dir;
}
$app_path = rtrim($app_path, '/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $app_path; ?>/main.css">
</head>
<body>
<header>
    <h1><a href="<?php echo $app_path; ?>/index.php">My Guitar Shop</a></h1>
    <nav class="site_navigation">
        <a href="<?php echo $app_path; ?>/index.php">Main Menu</a>
        <a href="<?php echo $app_path; ?>/product_manager/">Product Manager</a>
        <a href="<?php echo $app_path; ?>/product_catalog/">Product Catalog</a>
        <a href="<?php echo $app_path; ?>/cart/">Cart</a>
    </nav>
</header>
