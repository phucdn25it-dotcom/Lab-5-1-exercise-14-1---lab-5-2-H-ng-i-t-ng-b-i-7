<?php include '../view/header.php'; ?>
<main>
    <h1>Edit Product</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="update_product">
        <input type="hidden" name="product_id" value="<?php echo $product->getID(); ?>">
        <label>Category:</label>
        <select name="category_id">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category->getID(); ?>" <?php
                if ($category->getID() == $product->getCategory()->getID()) echo 'selected'; ?>>
                <?php echo htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
        </select><br>
        <label>Code:</label>
        <input type="text" name="code" maxlength="10" required value="<?php echo htmlspecialchars($product->getCode(), ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label>Name:</label>
        <input type="text" name="name" required value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label>List Price:</label>
        <input type="number" name="price" min="0" step="0.01" required value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label>&nbsp;</label>
        <input class="button-primary" type="submit" value="Update Product"><br>
    </form>
    <p class="page_links"><a href="index.php?category_id=<?php echo $product->getCategory()->getID(); ?>">Back to Product List</a></p>
</main>
<?php include '../view/footer.php'; ?>
