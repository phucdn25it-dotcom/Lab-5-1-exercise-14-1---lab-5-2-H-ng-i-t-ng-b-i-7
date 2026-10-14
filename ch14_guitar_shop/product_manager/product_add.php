<?php include '../view/header.php'; ?>
<main>
    <h1>Add Product</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_product" />

        <label>Category:</label>
        <select name="category_id">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category->getID(); ?>">
                <?php echo $category->getName(); ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        <label>Code:</label>
        <input type="text" name="code" maxlength="10" required>
        <br>

        <label>Name:</label>
        <input type="text" name="name" required>
        <br>

        <label>List Price:</label>
        <input type="number" name="price" min="0" step="0.01" required>
        <br>

        <label>&nbsp;</label>
        <input class="button-primary" type="submit" value="Add Product">
        <br>
    </form>
    <p class="page_links"><a href="index.php">Back to Product List</a>
       <span aria-hidden="true">·</span> <a href="../index.php">Back to Main Menu</a></p>
</main>
<?php include '../view/footer.php'; ?>
